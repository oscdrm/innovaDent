<?php

namespace App\Http\Middleware;

use Closure;

class DoctorMiddleware
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
        if(auth()->user()->role->id == 3){
            return redirect('/home');
        }
        return $next($request);
    }
}
