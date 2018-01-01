<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleWare
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
            
            if ($request->user()->hasRole('admin')) 
            {
                return $next($request);
            }
            abort(403);
            
        }
        
        
    }
}
