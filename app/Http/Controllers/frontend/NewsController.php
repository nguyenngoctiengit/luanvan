<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\frontend\news;
use App\model\frontend\Comment;
use App\model\frontend\Category;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;
use Validator;
use Illuminate\Support\Facades\Redirect;
class NewsController extends Controller
{
    public function index(){
    	$news=News::join('admin','admin.id','=','admin_id')->leftjoin('comment','news_id','=','news.id')->select('news.content','image','subject','admin.name','news.created_at','news.id','slug',DB::raw('COUNT(comment.id) as sl_cm'))->groupBy('news.id','news.content','image','subject','admin.name','created_at')->paginate(12);
    	return view('pages.news.index')->with('news',$news);
    }
    public function showChitiet($slug){
        $cate_product=Category::get();
        $new=News::join('admin','admin.id','=','admin_id')->select('news.content','image','subject','admin.name','news.created_at','news.id','slug')->where('news.slug',$slug)->first();
        $news_recent=News::limit(7)->orderby('id','desc')->get();          	
    	$comment=Comment::where('news_id',$new->id)->select('comment.*','avatar')->join('users','users.id','=','comment.user_id')->orderby('comment.id','desc')->get();
    	$sl=Comment::where('news_id',$new->id)->count();

    	return view('pages.news.detail')->with('new',$new)->with('comment',$comment)->with('sl',$sl)->with('cate_product',$cate_product)->with('news_recent',$news_recent);
    }
    public function storeComment($id,$slug,Request $request){
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
           $messages = $validator->messages();
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }
    		$comment=new Comment();
    		$comment->email=$request->email;
    		$comment->name=$request->name;
    		$comment->content=$request->comment;
    		$comment->news_id=$id;
            $comment->user_id=\Auth::user()->id;
    		$comment->save();
    		return redirect()->route('chitiettintuc',['slug'=>$slug]);
    }
}
