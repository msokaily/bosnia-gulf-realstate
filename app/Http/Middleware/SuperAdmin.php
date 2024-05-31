<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */


    public function handle($request, Closure $next, $guard='admin')
    {
        $remember_me = $request->has('remember') ? true : false; 
        if (Auth::viaRemember()) {
            return $next($request);
        }
        
        if (Auth::guard($guard)->check() && auth()->user()->role == 'Admin' && auth()->user()->super_admin){
            return $next($request);
        }
     
        return redirect('admin/login');
    }
}
