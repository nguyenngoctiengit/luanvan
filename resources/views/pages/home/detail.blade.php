@extends('pages.layout.layout')
@section('content')
<!-- content-wraper start -->
<div class="content-wraper">
	<div class="container">
		<div class="row single-product-area">
			<div class="col-lg-5 col-md-6">
				<!-- Product Details Left -->
				<div class="product-details-left">
					<div class="product-details-images slider-navigation-1">
						@foreach($image as $item)
						<div class="lg-image">
							<a class="popup-img venobox vbox-item" href="{{URL::to('/uploads/product/'.$item->image)}}" data-gall="myGallery">
								<img src="{{URL::to('/uploads/product/'.$item->image)}}" alt="product image">
							</a>
						</div>
						@endforeach
					</div>
					<div class="product-details-thumbs slider-thumbs-1">
						@foreach($image as $item)                            
						<div class="sm-image"><img src="{{URL::to('/uploads/product/'.$item->image)}}" alt="product image thumb"></div>
						@endforeach
					</div>
				</div>
				<!--/ Product Details Left -->
			</div>

			<div class="col-lg-7 col-md-6">
				<div class="product-details-view-content pt-60">
					<div class="product-info">
						<h2 style="margin-top: 100px;font-family:oswald">{{$product->name_pro}}</h2>						
						<div class="rating-box">
							<ul class="rating rating-with-review-item">
								@php
								$total_rate=$product->one_rate+$product->two_rate+$product->three_rate+$product->four_rate+$product->five_rate;
								if($total_rate!=0){
									$total_rate_tb=round(($product->one_rate+$product->two_rate*2+$product->three_rate*3+$product->four_rate*4+$product->five_rate*5)/$total_rate);
								}else{
									$total_rate_tb=0;
								}
								@endphp
								 @if($total_rate_tb!=0)
								<ul class="rating">
									<li style="margin-right: 100px">Số lượt đánh giá: <span class="test-message" style="font-size: 20px">{{$total_rate}}</span></li>
									@for($i=1;$i<=5;$i++)
									@if($i<=$total_rate_tb)
									<li><i class="fa fa-star-o"></i></li>
									@else
									<li class="no-star"><i class="fa fa-star-o"></i></li>
									@endif
									@endfor
								</ul>
								@else
								<span>Chưa có đánh giá</span>
								@endif
						</div>						
						<div class="price-box pt-20">
							@if($km_discount!=null)
							<span style="color: #FFC526" class="new-price new-price-2">{{number_format(($product->price)-($product->price*$km_discount)/100).' '.'VNĐ'}}</span>
							<span style="margin-left: 50px" class="old-price"><strong><strike>{{number_format($product->price).' '.'VNĐ'}}</strike></strong></span>
							 <span style="margin-left:50px" class="test-message">Giảm {{$km_discount}}%</span>
							@else
							<span style="color: #FFC526" class="new-price new-price-2"><strong>{{number_format($product->price).' '.'VNĐ'}}</strong></span>
							@endif				
						</div>
						
						<div class="product-desc">
							<p>
								<span>{{$product->product_chatlieu}}
								</span>
							</p>
							@if($product->count<=0)
							<span style="font-family:oswald;margin-right:20px;font-size: 17px">Trạng thái: &nbsp<b style="color: red">Hết hàng</b>
							</span>
							<span style="font-family: oswald;font-size: 17px">Số lượng còn:<b style="color: red"> {{$product->count}}</b>
								</span>
							@else
							<span style="font-family:oswald;margin-right:20px;font-size: 17px">Trạng thái: &nbsp<b style="color: blue">Còn hàng</b>
							</span>
							@endif
						</div>	
						@if($product->count>0)																
						<div class="single-add-to-cart">
							<form class="form" action="{{URL::to('/add-cart-ajax')}}" method="post">
								@csrf
								<input type="hidden" value="{{$product->id_product}}" class="cart_product_id_{{$product->id_product}}">
								<input type="hidden" value="{{$product->name_pro}}" class="cart_product_name_{{$product->id_product}}">
								<input type="hidden" value="{{$product->image}}" class="cart_product_image_{{$product->id_product}}">
								<input type="hidden" class="cart_product_slug_{{$product->id_product}}" value="{{$product->slug}}">
							@if($km_discount!=null)
								<input type="hidden" value="{{($product->price)-($product->price*$km_discount)/100}}" class="cart_product_price_{{$product->id_product}}">
								@else
								<input type="hidden" value="{{$product->price}}" class="cart_product_price_{{$product->id_product}}">
								@endif	
								<input type="hidden" value="{{URL::to('/show-cart')}}" name="show_cart" class="show_cart">
								<input type="hidden" value="1" class="cart_product_quantity_{{$product->id_product}}">
								<button type="button" class="btn btn-danger add-to-cart btn-them" data-id_product="{{$product->id_product}}">Thêm giỏ hàng</button>
							</form>
						</div>
						@endif
						<div class="product-additional-info pt-25">
							<a class="wishlist-btn" href="{{route('wishlist.add',['idproduct'=>$product->id_product])}}"><i class="fa fa-heart-o"></i>Thêm yêu thích</a>
							
						</div>
						<div class="block-reassurance">
							<ul>
								<li>
									<div class="reassurance-item">
										<div class="reassurance-icon">
											<i class="fa fa-check-square-o"></i>
										</div>
										<p>Security policy (edit with Customer reassurance module)</p>
									</div>
								</li>
								<li>
									<div class="reassurance-item">
										<div class="reassurance-icon">
											<i class="fa fa-truck"></i>
										</div>
										<p>Delivery policy (edit with Customer reassurance module)</p>
									</div>
								</li>
								<li>
									<div class="reassurance-item">
										<div class="reassurance-icon">
											<i class="fa fa-exchange"></i>
										</div>
										<p> Return policy (edit with Customer reassurance module)</p>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div> 
		</div>
	</div>
