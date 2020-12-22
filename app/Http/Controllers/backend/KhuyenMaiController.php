<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\model\backend\Chitiet_khuyenmai;
use Illuminate\Database\Query\Builder;
use Validator;
class KhuyenMaiController extends Controller
{
     public function AuthLogin(){
        $id = Session::get('id');
        if($id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function all_khuyenmai(Request $request){
        $this->AuthLogin();
        $select=null;
        $select=$request->khuyenmai;
        if($select==null||$select==-1){
        $all_khuyenmai = DB::table('khuyenmai')->orderby('id','desc')->paginate(5)->appends(request()->query());
        }
        else if($select==1){
            $all_khuyenmai=DB::table("khuyenmai")->whereRaw("DATEDIFF(CURDATE(),ngaybatdau)>=0 and DATEDIFF(CURDATE(),ngayketthuc)<0")->paginate(3)->appends(request()->query());
        }
        else{
        $all_khuyenmai=DB::table("khuyenmai")->whereRaw("DATEDIFF(CURDATE(),ngaybatdau)<0 || DATEDIFF(CURDATE(),ngayketthuc)>=0")->paginate(3)->appends(request()->query());
        }
        $dsuser = DB::table('admin')->get();
        $manager_khuyenmai  = view('admin.all_khuyenmai')->with('all_khuyenmai',$all_khuyenmai)->with('dsuser',$dsuser)->with('select',$select);
        return view('admin.admin_layout',compact('dsuser'))->with('admin.all_khuyenmai', $manager_khuyenmai);
    }
    public function save_khuyenmai(Request $request){
        $this->AuthLogin();
         $validator= Validator::make($request->all(), [
         'title'=>'required',
         'slug'=>'required',
         'content'=>'required',
         'start'=>'required|date',
         'end'=>'required|date|after_or_equal:start',
         'hinh' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
      ],[
       'title.required'=>'Vui lòng nhập tiêu đề!',
       'slug.required'=>'Vui lòng nhập đường dẫn thân thiện!',
       'content.required'=>'Vui lòng nhập nội dung!',
       'start.required'=>'Vui lòng chọn ngày!',
       'start.date'=>'Dữ liệu là ngày!',
       'end.required'=>'Vui lòng chọn ngày!',
       'end.date'=>'Dữ liệu là ngày!',
       'end.after_or_equal'=>'Ngày kết thúc phải sau ngày khuyến mãi!',
        'hinh.image'=>'File upload không phải là hình!',
        'hinh.mimes'=>'File upload không phải là hình!',
        'hinh.max'=>'File upload vượt quá dung lượng cho phép!',
      ]);
      if ($validator->fails())
      {       
         return response()->json(array('success'=>0,'error'=>$validator->getMessageBag()));
      }   
        $data = array();
        $data['subject'] = $request->title;
        $data['slug'] = $request->slug;
        $data['content'] = $request->content;
        $data['ngaybatdau'] = $request->start;
        $data['ngayketthuc'] = $request->end;
        $data['admin_id'] = Session::get('id');
        $file=$request->file('hinh');
        $new_name=rand().'.'.$file->getClientOriginalName();
        $file->move(public_path('uploads/khuyenmai'),$new_name);
        $data['image']=$new_name;
        DB::table('khuyenmai')->insert($data);
        return response()->json(['success'=>1]);
    }
    public function delete_khuyenmai($id){
          $this->AuthLogin();
          $flag = false;
          $list_chitiet =  DB::table('chitiet_khuyenmai')->where('khuyenmai_id',$id)->get();
          $banner=DB::table('banner')->where('khuyenmai_id',$id)->count();
          foreach ($list_chitiet as $key => $value) {
             $flag = true;        
         }
         if($banner>0){ 
          return response()->json(["result"=>"false","message"=>"Đã tồn tại banner về khuyến mãi này nên bạn không thể xóa!"]);
         }
         if($flag){
            return response()->json(["result"=>"false","message"=>"Đã tồn tại sản phẩm thuộc khuyến mãi này nên bạn không thể xóa!"]);
        }else {
            DB::table('khuyenmai')->where('id',$id)->delete();
            return response()->json("true");
        }
    }
    public function edit_khuyenmai($id){
        $this->AuthLogin();
        $edit = DB::table('khuyenmai')->where('id',$id)->first();
       return response()->json($edit);
    }

    public function update_khuyenmai(Request $request){
        $this->AuthLogin();
         $validator= Validator::make($request->all(), [
         'title'=>'required',
         'slug'=>'required',
         'content'=>'required',
         'start'=>'required|date',
         'end'=>'required|date|after_or_equal:start',
         'hinh' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
      ],[
       'title.required'=>'Vui lòng nhập tiêu đề!',
       'slug.required'=>'Vui lòng nhập đường dẫn thân thiện!',
       'content.required'=>'Vui lòng nhập nội dung!',
       'start.required'=>'Vui lòng chọn ngày!',
       'start.date'=>'Dữ liệu là ngày!',
       'end.required'=>'Vui lòng chọn ngày!',
       'end.date'=>'Dữ liệu là ngày!',
       'end.after_or_equal'=>'Ngày kết thúc phải sau ngày khuyến mãi!',
       'hinh.required'=>'Vui lòng upload hình!',
        'hinh.image'=>'File upload không phải là hình!',
        'hinh.mimes'=>'File upload không phải là hình!',
        'hinh.max'=>'File upload vượt quá dung lượng cho phép!',
      ]);
      if ($validator->fails())
      {       
         return response()->json(array('success'=>0,'error'=>$validator->getMessageBag()));
      }   
        $data = array();
        $data['subject'] = $request->title;
        $data['slug'] = $request->slug;
        $data['content'] = $request->content;
        $data['ngaybatdau'] = $request->start;
        $data['ngayketthuc'] = $request->end;
        $data['admin_id'] = Session::get('id');
        if($request->file('hinh')){
           $file=$request->file('hinh');
           $new_name=rand().'.'.$file->getClientOriginalName();
           $file->move(public_path('uploads/khuyenmai'),$new_name);
           $data['image']=$new_name;
           DB::table('khuyenmai')->where('id',$request->id)->update($data);
        }
        else{
            DB::table('khuyenmai')->where('id',$request->id)->update($data);
        }
       
        return response()->json(['success'=>1]);
    }

    public function all_chitietkhuyenmai($id){
        $product = DB::table('chitiet_khuyenmai')->join('product','chitiet_khuyenmai.product_id','=','product.id')->where('khuyenmai_id',$id)->select('chitiet_khuyenmai.id','discount','product_id','name','price','image')->get();
            return response()->json($product);                  
    }
     public function add_chitietkhuyenmai($id){
        $this->AuthLogin();
        $product = DB::table('product')->select('id','name','price')->get();
         return response()->json($product);      
    }
     public function get_price_product($id){
        $this->AuthLogin();
        $product = DB::table('product')->where('id',$id)->select('price')->first();
         return response()->json($product);      
    }
    public function delete_chitietkhuyenmai($id){
        $this->AuthLogin();
        $khuyenmai_id=DB::table('chitiet_khuyenmai')->where('id',$id)->first()->khuyenmai_id;
        DB::table('chitiet_khuyenmai')->where('id',$id)->delete();
        $count=DB::table('chitiet_khuyenmai')->where('khuyenmai_id',$khuyenmai_id)->count();
        if($count==0){
           return response()->json(["id"=>$khuyenmai_id,"remove"=>true]);
        }
        return response()->json(["id"=>$khuyenmai_id,"remove"=>"false"]);
    }
    public function save_chitietkhuyenmai(Request $request){
        $this->AuthLogin();
        $data = array();
        $dem=0;
        if($request->id_product_1!=-1&&$request->discount_product_1!=null){
        DB::table('chitiet_khuyenmai')->insert(['discount'=>$request->discount_product_1,'khuyenmai_id'=>$request->id_khuyenmai,'product_id'=>$request->id_product_1]);
        $dem++;
        } 
         if($request->id_product_2!=-1&&$request->discount_product_2!=null){
        DB::table('chitiet_khuyenmai')->insert(['discount'=>$request->discount_product_2,'khuyenmai_id'=>$request->id_khuyenmai,'product_id'=>$request->id_product_2]); 
         $dem++; 
        } 
        if($request->id_product_3!=-1&&$request->discount_product_3!=null){
        DB::table('chitiet_khuyenmai')->insert(['discount'=>$request->discount_product_3,'khuyenmai_id'=>$request->id_khuyenmai,'product_id'=>$request->id_product_3]); 
         $dem++; 
        } 
        if($request->id_product_4!=-1&&$request->discount_product_4!=null){
        DB::table('chitiet_khuyenmai')->insert(['discount'=>$request->discount_product_4,'khuyenmai_id'=>$request->id_khuyenmai,'product_id'=>$request->id_product_4]); 
         $dem++; 
        } 
        if($request->id_product_5!=-1&&$request->discount_product_5!=null){
        DB::table('chitiet_khuyenmai')->insert(['discount'=>$request->discount_product_5,'khuyenmai_id'=>$request->id_khuyenmai,'product_id'=>$request->id_product_5]); 
         $dem++; 
        } 
        return response()->json(["success"=>1,"sl_success"=>$dem,"khuyenmai_id"=>$request->id_khuyenmai]);   
    }
     public function edit_chitietkhuyenmai($id){
        $this->AuthLogin();
        $product = DB::table('chitiet_khuyenmai')->join('product','chitiet_khuyenmai.product_id','=','product.id')->where('chitiet_khuyenmai.id',$id)->select('chitiet_khuyenmai.id','khuyenmai_id','discount','product_id','name','price','image')->first();
        $ds_product = DB::table('product')->select('id','name','price')->get();
         return response()->json(['ds_product'=>$ds_product,'product'=>$product]);    
    }

    public function update_chitietkhuyenmai(Request $request){
        $this->AuthLogin();
        $validator= Validator::make($request->all(), [
        'discount'=>'required'],[
       'discount.required'=>'Vui lòng nhập % giảm giá!',
      ]);
      if ($validator->fails())
      {       
         return response()->json(array('success'=>0,'error'=>$validator->getMessageBag()));
      }  
        $data = array();
        $data['product_id'] = $request->id_product;
        $data['discount']=$request->discount;      
        DB::table('chitiet_khuyenmai')->where('id',$request->id)->update($data);
        return response()->json($request->id_khuyenmai);
    }
    

    //End Function Admin Page
}
