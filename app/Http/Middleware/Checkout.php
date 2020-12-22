<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
class Checkout
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
        if(Auth::check()&&Auth::user()->active==2)
        {
            if(Session::get('cart')==true)
            {
                return $next($request);
            }
            else{
                return redirect()->route('show.cart');
            }
        }else{
            return redirect()->route('get.login');
        }
    }
}