</div>
<!-- content-wraper end -->
<!-- Begin Product Area -->
<div class="product-area pt-35">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="li-product-tab">
					<ul class="nav li-product-menu">
						<li><a class="active" data-toggle="tab" href="#description"><span>Mô tả</span></a></li>
						<li><a data-toggle="tab" href="#product-details"><span>Chi tiết</span></a></li>
						<li><a data-toggle="tab" href="#reviews"><span>Bình luận</span></a></li>
					</ul>               
				</div>
				<!-- Begin Li's Tab Menu Content Area -->
			</div>
		</div>
		<div class="tab-content">
			<div id="description" class="tab-pane active show" role="tabpanel">
				<div class="product-description">
					<span>{{$product->mota}}</span>
				</div>
				<div class="row">
					<div class="col-9">
						@foreach($image as $item)                            
						<div><img width="100%" src="{{URL::to('/uploads/product/'.$item->image)}}" alt="product image thumb"></div>
						@endforeach
					</div>
				</div>
			</div>
			<div id="product-details" class="tab-pane" role="tabpanel">
				<div class="product-details-manufacturer">
					<h2 style="font-weight: 500;font-family:oswald">{{$product->name_pro}}</h2>
					<p style="color: #000000"><span>- Danh mục: </span>{{$product->name_cate}}</p>
					<p style="color: #000000"><span>- Thương hiệu: </span>{{$product->name_brand}}</p>
					<p style="color: #000000"><span>- Chất liệu: </span>{{$product->chatlieu}}</p>
					<p style="color: #000000"><span>- Color: </span>{{$product->color}}</p>
					<p style="color: #000000"><span>- Ngăn đựng: </span>{{$product->ngandung}}</p>
					<p style="color: #000000"><span>- Size: </span>{{$product->size}}</p>
					<p style="color: #000000"><span>- Bảo hành: </span>{{$product->baohanh}}</p>
					<p style="color: #000000"><span>- Khối lượng: </span>{{$product->weight}}</p>
					<p style="color: #000000"><span>- Tải trọng: </span>{{$product->taitrong}}</p>
				</div>
			</div>			
			<div id="reviews" class="tab-pane" role="tabpanel">
				<div class="product-reviews">
					<div class="product-details-comment-block">
						@if(\Auth::check())
						<div style="margin-bottom:30px " class="review-btn">
							<a class="review-links" href="" data-toggle="modal" data-target="#mymodal">Viết bình luận</a>
						</div>
						@endif
						 <!-- Begin Li's Blog Comment Section -->
                                    <div class="li-comment-section">
                                        <ul id="li-com">
                                        	@foreach($comment as $item)
                                            <li>
                                                <div class="author-avatar pt-15">
                                                    <img width="80px" src="{{URL::to('/uploads/avatar/'.$item->avatar)}}" alt="User">
                                                </div>
                                                <div class="comment-body pl-15">
                                            		<ul style="margin:none" class="rating">
                                            			@for($i=1;$i<=5;$i++)
                                            			@if($i<=$item->rate)
                                            			<li style="display: inline;border: none;padding: 10px;"><i class="fa fa-star-o"></i></li>
                                            			@else
                                            			<li style="display: inline;border: none;padding: 10px;" class="no-star"><i class="fa fa-star-o"></i></li>		
                                            			@endif
                                            			@endfor
                                            		</ul>
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
						<!-- Begin Quick View | Modal Area -->
						@if(\Auth::check())
						@php
						$user=\Auth::user();
						@endphp
						<div class="modal fade modal-wrapper" id="mymodal">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-body">
										<h3 class="review-page-title">Đánh giá</h3>
										<div class="modal-inner-area row">
											<div class="col-lg-6">
												<div class="li-review-product">
													<img width="100%" src="{{URL::to('/uploads/product/'.$product->image)}}" alt="Li's Product">
													<div class="li-review-product-desc">
														<h2 style="font-weight: 500;font-family:oswald;margin-top: 30px">{{$product->name_pro}}</h2>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="li-review-content">
													<!-- Begin Feedback Area -->
													<div class="feedback-area">
														<div class="feedback">
															<h3 class="feedback-title">Phản hồi</h3>
															
															<form class="form-comment" action="{{URL::to('/binh-luan/'.$product->id_product)}}" method="POST">
																{{csrf_field()}}
																<p class="your-opinion">
																	<label>Số điểm</label>
																	<span>
																		<select name="select" class="star-rating">
																			<option value="1">1</option>
																			<option value="2">2</option>
																			<option value="3">3</option>
																			<option value="4">4</option>
																			<option value="5">5</option>
																		</select>
																	</span>
																</p>
																<p class="feedback-form">
																	<label for="feedback">Đánh giá</label>
																	<textarea id="feedback" class="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
																</p>
															
																<div class="feedback-input">
																	<p class="feedback-form-author">
																		<label for="author">Tên<span class="required"></span>
																		</label>
																		<input class="author" id="author" name="author" value="{{$user->name}}" size="30" aria-required="true" type="text">
																	</p>
																	<p class="feedback-form-author feedback-form-email">
																		<label for="email">Email<span class="required"></span>
																		</label>
																		<input class="email" id="email" name="email" value="{{$user->email}}" size="30" aria-required="true" type="text">
																		<span><sub>*</sub>Email cung cấp sẽ được giấu đi</span>
																	</p>
																	<div class="feedback-btn pb-15">
																		<a href="#" class="close" data-dismiss="modal" aria-label="Close">Đóng</a>
																		<input type="button" class="send-binhluan" value="Gửi bình luận">
																	</div>
																</div>
															</form>
														</div>
													</div>
													<!-- Feedback Area End Here -->
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>   
						<!-- Quick View | Modal Area End Here -->
							@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Product Area End Here -->
