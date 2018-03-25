<?php

namespace App\Http\Middleware;

use Closure;

class UserVerifiedMiddleware
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
        if(!auth()->user()->confirmed){
            $notification = 'Debe validar su correo electronico antes de continuar';
            return redirect('/home')->with(compact('notification'));
        }
        
        return $next($request);
    }
}
