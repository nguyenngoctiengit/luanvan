<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;

class LoginController extends Controller
{
    use AuthenticatesUsers;

   public function getLogin(){
    return view('pages.auth.login');
   }
   public function postLogin(Request $request){
    $validator= Validator::make($request->all(), [        
            'email'=>'required|max:50|regex:/^.+@.+$/i',
            'password'=>'required|min:6',       
        ],['email.required'=>"Vui lòng nhập email",
          'password.required'=>"Vui lòng nhập mật khẩu",
          'password.min'=>"Mật khẩu phải ít nhất có 6 ký tự",
          'email.max'=>"Email vượt quá số kỳ tự cho phép!",
          'email.regex'=>'Sai định dạng email', 
      ]);
        if ($validator->fails())
        {         
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }
    $remember=$request->has('remember')?true:false;
    $credentials=$request->only('email','password');
    if(\Auth::attempt($credentials,$remember)){
       if(\Auth::user()->active==2){      
       return redirect()->action('frontend\HomeController@index')->with('message','Đăng nhập thành công bạn có thể tiến hành mua hàng');
        }
        else{
            return redirect()->action('frontend\HomeController@index')->with('message','Đăng nhập thành công nhưng tài khoản của bạn chưa kích hoạt, bạn vui lòng kích hoạt tài khoản để tiến hành mua hàng');
        }
    }
      return redirect()->back()->with('fail', 'Đăng nhập thất bại'); 
   }
  public function getLogout(){
    \Auth::logout();
     return redirect()->back()->with('message','Đăng xuất thành công');
  }
}
