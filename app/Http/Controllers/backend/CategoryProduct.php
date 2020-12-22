<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\model\backend\Cate;
class CategoryProduct extends Controller
{
     public function AuthLogin(){
        $id = Session::get('id');
        if($id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function all_category_product(){
         $this->AuthLogin();
        $all_category_product = Cate::orderBy('id','DESC')->paginate(5);
        $dsuser = DB::table('admin')->get();
        $manager_category_product  = view('admin.all_category_product')->with('all_category_product',$all_category_product)->with('dsuser',$dsuser);
        return view('admin.admin_layout',compact('dsuser'))->with('admin.all_category_product', $manager_category_product);
    }
    public function add_category_product(){
        $this->AuthLogin();
        $dsuser = DB::table('admin')->get();
    	return view('admin.add_category_product')->with('dsuser',$dsuser);
    }
     public function save_category_product(Request $request){
        $this->AuthLogin();
        $this->validate($request,
                [
                    'name'=>'required',
                    'slug'=>'required',
                ],
                [
                    'name.required'=>'Vui lòng nhập tên danh mục',
                    'slug.required'=>'Vui lòng nhập slug',
                ]);
        $data = $request->all();
        $brand = new Cate();
        $brand->name = $data['name'];
        $brand->slug = $data['slug'];
        $brand->save();        
        Session::put('message','Thêm danh mục sản phẩm thành công');
        return Redirect::to('add-category-product');
    }
    public function edit_category_product($id){
       $this->AuthLogin();
        $edit_cate_product = Cate::where('id',$id)->get();
        $dsuser = DB::table('admin')->get();
        $manager_cate_product  = view('admin.edit_category_product')->with('edit_cate_product',$edit_cate_product)->with('dsuser',$dsuser);

        return view('admin.admin_layout',compact('dsuser'))->with('admin.edit_category_product', $manager_cate_product);
    }
    
    public function update_category_product(Request $request,$id){
       $this->AuthLogin();
        $data = $request->all();
        $cate = Cate::find($id);
        $cate->name = $data['name'];
        $cate->slug = $data['slug'];
        $cate->save();
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function delete_category_product($id){
       $this->AuthLogin();
        $flag = false;
        $list_product =  DB::table('product')->get();
        foreach ($list_product as $key => $value) {
            if($value->category_id == $id){
               $flag = true;
            }
        }
        if($flag){
            Session::put('message','Không được phép xóa.');
             return Redirect::to('all-category-product  ');
        }else {
            DB::table('category_product')->where('id',$id)->delete();
            Session::put('message','Xóa danh mục sản phẩm thành công');
            return Redirect::to('all-category-product');
        }
    }

}
