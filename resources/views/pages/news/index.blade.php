@extends('pages.layout.layout')
@section('content')
 <div style="margin-top: -20px" class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>   
                      <li class="active">Tin tức</li> 
                    </ul>           
                </div>
            </div>  
        </div>      
            <!-- Begin Li's Main Blog Page Area -->
            <div class="li-main-blog-page pt-60 pb-55">
                <div class="container">
                    <div class="row">
                        <!-- Begin Li's Main Content Area -->
                        <div class="col-lg-12">
                            <div class="row li-main-content">
                            	@foreach($news as $new)
                                <div class="col-lg-12">
                                    <div class="li-blog-single-item pb-30">
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <div class="li-blog-banner">
                                                	<a href="{{URL::to('/tin-tuc/'.$new->slug)}}"><img width="100%" height="250px" src="{{URL::to('/uploads/new/'.$new->image)}}" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="li-blog-content">
                                                    <div class="li-blog-details">
                                                        <h3 class="li-blosg-heading pt-xs-25 pt-sm-25"><a href="{{URL::to('/tin-tuc/'.$new->slug)}}">{{ \Illuminate\Support\Str::limit($new->subject, 40, '...') }}</a></h3>
                                                        <div class="li-blog-meta">
                                                            <a class="author" href="#"><i class="fa fa-user"></i>{{$new->name}}</a>
                                                            <a class="comment" href="#"><i class="fa fa-comment-o"></i> {{$new->sl_cm}}</a>
                                                            <a class="post-time" href="#"><i class="fa fa-calendar"></i>{{$new->created_at}}</a>
                                                        </div>
                                                        <p style="word-wrap: break-word;">{{ \Illuminate\Support\Str::limit($new->content, 200, '...') }}</p>
                                                        <a class="read-more" href="{{URL::to('tin-tuc/'.$new->slug)}}">Đọc thêm...</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                @endforeach
                                 {{$news->links()}}          
                                
                                
                                
                            </div>
                        </div>
                        <!-- Li's Main Content Area End Here -->
                    </div>
                </div>
            </div>
 @endsection