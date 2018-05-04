<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class super
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
//        auth()->check() && auth()->user()->name == 'admin';
        if (Auth::user()->name != 'admin'){
            return redirect()->intended()->with('danger','您不是超级管理员');
        }
        return $next($request);
    }
}
