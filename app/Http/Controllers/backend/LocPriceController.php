<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
class LocPriceController extends Controller
{
   public function AuthLogin(){
        $id = Session::get('id');
        if($id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

     public function add_loc_product(){
        $this->AuthLogin();
        $dsuser = DB::table('admin')->get();
        return view('admin.add_loc_product')->with('dsuser',$dsuser);
    }
    public function all_loc_product(){
        $this->AuthLogin();    
        $all_loc_product = DB::table('price_select')->paginate(10);
        $dsuser = DB::table('admin')->get();
        $manager_loc_product  = view('admin.all_loc_product')->with('all_loc_product',$all_loc_product)->with('dsuser',$dsuser);
        return view('admin.admin_layout',compact('dsuser'))->with('admin.all_loc_product', $manager_loc_product);
    }
    public function save_loc_product(Request $request){
        $this->AuthLogin();
         $this->validate($request,
                [
                    'name'=>'required',
                    'price_min'=>'required',
                    'price_max'=>'required',
                ],
                [
                    'name.required'=>'Vui lòng nhập tên hiển thị',
                    'price_min.required'=>"Vui lòng nhập giá thấp nhất",
                    'price_max.required'=>'vui lòng nhập giá cáo nhất',         
                ]);
        $dsuser = DB::table('admin')->get();
        $data = $request->all();
      	$price=array();
      	$price['name']=$data['name'];
      	$price['price_min']=$data['price_min'];
      	$price['price_max']=$data['price_max'];
       	DB::table('price_select')->insert($price);
        Session::put('message','Thêm mức giá sản phẩm thành công');
        return Redirect::to('add-loc-product');
    }
    public function edit_loc_product($id){
        $this->AuthLogin();
        $dsuser = DB::table('admin')->get();
        $price=DB::table('price_select')->where('id',$id)->first();
        return view('admin.edit_loc_product')->with('dsuser',$dsuser)->with('price',$price);
    }
    public function update_loc_product(Request $request){
        $this->AuthLogin();
         $this->validate($request,
                [
                    'name'=>'required',
                    'price_min'=>'required',
                    'price_max'=>'required',
                ],
                [
                    'name.required'=>'Vui lòng nhập tên hiển thị',
                    'price_min.required'=>"Vui lòng nhập giá thấp nhất",
                    'price_max.required'=>'vui lòng nhập giá cáo nhất',         
                ]);
        $dsuser = DB::table('admin')->get();
        $data = $request->all();
      	$price=array();
      	$price['name']=$data['name'];
      	$price['price_min']=$data['price_min'];
      	$price['price_max']=$data['price_max'];
       	DB::table('price_select')->where('id',$data['id'])->update($price);
        Session::put('message','Thêm mức giá sản phẩm thành công');
       return redirect()->action('backend\LocPriceController@edit_loc_product',['id'=>$data['id']]);
    }
    public function delete_loc_product($id){
        $this->AuthLogin();   
            DB::table('price_select')->where('id',$id)->delete();
            Session::put('message','Xóa mức giá sản phẩm thành công');
            return Redirect::to('all-loc-product');
    }
}
