<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
class AdminController extends Controller
{
    public function AuthLogin(){
        $id = Session::get('id');
        if($id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
     public function index(){
        return view('admin.admin_login');
    }
     public function show_dashboard(){
        $this->AuthLogin();
        $dsuser = DB::table('admin')->get();
        return view('admin.dashboard',compact('dsuser'));
    }
     public function dashboard(Request $request){
        $email = $request->email;
        $password = md5($request->password);
        $result = DB::table('admin')->where('email',$email)->where('password',$password)->first();
        if($result){
            Session::put('name',$result->name);
            Session::put('id',$result->id);
            return Redirect::to('/dashboard');
        }else{
            Session::put('message','Mật khẩu hoặc tài khoản bị sai.Làm ơn nhập lại');
            return Redirect::to('/admin');
        }
    }
     public function logout(){
        $this->AuthLogin();
        Session::put('name',null);
        Session::put('id',null);
        return Redirect::to('/admin');
    }
}
