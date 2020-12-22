<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\backend\Admin;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Validator;
class UserController extends Controller
{
     public function AuthLogin(){
        $id = Session::get('id');
        if($id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
     public function manage_user(){
        $this->AuthLogin();
        $all_user = DB::table('admin')->join('phancap','phancap.id','=','admin.phancap_id')->select('admin.email as email','admin.name as name','admin.phone as phone','phancap.name as name_phancap','phancap.id as 
            phancap_id','admin.id as id')->get();
        $dsuser = DB::table('admin')->get();
        /*$phancap = DB::table('phancap')->orderby('id','asc')->get();*/
        $role = DB::table('phancap')->orderby('id','asc')->get();
        $manager_user  = view('admin.manage_user')->with('all_user',$all_user)->with('role',$role)->with('dsuser',$dsuser);
        // dd($all_user);
        return view('admin.admin_layout',compact('dsuser'))->with('dsuser',$dsuser)->with('admin.manage_user', $manager_user);
    }

    public function add_user(){
        $this->AuthLogin();
        $role = DB::table('phancap')->orderby('id','asc')->get();
        $dsuser = DB::table('admin')->get();
        return view('admin.add_user',compact('dsuser'))->with('dsuser',$dsuser)->with('role',$role);
    }
    public function save_user(Request $request){
         $this->AuthLogin();
        $user = new Admin();
        $data = $request->all();
        $user->email = $data['email'];
        $user->password =md5($data['password']);
        $user->name = $data['name'];
        $user->phone = $data['phone'];
        $user->phancap_id = $data['phancap'];
        $user->save();        
        Session::put('message','Thêm thành viên thành công');
        return Redirect::to('add-user');
    }
    public function sua_admin(Request $request,$id){
        $this->AuthLogin();
        $data = array();
        $all_user = DB::table('admin')->orderby('id','asc')->get();
        $data['phancap_id'] = $request->phancap;            
        DB::table('admin')->where('id',$id)->update($data);
        Session::put('message','Cập nhật thành công');
        return Redirect::to('manage-user');
    }
    public function editPassword(){
         $this->AuthLogin();
          $dsuser = DB::table('admin')->get();
            $user=DB::table('admin')->where('id',Session::get('id'))->first();
        return view('admin.edit_password')->with('dsuser',$dsuser)->with('user',$user);
    }
    public function updatePassword(Request $request){
         $this->AuthLogin();
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
        $user=DB::table('admin')->where('id',Session::get('id'))->first();
        $user_mahoa_pass=md5($request->password_old);
        if($user_mahoa_pass==$user->password){
            $pass=md5($request->password_new);
            DB::table('admin')->where('id',Session::get('id'))->update(['password'=>$pass]);
            return redirect()->back()->with('success',"Thay đổi mật khẩu thành công");
        }
        return redirect()->back()->with('danger',"Mật khẩu không đúng");

    }
}
