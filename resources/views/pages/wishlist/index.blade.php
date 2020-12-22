@extends('pages.layout.layout')
@section('content')
 <div style="margin-top: -20px" class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>   
                      <li class="active">Wishlist</li>
                    </ul>           
                </div>
            </div>  
        </div>      
       
<!--Wishlist Area Strat-->
<div class="wishlist-area pt-60 pb-60">
	<div class="container">
		<div class="row">
			<div class="col-12">
				@if(session()->has('message'))
				<div class="alert alert-success">
					{{session()->get('message')}}
				</div> 
				@elseif(session()->has('error'))  
				<div class="alert alert-danger">
					{{session()->get('error')}}
				</div> 
				@endif
				<form>
					<div class="table-content table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th class="li-product-remove">Xóa</th>
									<th class="li-product-thumbnail">Hình ảnh</th>
									<th class="cart-product-name">Tên sản phẩm</th>
									<th class="li-product-price">Giá góc</th>
									<th class="li-product-price">Giá giảm</th>
									<th class="li-product-stock-status">Tồn kho</th>
									<th class="li-product-add-cart">Giỏ hàng</th>
								</tr>
							</thead>
							<tbody>
								  <?php
                                   $ngayhientai=now('Asia/Ho_Chi_Minh');
                                   ?>
								@foreach($ct_wishlist as $item)
								<tr>
									<td class="li-product-remove"><a href="{{route('wishlist.delete',['idctwishlist'=>$item->id_wishlist])}}"><i class="fa fa-times"></i></a></td>
									<td class="li-product-thumbnail"><a href="{{URL::to('/'.$item->slug)}}"><img style="width: 50px"  src="{{asset('/uploads/product/'.$item->image)}}" alt=""></a></td>
									<td class="li-product-name"><a href="{{URL::to('/'.$item->slug)}}">{{$item->name}}</a></td>
									@php
									$price=$item->price;
									$stt=0;
									$discount=0;
									@endphp
								
									 @foreach($khuyenmai as $key=>$item_km)
									 @if($item_km->product_id==$item->id_pro && $ngayhientai>=$item_km->ngaybatdau && $ngayhientai< $item_km->ngayketthuc )
									  @if($discount<$item_km->discount)
									  @php
									  $stt++;
									  $price=($item->price)-($item->price*$item_km->discount)/100;
									  $discount=$item_km->discount;
									  @endphp
									  @endif
									  @endif
									 @endforeach
									 @if($stt!=0)
									 <td class="li-product-price"><span class="amount"><strike>{{number_format($item->price)}}</strike> VND</span></td>
									 <td class="li-product-price"><span style="color: red"  class="amount">{{number_format($price)}} VND</span> </td>
									@else
									<td class="li-product-price"><span class="amount">{{number_format($item->price)}}</span> VND</td>
									<td></td>
									@endif
									@if($item->count>0)
									<td class="li-product-stock-status"><span class="in-stock">in stock</span></td>
									@else
									<td class="li-product-stock-status"><span class="out-stock">Out stock</span></td>
									@endif
									
									<td>
										  <form style="margin-bottom: -40px" class="form" action="{{URL::to('/add-cart-ajax')}}" method="post">
										  	@csrf

										  	<input type="hidden" value="{{$item->id_pro}}" class="cart_product_id_{{$item->id_pro}}">
                                            <input type="hidden" value="{{$item->name}}" class="cart_product_name_{{$item->id_pro}}">
                                            <input type="hidden" value="{{$item->image}}" class="cart_product_image_{{$item->id_pro}}">
                                            <input type="hidden" value="{{$price}}" class="cart_product_price_{{$item->id_pro}}">
                                            <input type="hidden" value="{{URL::to('/show-cart')}}" name="show_cart" class="show_cart">
                                            <input type="hidden" value="1" class="cart_product_quantity_{{$item->id_pro}}">
                                             <input type="hidden" class="cart_product_slug_{{$item->id_pro}}" value="{{$item->slug}}">
                                             @if(Auth::check()&&Auth::user()->active==2)
                                            <input type="hidden" class="kt_account" value="1">
                                             @else
                                            <input type="hidden" class="kt_account" value="0">
                                            @endif 
                                        @if($item->count>0) 
										<button style="margin-top: -20px"type="button" class="btn btn-danger add-to-cart btn-them" data-id_product="{{$item->id_pro}}">Thêm giỏ hàng</button>
										@else
										<button disabled="disabled" style="margin-top: -20px" type="button" class="btn btn-default add-to-cart" data-id_product="{{$item->id_pro}}">Thêm giỏ hàng</button>
										@endif
									</form>
									</td>
									
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--Wishlist Area End-->
@endsection