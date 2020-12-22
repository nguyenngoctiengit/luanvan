<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\frontend\Category;
use App\model\frontend\Banner;
use App\model\frontend\Product;
use App\model\frontend\Khuyenmai;
use App\model\frontend\Chitiet_khuyenmai;
use App\model\frontend\Image;
use App\model\frontend\Comment;
use App\model\frontend\Brand_product;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\model\frontend\PriceSelect;
use DB;
use Validator;
class HomeController extends Controller
{
    public function index()
    {
        $cate_product=Category::get();
        $banner=Banner::where('banner.status','1')->leftjoin('product','product.id','=','banner.product_id')->leftjoin('khuyenmai','khuyenmai.id','=','banner.khuyenmai_id')->leftjoin('news','news.id','=','banner.news_id')->select('banner.image as image_banner','product_id','product.slug as slug_pro','news.id as id_news','news.slug as slug_new','khuyenmai.id as id_km','khuyenmai.slug as slug_km')->get();
        
        $product=Product::join('danhgia','danhgia.id_product','=','product.id')->where('status','1')->select('product.*','danhgia.id as id_rate','one_rate','two_rate','three_rate','four_rate','five_rate')->orderby('product.id','asc')->paginate(12);
        $km=Khuyenmai::join('chitiet_khuyenmai','khuyenmai.id','=','chitiet_khuyenmai.khuyenmai_id')->select('ngaybatdau','ngayketthuc','discount','product_id')->orderby('khuyenmai.id','asc')->get();
        return view('pages.home.home')->with('cate_product',$cate_product)->with('banner',$banner)->with('product',$product)->with('khuyenmai',$km);
    }
   public function show_detail_product($product_slug){
        $product_id=Product::where('slug',$product_slug)->first()->id;
   	 		$ngayhientai=now('Asia/Ho_Chi_Minh');
        $image=Image::where('product_id',$product_id)->orderby('id','asc')->get();

        $comment=Comment::where('product_id',$product_id)->join('users','users.id','=','comment.user_id')->orderby('comment.id','desc')->select('users.avatar','comment.*')->get();

   			$product=Product::where('product.id',$product_id)->join('category_product','category_product.id','=','product.category_id')->join('brand_product','product.brand_id','=','brand_product.id')->join('danhgia','danhgia.id_product','=','product.id')->select('product.name as name_pro','image','product.slug','category_product.name as name_cate','brand_product.name as name_brand','price','count','mota','color','chatlieu','ngandung','size','baohanh','weight','taitrong','product.id as id_product','category_product.id as cate_id','danhgia.*')->first(); 

   		 $product_km_same=Product::limit(4)->where('status','1')->where('category_id',$product->cate_id)->whereNotIn('product.id',[$product_id])->get();

        $km=Khuyenmai::join('chitiet_khuyenmai','khuyenmai.id','=','chitiet_khuyenmai.khuyenmai_id')->select('ngaybatdau','ngayketthuc','discount','product_id')->orderby('khuyenmai.id','asc')->get();
          $discount=0;
          $km_discount=null;
   			  foreach ($km as $key => $value) {
          if($value->product_id==$product_id&&$ngayhientai>=$value->ngaybatdau && $ngayhientai< $value->ngayketthuc&&$discount<$value->discount)
          {
            $discount=$value->discount;
            $km_discount=$value->discount;
          }
        }

   			return view('pages.home.detail')->with('product',$product)->with('image',$image)->with('comment',$comment)->with('product_km_same',$product_km_same)->with('khuyenmai',$km)->with('km_discount',$km_discount);
   }

   public function quickview(Request $request,$id){
        $ngayhientai=now('Asia/Ho_Chi_Minh');
         $product=Product::where('product.id',$id)->join('category_product','category_product.id','=','product.category_id')->join('brand_product','product.brand_id','=','brand_product.id')->join('danhgia','danhgia.id_product','=','product.id')->select('product.name as name_pro','image','product.slug','category_product.name as name_cate','brand_product.name as name_brand','price','count','mota','color','chatlieu','ngandung','size','baohanh','weight','taitrong','product.id as id_product','category_product.id as cate_id','danhgia.*')->first();
          $km=Khuyenmai::join('chitiet_khuyenmai','khuyenmai.id','=','chitiet_khuyenmai.khuyenmai_id')->select('ngaybatdau','ngayketthuc','discount','product_id')->orderby('khuyenmai.id','asc')->get();
          $discount=0;
          $km_discount=null;
          foreach ($km as $key => $value) {
            if($value->product_id==$id&&$ngayhientai>=$value->ngaybatdau && $ngayhientai< $value->ngayketthuc&&$discount<$value->discount)
            {
              $discount=$value->discount;
              $km_discount=$value->discount;
            }
        } 
        return response()->json(['product'=>$product,'discount'=>$km_discount]);
   }

   public function binhluan(Request $request,$product_id){
        $validator= Validator::make($request->all(), [
          'name'=>'required|max:50|min:5',
          'email'=>'required|max:50|regex:/^.+@.+$/i',
          'comment'=>'required',
       ],[
         'name.required'=>'Vui lòng nhập họ tên!',
         'name.max'=>"Họ tên tối đa 50 ký tự!",
         'name.min'=>"Họ tên ít nhất 5 ký tự!",
         'email.required'=>"Vui lòng nhập email",
         'email.max'=>"Email vượt quá số kỳ tự cho phép!",
         'email.regex'=>'Sai định dạng email',
         'comment.required'=>'Vui lòng nhập bình luận',
       ]);
        if ($validator->fails())
        {       
         return response()->json(array('success'=>0,'error'=>$validator->getMessageBag()));
       }   
        $data=$request->all();
        $comment=new Comment();
        $comment->email=$data['email'];
        $comment->name=$data['name'];
        $comment->rate=$data['rate'];
        $comment->content=$data['comment'];
        $comment->created_at=now('Asia/Ho_Chi_Minh');
        $comment->product_id=$product_id;
        $comment->user_id=\Auth::user()->id;
        $image=\Auth::user()->avatar;
        $comment->save();    
        return response()->json($image);
   }

