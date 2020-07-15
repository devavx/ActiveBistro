<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminAuthenticated
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
        if (Auth::user()->role->name!='admin') {
            return redirect('/home')->with('message','OOPS!! You are not allowed for access to this page');
        }
        return $next($request);
    }
}
