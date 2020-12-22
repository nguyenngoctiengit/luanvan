<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class UserRole
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
        if(Auth::check()&&Auth::user()->active==1||Auth::check()&&Auth::user()->active==2)
        {
            return $next($request);
        }else{
            return redirect()->route('get.login');
        }
    }
}
