<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Http\Response;
class AdminAuthenticated
{
    public function handle($request, Closure $next)
    {
        if (!auth()->user()) {
            return redirect('/admin/login');
        } else {
            $user = User::find(auth()->user()->id);
            if ($user->role != 'admin' && $user->role != 'sub-admin') {
                return redirect('/user-home');
            }
        }
        return $next($request);
    }

}