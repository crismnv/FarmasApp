<?php

namespace App\Http\Middleware;

use Closure;

class TrabajadorMiddleWare
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
        if (is_null($request->user()))
        {
            abort(403);
            return;
        }else{
            
            if ($request->user()->hasRole('admin') || $request->user()->hasRole('quimico')|| $request->user()->hasRole('trabajador')) 
            {
                return $next($request);
            }
            abort(403);
            
        }
    }
}
