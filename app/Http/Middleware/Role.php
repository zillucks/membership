<?php

namespace App\Http\Middleware;

use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // if (!$request->user() || !$request->user()->hasRole($roles)) {
        //     return redirect()->intended('/');
        // }
        if (!in_array($request->user()->currentRole(), $roles)) {
            if($request->ajax() || $request->wantsJson()) {
				return response('Unauthorized!!!', 401);
			}
			else {
				return redirect()->intended('/');
			}
        }
        return $next($request);
    }
}
