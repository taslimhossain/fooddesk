<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{

    public function signup()
    {
        return view('front.signup');
    }
    public function myAccount()
    {
        $setting = Setting::firstOrFail();
        if ($setting->offline == 1) {
            return view('front.offline');
        }
        if (!auth()->check()) {
            return redirect('/signup?ref=my-account');
        }
        if (!auth()->user()->email_verified_at&&auth()->user()->type==0) {

            auth()->user()->sendEmailVerificationNotification();

            return redirect('/signup')->withError("Your email is not verified. Check your email");
        }
        $user = Auth()->user();

        return view('front.myAccount', compact('user'));
    }
    public function myOrder(Order $order)
    {
        if (auth()->user()->id != $order->user_id) {
            return redirect()->back()->withError("Unable to access");
        }
        return view('front.myOrder', compact('order'));
    }
    public function signin(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            if (auth()->user()->type == 0) {
                if (!auth()->user()->email_verified_at) {

                    auth()->user()->sendEmailVerificationNotification();

                    return redirect('/signup')->withError("Your email is not verified. Check your email");
                }
                return redirect($request->ref);
            } else {
                return redirect("/orders");
            }
        } else {
            return redirect('/signup')->withError("Invalid Email or Password");
        }
    }
    public function updateAddress(Request $request)
    {
        $request->validate([
            'address1' => ['required'],
            'address2' => ['required'],
            'town' => ['required'],
            'zip' => ['required']

        ]);
        $user_id = Auth::User()->id;
        $obj_user = User::find($user_id);
        $obj_user->address1 = $request->address1;
        $obj_user->address2 = $request->address2;
        $obj_user->town = $request->town;
        $obj_user->zip = $request->zip;
        $obj_user->save();
        return redirect()->back()->with("success", "User address updated successfully");
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            'firstname' => ['required'],
            'lastname' => ['required'],
            'email'=>'required|email|unique:users,email,' .auth()->id(),
            'confirm_mail'=>'nullable|email|same:email',

        ]);
        $user_id = Auth::User()->id;
        $old_email = auth()->user()->email;

        $obj_user = User::find($user_id);
        $obj_user->firstname = $request->firstname;
        $obj_user->lastname = $request->lastname;
        if ($request->password) {
            if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
                return redirect()->back()->withError("Your current password does not matches with the password you provided. Please try again.");
            }
            if (strlen($request->password) < 6) {
                return redirect()->back()->withError("Length of new password must be at least 6");
            }
            if ($request->password != $request->password_confirmation) {
                return redirect()->back()->withError("Password doesn't match");
            }
            $obj_user->email = $request->input('email');
            $obj_user->password = Hash::make($request['password']);
            if ($request->input('email')!=$old_email){
                $obj_user->email_verified_at=null;
                auth()->user()->sendEmailVerificationNotification();
            }
        }
        $obj_user->save();
        return redirect()->back()->with("success", "User information updated successfully");
    }
    public function wishlist(Request $request)
    {
        $setting = Setting::firstOrFail();
        if ($setting->offline == 1) {
            return view('front.offline');
        }
        $lists = [];
        if ($request->session()->has('wishlists')) {
            $lists = $request->session()->get('wishlists');
        }
        $products = Product::whereIn('fid', $lists)->get();
        return view('front.wishlist', compact('products'));
    }
    public function cart(Request $request)
    {
        $setting = Setting::firstOrFail();
        if ($setting->offline == 1) {
            return view('front.offline');
        }
        $cart = [];
        if ($request->session()->has('cart')) {
            $cart = $request->session()->get('cart');
        }

        return view('front.cart', compact('cart'));
    }
    public function removeCart(Request $request)
    {
        $cart = $request->session()->get('cart');
        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i]["id"] == $request->id) {
                unset($cart[$i]);
            }
        }
        $request->session()->put('cart', $cart);
        return "Successfully removed from Cart";
    }
    public function addToCart(Request $request)
    {
        $product = Product::where('fid', '=', $request->id)->first();
        if ($request->session()->has('cart')) {
            $cart = $request->session()->get('cart');
            $exist = false;
            for ($i = 0; $i < count($cart); $i++) {
                if ($cart[$i]["id"] == $request->id) {
                    $cart[$i]["quantity"] += $request->weight == "KG" ? $request->quantity * 1000 : $request->quantity;
                    $cart[$i]["msg"] .= " " . $request->msg;
                    $exist = true;
                }
            }
            if (!$exist) {
                array_push($cart, [
                    "id" => $request->id,
                    "quantity" => $request->weight == "KG" ? $request->quantity * 1000 : $request->quantity,
                    "msg" => $request->msg,
                    "weight" => $request->weight,
                    "product" => $product
                ]);
            }
            $request->session()->put('cart', $cart);
        } else {
            $cart = array([
                "id" => $request->id,
                "quantity" => $request->weight == "KG" ? $request->quantity * 1000 : $request->quantity,
                "msg" => $request->msg,
                "weight" => $request->weight,
                "product" => $product
            ]);
            $request->session()->put('cart', $cart);
        }
        return "Successfully added to Cart";
    }
    public function addToWishList($fid, Request $request)
    {
        if ($request->session()->has('wishlists')) {
            $wishlist = $request->session()->get('wishlists');
            array_push($wishlist, $fid);

            $request->session()->put('wishlists',  array_unique($wishlist));
        } else {
            $wishlist = array($fid);
            $request->session()->put('wishlists', $wishlist);
        }
        return "Successfully added to wishlist";
    }
    public function removeFromWishList($fid, Request $request)
    {
        $wishlist = $request->session()->get('wishlists');
        $wishlist = array_diff($wishlist, [$fid]);
        $request->session()->put('wishlists',  array_unique($wishlist));
        return "Successfully removed from wishlist";
    }
}
