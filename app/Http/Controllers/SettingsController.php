<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\OrderDayException;
use App\OrderDayPickup;
use App\PickupTime;
use App\PickupTimeException;
use App\Setting;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Symfony\Component\Process\Process;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        $setting = Setting::firstOrFail();
        if (auth()->user()->type == 1) {
            return view('settings.edit', compact('setting'));
        } else {
            return view('settings.editManager', compact('setting'));

        }
    }

    public function userList()
    {
        return view('admin.user.list');
    }

    public function emailSetting()
    {
        $setting = Setting::firstOrFail();

        return view('settings.email', compact('setting'));
    }

    public function viewUser(User $user)
    {
        return view('admin.user.details', compact('user'));
    }

    public function editUser(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User deleted');
    }

    public function updateUser(Request $request)
    {
        $user = User::find($request->id);
        $user->update($request->all());
        return redirect()->back()->with('success', 'User updated');

    }

    public function userData()
    {
        $data = User::whereType(0)->latest()->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                $btn = '<div class="btn-group"><a href="' . URL::to('/') . '/users/' . $row->id . '" class="btn btn-sm btn-outline-primary">View</a><a href="' . URL::to('/') . '/edit-user/' . $row->id . '" class="btn btn-sm btn-outline-warning">Edit</a><a href="' . URL::to('/') . '/delete-user/' . $row->id . '" onclick="return confirm(' . "'Are you sure you want to delete this item?'" . ')" class="btn btn-sm btn-outline-danger">Remove</a>
                               </div>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('settings.create');
    }

    public function orderSetting()
    {
        $day0 = OrderDayPickup::where('day', '=', 0)->first();
        $day1 = OrderDayPickup::where('day', '=', 1)->first();
        $day2 = OrderDayPickup::where('day', '=', 2)->first();
        $day3 = OrderDayPickup::where('day', '=', 3)->first();
        $day4 = OrderDayPickup::where('day', '=', 4)->first();
        $day5 = OrderDayPickup::where('day', '=', 5)->first();
        $day6 = OrderDayPickup::where('day', '=', 6)->first();
        $days = ['m.sunday', 'm.monday', 'm.tuesday', 'm.wednesday', 'm.thursday', 'm.friday', 'm.saturday',];
        $orderDayExceptions = OrderDayException::latest()->get();
        $pickupTimes = PickupTime::orderBy('day')->get();
        $pickupTimeExceptions = PickupTimeException::orderBy('date')->get();
        $setting = Setting::first();
        return view('settings.order', compact('setting', 'pickupTimeExceptions', 'days', 'pickupTimes', 'orderDayExceptions', 'day0', 'day1', 'day2', 'day3', 'day4', 'day5', 'day6'));
    }

    public function pickupTime(Request $request)
    {

        PickupTime::whereNotNull('id')->delete();
        if ($request->day) {
            $days = [];
            for ($i = 0; $i < count($request->day); $i++) {
                if ($request->from[$i] == 'closed'||$request->from[$i] == 'none'):
                    continue;
                else:
                    $days[] = [
                        "day" => $request->day[$i],
                        "from" => $request->from[$i],
                        "to" => $request->to[$i],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                endif;
            }
            PickupTime::insert($days);
        }
        return redirect()->back()->with('success', 'Pickup Times updated successfully');
    }

    public function pickupTimeException(Request $request)
    {
        PickupTimeException::whereNotNull('id')->delete();
        if ($request->date) {
            for ($i = 0; $i < count($request->date); $i++) {
                PickupTimeException::create(
                    [
                        "date" => $request->date[$i],
                        "from" => $request->from[$i],
                        "to" => $request->to[$i],
                    ]
                );
            }
        }
        return redirect()->back()->with('success', 'Pickup Times updated successfully');
    }

    public function pickupTimeExceptionRange(Request $request)
    {
        if ($request->to < $request->from) {
            return redirect()->back()->with('error', 'Invalid format');
        }
        $setting = Setting::first();
        $setting->update([
            "from_exception" => $request->from,
            "to_exception" => $request->to
        ]);
        return redirect()->back()->with('success', 'Pickup Times updated successfully');

    }

    public function orderPickup(Request $request)
    {
        for ($i = 0; $i < 7; $i++) {
            $day = OrderDayPickup::where('day', '=', $i)->first();
            $day->update([
                "min_time" => $request["min_time" . $i],
                "pickup" => $request["pickup" . $i]
            ]);
        }
        return redirect()->back()->with('success', 'Order Pickup time updated successfully');
    }

    public function orderPickupException(Request $request)
    {
        OrderDayException::whereNotNull('id')->delete();
        if ($request->date) {
            for ($i = 0; $i < count($request->date); $i++) {
                OrderDayException::create(
                    [
                        "date" => $request->date[$i],
                        "min_time" => $request->min_time[$i],
                        "pickup" => $request->pickup[$i],
                    ]
                );
            }
        }
        return redirect()->back()->with('success', 'Order Pickup Exception updated successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();

        Setting::create($requestData);

        return redirect('settings')->with('flash_message', 'Setting added!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $setting = Setting::findOrFail($id);

        return view('settings.show', compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $setting = Setting::findOrFail($id);

        return view('settings.edit', compact('setting'));
    }

    public function changePassword()
    {
        return view('admin.changePassword');
    }

    public function changeEmail()
    {
        return view('admin.changeEmail');
    }

    public function updatePassword(Request $request)
    {
        $user_id = Auth::User()->id;
        $obj_user = User::find($user_id);
        if ($request->old_email) {
            if (auth()->user()->email != $request->old_email) {
                return redirect()->back()->withError("Wrong Email");
            }
            if (!$request->new_email) {
                return redirect()->back()->withError("Email Required");
            }
            if ($request->new_email != $request->confirm_email) {
                return redirect()->back()->withError("Email Doesn't Match");
            }
            $obj_user->email = $request->new_email;
        }
        if ($request->old_password) {
            if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
                return redirect()->back()->withError("Your current password does not matches with the password you provided. Please try again.");
            }
            if (strlen($request->password) < 6) {
                return redirect()->back()->withError("Length of new password must be at least 6");
            }
            if ($request->password != $request->password_confirmation) {
                return redirect()->back()->withError("Password doesn't match");
            }
            $obj_user->password = Hash::make($request['password']);
        }
        $obj_user->save();
        return redirect()->back()->with("success", "Account updated successfully");
    }

    public function adminList()
    {
        $admins = User::whereType(2)->get();
        return view('admin.adminList', compact('admins'));
    }

    public function addAdmin()
    {
        return view('admin.createAdmin');
    }

    public function deleteAdmin(User $user)
    {
        $user->delete();

        return redirect()->route('adminList')->with('success', 'Admin deleted successfully');
    }

    public function insertAdmin(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        User::create([
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'address1' => "",
            'address2' => "",
            'zip' => "",
            'town' => "",
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'type' => 2
        ]);
        return redirect()->route('adminList')->with('success', 'New admin added successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        if ($request->logo_img) {
            $path = time() . '.' . $request->logo_img->getClientOriginalExtension();
            $request->logo_img->move(public_path('images'), $path);
            $request["logo"] = $path;
        }

        if ($request->fav_icon_img) {
            $path = 'f' . time() . '.' . $request->fav_icon_img->getClientOriginalExtension();
            $request->fav_icon_img->move(public_path('images'), $path);
            $request["fav_icon"] = $path;
        }

        if ($request->banner_img) {
            $path = 'b1pda' . time() . '.' . $request->banner_img->getClientOriginalExtension();
            $request->banner_img->move(public_path('images'), $path);
            $request["banner"] = $path;
        }
        if ($request->banner_img2) {
            $path = 'b2' . time() . '.' . $request->banner_img2->getClientOriginalExtension();
            $request->banner_img2->move(public_path('images'), $path);
            $request["banner2"] = $path;
        }
        if ($request->banner_img3) {
            $path = 'b3' . time() . '.' . $request->banner_img3->getClientOriginalExtension();
            $request->banner_img3->move(public_path('images'), $path);
            $request["banner3"] = $path;
        }
        if ($request->banner_img4) {
            $path = 'b4' . time() . '.' . $request->banner_img4->getClientOriginalExtension();
            $request->banner_img4->move(public_path('images'), $path);
            $request["banner4"] = $path;
        }
        if ($request->banner_img5) {
            $path = 'b5' . time() . '.' . $request->banner_img5->getClientOriginalExtension();
            $request->banner_img5->move(public_path('images'), $path);
            $request["banner5"] = $path;
        }

        if ($request->sticky_logo_img) {
            $path = 's' . time() . '.' . $request->sticky_logo_img->getClientOriginalExtension();
            $request->sticky_logo_img->move(public_path('images'), $path);
            $request["sticky_logo"] = $path;
        }

        if ($request->default_product_img) {
            $path = 'd' . time() . '.' . $request->default_product_img->getClientOriginalExtension();
            $request->default_product_img->move(public_path('images'), $path);
            $request["default_product"] = $path;
        }
        if ($request->input('wishList', false)) {
            $request['wishList'] = true;
        } else {
            $request['wishList'] = false;
        }

        $requestData = $request->all();

        $setting = Setting::findOrFail($id);
        $hour = $setting->cron_hour;
        $minute = $setting->cron_minute;
        $setting->update($requestData);
        if ($request->cron_hour) {
            if ($request->cron_hour != $hour || $request->cron_minute != $minute) {
                exec('php artisan schedule:run');
            }
        }

        return redirect()->back()->with('flash_message', 'Setting updated!');
    }

    public function removeBanner()
    {
        $setting = Setting::first();
        if (request()->id == 1) {
            $setting->update([
                "banner" => ""
            ]);
        }
        if (request()->id == 2) {
            $setting->update([
                "banner2" => ""
            ]);
        }
        if (request()->id == 3) {
            $setting->update([
                "banner3" => ""
            ]);
        }
        if (request()->id == 4) {
            $setting->update([
                "banner4" => ""
            ]);
        }
        if (request()->id == 5) {
            $setting->update([
                "banner5" => ""
            ]);
        }
        return "deleted";
    }
    public function removeLogo()
    {
        $setting = Setting::first();
        if (request()->type == 'logo') {
            $setting->update([
                "logo" => ""
            ]);
        }else{
            $setting->update([
                "sticky_logo" => ""
            ]);
        }
        return "deleted";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Setting::destroy($id);

        return redirect('settings')->with('flash_message', 'Setting deleted!');
    }
}
