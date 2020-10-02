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
              return redirect()->route('history');
              break;
            case 'employer':
              return 'applicationcheck';
              break;
            case 'admin':
              return 'adminpage';
              break;
          }
            //return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
