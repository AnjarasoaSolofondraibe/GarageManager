<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Rolemiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if(! in_array(auth()->user()->role, $roles)) {
            abort(403, 'Accès refusé');
        }
        
        return $next($request);
    }
}
