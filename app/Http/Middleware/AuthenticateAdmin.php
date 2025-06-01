<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateAdmin
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
        if (!Auth::check() || Auth::user()->Роль !== 'admin') {
            return redirect('/login')->with('error', 'Доступ запрещен. Пожалуйста, войдите в систему.');
        }

        return $next($request);
    }
}
