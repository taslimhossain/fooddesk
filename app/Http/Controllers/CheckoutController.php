<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDayException;
use App\OrderDayPickup;
use App\OrderLine;
use App\PickupTime;
use App\PickupTimeException;
use App\Product;
use App\Setting;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {

        $setting = Setting::firstOrFail();
        if ($setting->offline == 1) {
            return view('front.offline');
        }
        $cart = [];
        if ($request->session()->has('cart')) {
            $cart = $request->session()->get('cart');
        }
        // if (count($cart) == 0) {
        //     return redirect()->back()->with('error', 'Cart is empty');
        // }
        $exceptions = PickupTimeException::where(['from'=>'-1'])->whereDate('date','>=',now())
            ->get();
        $exceptions_dates  = $exceptions->pluck('date')->toArray();
        $users = User::whereType(0)->get();
        $exception_range = Setting::where('from_exception','!=',null)->select(['from_exception','to_exception'])->first();
        if ($exception_range){
            $period = CarbonPeriod::create($exception_range->from_exception,$exception_range->to_exception);
            foreach ($period as $date) {
                $exceptions_dates[] = $date->format('Y-m-d');
            }
        }
        $holidays= $this->getMonthHoliday(now()->timestamp);
        $exceptions_dates = array_merge($exceptions_dates,$holidays);
        //
        return view('front.checkout', compact('cart', 'users'))->with(['exceptions_dates'=>$exceptions_dates]);
    }
    public function updateBilling()
    {
        $user = User::find(request()->id);
        return view('front.dynamicBilling', compact('user'));
    }

    public function getMonthHoliday($timestamp){

        $date = date('Y-m-d',$timestamp);
        $pickupTime = PickupTime::groupBy('day')->get();
        $pickUpDays = $pickupTime->pluck('day')->toArray();
        $days = [0,1,2,3,4,5,6];
        $holidays= array_diff($days,$pickUpDays);
        if (count($holidays)>0){
            Carbon::setWeekendDays($holidays);
            $weekEnds = [];
            $weekDate = Carbon::parse($date)->subMonth();

            for ($i=0;$i<=30;$i++){
                $weekEnds[$i] = $weekDate->nextWeekendDay()->format('Y-m-d');
                $weekDate = Carbon::parse($weekEnds[$i]);
            }
            $exception_range = Setting::where('from_exception','!=',null)->select(['from_exception','to_exception'])->first();
            $exceptions_dates=[];
            if ($exception_range){
                $period = CarbonPeriod::create($exception_range->from_exception,$exception_range->to_exception);
                foreach ($period as $date) {
                    $exceptions_dates[] = $date->format('Y-m-d');
                }
            }
            if (request()->ajax()){
                return response()->json(['weekends'=>array_merge($weekEnds,$exceptions_dates)]);
            }else{
                return $weekEnds;
            }
        }else{
            if (request()->ajax()){
                return response()->json(['weekends'=>false]);
            }else{
                return [];
            }
        }

    }


    public function checkDate(Request $request)
    {
        // return $request->date;
        //check next delivery date
        $dt = new DateTime();
        $day = date('N', strtotime($dt->format('D'))) % 7;
        $pickup_date = date_create($request->date);
        $diff = date_diff($dt, $pickup_date);


        if ($diff->format("%R") == '-') {
            return [
                "err" => "Choose different day"
            ];
        }
        $pickup = OrderDayPickup::where('day', '=', $day)->first();
        $pickupException = OrderDayException::where('date', '=', $dt->format('y-m-d'))->get();
        if ($pickupException->count() > 0) {
            $pickup = $pickupException[0];
        }

        if ($diff->format("%a") < ($pickup->pickup - 1)) {
            return [
                "err" => "Choose greater day"
            ];
        }
        $setting=Setting::first();
        if($request->date>=$setting->from_exception&&$request->date<=$setting->to_exception){
            return [
                "err" => "Choose different day"
            ];
        }
        $times = PickupTimeException::where('date', '=', $request->date)->get();
        if ($times->count() > 0) {
            foreach ($times as $time) {
                if ($time->from == "-1") {
                    return [
                        "err" => "Choose greater day"
                    ];
                }
            }
            return [
                "success" => $times
            ];
        }
        $times = PickupTime::where('day', '=', date('N', strtotime($pickup_date->format('D'))) % 7)->get();
        if ($times->count() < 1) {
            return [
                "err" => "Choose different day"
            ];
        }
        return [
            "success" => $times
        ];
        //check holiday


    }
    public function checkoutSubmit(Request $request)
    {
        $user_id = 0;
        $cart = $request->session()->get('cart');
        if (!$cart) {
            $cart = [];
        }
        if (count($cart) == 0) {
            return back()->with('error', 'cart is empty');
        }
        $msg = "";
        if ($request->create_account) {

            $validator = Validator::make($request->all(), [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6'],
            ]);
            if ($validator->fails()) {
                if(strlen($request['password']>5)){

                    return redirect()->back()->with('error', 'Email already exist');
                }
                else{
                    return redirect()->back()->with('error', 'The length of password must be atleast 6 ');

                }
            }
            $subject = Setting::firstOrFail()->signup_title;
        $body = Setting::firstOrFail()->signup_message;
        $email=$request['email'];
        $from_email = Setting::firstOrFail()->from_email;
        $data = array("body" => $body);
        Mail::send('mail', $data, function ($message) use ($subject, $email, $from_email) {
            $message->to($email)
                ->from($from_email)
                ->subject($subject);
        });
            $user = User::create([
                'firstname' => $request['firstname'],
                'lastname' => $request['lastname'],
                'address1' => $request['address1'],
                'address2' => "",
                'zip' => $request['zip'],
                'town' => $request['town'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'type' => 0,
                'telephone'=>$request->phone
            ]);
            $user_id=$user->id;
            $msg = "Account created successfully";
            $user->sendEmailVerificationNotification();
            //  $user->
        }

        $shipping_different = 0;
        if (auth()->check()) {
            $user_id = auth()->id();
        }
        if ($request->user_id) {
            $user_id = $request->user_id;
        }
        //validate
        if ($request->shipping_different) {
            $shipping_different = 1;
            $s_firstname = $request->s_firstname;
            $s_lastname = $request->s_lastname;
            $s_email = $request->s_email;
            $s_phone = $request->s_phone;
            $s_company = $request->s_company;
            $s_company_number = $request->s_company_number;
            $s_address1 = $request->s_address1;
            $s_address2 = $request->s_address2;
            $s_town = $request->s_town;
            $s_zip = $request->s_zip;
        } else {
            $s_firstname = $request->firstname;
            $s_lastname = $request->lastname;
            $s_email = $request->email;
            $s_phone = $request->phone;
            $s_company = $request->company;
            $s_company_number = $request->company_number;
            $s_address1 = $request->address1;
            $s_address2 = $request->address2;
            $s_town = $request->town;
            $s_zip = $request->zip;
        }
        //create order
        $order = Order::create([
            "user_id" => $user_id,
            "status" => 0,
            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "email" => $request->email,
            "phone" => $request->phone,
            "company" => $request->company,
            "company_number" => $request->company_number,
            "address1" => $request->address1,
            "address2" => $request->address2,
            "town" => $request->town,
            "zip" => $request->zip,
            "shipping_different" => $shipping_different,
            "s_firstname" => $s_firstname,
            "s_lastname" => $s_lastname,
            "s_email" => $s_email,
            "s_phone" => $s_phone,
            "s_company" => $s_company,
            "s_company_number" => $s_company_number,
            "s_address1" => $s_address1,
            "s_address2" => $s_address2,
            "s_town" => $s_town,
            "s_zip" => $s_zip,
            "date" => $request->date,
            "dayname" => $request->dayname,
            "hour" => $request->hour,
            "minute" => $request->minute,
            "total" => $request->total,
            "message" => $request->message,
            "give_invoice" => $request->give_invoice ? 1 : 0
        ]);
        //create orderline

        foreach ($cart as $item) {

            if ($item["product"]->sell_product_option == "per_unit") {
                $price = $item["product"]->price_per_unit;
            } elseif ($item["product"]->sell_product_option == "weight_wise") {
                $price = $item["product"]->price_weight;
            } else {
                $price = $item["product"]->price_per_person;
            }
            OrderLine::create([
                "order_id" => $order->id,
                "product_id" => $item["id"],
                "quantity" => $item["quantity"],
                "price" => $price,
                "message" => $item["msg"]
            ]);
        }
        //if user new account

        //clear the cart
        $cart = [];
        $request->session()->put('cart', $cart);

        //to user
        $subject = Setting::firstOrFail()->order_place_title;
            $body = Setting::firstOrFail()->order_place_body;
            $body=implode($order->firstname.' '.$order->lastname,explode('#name',$body));
            $body=implode($order->id,explode('#id',$body));
            $body=implode($order->created_at->format('d-m-Y'),explode('#date',$body));
            $body=implode($order->date->format('D m/d') . " on " . $order->hour . ":" . $order->minute,explode('#pickup',$body));
        $detail="<table style='border:1px solid black;width: 100%;border-collapse: collapse;'>";
        foreach($order->orderLines as $item)
        {
            $detail.='<tr>
            <td style="padding:3px;border:1px solid black">';
            if($item[ "product" ]->sell_product_option=="weight_wise"){
                $detail.=$item["quantity"]>999?($item["quantity"]/1000)."kg":$item["quantity"]."gr";
            }

            elseif($item["product"]->sell_product_option=="per_unit")
            {
                $detail.=$item["quantity"]."stuk" ;
            }
            else {
                $detail.=$item["quantity"]."person";
            }

            $detail.='</td>';
            $detail.='<td style="padding:3px;border:1px solid black">'.$item->product->product_name_dch.'</td>';
            $detail.='<td style="padding:3px;border:1px solid black">';
            if($item["product"]->sell_product_option=="weight_wise")
            {
                $detail.='€'.number_format((float)$item["product"]->price_weight*1000, 2, ',', '').'/kg';
            }
            elseif($item["product"]->sell_product_option=="per_unit")
            {
                $detail.='€'.number_format((float)$item["product"]->price_per_unit,
                        2, ',', '').'/ stuk';
            }
            else {
                $detail.='€'.number_format((float)$item["product"]->price_per_person, 2, ',', '').'/person';
            }
            $detail.='</td>
                <td style="border:1px solid black;padding:3px;">';
            if($item["product"]->sell_product_option=="weight_wise")
            {
                $detail.='€'.number_format((float)$item["product"]->price_weight*$item["quantity"], 2, ',', '');
            }
            elseif($item["product"]->sell_product_option=="per_unit"){
                $detail.='€'.number_format((float)$item["product"]->price_per_unit*$item["quantity"],
                        2, ',', '');
            }
            else {
                $detail.='€'.number_format((float)$item["product"]->price_per_person*$item["quantity"], 2, ',', '');
            }
            $detail.='</td>
        </tr>';
        }
        $detail.='<tr>


           <td colspan="3" style="text-align:center;border:1px solid black;padding:3px;" >Totaal</td>
           <td style="border:1px solid black;padding:3px;">€'.$order->total.'</td>
           </tr></table>';
            $body=implode($detail,explode('#detail',$body));
            $body=implode('€'.$order->total,explode('#total',$body));
            $from_email = Setting::firstOrFail()->from_email;


            $email = $order->email;
            $data = array("body" => $body);
            Mail::send('mail', $data, function ($message) use ($subject, $email, $from_email) {
                $message->to($email)
                    ->from($from_email)
                    ->subject($subject);
            });


            //to admin
            $subject = Setting::firstOrFail()->order_admin_title;
            $body = Setting::firstOrFail()->order_admin_body;
            $body=implode($order->firstname.' '.$order->lastname,explode('#name',$body));
            $body=implode($order->id,explode('#id',$body));
            $body=implode($order->created_at->format('d-m-Y'),explode('#date',$body));
            $body=implode($order->date->format('D m/d') . " on " . $order->hour . ":" . $order->minute,explode('#pickup',$body));
            $email = Setting::firstOrFail()->order_email;
            $data = array("body" => $body);
            Mail::send('mail', $data, function ($message) use ($subject, $email, $from_email) {
                $message->to($email)
                    ->from($from_email)
                    ->subject($subject);
            });


        return redirect()->back()->with('success', 'Order placed successfully ' . $msg);
        //redirect to order success
    }
}
