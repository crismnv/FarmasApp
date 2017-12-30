<?php

namespace App\Http\Middleware;

use Closure;

class ClienteMiddleware
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
        try{
            if ($request->user()->hasRole('admin') ||  $request->user()->hasRole('cliente') ) 
            {
                return $next($request);
            }
            abort(403);
        } catch (Exception $e) {
            abort(403);
        }
    }
}
