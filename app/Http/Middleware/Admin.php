<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
//        dump(\Auth::check());
        if(!(\Auth::check()))
            return redirect()->route('adminlogin');
        if ($request->user()->isadmin == 1) {
            return $next($request);

        }
        return r_backerror('ليس لديك صلاحية الدخول');

    }
}
