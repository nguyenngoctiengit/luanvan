<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Validator;
class PhieuNhapController extends Controller
{
	public function AuthLogin(){
        $id = Session::get('id');
        if($id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
   public function save_phieunhap_product(Request $request){
   		$this->AuthLogin();
         $validator= Validator::make($request->all(), [
         'title'=>'required',
         'date'=>'required',
      ],[
         'title.required'=>'Vui lòng nhập tiêu đề!',
         'date.required'=>'Vui lòng chọn ngày nhập!',
      ]);
      if ($validator->fails())
      {       
         return response()->json(array('success'=>0,'error'=>$validator->getMessageBag()));
      }   
   		$data = $request->all();
   		 DB::table('phieunhap')->insert(['title'=>$data['title'],'ngaynhap'=>$data['date'],'admin_id'=>Session::get('id')]);
         return response()->json('true');
   }
   public function all_phieunhap_product(){
   		$this->AuthLogin();
   		$dsuser = DB::table('admin')->get();
   		$all_phieunhap=DB::table('phieunhap')->orderby('id','desc')->get();
   		return view('admin.all_phieunhap_product')->with('dsuser', $dsuser)->with('all_phieunhap',$all_phieunhap);
   }
     public function edit_phieunhap_product($id){
        $this->AuthLogin();
        $edit = DB::table('phieunhap')->where('id',$id)->first();
       return response()->json($edit);
    }
    public function update_phieunhap_product(Request $request){
    	 $this->AuthLogin();
          $validator= Validator::make($request->all(), [
         'title'=>'required',
         'date'=>'required',
      ],[
         'title.required'=>'Vui lòng nhập tiêu đề!',
         'date.required'=>'Vui lòng chọn ngày nhập!',
      ]);
      if ($validator->fails())
      {       
         return response()->json(array('success'=>0,'error'=>$validator->getMessageBag()));
      }   
        $data = $request->all();
        DB::table('phieunhap')->where('id',$data['id_phieunhap'])->update(['title'=>$data['title'],'ngaynhap'=>$data['date']]);
         return response()->json($data);
    }
    public function delete_phieunhap_product($id){
    	 $this->AuthLogin();
        $flag = false;
        $list_chitiet =  DB::table('chitiet_phieunhap')->where('phieunhap_id',$id)->get();
        foreach ($list_chitiet as $key => $value) {
               $flag = true;        
        }
        if($flag){
            return response()->json("false");
        }else {
            DB::table('phieunhap')->where('id',$id)->delete();
            return response()->json("true");
        }
    }
    public function all_chitiet_phieunhap($id){
		$all_chitiet=DB::table('chitiet_phieunhap')->where('phieunhap_id',$id)->join('product','product.id','=','chitiet_phieunhap.product_id')->orderby('id','desc')->select('chitiet_phieunhap.*','product.name','image')->get();
        return response()->json($all_chitiet);
    }
    public function add_chitiet_phieunhap($id){
    	$this->AuthLogin();
    	$product=DB::table('product')->orderby('id','desc')->select('id','name')->get();
    	return response()->json($product);
    }
    public function save_chitiet_phieunhap(Request $request){
    	$this->AuthLogin();
        $validator= Validator::make($request->all(), [
         'quantity'=>'required|numeric|min:1',
      ],[
       'quantity.required'=>'Vui lòng nhập số lượng!',
       'quantity.min'=>'Số lượng ít nhất là 1',
      ]);
      if ($validator->fails())
      {       
         return response()->json(array('success'=>0,'error'=>$validator->getMessageBag()));
      }   
        $data=$request->all();
    	 DB::table('chitiet_phieunhap')->insert(['quantity'=>$data['quantity'],'product_id'=>$data['id_sanpham'],'phieunhap_id'=>$data['id_phieunhap']]);
    	 $product=DB::table('product')->where('id',$data['id_sanpham'])->first();
    	 $count=$product->count+$data['quantity'];
    	 DB::table('product')->where('id',$data['id_sanpham'])->update(['count'=>$count]);
        return response()->json("true");
    }
    public function delete_chitiet_phieunhap($id){
    	$this->AuthLogin();
    	$ct_phieunhap=DB::table('chitiet_phieunhap')->where('id',$id)->first();
    	$quantity=$ct_phieunhap->quantity;
    	$id_phieunhap=$ct_phieunhap->phieunhap_id;
    	$product=DB::table('product')->where('id',$ct_phieunhap->product_id)->first();
    	$count=$product->count-$quantity;
        if($count<0){
             return response()->json("false");
        }else{
    	 DB::table('product')->where('id',$product->id)->update(['count'=>$count]);
    	 DB::table('chitiet_phieunhap')->where('id',$id)->delete();
          return response()->json("true");
        }   	 
    }
    public function edit_chitiet_phieunhap($id){
    	$this->AuthLogin();
    	$product=DB::table('product')->select('id','name')->orderby('id','desc')->get();
    	$ct_phieunhap=DB::table('chitiet_phieunhap')->where('id',$id)->first();
    	return response()->json(array('product'=>$product,'ct_phieunhap'=>$ct_phieunhap));
    }
    public function update_chitiet_phieunhap(Request $request){
    	$this->AuthLogin();
         $validator= Validator::make($request->all(), [
         'quantity'=>'required|numeric|min:1',
      ],[
         'quantity.required'=>'Vui lòng nhập số lượng!',
         'quantity.min'=>'Số lượng ít nhất là 1',
      ]);
      if ($validator->fails())
      {       
         return response()->json(array('success'=>0,'error'=>$validator->getMessageBag()));
      }   
    	$data = $request->all();
    	$ct_phieunhap=DB::table('chitiet_phieunhap')->where('id',$data['id_ct_phieunhap'])->first();
    	$quantity=$ct_phieunhap->quantity;
    	$product_id=$ct_phieunhap->product_id;
    	$product=DB::table('product')->where('id',$ct_phieunhap->product_id)->first();
    	if($data['id_sanpham']==$ct_phieunhap->product_id){
    		if($data['quantity']<$ct_phieunhap->quantity){
    			$count=$ct_phieunhap->quantity-$data['quantity'];
                if($product->count<$count){
                    return response()->json("false");
                }
                else{
    			DB::table('product')->where('id',$product->id)->update(['count'=>$product->count-$count]);
    			DB::table('chitiet_phieunhap')->where('id',$data['id_ct_phieunhap'])->update(['quantity'=>$data['quantity']]);
                    return response()->json("true");
                    }

    		}
            elseif($data['quantity']>$ct_phieunhap->quantity){
				$count=$data['quantity']-$ct_phieunhap->quantity;
				DB::table('product')->where('id',$product->id)->update(['count'=>$product->count+$count]);
				DB::table('chitiet_phieunhap')->where('id',$data['id_ct_phieunhap'])->update(['quantity'=>$data['quantity']]);
                return response()->json("true");
    		}
            else{ 
                return response()->json("true");
    		}

    	}
        else{
    		$count=$product->count-$quantity;
            if($count<0){
                 return response()->json("false");
            }
    		DB::table('product')->where('id',$product->id)->update(['count'=>$count]);
    		$product=DB::table('product')->where('id',$data['id_sanpham'])->first();
    		$count=$product->count+$data['quantity'];
    		DB::table('product')->where('id',$product->id)->update(['count'=>$count]);
    		DB::table('chitiet_phieunhap')->where('id',$data['id_ct_phieunhap'])->update(['quantity'=>$data['quantity'],'product_id'=>$data['id_sanpham']]);
            return response()->json("true");
    	}
    }
}
