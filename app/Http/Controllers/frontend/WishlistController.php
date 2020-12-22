<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\frontend\Product;
use App\model\frontend\Khuyenmai;
use App\model\frontend\Chitiet_khuyenmai;
use DB;
use Auth;
class WishlistController extends Controller
{
    public function index($id){
         $km=Khuyenmai::join('chitiet_khuyenmai','khuyenmai.id','=','chitiet_khuyenmai.khuyenmai_id')->select('ngaybatdau','ngayketthuc','discount','product_id')->orderby('khuyenmai.id','asc')->get();
        $ct_wishlist=DB::table('chitiet_wishlist')->join('product','product.id','=','chitiet_wishlist.id_product')->where('id_wishlist',$id)->select('product.id as id_pro','chitiet_wishlist.id as id_wishlist','image','name','count','slug','price')->get();

        return view('pages.wishlist.index')->with('ct_wishlist',$ct_wishlist)->with('khuyenmai',$km);
    }
    public function insert($id){
        $product=Product::where('id',$id)->select('id')->first();
        $user=Auth::user()->id;
        $wishlist=DB::table('wishlist')->where('id_user',$user)->first();
        if($wishlist==null){
            $id_wishlist=DB::table('wishlist')->insertGetId(['id_user'=>$user]);
            DB::table("users")->where('id',$user)->update(['id_wishlist'=>$id_wishlist]);
        }else{
            $id_wishlist=$wishlist->id;
        }
        $wishlist_ct=DB::table('chitiet_wishlist')->join('wishlist','wishlist.id','=','chitiet_wishlist.id_wishlist')->where('id_user',$user)->where('id_product',$product->id)->count();
        if($wishlist_ct==0){
            DB::table('chitiet_wishlist')->insert(['id_product'=>$product->id,'id_wishlist'=>$id_wishlist]);
        }   
        return redirect()->route('wishlist.index',['id'=>$id_wishlist]);
    }
    public function delete($id){
        $wishlist_ct=DB::table('chitiet_wishlist')->where('id',$id)->first();
        $id_wishlist=$wishlist_ct->id_wishlist;
        DB::table('chitiet_wishlist')->where('id',$id)->delete();
        return redirect()->route('wishlist.index',['id'=>$id_wishlist]);
    }

}
