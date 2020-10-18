<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Setting;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected function redirectTo()
    {
        //use your own route
        return URL::to('/signup?success=1');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $subject = Setting::firstOrFail()->signup_title;
        $body = Setting::firstOrFail()->signup_message;
        $email=$data['email'];
        $from_email = Setting::firstOrFail()->from_email;
        $dt = array("body" => $body);
        Mail::send('mail', $dt, function ($message) use ($subject, $email, $from_email) {
            $message->to($email)
                ->from($from_email)
                ->subject($subject);
        });
        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'address1' => $data['address1'],
            'address2' => "",
            'telephone' => $data['telephone'],
            'zip' => $data['zip'],
            'town' => $data['town'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => 0
        ]);
    }
}
