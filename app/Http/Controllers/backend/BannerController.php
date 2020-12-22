<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
class BannerController extends Controller
{
    public function AuthLogin(){
        $id = Session::get('id');
        if($id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

     public function add_banner(){
        $this->AuthLogin();
        $product=DB::table('product')->select('id','name')->get();
        $news=DB::table('news')->select('id','subject')->get();
        $khuyenmai=DB::table('khuyenmai')->select('id','subject')->get();
        $dsuser = DB::table('admin')->get();
        return view('admin.add_banner')->with('dsuser',$dsuser)->with('product',$product)->with('news',$news)->with('khuyenmai',$khuyenmai);
    }
    public function all_banner(){
        $this->AuthLogin();    
        $all_banner = DB::table('banner')->leftjoin('product','product.id','=','banner.product_id')->leftjoin('news','news.id','=','banner.news_id')->leftjoin('khuyenmai','khuyenmai.id','=','banner.khuyenmai_id')->join('admin','admin.id','=','banner.admin_id')->select('banner.*','product.name','news.subject as subject_new','khuyenmai.subject as subject_km','admin.name as name_admin')->paginate(5);
        $dsuser = DB::table('admin')->get();
        $manager_banner  = view('admin.all_banner')->with('all_banner',$all_banner)->with('dsuser',$dsuser);
        return view('admin.admin_layout',compact('dsuser'))->with('admin.all_all_banner', $manager_banner);
    }
    public function save_banner(Request $request){
        $this->AuthLogin();
        $this->validate($request,
                [
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
                ],
                [
                    'image.required'=>'Vui lòng chọn hình ảnh',
                     'image.image'=>'File upload không phải là hình!',
                     'image.mimes'=>'File upload không phải là hình!',
                     'image.max'=>'File upload vượt quá dung lượng cho phép!',      
                ]);
        $data = $request->all();
        $banner = array();
        $banner['status'] = $data['status'];
        $date=now('Asia/Ho_Chi_Minh');
        $banner['created_at'] = $date;
        $banner['admin_id']=Session::get('id');
        $get_image = $request->file('image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move(public_path('uploads/banner'),$new_image);
            $banner['image'] = $new_image;
        }
        if($data['rdo_banner']==1){
        	$banner['product_id']=$data['product'];
        }else if($data['rdo_banner']==2){
			$banner['news_id']=$data['new'];
        }else{
			$banner['khuyenmai_id']=$data['khuyenmai'];
        }
        DB::table('banner')->insert($banner);
        Session::put('message','Thêm banner thành công');
        return Redirect::to('add-banner');
    }
    public function edit_banner($id){
        $this->AuthLogin();
        $banner=DB::table('banner')->where('id',$id)->first();    
        $product=DB::table('product')->select('id','name')->get();
        $news=DB::table('news')->select('id','subject')->get();
        $khuyenmai=DB::table('khuyenmai')->select('id','subject')->get();
        $dsuser = DB::table('admin')->get();
        return view('admin.edit_banner')->with('dsuser',$dsuser)->with('product',$product)->with('news',$news)->with('khuyenmai',$khuyenmai)->with('banner',$banner);
    }
    public function update_banner(Request $request){
      $this->AuthLogin();
        $this->validate($request,
                [
                    'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
                ],
                [
                     'image.image'=>'File upload không phải là hình!',
                     'image.mimes'=>'File upload không phải là hình!',
                     'image.max'=>'File upload vượt quá dung lượng cho phép!',      
                ]);
        $data = $request->all();
        $banner = array();
        $banner['status'] = $data['status'];
        $date=now('Asia/Ho_Chi_Minh');
        $banner['created_at'] = $date;
        $banner['admin_id']=Session::get('id');
        $get_image = $request->file('image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move(public_path('uploads/banner'),$new_image);
            $banner['image'] = $new_image;
        }
        $banner['news_id']=null;
        $banner['product_id']=null;
        $banner['khuyenmai_id']=null;
        if($data['rdo_banner']==1){
        	$banner['product_id']=$data['product'];
        }else if($data['rdo_banner']==2){
			$banner['news_id']=$data['new'];
        }else{
			$banner['khuyenmai_id']=$data['khuyenmai'];
        }
        DB::table('banner')->where('id',$data['id'])->update($banner);
        Session::put('message','Sửa banner thành công');
        return redirect()->action('backend\BannerController@edit_banner',['id'=>$data['id']]);
    }
    public function delete_banner($id){
        $this->AuthLogin(); 
        DB::table('banner')->where('id',$id)->delete();
        Session::put('message','Xóa banner thành công');
        return Redirect::to('all-banner');     
    }
}
