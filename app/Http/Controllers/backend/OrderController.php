<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
use App\model\backend\Product;
use App\model\backend\Order;
use Carbon\Carbon;
class OrderController extends Controller
{
   public function AuthLogin(){
        $id = Session::get('id');
        if($id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
     public function thongke(Request $request){
        $this->AuthLogin();

        $select_date=null;
        $select_date=$request->select_date;
        $x=Carbon::now();
        if($select_date!=null){
            $x=Carbon::create($select_date);
        }
        //Thông kê tiền mỗi ngày
        $listDay=Order::getListDayInMonth($x->year,$x->month);
        $doanhthuMonth=DB::table('tbl_order')->where('status','3')->whereYear('created_at',$x->year)->whereMonth('created_at',$x->month)->select(\DB::raw('sum(total) as totalMoney'),\DB::raw('DATE(created_at) day'))->groupBy('day')->get()->toArray();
         $doanhthuMonthDefault=DB::table('tbl_order')->where('status','1')->whereYear('created_at',$x->year)->whereMonth('created_at',$x->month)->select(\DB::raw('sum(total) as totalMoney'),\DB::raw('DATE(created_at) day'))->groupBy('day')->get()->toArray();
        $arrdoanhthuMonth=[];
        $arrdoanhthuMonthDefault=[];
        foreach($listDay as $day){
            
            $total=0;
            foreach ($doanhthuMonth as $key => $value) {
               if($day==$value->day){

                $total=$value->totalMoney;
                break;
               }
            }
            $arrdoanhthuMonth[]=(int)$total;

             $total=0;
              foreach ($doanhthuMonthDefault as $key => $value) {
               if($day==$value->day){
                $total=$value->totalMoney;
                break;
               }
            }
            $arrdoanhthuMonthDefault[]=(int)$total;
        }

        //Thống kê trạng thái đơn hàng
        $status_count_1=DB::table('tbl_order')->where('status','1')->select('id')->count();
        $status_count_2=DB::table('tbl_order')->where('status','2')->select('id')->count();
        $status_count_3=DB::table('tbl_order')->where('status','3')->select('id')->count();
        $status_count_0=DB::table('tbl_order')->where('status','0')->select('id')->count();
        $status_thongke=[
            ['Chưa xử lý',$status_count_1,false],
            ['Đã xử lý',$status_count_2,false],
            ['Đã hoàn thành',$status_count_3,false],
            ['Đã hủy',$status_count_0,false],
        ];
        //Thống kê số đơn hàng trong 1 tháng
         $all_count_order=DB::table('tbl_order')->whereYear('created_at',$x->year)->whereMonth('created_at',$x->month)->select('id')->count();
         //Thông kê doanh thu 1 tháng
         $total_doanhthu=DB::table('tbl_order')->where('status','3')->whereYear('created_at',$x->year)->whereMonth('created_at',$x->month)->select(\DB::raw('sum(total) as totalMoney'))->first();
        //Thống kê đơn hàng thành công trong 1 tháng
         $all_count_order_status_3=DB::table('tbl_order')->where('status','3')->whereYear('created_at',$x->year)->whereMonth('created_at',$x->month)->select('id')->count();
        $dsuser = DB::table('admin')->get();
        //Thống kê số khách hàng đã đặt hàng trong 1 tháng
        $all_kh=DB::table('tbl_order')->whereYear('created_at',$x->year)->whereMonth('created_at',$x->month)->select('user_id')->distinct()->count('user_id');
        // dd($request);
        $manager_order  = view('admin.thongke_order')->with('dsuser',$dsuser)->with('listDay',json_encode($listDay))->with('arrdoanhthuMonth',json_encode($arrdoanhthuMonth))->with('arrdoanhthuMonthDefault',json_encode($arrdoanhthuMonthDefault))->with('status_thongke',json_encode($status_thongke))->with('request',$request)->with('all_count_order',$all_count_order)->with('total_doanhthu',$total_doanhthu)->with('all_count_order_status_3',$all_count_order_status_3)->with('all_kh',$all_kh);
        return view('admin.admin_layout',compact('dsuser'))->with('admin.thongke_order', $manager_order);
    }
    public function index(Request $request){
    	 $this->AuthLogin();
        $status=null;
        $status=$request->select_status;
        $request_tk=null;
        if($status==null||$status==-1){
    	 $all_order=DB::table('tbl_order')->leftjoin('admin','admin.id','=','tbl_order.admin_id')->select('tbl_order.*','name')->orderby('id','desc')->paginate(10);
        }else{
            $all_order=DB::table('tbl_order')->leftjoin('admin','admin.id','=','tbl_order.admin_id')->where('status',$status)->select('tbl_order.*','name')->orderby('id','desc')->paginate(10)->appends(request()->query());
        }
    	  $dsuser = DB::table('admin')->get();
    	 $manager_order  = view('admin.all_order')->with('all_order',$all_order)->with('dsuser',$dsuser)->with('status',$status)->with('request_tk',$request_tk);
    	return view('admin.admin_layout',compact('dsuser'))->with('admin.all_order', $manager_order);
    }
    public function check($id){
        $this->AuthLogin();
        $donhang=DB::table('tbl_order')->where('id',$id)->first();
        $all_ct_dh=DB::table('order_detail')->where('order_id',$id)->get();
        $flag=true;
        $arr=array();
        foreach ($all_ct_dh as $key => $value) {
            $product=Product::where('id',$value->product_id)->first();
            if($product->count<$value->quantity){
                $flag=false;
                $mes=array('name'=>$product->name,'count'=>$product->count,'quantity'=>$value->quantity);
                array_push($arr,$mes);
            }
        }
        if($flag==true){
            $message="Đơn hàng này có thể duyệt";
        }
        else{
            $message=$arr;
        }
        return response()->json(array('flag'=>$flag,'message'=>$message));
    }
    public function update(Request $request,$id){
    	$this->AuthLogin();
        $donhang=DB::table('tbl_order')->where('id',$id)->first();
        $arr_message=[];
        $message="";
        if($donhang->status==1)
        {
            $name_duyet=DB::table('admin')->where('id',Session::get('id'))->first()->name;
            if($request->status==2){
                $flag=true;
                $all_ct_dh=DB::table('order_detail')->where('order_id',$id)->get();
                foreach ($all_ct_dh as $key => $value)
                {   
                    $product=Product::where('id',$value->product_id)->first();
                    if($product->count<$value->quantity){
                        $flag=false;
                        break;
                    }
                }
                if($flag==true){
                    foreach ($all_ct_dh as $key => $value)
                    {   
                        $product=Product::where('id',$value->product_id)->first();
                        $product->count=$product->count-$value->quantity;
                         $product->save();
                    }
                    DB::table('tbl_order')->where('id',$id)->update(['status'=>$request->status,'admin_id'=>Session::get('id')]);
                     return response()->json(array('name'=>$name_duyet,'status'=>'1','success'=>$flag,'message'=>'Đơn hàng đã chuyển từ trạng thái chưa xử lý sang trạng thái duyệt thành công'));
                }
                else{
                    return response()->json(array('status'=>'1','success'=>$flag,'message'=>'Sản phẩm cung ứng thiếu không thể duyệt đơn hàng! Bạn vui lòng kiểm tra lại!'));
                }
            }
            elseif($request->status==3){
                 return response()->json(array('status'=>'1','message'=>'Đơn hàng không thể chuyển từ trạng thái chưa xử lý sang trạng thái hoàn thành!'));
            }
            elseif($request->status==1){
                 return response()->json(array('status'=>'1','message'=>'Đơn hàng đã ở trạng thái chưa xử lý, bạn hãy thay đổi trạng thái khác!'));
            }
            else{
                DB::table('tbl_order')->where('id',$id)->update(['status'=>$request->status]);
                 return response()->json(array('name'=>$name_duyet,'status'=>'1','message'=>'Đơn hàng đã chuyển từ trạng thái chưa xử lý sang trạng thái hủy thành công!'));
            }

        }elseif($donhang->status==2){
             if($request->status==0){
                $all_ct_dh=DB::table('order_detail')->where('order_id',$id)->get();
                foreach ($all_ct_dh as $key => $value)
                {
                    $product=Product::where('id',$value->product_id)->first();
                        $product->count=$product->count+$value->quantity;
                        $product->save();
                        DB::table('tbl_order')->where('id',$id)->update(['status'=>$request->status]);
                }
                 return response()->json(array('status'=>'2','message'=>'Đơn hàng đã chuyển từ trạng thái duyệt sang hủy thành công'));
             }
             elseif($request->status==1){
                return response()->json(array('status'=>'2','message'=>'Đơn hàng đã duyệt không thể chuyển sang trạng thái chưa xử lý! Bạn vui lòng kiểm tra lại!'));
             }
             elseif($request->status==2){
                return response()->json(array('status'=>'2','message'=>'Đơn hàng đã duyệt! Bạn không thể duyệt lần 2'));
             }
             else{
                 DB::table('tbl_order')->where('id',$id)->update(['status'=>$request->status]);
                 return response()->json(array('status'=>'2','message'=>'Đơn hàng đã chuyển từ trạng thái duyệt sang trạng thái hoàn thành thành công'));
             }
        }
        else{
            if($donhang->status==0)
            return response()->json(array('status'=>'0','message'=>'Đơn hàng hiện tại đã hủy'));
            else
                return response()->json(array('status'=>'3','message'=>'Đơn hàng hiện tại đã hoàn thành'));
        }
    }
    public function show_chitiet_donhang($id){
    	$this->AuthLogin();
    	$all_ct_donhang=DB::table('order_detail')->where('order_id',$id)->join('product','product.id','=','product_id')->select('name','image','order_detail.price as price','quantity')->get();
    	$shipping=DB::table('tbl_order')->where('tbl_order.id',$id)->join('shipping','tbl_order.shipping_id','=','shipping.id')->select('shipping.*')->first();
    	$all_donhang=array('all_ct_donhang'=>$all_ct_donhang,'shipping'=>$shipping);
    	return response()->json($all_donhang);
    }

    public function search(Request $request){
        $this->AuthLogin();
        if($request->select_status==null||$request->select_status==-1){
         $all_order=DB::table('tbl_order')->leftjoin('admin','admin.id','=','tbl_order.admin_id')->join('shipping','shipping.id','=','tbl_order.shipping_id')->where('tbl_order.id','like','%'.$request->id_order.'%')->where('created_at','like','%'.$request->date_order.'%')->where('shipping.phone','like','%'.$request->phone_order.'%')->where('shipping.name','like','%'.$request->name_order.'%')->select('tbl_order.*','admin.name')->orderby('id','desc')->paginate(10)->appends(request()->query());
        }else{
             $all_order=DB::table('tbl_order')->leftjoin('admin','admin.id','=','tbl_order.admin_id')->join('shipping','shipping.id','=','tbl_order.shipping_id')->where('tbl_order.id','like','%'.$request->id_order.'%')->where('created_at','like','%'.$request->date_order.'%')->where('shipping.phone','like','%'.$request->phone_order.'%')->where('status',$request->select_status)->where('shipping.name','like','%'.$request->name_order.'%')->select('tbl_order.*','admin.name')->orderby('id','desc')->paginate(10)->appends(request()->query());
        }
        $dsuser = DB::table('admin')->get();
        $manager_order  = view('admin.all_order')->with('all_order',$all_order)->with('dsuser',$dsuser)->with('status',$request->select_status)->with('request_tk',$request);
        return view('admin.admin_layout',compact('dsuser'))->with('admin.all_order', $manager_order);
    }
}
