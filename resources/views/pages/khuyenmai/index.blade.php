@extends('pages.layout.layout')
@section('content')
 <div style="margin-top: -20px" class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>   
                       <li class="active">Khuyến mãi</li>	
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
					@foreach($khuyenmai as $item)
					<div class="col-lg-4 col-md-6">
						<div class="li-blog-single-item pb-25">
							<div class="li-blog-banner">
								<a href="{{URL::to('/'.$item->slug)}}"><img class="img-full" src="{{URL::to('/uploads/khuyenmai/'.$item->image)}}" alt=""></a>
							</div>
							<div class="li-blog-content">
								<div class="li-blog-details">
									<h3 class="li-blog-heading pt-25"><a href="{{URL::to('/'.$item->slug)}}">{{$item->subject}}</a></h3>
									<div class="li-blog-meta">
										<a class="post-time"><i class="fa fa-calendar"></i>start:{{$item->ngaybatdau}} end:{{$item->ngayketthuc}}</a>
									</div>
									<p style="word-wrap: break-word;">{{ \Illuminate\Support\Str::limit($item->content, 90, '...') }}</p>
									<a class="read-more" href="{{URL::to('/'.$item->slug)}}">Đọc thêm...</a>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
			 {{-- {{$khuyenmai->links()}}       --}}   

			<!-- Li's Main Content Area End Here -->
		</div>
	</div>
</div>
<!-- Li's Main Blog Page Area End Here -->
@endsection