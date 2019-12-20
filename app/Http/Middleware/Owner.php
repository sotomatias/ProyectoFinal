<?php

namespace App\Http\Middleware;

use Closure;

class Owner
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
        if(auth()->user()->typeofuser === 3 || auth()->user()->typeofuser === 2){
            return $next($request);
        }
            return redirect('home')->with('error',"You don't have admin access");
        }
    }