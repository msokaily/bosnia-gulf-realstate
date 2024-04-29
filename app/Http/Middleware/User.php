<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */


    public function handle($request, Closure $next, $guard='')
    {
        if (Auth::viaRemember()) {
            return $next($request);
        }
        
        if (Auth::guard($guard)->check() && in_array(Auth::guard($guard)->user()->role, ['User'])){
            return $next($request);
        }
     
        return redirect('login');
    }
}
