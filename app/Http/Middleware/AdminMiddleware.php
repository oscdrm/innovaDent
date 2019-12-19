<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        if(!auth()->check()){
            return redirect('/login');
        }

        if((!auth()->user()->role()->id == 1) || (!auth()->user()->role()->name == 'Admin')){
            return redirect('/login');
        }

        return $next($request);
    }
}
