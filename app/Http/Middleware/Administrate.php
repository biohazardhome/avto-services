<?php

namespace App\Http\Middleware;

use Closure;
use Gate;

class Administrate
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
        if (!Gate::allows('adminAccess')) {
            // return response('Unauthorized.', 401);
            return redirect('/login');
        }
        return $next($request);
    }
}
