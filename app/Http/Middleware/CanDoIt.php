<?php

namespace App\Http\Middleware;

use Closure;

class CanDoIt
{
    public function handle($request, Closure $next)
    {
        if (! canActivity()) {
            return redirect('admin/home');
        }
        // dd(234);

        // allow the request to pass through
        return $next($request);
    }
}
?>