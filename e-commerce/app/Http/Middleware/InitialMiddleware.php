<?php


namespace App\Http\Middleware;
use App\Setting;
use Closure;

class InitialMiddleware
{
    public function handle($request, Closure $next)
    {
        $setting =Setting::orderBy('id','DESC')->first();
        $uri = $request->path();
        view()->share('setting', $setting);
        view()->share('uri', $uri);
        if($request->user()){
            view()->share('user', $request->user());
        }
        return $next($request);
    }
}