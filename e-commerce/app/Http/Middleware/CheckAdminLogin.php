<?php


namespace App\Http\Middleware;


use App\User;
use Closure;
class CheckAdminLogin
{
    public function handle($request, Closure $next)
    {
        if(auth()->user()){
            $user = User::find(auth()->user()->id);
            if ($user->role == 'admin' || $user->role == 'sub-admin') {
                return redirect('/admin/dashboard');
            }
        }
        return $next($request);
    }
}