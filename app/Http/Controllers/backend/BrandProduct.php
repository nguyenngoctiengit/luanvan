<?php

namespace App\Http\Controllers\backend;

use App\model\backend\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
class BrandProduct extends Controller
{
    public function AuthLogin(){
        $id = Session::get('id');
        if($id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

     public function add_brand_product(){
        $this->AuthLogin();
        $dsuser = DB::table('admin')->get();
        return view('admin.add_brand_product')->with('dsuser',$dsuser);
    }
    public function all_brand_product(){
        $this->AuthLogin();    
        $all_brand_product = Brand::orderBy('id','DESC')->paginate(5);
        $dsuser = DB::table('admin')->get();
        $manager_brand_product  = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product)->with('dsuser',$dsuser);
        return view('admin.admin_layout',compact('dsuser'))->with('admin.all_brand_product', $manager_brand_product);
    }
    public function save_brand_product(Request $request){
        $this->AuthLogin();
         $this->validate($request,
                [
                    'name'=>'required',
                    'email'=>'required|max:50|regex:/^.+@.+$/i|unique:brand_product',
                    'phone'=>'required|min:9|max:10',
                    'address'=>'required',
                ],
                [
                    'name.required'=>'Vui lòng nhập tên danh mục',
                    'email.required'=>"Vui lòng nhập email",
                    'email.unique'=>"Đã tồn tại email!",
                    'email.regex'=>'Sai định dạng email',
                    'phone.required'=>'vui lòng nhập số điện thoại',
                    'phone.min'=>'vui lòng nhập nhiều hơn 9 số',
                    'phone.max'=>'vui lòng nhập nhiều hơn 10 số',
                    'address.required' => 'Vui lòng nhập địa chỉ',                   
                ]);
        $dsuser = DB::table('admin')->get();
        $data = $request->all();
        $brand = new Brand();
        $brand->name = $data['name'];
        $brand->email = $data['email'];
        $brand->phone = $data['phone'];
        $brand->address = $data['address'];
        $brand->save();        
        Session::put('message','Thêm thương hiệu sản phẩm thành công');
        return Redirect::to('add-brand-product');
    }
    public function edit_brand_product($id){
        $this->AuthLogin();
        
        $edit_brand_product = Brand::where('id',$id)->get();
        $dsuser = DB::table('admin')->get();
        $manager_brand_product  = view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product)->with('dsuser',$dsuser);

        return view('admin.admin_layout',compact('dsuser'))->with('admin.edit_brand_product', $manager_brand_product);
    }
    public function update_brand_product(Request $request,$id){
        $this->AuthLogin();
        $dsuser = DB::table('admin')->get();
        $data = $request->all();
        $brand = Brand::find($id);
        // $brand = new Brand();
        $brand->name = $data['name'];
        $brand->email = $data['email'];
        $brand->phone = $data['phone'];
        $brand->address = $data['address'];
        $brand->save();
        Session::put('message','Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    public function delete_brand_product($id){
        $this->AuthLogin();
        $flag = false;
        $list_product =  DB::table('product')->get();
        foreach ($list_product as $key => $value) {
            if($value->brand_id == $id){
               $flag = true;
            }
        }
        if($flag){
            Session::put('message','Không được phép xóa.');
             return Redirect::to('all-brand-product');
        }else {
            DB::table('brand_product')->where('id',$id)->delete();
            Session::put('message','Xóa thương hiệu sản phẩm thành công');
            return Redirect::to('all-brand-product');
        }
    }
}
