<?php

namespace App\Http\Middleware;

use Closure;

class Profile
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
        if ($request->id != auth()->user()->id) {
            return redirect('home')->with('error','You are not the owner of this profile');
        }
        return $next($request);
}
}
