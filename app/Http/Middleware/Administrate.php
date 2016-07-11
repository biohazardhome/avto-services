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
        if (!Gate::allows('adminAccess') && !$request->is('admin/login')) {
            // return response('Unauthorized.', 401);
            return redirect('/admin/login');
        }
        return $next($request);
    }
}
