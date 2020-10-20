<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
          switch (Auth::user()->roles->pluck('name')->first()) {
            case 'employee':
              return redirect()->route('applicationcheck');
              break;
            case 'employer':
              return redirect()->route('applicationcheck');
              break;
          }
            //return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
