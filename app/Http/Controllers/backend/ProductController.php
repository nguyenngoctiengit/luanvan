<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
use App\model\backend\Product;
use Carbon\Carbon;
class ProductController extends Controller
{
     public function AuthLogin(){
        $admin_id = Session::get('id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function thongke(){
        $this->AuthLogin();
        $x=Carbon::now()->timezone('Asia/Ho_Chi_Minh');
        $dsuser = DB::table('admin')->get();
        $count_product=DB::table('product')->count();
        $product_ban_1st = DB::table('order_detail')->join('tbl_order','order_detail.order_id','=','tbl_order.id')->where('tbl_order.status','3')->whereMonth('created_at',$x->month)->whereYear('created_at',$x->year)->select(\DB::raw('sum(quantity) as totalSLBan'))->groupBy('product_id')->orderByDesc('totalSLBan')->first();
        $count_product_het=DB::table('product')->where('count','0')->count(); 
        $product_km=DB::table('chitiet_khuyenmai')->join('khuyenmai','khuyenmai.id','=','chitiet_khuyenmai.khuyenmai_id')->whereMonth('ngaybatdau','<=',$x->month)->whereMonth('ngayketthuc','>=',$x->month)->whereYear('ngaybatdau',$x->year)->whereYear('ngayketthuc',$x->year)->select('discount')->orderby('discount','desc')->first(); 
        $manager_sanpham  = view('admin.thongke_sanpham')->with('dsuser',$dsuser)->with('count_product',$count_product)->with('product_ban_1st',$product_ban_1st)->with('count_product_het',$count_product_het)->with('product_km',$product_km);
        return view('admin.admin_layout',compact('dsuser'))->with('admin.thongke_sanpham', $manager_sanpham);
    }
     public function sanpham_danhgia(){
        $arr_product=[];
        $hang=0;
        $temp=-1;
        $product=DB::table('product')->join('danhgia','danhgia.id_product','=','product.id')->select('name','image','danhgia.*')->orderby('id','asc')->get();       
             foreach ($product as $key => $item) {
                $sum=$item->one_rate+$item->two_rate+$item->three_rate+$item->four_rate+$item->five_rate;
                if($sum!=0){
                $average=($item->one_rate+$item->two_rate*2+$item->three_rate*3+$item->four_rate*4+$item->five_rate*5)/$sum;
                }else{
                    $average="Chưa đánh giá";
                }
               
                $arr_product[]=[
                    'id'=>$item->id_product,
                    'name'=>$item->name,
                    'image'=>$item->image,
                    'one_rate'=>$item->one_rate,
                    'two_rate'=>$item->two_rate,
                    'three_rate'=>$item->three_rate,
                    'four_rate'=>$item->four_rate,
                    'five_rate'=>$item->five_rate,
                    'sum'=>$sum,
                    'average'=>$average
                ]; 
                } 
                // $arr_product_sort=collect($arr_product)->sortByDesc('average')->sortByDesc('sum')->values()->all();
                $arr_product_sort=collect($arr_product)->sortByDesc(function($product) {
                    return [$product['sum'],$product['average']];
                });
                $arr_product_sort_1=[];
                foreach ($arr_product_sort as $key => $value) {
                  if($temp!=$value['sum']){
                    $hang++;
                }
                 $arr_product_sort_1[]=[
                    'hang'=>$hang,
                    'id'=>$value['id'],
                    'name'=>$value['name'],
                    'image'=>$value['image'],
                    'one_rate'=>$value['one_rate'],
                    'two_rate'=>$value['two_rate'],
                    'three_rate'=>$value['three_rate'],
                    'four_rate'=>$value['four_rate'],
                    'five_rate'=>$value['five_rate'],
                    'sum'=>$value['sum'],
                    'average'=>$value['average']
                ]; 
                $temp=$value['sum'];
                }
            return response()->json($arr_product_sort_1);        
    }


    public function sanpham_banchay(Request $request){
        $select_date=null;
        $select_date=$request->select_date;
        $x=Carbon::now()->timezone('Asia/Ho_Chi_Minh');
        if($select_date!=null){
            $x=Carbon::create($select_date)->timezone('Asia/Ho_Chi_Minh');
        }
        $arr_product=[];
        $hang=0;
        $temp=-1;
        $product_cb=DB::table('product')->select('id','name','price','image')->get();
        $product_ban = DB::table('order_detail')->join('product','order_detail.product_id','=','product.id')->join('tbl_order','order_detail.order_id','=','tbl_order.id')->where('tbl_order.status','3')->whereMonth('created_at',$x->month)->whereYear('created_at',$x->year)->select(\DB::raw('sum(quantity) as totalSLBan'),'product_id','name','product.price','image')->groupBy('product_id')->orderByDesc('totalSLBan')->get();

             foreach ($product_ban as $key => $item_product_ban) {
                if($temp!=$item_product_ban->totalSLBan){
                    $hang++;
                }
                $temp=$item_product_ban->totalSLBan;
                $arr_product[]=[
                    'hang'=>$hang,
                    'product_id'=>$item_product_ban->product_id,
                    'name'=>$item_product_ban->name,
                    'price'=>$item_product_ban->price,
                    'image'=>$item_product_ban->image,
                    'totalSLBan'=>$item_product_ban->totalSLBan
                ]; 
                }
                
                foreach ($product_cb as $key => $value) {
                    $x=0;
                    foreach ($product_ban as $key => $item_product_ban) {
                        if($item_product_ban->product_id==$value->id){
                            $x++;
                            break;
                        }
                     }
                     if($x==0){
                        $arr_product[]=[
                            'hang'=>$hang+1,
                            'product_id'=>$value->id,
                            'name'=>$value->name,
                            'price'=>$value->price,
                            'image'=>$value->image,
                            'totalSLBan'=>0,
                        ]; 
                     }
                }
            return response()->json($arr_product);        
    }

    public function sanpham_tonkho(){
        $arr_product=[];
        $hang=0;
        $temp=-1;
        $product=DB::table('product')->select('id','name','price','image','count')->orderby('count','asc')->get();       
             foreach ($product as $key => $item) {
                if($temp!=$item->count){
                    $hang++;
                }
                $temp=$item->count;
                $arr_product[]=[
                    'hang'=>$hang,
                    'id'=>$item->id,
                    'name'=>$item->name,
                    'price'=>$item->price,
                    'image'=>$item->image,
                    'count'=>$item->count
                ]; 
                }             
            return response()->json($arr_product);        
    }

     public function sanpham_khuyenmai(Request $request){
        $select_date=null;
        $select_date=$request->select_date;
        if($select_date!=null){
            $x=Carbon::create($select_date)->timezone('Asia/Ho_Chi_Minh');
        }
        $arr_product=[];
        $hang=0;
        $temp=-1;
        $product=DB::table('chitiet_khuyenmai')->rightjoin('product','product.id','=','chitiet_khuyenmai.product_id')->leftjoin('khuyenmai','khuyenmai.id','=','chitiet_khuyenmai.khuyenmai_id')->whereMonth('ngaybatdau','<=',$x->month)->whereMonth('ngayketthuc','>=',$x->month)->whereYear('ngaybatdau',$x->year)->whereYear('ngayketthuc',$x->year)->select('ngaybatdau','ngayketthuc','product_id','khuyenmai_id','discount','name','price','product.image')->orderby('discount','desc')->get();
             foreach ($product as $key => $item) {
                $y=Carbon::create($item->ngayketthuc)->subDay(1)->timezone('Asia/Ho_Chi_Minh');
                if($y->month>=$x->month){
                if($temp!=$item->discount){
                    $hang++;
                }
                $temp=$item->discount;
                $arr_product[]=[
                    'hang'=>$hang,
                    'product_id'=>$item->product_id,
                    'khuyenmai_id'=>$item->khuyenmai_id,
                    'name'=>$item->name,
                    'price'=>$item->price,
                    'image'=>$item->image,
                    'discount'=>$item->discount,
                    'ngaybatdau'=>$item->ngaybatdau,
                    'ngayketthuc'=>$item->ngayketthuc
                ]; 
                }       
                }      
            return response()->json($arr_product);        
    }


    public function add_product(){
        $this->AuthLogin();
        $cate_product = DB::table('category_product')->orderby('id','asc')->get(); 
        $brand_product = DB::table('brand_product')->orderby('id','asc')->get(); 
        $dsuser = DB::table('admin')->get();
        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product',$brand_product)->with('dsuser',$dsuser);
    	

    }
    public function all_product(){
        $this->AuthLogin();
    	$all_product = DB::table('product')->join('category_product','category_product.id','=','product.category_id')
        ->join('brand_product','brand_product.id','=','product.brand_id')->select('brand_product.name as name_brand','category_product.name as name_cate','product.image','product.price','product.slug','product.name as name_product','product.count','product.status','product.id')->paginate(10);
        $dsuser = DB::table('admin')->get();
        
    	$manager_product  = view('admin.all_product')->with('all_product',$all_product)->with('dsuser',$dsuser);
    	return view('admin.admin_layout',compact('dsuser'))->with('admin.all_product', $manager_product);

    }
    public function save_product(Request $request){
         $this->AuthLogin();
    	$data = array();
        $this->validate($request,
                [
                    'name'=>'required',
                    'slug'=>'required',
                    'mota'=>'required',
                    'price'=>'required',
                    'image'=>'required',
                    'count'=>'required',
                    'color'=>'required',
                    'chatlieu'=>'required',
                    'ngandung'=>'required',
                    'size'=>'required',
                    'baohanh'=>'required',
                    'weight'=>'required',
                    'taitrong'=>'required',
                ],
                [
                    'name.required'=>'Vui lòng nhập tên danh mục',
                    'slug.required'=>'Vui lòng nhập slug',
                    'mota.required'=>"Vui lòng nhập mô tả",
                    'price.required'=>'vui lòng nhập giá',
                    'image.required'=>'vui lòng điền hình',
                    'count.required' => 'Vui lòng nhập số lượng', 
                    'color.required' => 'Vui lòng nhập màu', 
                    'chatlieu.required' => 'Vui lòng nhập chất liệu', 
                    'ngandung.required' => 'Vui lòng nhập ngắn đựng', 
                    'size.required' => 'Vui lòng nhập kích thước', 
                    'baohanh.required' => 'Vui lòng nhập thời gian bảo hành', 
                    'weight.required' => 'Vui lòng nhập weight', 
                    'taitrong.required' => 'Vui lòng nhập tải lượng',                   
                ]);

    	$data['name'] = $request->name;
        $data['slug'] = $request->slug;
        $data['mota'] = $request->mota;
    	$data['price'] = $request->price;
        $data['count'] = $request->count;
        $data['color'] = $request->color;
        $data['chatlieu'] = $request->chatlieu;
        $data['ngandung'] = $request->ngandung;
        $data['size'] = $request->size;
        $data['baohanh'] = $request->baohanh;
        $data['weight'] = $request->weight;
        $data['taitrong'] = $request->taitrong;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['status'] = $request->status;
        $data['image'] = $request->product_status;
        $get_image = $request->file('image');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move(public_path('uploads/product'),$new_image);
            $data['image'] = $new_image;
            $id_pro=DB::table('product')->insertGetId($data);
	    	$id_rate=DB::table('danhgia')->insertGetId(['id_product'=>$id_pro]);
	    	DB::table('product')->where('id',$id_pro)->update(['danhgia_id'=>$id_rate]);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('add-product');
        }
    	$id_pro=DB::table('product')->insertGetId($data);
    	$id_rate=DB::table('danhgia')->insertGetId(['id_product'=>$id_pro]);
    	DB::table('product')->where('id',$id_pro)->update(['danhgia_id'=>$id_rate]);
    	Session::put('message','Thêm sản phẩm thành công');
    	return Redirect::to('all-product');
    }
    public function unactive_product($id){
         $this->AuthLogin();
        DB::table('product')->where('id',$id)->update(['status'=>0]);
        Session::put('message','Không kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');

    }
    public function active_product($id){
         $this->AuthLogin();
        DB::table('product')->where('id',$id)->update(['status'=>1]);
        Session::put('message','Kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function edit_product($id){
         $this->AuthLogin();
        $cate_product = DB::table('category_product')->orderby('id','desc')->get(); 
        $brand_product = DB::table('brand_product')->orderby('id','desc')->get(); 
        $edit_product = DB::table('product')->where('id',$id)->get();
        $dsuser = DB::table('admin')->get();
        $manager_product  = view('admin.edit_product')->with('edit_product',$edit_product)
        ->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('dsuser',$dsuser);
        return view('admin.admin_layout',compact('dsuser'))->with('admin.edit_product', $manager_product);
    }
    public function update_product(Request $request,$id){
         $this->AuthLogin();
        $data = array();
       $data['name'] = $request->name;
        $data['slug'] = $request->slug;
        $data['mota'] = $request->mota;
        $data['price'] = $request->price;
        $data['count'] = $request->count;
        $data['color'] = $request->color;
        $data['chatlieu'] = $request->chatlieu;
        $data['ngandung'] = $request->ngandung;
        $data['size'] = $request->size;
        $data['baohanh'] = $request->baohanh;
        $data['weight'] = $request->weight;
        $data['taitrong'] = $request->taitrong;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['status'] = $request->product_status;
        $get_image = $request->file('image');
        
        if($get_image){
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                    $get_image->move(public_path('uploads/product'),$new_image);
                    $data['image'] = $new_image;
                    DB::table('product')->where('id',$id)->update($data);
                    Session::put('message','Cập nhật sản phẩm thành công');
                    return Redirect::to('all-product');
        }
            
        DB::table('product')->where('id',$id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function delete_product($id){
        $this->AuthLogin();
        $count_banner=DB::table('banner')->where('product_id',$id)->count();
        $count_ct_km=DB::table('chitiet_khuyenmai')->where('product_id',$id)->count();
        $count_ct_pn=DB::table('chitiet_phieunhap')->where('product_id',$id)->count();
        $count_ct_wish=DB::table('chitiet_wishlist')->where('id_product',$id)->count();
        $count_ct_com=DB::table('comment')->where('product_id',$id)->count();
        // $count_danhgia=DB::table('danhgia')->where('id_product',$id)->count();
        $count_image=DB::table('image_product')->where('product_id',$id)->count();
        $count_order_detail=DB::table('order_detail')->where('product_id',$id)->count();
        if($count_banner>0||$count_ct_km>0||$count_ct_pn>0||$count_ct_wish>0||$count_ct_com>0||$count_image>0||$count_order_detail>0){
            Session::put('message','Xóa sản phẩm thất bại');
        }else{
           DB::table('product')->where('id',$id)->update(['danhgia_id'=>null]);
           DB::table('danhgia')->where('id_product',$id)->delete();
           DB::table('product')->where('id',$id)->delete();
           Session::put('message','Xóa sản phẩm thành công');
        }
        return Redirect::to('all-product');
    }
    public function detail_product($id){
        $this->AuthLogin();
        $detail = Product::where('id',$id)->first();
        $dsuser = DB::table('admin')->get();
        $manager_detail_product  = view('admin.detail_product')->with('detail',$detail)->with('dsuser',$dsuser);
        return view('admin.admin_layout',compact('dsuser'))->with('admin.detail_product', $manager_detail_product);

    }
}
