<?php

namespace App\Http\Controllers\Auth;

use App\Setting;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/user-home';

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
            'name' => ['required', 'string', 'max:255'],
            'sign_username' => 'required|string|max:100|unique:users,username',
            'sign_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'sign_password' => ['required', 'string', 'min:6'],
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
        $setting = Setting::latest()->first();
        $ref = Session::get('ref');
        if($ref) {
            $ref = substr($ref,5);
        }
        $user = User::create([
            'name' => $data['sign_username'],
            'username' => $data['sign_username'],
            'email' => $data['sign_email'],
            'password' => Hash::make($data['sign_password']),
            'mobile' => $data['mobile'],
            'credit_balance' => $setting->sign_up_credit,
            'singUp_credit' => $setting->sign_up_credit,
            'referral_id' => $ref ? $ref : null
        ]);
        if($ref) {
            $referUser = User::find($ref);
            $countOfReferral = User::whereReferral_id($ref)->count();
            if($countOfReferral < 20) {
                $referUser->update([
                    'credit_balance' => ($referUser->credit_balance + $setting->referral_get_credit),
                    'referral_credit' => ($referUser->referral_credit + $setting->referral_get_credit)
                ]);
            }
            Session::forget('ref');
        }
        $mailData = [
            'name' => $data['sign_username'],
        ];
        $this->sendEmail('email.email-welcome',$mailData ,'Welcome to BillboardBd', $data['sign_email']);
        return  $user;

    }
}
