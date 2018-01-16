<?php

namespace App\Http\Middleware;

use Closure;

class Access
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param string $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if ($role == 'admin') {
            if ($request->user()->role != 'admin') {
                abort(404);
            }
        }
        return $next($request);
    }
}
