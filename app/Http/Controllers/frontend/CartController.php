<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use App\model\frontend\Product;
class CartController extends Controller
{
      public function show_cart(){
   		return view('pages.cart.show_cart');
   }
     public function add_cart_ajax(Request $request){
     	$data=$request->all();
   	
   		$session_id=substr(md5(microtime()),rand(0,26),5);
   		$cart=Session::get('cart');

   		if($cart==true){

   			$is_avaliable=0;
   			foreach ($cart as $key => $value) {
   				if($value['product_id']==$data['cart_product_id']){
   					$cart[$key]['product_qty']=$cart[$key]['product_qty']+1;
   					$is_avaliable++;									
   				}
   			}
   		Session::put('cart',$cart); 	
   			if($is_avaliable==0){
   				$cart[]=array(
   					'session_id'=>$session_id,
   					'product_name'=>$data['cart_product_name'],
   					'product_id'=>$data['cart_product_id'],
   					'product_image'=>$data['cart_product_image'],
   					'product_price'=>$data['cart_product_price'],
   					'product_qty'=>$data['cart_product_qty'],
                  'product_slug'=>$data['cart_product_slug']
   				);
   				Session::put('cart',$cart);
   			}
   		}
   		else{
   			$cart[]=array(
   					'session_id'=>$session_id,
   					'product_name'=>$data['cart_product_name'],
   					'product_id'=>$data['cart_product_id'],
   					'product_image'=>$data['cart_product_image'],
   					'product_price'=>$data['cart_product_price'],
   					'product_qty'=>$data['cart_product_qty'],
                 'product_slug'=>$data['cart_product_slug']
   				);
   			}
   		Session::put('cart',$cart);
   		Session::save();
         return response()->json(Session::get('cart'));
   }
   public function add_cart(Request $request){
      $data=$request->all();

      $session_id=substr(md5(microtime()),rand(0,26),5);
      $cart=Session::get('cart');

      if($cart==true){
            $is_avaliable=0;
            foreach ($cart as $key => $value) {
               if($value['product_id']==$data['id']){
                  $cart[$key]['product_qty']=$cart[$key]['product_qty']+$data['count'];
                  $is_avaliable++;                          
               }
            }
            // Session::put('cart',$cart);
            // Session::save(); 
               if($is_avaliable==0){
               $cart[]=array(
                  'session_id'=>$session_id,
                  'product_name'=>$data['name'],
                  'product_id'=>$data['id'],
                  'product_image'=>$data['image'],
                  'product_price'=>$data['price'],
                  'product_qty'=>$data['count'],
                  'product_slug'=>$data['slug']
               );
               // Session::put('cart',$cart);
               // Session::save(); 
            }

         }
         else{
            $cart[]=array(
                  'session_id'=>$session_id,
                  'product_name'=>$data['name'],
                  'product_id'=>$data['id'],
                  'product_image'=>$data['image'],
                  'product_price'=>$data['price'],
                  'product_qty'=>$data['count'],
                  'product_slug'=>$data['slug']
               );
            }  
            Session::put('cart',$cart);
            Session::save(); 
            return redirect()->route('show.cart');
   }
   public function delete_cart($session_id){
   		$cart=Session::get('cart');
   		if($cart==true){
   			foreach ($cart as $key => $value) {
   				if($value['session_id']==$session_id){
   					unset($cart[$key]);
   				}
   			}
		Session::put('cart',$cart);
      Session::save(); 
		return redirect()->back()->with('message','Xóa sản phẩm khỏi giỏ hàng thành công!');
   		}
   		else{
   			return redirect()->back()->with('message','Xóa sản phẩm that bai!');
   		}  		 		
   }
   public function update_cart(Request $request){
   		$data=$request->all();
   		$cart=Session::get('cart');
   		if($cart==true){
   			foreach ($data['cart_qty'] as $key => $qty) {
   				foreach ($cart as $session => $value) {
   					if($value['session_id']==$key&&$qty!=null){
   						$cart[$session]['product_qty']=$qty;
   					}
   				}

   			}
   			Session::put('cart',$cart);
   			return redirect()->back()->with('message','Cập nhật thành công');
   		}else{
   			return redirect()->back()->with('message','Cập nhật thất bại');
   		}
   }
   public function delete_all_cart(){
   		$cart=Session::get('cart');
   		if($cart==true){
   			Session::forget('cart');
   			return redirect()->back()->with('message','Xóa hết giỏ hàng thành công');
   		}
   }

}