   public function aboutUs(){
    return view('pages.home.about');
   }
   public function category($slug,Request $request){
        $orderby=$request->orderby; 
        $cate=Category::where('slug',$slug)->first();

        $brand=Brand_product::get();
        $price_select=PriceSelect::orderby('price_min','asc')->get();
        $select=PriceSelect::find($request->price_select);
        $product=null;
        $brand_select=Brand_product::where('id',$request->brand_select)->get();
        if($brand_select->count()==0){
           $brand_select="";
        }
        else{
          $brand_select=$request->brand_select;
        }
        if($orderby=="sort-asc")
        {
          $product=Product::join('danhgia','danhgia.id_product','=','product.id')->where('status','1')->where('category_id',$cate->id)->where('brand_id','like','%'.$brand_select.'%')->select('product.*','danhgia.id as id_rate','one_rate','two_rate','three_rate','four_rate','five_rate')->orderBy('product.id','asc')->paginate(12)->appends(request()->query());    
        }
        elseif($orderby=="sort-desc")
        {
          $product=Product::join('danhgia','danhgia.id_product','=','product.id')->where('status','1')->where('category_id',$cate->id)->where('brand_id','like','%'.$brand_select.'%')->select('product.*','danhgia.id as id_rate','one_rate','two_rate','three_rate','four_rate','five_rate')->orderBy('id','desc')->paginate(12)->appends(request()->query());
        }
        else{
          $product=Product::join('danhgia','danhgia.id_product','=','product.id')->where('status','1')->where('category_id',$cate->id)->where('brand_id','like','%'.$brand_select.'%')->select('product.*','danhgia.id as id_rate','one_rate','two_rate','three_rate','four_rate','five_rate')->paginate(12)->appends(request()->query());
        }
         $km=Khuyenmai::join('chitiet_khuyenmai','khuyenmai.id','=','chitiet_khuyenmai.khuyenmai_id')->select('ngaybatdau','ngayketthuc','discount','product_id')->orderby('khuyenmai.id','asc')->get();
         return view('pages.home.category')->with('product',$product)->with('khuyenmai',$km)->with('cate',$cate)->with('price_select',$price_select)->with('select',$select)->with('orderby',$orderby)->with('brand',$brand)->with('brand_select',$brand_select);
   }
     public function search(Request $request){
         $orderby=$request->orderby;
         $keywords = $request->keywords_submit;
         $brand=Brand_product::get();
         $cate=Category::get();
         $cate_select=Category::where('id',$request->cate_select)->get();
          if($cate_select->count()==0){
           $cate_select="";
        }
        else{
          $cate_select=$request->cate_select;
        }
         $price_select=DB::table('price_select')->orderBy('price_min','asc')->get();
       $select=PriceSelect::find($request->price_select);
       $product=null;
        $brand_select=Brand_product::where('id',$request->brand_select)->get();
        if($brand_select->count()==0){
           $brand_select="";
        }
        else{
          $brand_select=$request->brand_select;
        }
        if($orderby=="sort-asc")
        {
          $product=Product::join('danhgia','danhgia.id_product','=','product.id')->where('status','1')->where('name','like','%'.$keywords.'%')->where('brand_id','like','%'.$brand_select.'%')->where('category_id','like','%'.$cate_select.'%')->select('product.*','danhgia.id as id_rate','one_rate','two_rate','three_rate','four_rate','five_rate')->orderBy('id','asc')->paginate(12)->appends(request()->query());  
        }
        elseif($orderby=="sort-desc")
        {
          $product=Product::join('danhgia','danhgia.id_product','=','product.id')->where('status','1')->where('name','like','%'.$keywords.'%')->where('brand_id','like','%'.$brand_select.'%')->where('category_id','like','%'.$cate_select.'%')->select('product.*','danhgia.id as id_rate','one_rate','two_rate','three_rate','four_rate','five_rate')->orderBy('id','desc')->paginate(12)->appends(request()->query());
        }
        else{
            $product=Product::join('danhgia','danhgia.id_product','=','product.id')->where('status','1')->where('name','like','%'.$keywords.'%')->where('brand_id','like','%'.$brand_select.'%')->where('category_id','like','%'.$cate_select.'%')->select('product.*','danhgia.id as id_rate','one_rate','two_rate','three_rate','four_rate','five_rate')->paginate(12)->appends(request()->query());
        }
         $km=Khuyenmai::join('chitiet_khuyenmai','khuyenmai.id','=','chitiet_khuyenmai.khuyenmai_id')->select('ngaybatdau','ngayketthuc','discount','product_id')->orderby('khuyenmai.id','asc')->get();
         return view('pages.home.search')->with('product',$product)->with('khuyenmai',$km)->with('keywords',$keywords)->with('price_select',$price_select)->with('select',$select)->with('orderby',$orderby)->with('brand',$brand)->with('brand_select',$brand_select)->with('cate',$cate)->with('cate_select',$cate_select);
   }

}
