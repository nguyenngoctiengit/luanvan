<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Mail;
use App\Http\Requests\RequestResetPassword;
use Validator;
class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function getFormResetPassword(){
        return view('pages.auth.email');
    }

    public function sendCodeResetPassword(Request $request){
        $email=$request->email;
        $checkUser=User::where('email',$email)->first();
        if(!$checkUser){
            return redirect()->back()->with('status','false');
        }
        $code=bcrypt(md5(time().$email));
        $checkUser->code=$code;
        $checkUser->time_code=Carbon::now();
        $checkUser->save();

        $url=route('get.link.reset.password',['code'=>$checkUser->code,'email'=>$email]);
        $data=['route'=>$url];

        Mail::send('pages.email.reset_password',$data,function($message) use ($email){
            $message->to($email,'Reset password')->subject('Lấy lại mật khẩu');
        });

        return redirect()->back()->with('status','true');
    }
    public function resetPassword(Request $request){
        $code=$request->code;
        $email=$request->email;
        $checkUser=User::where(['code'=>$code,'email'=>$email])->first();
        if(!$checkUser){
             return redirect('/')->with('message','Xin lỗi! Link xác nhận mật khẩu không đúng! Bạn vui lòng kiểm tra lại.');
        }
        return view('pages.auth.reset');
    }

    public function saveResetPassword(Request $request){
         $validator= Validator::make($request->all(), [               
            'password'=>'required|min:6',
            'password_confirm'=>'required_with:password|same:password|min:6|nullable'
            ,
        ],[
          'password.required'=>"Vui lòng nhập mật khẩu",
          'password.min'=>"Mật khẩu phải ít nhất có 6 ký tự",       
          'password_confirm.required_with'=>'Cần nhập lại mật khẩu',
           'password_confirm.same'=>'Mật khẩu nhập lại không khớp',
            'password_confirm.min'=>"Mật khẩu phải ít nhất có 6 ký tự",    
      ]);
        if ($validator->fails())
        {         
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }
        if($request->password){
        $code=$request->code;
        $email=$request->email;           
        $checkUser=User::where(['code'=>$code,'email'=>$email])->first();
        
        if(!$checkUser){
             return redirect('/')->with('danger','Xin lỗi! Đường dẫn mật khẩu không đúng!');
        }
        $checkUser->password=bcrypt($request->password);  
        $checkUser->save();
         return redirect()->route('get.login')->with('success','Bạn đã thay đổi password thành công!');
     }
    }
}
