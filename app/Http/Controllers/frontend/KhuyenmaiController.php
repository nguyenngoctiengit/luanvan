<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\frontend\Khuyenmai;
use App\model\frontend\Product;
use App\model\frontend\Chitiet_khuyenmai;
use DB;
class KhuyenmaiController extends Controller
{
    public function index(){
    	$khuyenmai=DB::select("SELECT *, if((DATEDIFF(CURDATE(),ngaybatdau)>=0) and (DATEDIFF(CURDATE(),ngayketthuc)<0),true,false ) as hieuluc,DATEDIFF(CURDATE(), ngaybatdau) as songaybatdau FROM  `khuyenmai` ORDER BY hieuluc desc, abs(songaybatdau) asc limit 18");
    	return view('pages.khuyenmai.index')->with('khuyenmai',$khuyenmai);
    }
    public function showChitiet($slug){
         $detail_km=Khuyenmai::where('slug',$slug)->first();
    	$product=Chitiet_khuyenmai::where('chitiet_khuyenmai.khuyenmai_id',$detail_km->id)->where('status','1')->join('product','product.id','=','chitiet_khuyenmai.product_id')->join('danhgia','danhgia.id_product','=','product.id')->select('product.*','discount')->paginate(12);
    	
        $km=Khuyenmai::join('chitiet_khuyenmai','khuyenmai.id','=','chitiet_khuyenmai.khuyenmai_id')->select('ngaybatdau','ngayketthuc','discount','product_id')->get();
       
       // dd($product);
    	return view('pages.khuyenmai.detail')->with('product',$product)->with('khuyenmai',$km)->with('detail_km',$detail_km);
    }
}
