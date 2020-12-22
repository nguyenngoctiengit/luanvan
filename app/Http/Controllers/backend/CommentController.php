<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use App\model\backend\Comment;
use Illuminate\Support\Facades\Redirect;
class CommentController extends Controller
{
    public function AuthLogin(){
        $id = Session::get('id');
        if($id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function delete_comment($id,$id_product){
        $this->AuthLogin();
        DB::table('comment')->where('id',$id)->delete();
        Session::put('message','Xóa bình luận thành công');
        // return Redirect::to('comment-product/{id_product}');
        return redirect()->route('get.listcomment',['id'=>$id_product]);
    }
    public function comment_product($id){
        $this->AuthLogin();
        $comment = DB::table('comment')->where('product_id',$id)->get();
        $dsuser = DB::table('admin')->get();
        return view('admin.all_comment',compact('dsuser'))->with('comment',$comment);
    }

    //End Function Admin Page
}
