<?php

namespace App\Http\Middleware;

use Closure;

class PremiumMiddleware
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
        if(auth()->user()->admin){
            return $next($request);
        }

        if(auth()->user()->is_premium()){
            return $next($request);
        }

        return redirect('/users/premium');
    }
}
