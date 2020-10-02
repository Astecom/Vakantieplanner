<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
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
      
      if(Auth::user()->hasRole('admin')){
        return $next($request);
      }
      else{
        dd("You don't have permission to see this page");
      }
    }


}
