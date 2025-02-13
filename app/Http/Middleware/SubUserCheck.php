<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        // dd('OK');
        if(auth()->user()->user_type=='admin'){
            return $next($request);
        }elseif(auth()->user()->user_type=='subadmin'){
            return $next($request);
        }else{
           return redirect('/login');
        }
    }
}
