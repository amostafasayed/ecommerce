<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cart;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/user-home';
    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }

    public function findUsername()
    {
        $login = request()->input('login');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        request()->merge([$fieldType => $login]);

        return $fieldType;
    }

    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }

    protected function authenticated(Request $request, $user)
    {
        if(!$user->is_active){
            Auth::logout();
            return redirect('/');
        }
        if(($user->role === 'admin' || $user->role === 'sub-admin') && $request->input('from') == 'ad'){
            return redirect('/admin/dashboard');


        }else if($user->role === 'user' && $request->input('from') == 'st'){
            Cart::merge(auth()->user()->id);
            return redirect('/user-home');

        }else {
            Auth::logout();
            return redirect('/');
        }
    }

    public function logout(Request $request)
    {
        $this->cartStore();
        $this->guard()->logout();
        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }

    public function eraseCartItem($identifier) {
        $instanceItem = DB::table('shoppingcart')->whereIdentifier($identifier)->first();
        if($instanceItem){
            DB::table('shoppingcart')->whereIdentifier($identifier)->delete();
        }

    }

    public function cartStore() {
        if(auth()->user()->id){
            $this->eraseCartItem(auth()->user()->id);
            if(Cart::content()->count()){
                Cart::store(auth()->user()->id);
            }
        }
    }
}