<!-- Begin Li's Laptop Product Area -->
<section class="product-area li-laptop-product pt-30 pb-50">
	<div class="container">
		<div class="row">
			<!-- Begin Li's Section Area -->
			<div class="col-lg-12">
				<div class="li-section-title">
					<h2>
						<span>Sản phẩm cùng danh mục</span>
					</h2>
				</div>
				<div class="row">
						<?php
                                   $ngayhientai=now('Asia/Ho_Chi_Minh');
                                   $dem=0;
                                   ?>
                                     @foreach($product_km_same as $item_pro)

                                    <?php $dem++; ?>                              
                                    <div class="col-lg-3">
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                
                                                <a href="{{URL::to($item_pro->slug)}}"> 
                                                    <img src="{{URL::to('/uploads/product/'.$item_pro->image)}}" alt="Li's Product Image">
                                                </a>
                                                @if($item_pro->count==0)
                                                <span class="sticker-het">Hết hàng</span>
                                                @endif
                                               {{--  <span class="sticker">New</span> --}}
                                            </div>
                                             <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        
                                                        <div class="rating-box">
                                                            <ul class="rating">
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                     <h4><a class="product_name" href="{{URL::to($item_pro->slug)}}">{{$item_pro->name}}</a></h4>
                                                      <div class="price-box"> 
                                                       @php
                                                       $price=$item_pro->price;
                                                       $stt=0;
                                                       $discount=0;
                                                       @endphp
                                                        @foreach($khuyenmai as $key=>$item_km)
                                                        @if($item_km->product_id==$item_pro->id && $ngayhientai>=$item_km->ngaybatdau && $ngayhientai< $item_km->ngayketthuc )
                                                        @if($discount<$item_km->discount)
                                                        @php
                                                        $stt++;
                                                        $price=($item_pro->price)-($item_pro->price*$item_km->discount)/100;
                                                        $discount=$item_km->discount;
                                                        @endphp
                                                        @endif
                                                        @endif
                                                        @endforeach
                                                        @if($stt==0)
                                                         <span class="new-price">{{number_format($item_pro->price).' '.'VNĐ'}}</span>
                                                        @else
                                                        <span class="new-price new-price-2">{{number_format($price).' '.'VNĐ'}}</span>
                                                        <span class="old-price">{{number_format($item_pro->price).' '.'VNĐ'}}</span>
                                                        <span class="discount-percentage">{{$discount}}%</span>
                                                        @endif
      
                                                    </div>
                                                </div>

                                                 <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                       @if($item_pro->count>0) 
                                                        <form style="margin-bottom: -40px" class="form" action="{{URL::to('/add-cart-ajax')}}" method="post">
                                                           @csrf
                                            <input type="hidden" value="{{$item_pro->id}}" class="cart_product_id_{{$item_pro->id}}">
                                            <input type="hidden" value="{{$item_pro->name}}" class="cart_product_name_{{$item_pro->id}}">
                                            <input type="hidden" value="{{$item_pro->image}}" class="cart_product_image_{{$item_pro->id}}">
                                            <input type="hidden" value="{{$price}}" class="cart_product_price_{{$item_pro->id}}">
                                            <input type="hidden" value="{{URL::to('/show-cart')}}" name="show_cart" class="show_cart">
                                            <input type="hidden" value="1" class="cart_product_quantity_{{$item_pro->id}}">
                                            <input type="hidden" class="cart_product_slug_{{$item_pro->id}}" value="{{$item_pro->slug}}">
                                            
                                             @if(Auth::check()&&Auth::user()->active==2)
                                            <input type="hidden" class="kt_account" value="1">
                                            @else
                                            <input type="hidden" class="kt_account" value="0">
                                            @endif 
                                                      <button style="float: right" type="button" class="btn btn-default add-to-cart" data-id_product="{{$item_pro->id}}">Thêm giỏ hàng</button>
                                                      </form>
                                                       @endif
                                                        <li><a class="links-details" href="{{URL::to('/wishlist/add-wishlist/'.$item_pro->id)}}"><i class="fa fa-heart-o"></i></a></li>
                                                        <li><a class="btn-quickview" title="quick view" data-id_product="{{$item_pro->id}}" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>

                                                        
                                                    </ul>
                                                </div>
                                             </div>
                                        </div>
                                    </div>
                                      
                                    @if($dem==4)
                                        <div style="width: 100%;height: 10px"></div>
                                        <?php $dem=0; ?>
                                    @endif
                                    @endforeach 
                        <!-- Li's Section Area End Here -->
                  {{--   </div> --}}
                </div>
            </section>
            <!-- Li's Laptop Product Area End Here -->
            @endsection