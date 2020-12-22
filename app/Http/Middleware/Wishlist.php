<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use DB;
class Wishlist
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
        // dd($request->id);
        if(Auth::check())
        {
             $id_user=Auth::user()->id;
             $id=$request->id;
             $idproduct=$request->idproduct;
             $idctwishlist=$request->idctwishlist;
             if($idproduct!=null){
                 return $next($request);
             }
             if($idctwishlist!=null){
                $a=DB::table('wishlist')->join('chitiet_wishlist','chitiet_wishlist.id_wishlist','=','wishlist.id')->where('id_user',$id_user)->where('chitiet_wishlist.id',$idctwishlist)->count();
                if($a>0){
                     return $next($request);
                 }else{
                     return redirect()->route('home');
                 }
             }
             $count=DB::table('wishlist')->where('id_user',$id_user)->where('id',$id)->count();
            if($count==0){
                return redirect()->route('home');
            }
            return $next($request);
        }
        else{
            return redirect()->route('get.login');
        }
    }
}
