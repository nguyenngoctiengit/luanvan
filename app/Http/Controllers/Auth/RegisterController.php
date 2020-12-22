<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mail;
use App\Http\Requests\RegisterRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;
class RegisterController extends Controller
{
    public function getRegister(){
        return view('pages.auth.register');
    }

    public function postRegister(Request $request){       
        $validator= Validator::make($request->all(), [
           'name'=>'required|max:50|min:5',
            'email'=>'required|max:50|regex:/^.+@.+$/i|unique:users,email',
            'password'=>'required|min:6',
            'confirmpass'=>'required_with:password|same:password|min:6|nullable'
            ,
        ],['email.required'=>"Vui lòng nhập email",
          'email.unique'=>"Đã tồn tại email!",
          'password.required'=>"Vui lòng nhập mật khẩu",
          'password.min'=>"Mật khẩu phải ít nhất có 6 ký tự",
          'email.max'=>"Email vượt quá số kỳ tự cho phép!",
          'email.regex'=>'Sai định dạng email',
          'name.required'=>'Vui lòng nhập họ tên!',
          'name.max'=>"Họ tên tối đa 50 ký tự!",
          'name.min'=>"Họ tên ít nhất 5 ký tự!",
          'confirmpass.required_with'=>'Cần nhập lại mật khẩu',
           'confirmpass.same'=>'Mật khẩu nhập lại không khớp',
            'confirmpass.min'=>"Mật khẩu phải ít nhất có 6 ký tự",    
      ]);
        if ($validator->fails())
        {
           $messages = $validator->messages();
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }
        
      $email = $request->email;
       $user=new User();
       $user->name=$request->name;
       $user->email=$request->email;
       $user->password=bcrypt($request->password);
       $user->save();
       if($user->id){
        $email=$user->email;
        $code=bcrypt(md5(time().$email));
        $url=route('user.verify.account',['id'=>$user->id,'code'=>$code]);
        $user->code_active=$code;
        $user->save();
    
        $data=['route'=>$url];

        Mail::send('pages.email.verify_account',$data,function($message) use ($email)
        {
            $message->to($email,'Xác nhận tài khoản')->subject('Xác nhận tài khoản');
        });
       
        return redirect()->route('get.login')->with('success','Đăng ký thành công! Bạn vui lòng check mail để hoàn thành đăng ký và có thể tiến hành đặt hàng');
       }
     
    }

    public function verifyAccount(Request $request){
        $code=$request->code;
        $id=$request->id;
        $checkUser=User::where(['code_active'=>$code,'id'=>$id])->first();
        if(!$checkUser){
            return "Xin lỗi! Đường dẫn xác nhận tài khoản không tồn tại";
        }
        $checkUser->active='2';
        $checkUser->time_active=Carbon::now();
        $checkUser->save();
        return redirect('/')->with('message','Xác nhận tài khoản thành công mời bạn có thể đăng nhập tiến hành mua hàng!');
    } 

    public function resendCodeActive(){
      $user=\Auth::user();
      $email=$user->email;
      $code=bcrypt(md5(time().$email));
      $user->code_active=$code;
      $user->save();
      $url=route('user.verify.account',['id'=>$user->id,'code'=>$code]);
       $data=['route'=>$url];
        Mail::send('pages.email.verify_account',$data,function($message) use ($email)
        {
            $message->to($email,'Xác nhận tài khoản')->subject('Xác nhận tài khoản');
        });
        return redirect()->back()->with('message','Gửi link xác nhận tài khoản thành công! Vui lòng check mail để tiến hành mua hàng!');
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
