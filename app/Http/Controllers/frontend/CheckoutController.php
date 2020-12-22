<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\frontend\Order;
use App\model\frontend\Order_detail;
use App\model\frontend\Shipping;
use App\model\frontend\Product;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;
use Session;
use Validator;
use Mail;
use PDF;

class CheckoutController extends Controller
{
   public function getCheckout(){
      $ttkh=\Auth::user();
      return view('pages.checkout.checkout')->with('ttkh',$ttkh);
   }

   public function postCheckout(Request $request){
      $validator= Validator::make($request->all(), [
         'name'=>'required|min:5|max:50',
         'phone'=>'required|digits:10',
         'address'=>'required|min:15|max:100',
      ],[
         'name.required'=>'Vui lòng nhập họ tên!',
         'name.max'=>"Họ tên tối đa 50 ký tự!",
         'name.min'=>"Họ tên ít nhất 5 ký tự!",
         'phone.required'=>'Vui lòng nhập số điện thoại!',
         'phone.digits'=>'Số điện thoại gồm 10 chữ số',     
         'address.required'=>'Vui lòng nhập địa chỉ nhận hàng',
         'address.min'=>'Địa chỉ gồm ít nhât 15 ký tự',
         'address.max'=>'Địa chỉ gồm nhiều nhât 100 ký tự',
      ]);
      if ($validator->fails())
      {       
         return response()->json(array('success'=>0,'error'=>$validator->getMessageBag()));
      }   
      $cart=Session::get('cart');
         $product_0=array();
         $i=0;
         foreach ($cart as $key => $value) {
            $product=Product::where('id',$value['product_id'])->first();
            if($product->count<$value['product_qty']){
               $product_0[$i]=['id'=>$product->id,'count'=>$value['product_qty']-$product->count];
            }
            $i++;
         }
         if(count($product_0)>0){
            return response()->json(array('success'=>1,'product_0'=>$product_0,'sl_sp'=>$i,'cart'=>$cart));
         }
         $data=$request->all();
         $shipping=new Shipping();
         $shipping->name=$data['name'];
         $shipping->email=$data['email'];
         $shipping->address=$data['address'];
         $shipping->phone=$data['phone'];
         $shipping->payment=$data['method'];
         $shipping->notes=$data['notes'];
         $shipping->save();

         $shipping_str=$shipping->payment==1?"Thanh toán tiền mặt":"Thanh toán chuyển khoản";

         $total=0;
         foreach ($cart as $key => $value) {
           $total+=$value['product_price']*$value['product_qty'];
        }
        $order=new Order();
        $order->user_id=\Auth::user()->id;
        $order->shipping_id=$shipping->id;
        $order->status=1;
        $order->created_at=now('Asia/Ho_Chi_Minh');
        $order->total=$total;
        $order->save();
        $ttdh='';
        foreach ($cart as $key => $value) {
         $product=Product::where('id',$value['product_id'])->first(); 
         $count=$product->count-$value['product_qty'];       
         $order_detail=new Order_detail();
         $order_detail->order_id=$order->id;
         $order_detail->product_id=$value['product_id'];
         $order_detail->price=$value['product_price'];
         $order_detail->quantity=$value['product_qty'];
         $order_detail->save();
         $url=public_path().'/uploads/product/'.$product->image;
        
         $ttdh.='<tr style="text-align:center">
          <td>'.$product->name.'</td>
           <td><img width="100px" src="'.$url.'"</td>
          <td>'. $order_detail->price.'</td>
          <td>'.$order_detail->quantity.'</td>
          <td>'.(number_format($order_detail->price*$order_detail->quantity)).' VND</td>
          </tr>';
          
      }
     $html= '<!DOCTYPE html>
       <html>
       <head>
       <meta charset="UTF-8">
         <title></title>
         <style>
          body{font-family:DejaVu Sans,sans-serif}
         </style>
       </head>
      <body>
      <h2 style="text-align:center">THÔNG TIN ĐƠN HÀNG</h2>
    <table>     
        <tr>
        <td style="width:40%">
        <table style="float:top">
        <tr>
        <th style="text-align:left">Mã đơn hàng</th>
        <td>:</td>
        <td>'.$order->id.'</td>
        </tr>

        <tr style="text-align:left">
        <th style="text-align:left">Tổng tiền</th>
        <td>:</td>
        <td>'.(number_format($order->total)).' VND</td>
        </tr>

        <tr style="text-align:left">
        <th style="text-align:left">Ngày đặt</th>
        <td>:</td>
        <td>'.$order->created_at.'</td>
        </tr>
        </table>
        </td>


        <td style="width:60%">
        <table> 
        <caption style="text-align:left;"><b>Thông tin người đặt:</b></caption>
        <tr>
        <th style="text-align:left;width:120px">Tên</th>
        <td>:</td>
        <td>'.$shipping->name.'</td>
        </tr>
        <tr>
        <th style="text-align:left">Địa chỉ nhận hàng</th>
        <td>:</td>
        <td>'.$shipping->address.'</td>
        </tr>
        
        <tr>
        <th style="text-align:left">Số phone:</th>
        <td>:</td>
        <td>'.$shipping->phone.'</td>
        </tr>

        <tr>
        <th style="text-align:left">Email:</th>
        <td>:</td>
        <td>'.$shipping->email.'</td>
        </tr>

        <tr>
        <th style="text-align:left">Ghi chú:</th>
        <td>:</td>
        <td>'.$shipping->notes.'</td>
        </tr>

        <tr>
        <th style="text-align:left">Thanh toán:</th>
        <td>:</td>
        <td>'.$shipping_str.'</td>
        </tr>
        </table>
        </td>
        </tr> 
        
    </table>
    <h3 style="text-align:center">Nội dung đặt hàng</h3>
      <table style="width:100%">      
        <tr>
          <th style="width:200px">Tên sản phẩm</th>
          <th>Hình</th>
          <th>Giá</th>
          <th>SL</th>
          <th>Thành tiền</th>
        </tr> 
        ';
         $html.=$ttdh;
          $html.='
          </table>
          </body>
          </html>
          ';
        $pdf=\App::make('dompdf.wrapper');
        $pdf=PDF::setOptions ([
             'logOutputFile' => Storage_path ( 'log / log.htm' ),
             'tempDir' => Storage_path ( 'log /' )
        ])->loadHTML($html)->save('order.pdf');
       $email = $request->email;
         $data=['data'=>$order];
         Mail::send('pages.email.checkout',$data,function($message) use ($email){
           $message->to($email,'Xác nhận đơn mua hàng')->subject('Xác nhận đơn mua hàng');
          $message->attach("order.pdf");
         });

      Session::forget('cart');
      return response()->json(array('success'=>2,'order'=>$order->id));
   }
   public function showDanhgia(Request $request,$id){
      $product=DB::table('order_detail')->join('product','product.id','=','order_detail.product_id')->where('order_id',$id)->select('name','image','product.id')->get();
      return view('pages.checkout.danhgia')->with('product',$product);
   }
   public function storeDanhgia(Request $request){
      $data=$request->all();
      foreach($data['product_id'] as $key => $value)
      {
        $rate=$data['select'][$value];
        $rate_cur=DB::table('danhgia')->where('id_product',$value)->first();
        switch ($rate) {
          case 1:
            $number_rate=$rate_cur->one_rate+1;
            DB::table('danhgia')->where('id_product',$value)->update(['one_rate'=>$number_rate]);
            break;
           case 2:
            $number_rate=$rate_cur->two_rate+1;
            DB::table('danhgia')->where('id_product',$value)->update(['two_rate'=>$number_rate]);
            break;
             case 3:
            $number_rate=$rate_cur->three_rate+1;
            DB::table('danhgia')->where('id_product',$value)->update(['three_rate'=>$number_rate]);
            break;
             case 4:
           $number_rate=$rate_cur->four_rate+1;
            DB::table('danhgia')->where('id_product',$value)->update(['four_rate'=>$number_rate]);
            break;
             case 5:
           $number_rate=$rate_cur->five_rate+1;
            DB::table('danhgia')->where('id_product',$value)->update(['five_rate'=>$number_rate]);
            break;
          default:
            break;
        }
      }
      return redirect()->route('show.cart')->with('message','Cảm ơn bạn đã dành thời gian đánh sản phẩm của chúng tôi!');
  }
     
}
