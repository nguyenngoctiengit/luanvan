@extends('pages.layout.layout')
@section('content')
 <div style="margin-top: -20px" class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>   
                       <li class="active">{{ \Illuminate\Support\Str::limit($new->subject, 20, '...') }}</li> 
                    </ul>           
                </div>
            </div>  
        </div>      
<!-- Begin Li's Main Content Area -->
<div class="li-main-blog-page li-main-blog-details-page pt-60 pb-60 pb-sm-45 pb-xs-45">
    <div style="margin-top: 30px" class="container">
        <div class="row">
            <!-- Begin Li's Blog Sidebar Area -->
            <div class="col-lg-3 order-lg-1 order-2">
                <div class="li-blog-sidebar-wrapper">
                    <div class="li-blog-sidebar pt-25">
                        <h2 class="li-blog-sidebar-title">Danh mục sản phẩm</h2>
                        <ul class="li-blog-archive">
                            @foreach($cate_product as $item)
                            <li><a href="{{URL::to('/'.$item->slug)}}">{{$item->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="li-blog-sidebar">
                        <h4 class="li-blog-sidebar-title">Tin tức gần đây</h4>
                        @foreach($news_recent as $item)
                        <div style="height: 90px" class="li-recent-post pb-30">
                            <div class="li-recent-post-thumb">
                                <a href="{{URL::to('/'.$item->slug)}}">
                                    <img class="img-full" src="{{URL::to('/uploads/new/'.$item->image)}}" alt="Li's Product Image">
                                </a>
                            </div>
                            <div class="li-recent-post-des">
                                <span><a href="{{URL::to('/'.$item->slug)}}">{{ \Illuminate\Support\Str::limit($item->subject, 20, '...') }}</a></span>
                                <span class="li-post-date">{{$item->created_at}}</span>
                            </div>
                        </div>
                        @endforeach
                      
                    </div>
                  
                </div>
            </div>
            <!-- Li's Blog Sidebar Area End Here -->
            <div  class="col-lg-9 order-lg-1 order-1">
                <div class="row li-main-content">
                    <div class="col-lg-12">
                        <div class="li-blog-single-item pb-30">
                            <div class="li-blog-banner">
                                <img width="100%" height="400px" src="{{URL::to('/uploads/new/'.$new->image)}}" alt="">
                            </div>
                            <div class="li-blog-content">
                                <div class="li-blog-details">
                                    <h3 class="li-blog-heading pt-25"><a href="#">{{ $new->subject}}</a></h3>
                                    <div class="li-blog-meta">
                                        <a class="author" href="#"><i class="fa fa-user"></i>{{$new->name}}</a>
                                        <a class="comment" href="#"><i class="fa fa-comment-o"></i> {{$sl}}</a>
                                        <a class="post-time" href="#"><i class="fa fa-calendar"></i> {{$new->created_at}}</a>
                                    </div>
                                    <p style="word-wrap: break-word;">{{$new->content}}</p>

                                    <div class="li-blog-sharing text-center pt-30">
                                        <h4>share this post:</h4>
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-pinterest"></i></a>
                                        <a href="#"><i class="fa fa-google-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Begin Li's Blog Comment Section -->
                        <div class="li-comment-section">
                            <h3>{{$sl}} Bình luận</h3>
                            <ul>
                               @foreach($comment as $item)
                               <li>
                                <div class="author-avatar pt-15">
                                    <img class="img-full" src="{{URL::to('/uploads/avatar/'.$item->avatar)}}" alt="User">
                                </div>
                                <div class="comment-body pl-15">
                                   
                                    <h5 class="comment-author pt-15">{{$item->name}}</h5>
                                    <div class="comment-post-date">
                                        {{$item->created_at}}
                                    </div>
                                    <p>{{$item->content}}</p>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Li's Blog Comment Section End Here -->
                    <!-- Begin Blog comment Box Area -->
                    @if(\Auth::user())
                    <div class="li-blog-comment-wrapper">
                        <h3>Nơi bạn bày tỏ bình luận</h3>
                        <p>Email của bạn được ẩn đi sau khi bình luận</p>
                        <form action="{{URL::to('tin-tuc/binh-luan/'.$new->id).'/'.$new->slug}}" method="POST">
                           @csrf
                           <div class="comment-post-box">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Bình luận</label>
                                    <textarea name="comment" placeholder="Điền bình luận của bạn"></textarea>
                                    <p style="color: red">{!! $errors->first('comment') !!}</p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 mt-5 mb-sm-20 mb-xs-20">
                                    <label>Tên</label>
                                    <input name="name" value="{{\Auth::user()->name}}" type="text" class="coment-field" placeholder="Name">
                                    <p style="color: red">{!! $errors->first('name') !!}</p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 mt-5 mb-sm-20 mb-xs-20">
                                    <label>Email</label>
                                    <input value="{{\Auth::user()->email}}" name="email" type="text" class="coment-field" placeholder="Email">
                                    <p style="color: red">{!! $errors->first('email') !!}</p>
                                </div>
                                <div class="col-lg-12">
                                    <div class="coment-btn pt-30 pb-xs-30 pb-sm-30 f-left">
                                        <input class="li-btn-2" type="submit" name="submit" value="post comment">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                @endif
                <!-- Blog comment Box Area End Here -->
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- Li's Main Content Area End Here -->
@endsection