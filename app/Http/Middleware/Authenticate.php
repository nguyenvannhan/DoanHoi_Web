<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\View;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()) {
            $user = Auth::user();
            $userInfo = $user->Student;
            $userName = !is_null($user->Student) ? $user->Student->name : 'Admin';
            View::share('user', $user);
            View::share('userInfo', $userInfo);
            View::share('userName', $userName);
            return $next($request);
        }
        return redirect()->route('get_login_route');
    }
}
