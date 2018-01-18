<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AdminAuthentication
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

        if(Auth::user()->level == 1 || Auth::user()->student_id == 'admin') {
            return $next($request);
        }
        return redirect()->back();
    }
}
