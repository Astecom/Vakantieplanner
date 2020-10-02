<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class application
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
        if(Auth::user() == null){
          return redirect()->to('login');
        }
        else if(Auth::user()->hasRole('employee') || Auth::user()->hasRole('admin')){
          return $next($request);
        }
        else{
          dd('Sorry, we have an error with your role. Is it new?');
        }
    }


}
