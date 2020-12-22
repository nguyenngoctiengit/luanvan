<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\model\backend\Image;
class ImageController extends Controller
{
  public function AuthLogin(){
        $id = Session::get('id');
        if($id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
     public function add_image(Request $request){
        $this->AuthLogin();
        $product = DB::table('product')->orderby('id','asc')->get();
        $dsuser = DB::table('admin')->get();
        return view('admin.add_image')->with('product',$product)->with('dsuser',$dsuser);       
    }
    public function save_image(Request $request){
        $this->AuthLogin();
        $data = array();      
        if ($request->fProductDetail){
            foreach ($request->fProductDetail as $file) {
                $product_img = new Image();
                if(isset($file)){
                    $product_img->image = $file->getClientOriginalName();
                    $name_image = current(explode('.',$product_img->image));
                    $new_image =  $name_image.rand(0,999).'.'.$file->getClientOriginalExtension();
                    $product_img->product_id = $request->product_id;
                    $file->move(public_path('uploads\product'),$new_image);

                    $data['image'] = $new_image;
                    $data['product_id'] = $request->product_id;
                    DB::table('image_product')->insert($data);
                }
                # code...
            }
        }
        Session::put('message','Thêm hình ảnh cho sản phẩm thành công');
        return Redirect::to('add-image');


    }
    
    public function ImageUpload(Request $req) 
    {
        if($req->hasFile('fProductDetail'))
        {
            $flag = true;
            $allowedfileExtension=['jpg','png','jpeg','gif'];
            foreach ($req->file('fProductDetail') as $image) {
                //$imagesize = $image->getClientSize();
                // if($imagesize > 2048)
                // {
                //     $flag = 'false';
                //     break;
                // }
                $imageextension = $image->getClientOriginalExtension();
                if(!in_array($imageextension,$allowedfileExtension))
                {
                    $flag = false;
                    break;
                }
            }
            if($flag)
            { 
                $destinationPath = public_path('uploads/product');
                //lưu hình anh 
                foreach ($req->file('fProductDetail') as $image) {
                    $imagename = $image->getClientOriginalName();
                    $image->move($destinationPath, $imagename);
                    $image = new Image();
                    $image->image = $imagename;
                    $image->product_id = $req->product_id;
                    $image->save();
                }
                Session::put('message','Thêm hình ảnh cho sản phẩm thành công');
                return Redirect::to('add-image');;
            }
            Session::put('message','Thêm hình ảnh thất bại');
        }return Redirect::to('add-image');;
    }

    public function all_image(){
        $this->AuthLogin();
        $product = DB::table('product')->get();
        $dsuser = DB::table('admin')->get();
        $manager_image  = view('admin.all_image')->with('product',$product)->with('dsuser',$dsuser);
        return view('admin.admin_layout',compact('dsuser'))->with('admin.all_image', $manager_image);
    }


    //End Function Admin Page
}
