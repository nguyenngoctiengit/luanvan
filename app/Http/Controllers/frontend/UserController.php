<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\frontend\Order;
use App\model\frontend\Order_detail;
use App\model\frontend\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;
use File; 
use Hash;
class UserController extends Controller
{
	public function index(){
		$totalDonHang=Order::where('user_id',\Auth::user()->id)->select('id')->count();
		$chuaxuly=Order::where('user_id',\Auth::user()->id)->where('status','1')->select('id')->count();
		$daxuly=Order::where('user_id',\Auth::user()->id)->where('status','2')->select('id')->count();
		$thanhcong=Order::where('user_id',\Auth::user()->id)->where('status','3')->select('id')->count();
		$dsDonhang=Order::where('user_id',\Auth::user()->id)->paginate(10);
		$all_thongke=[
			'totalDonHang'=>$totalDonHang,
			'chuaxuly'=>$chuaxuly,
			'daxuly'=>$daxuly,
			'thanhcong'=>$thanhcong,
			'dsDonhang'=>$dsDonhang
		];  
		return view('pages.user.index',$all_thongke);
	}

	public function showChitiet($id){
		$all_chitietdonhang=Order_detail::where('order_id',$id)->join('product','product.id','=','product_id')->select('name','image','order_detail.price as price','quantity')->get();
		return response()->json($all_chitietdonhang);
	}
	public function deleteDonhang(Request $request){
		$data=$request->all();
		$order=Order::find($data['id']);
		if($order->status==1){
			$order->status=0;
			$order->save();
		}
		return response()->json($order);
	}
	public function editInfo(){
		$user=\Auth::user();
		return view('pages.user.info')->with('user',$user);
	}
	public function updateInfo(Request $request){
		$validator= Validator::make($request->all(), [
			'name'=>'required|max:50|min:5',
			'phone'=>'required|digits:10',
			'address'=>'required|min:15|max:100',
			'avatar' => 'image|max:2048|mimes:jpeg,png,jpg,gif',
		],[
			'name.required'=>'Vui lòng nhập họ tên!',
			'name.max'=>"Họ tên tối đa 50 ký tự!",
			'name.min'=>"Họ tên ít nhất 5 ký tự!",
			'phone.required'=>'Vui lòng nhập số điện thoại!',
			'phone.digits'=>'Số điện thoại gồm 10 chữ số',     
			'address.required'=>'Vui lòng nhập địa chỉ nhận hàng',
			'address.min'=>'Địa chỉ gồm ít nhât 15 ký tự',
			'address.max'=>'Địa chỉ gồm nhiều nhât 100 ký tự',
			'avatar.image'=>'Không phải là hình ảnh',
			'avatar.mimes'=>'Không tồn tại file có phần mở rộng như vậy',
			'avatar.max'=>'File vượt quá dung lượng'
		]);
		
		if ($validator->fails())
		{
			return redirect()->back()->withErrors($validator);
		}
		
		if($request->avatar){
			if(\Auth::user()->avatar!="user.png"){
				$file_old=\Auth::user()->avatar;
				$file_path = public_path('/uploads/avatar/').$file_old;
				unlink($file_path);
			}
			$file=$request->file('avatar');
			$new_name=rand().'.'.$file->getClientOriginalName();
			$file->move(public_path('uploads/avatar'),$new_name);
			User::whereId(\Auth::user()->id)->update(['avatar'=>$new_name,'name'=>$request->name
				,'phone'=>$request->phone,'address'=>$request->address
			]);
			
		}else{
		User::whereId(\Auth::user()->id)->update(['name'=>$request->name
			,'phone'=>$request->phone,'address'=>$request->address
		]);
	}
		return redirect()->back()->with('success','Cập nhật thành công');
	}
	public function editPassword(){
		return view('pages.user.password');
	}
	public function updatePassword(Request $request){
		$validator= Validator::make($request->all(), [
			'password_old'=>'required|min:6',
			'password_new'=>'required|min:6',
            'password_confirm'=>'required_with:password_new|same:password_new|min:6'
		],[
			'password_old.required'=>"Vui lòng nhập mật khẩu",
			'password_old.min'=>"Mật khẩu phải ít nhất có 6 ký tự",

			'password_new.required'=>"Vui lòng nhập mật khẩu",
			'password_new.min'=>"Mật khẩu phải ít nhất có 6 ký tự",

			'password_confirm.required_with'=>'Cần nhập lại mật khẩu',
			'password_confirm.same'=>'Mật khẩu nhập lại không khớp',
			'password_confirm.min'=>"Mật khẩu phải ít nhất có 6 ký tự",    
		]);
		if ($validator->fails())
		{
			$messages = $validator->messages();
			return redirect()->back()->withInput($request->input())->withErrors($validator);
		}
		if(Hash::check($request->password_old,\Auth::user()->password)){
			$user=User::find(\Auth::user()->id);
			$user->password=bcrypt($request->password_new);
			$user->save();
			return redirect()->back()->with('success',"Thay đổi mật khẩu thành công");
		}
		return redirect()->back()->with('danger',"Mật khẩu không đúng");
	}
}
