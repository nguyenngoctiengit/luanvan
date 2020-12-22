 @extends('pages.layout.layout')
@section('content')
 <div style="margin-top: -20px" class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>   
                       <li class="active">{{$cate->name}}</li>	
                    </ul>           
                </div>
            </div>  
        </div>  
<div style="margin-left: 100px;margin-top: 30px">
    <form method="get" action="{{route('get.search.category',['slug'=>$cate->slug])}}">
        <div class="row">
            <div class="col-lg-1 title-label">Tìm kiếm</div>
            <label class="title-label">Giá tiền:</label>
            <div class="col-lg-2">
                <select style="height: unset;" name="price_select" class="price-select nice-select wide method">
                    @foreach($price_select as $item)
                    @if($select!=null)
                    @if($item->id==$select->id)
                    <option selected value="{{$item->id}}">{{$item->name}}</option>
                     @else
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endif
                    @else
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <label class="title-label">Thương hiệu:</label>
              <div class="col-lg-2">
                <select style="height: unset;" name="brand_select" class="price-select nice-select wide method">
                    <option value="0">All</option>
                    @foreach($brand as $item)
                    @if($brand_select!=null)
                    @if($item->id==$brand_select)
                    <option selected value="{{$item->id}}">{{$item->name}}</option>
                     @else
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endif
                    @else
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <label class="title-label">Xếp theo:</label>
            <div class="col-lg-2">
                <select style="height: unset;" name="orderby" class="orderby nice-select wide method">
                    @if($orderby!=null)
                    @if($orderby=='sort-default')
                    <option selected value="sort-default" selected="selected">Mặc định</option>
                    <option value="sort-desc">Mới nhất</option>
                    <option value="sort-asc">Sản phẩm cũ</option>
                    @elseif($orderby=='sort-desc')
                     <option value="sort-default">Mặc định</option>
                    <option selected value="sort-desc">Mới nhất</option>
                    <option value="sort-asc">Sản phẩm cũ</option>
                    @else
                     <option value="sort-default">Mặc định</option>
                    <option value="sort-desc">Mới nhất</option>
                    <option selected value="sort-asc">Sản phẩm cũ</option>
                    @endif
                    @else
                    <option value="sort-default" selected="selected">Mặc định</option>
                    <option value="sort-desc">Mới nhất</option>
                    <option value="sort-asc">Sản phẩm cũ</option>
                    @endif
                   
                </select>
            </div>
            <label class="title-label">Click >> để tìm:</label>
            <div class="col-lg-1"><button class="li-btn" type="submit"><i class="fa fa-search"></i></button></div>
        </div>  
    </form>
</div>
 <div class="product-area pt-60 pb-50">
                <div class="container">
                    <div class="tab-content">
                        <div id="li-new-product" class="tab-pane active show" role="tabpanel">
                            <div class="row" style="padding-top:20px">
                                   <?php
                                   $ngayhientai=now('Asia/Ho_Chi_Minh');
                                   $dem=0;
                                   ?>
                                    @foreach($product as $item_pro)
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
                                    @if($select!=null)
                     				@if($price>=$select->price_min&&$price<=$select->price_max)
                                    <?php $dem++; ?>                              
                                    <div class="col-lg-3">
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                
                                                <a href="{{URL::to('/'.$item_pro->slug)}}"> 
                                                    <img src="{{URL::to('/uploads/product/'.$item_pro->image)}}" alt="Li's Product Image">
                                                </a>
                                                @if($discount>0)
                                                 <span class="sticker">-{{$discount}}%</span>
                                                 @endif
                                                @if($item_pro->count==0)
                                                <span class="sticker-het">Hết hàng</span>
                                                @endif
                                              
                                            </div>
                                             <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <div class="rating-box">
                                                            @php
                                                            $total_rate=$item_pro->one_rate+$item_pro->two_rate+$item_pro->three_rate+$item_pro->four_rate+$item_pro->five_rate;
                                                            if($total_rate!=0){
                                                            $total_rate_tb=round(($item_pro->one_rate+$item_pro->two_rate*2+$item_pro->three_rate*3+$item_pro->four_rate*4+$item_pro->five_rate*5)/$total_rate);
                                                            }else{
                                                                $total_rate_tb=0;
                                                            }
                                                            @endphp
                                                             @if($total_rate_tb!=0)
                                                            <ul class="rating">
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
                                                    </div>
                                                     <br />
                                                     <h4><a class="product_name" href="{{URL::to('/'.$item_pro->slug)}}">{{ \Illuminate\Support\Str::limit($item_pro->name, 80, '...') }}</a></h4>
                                                      <div class="price-box"> 
                                                        @if($stt==0)
                                                         <span class="new-price">{{number_format($item_pro->price).' '.'VNĐ'}}</span>
                                                        @else
                                                        <span class="new-price new-price-2">{{number_format($price).' '.'VNĐ'}}</span>
                                                        <span class="old-price">{{number_format($item_pro->price).' '.'VNĐ'}}</span>
                                                       
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
                                     @endif
                                     @else
                                     <?php $dem++; ?>                              
                                    <div class="col-lg-3">
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                
                                                <a href="{{URL::to('/'.$item_pro->slug)}}"> 
                                                    <img src="{{URL::to('/uploads/product/'.$item_pro->image)}}" alt="Li's Product Image">
                                                </a>
                                                @if($discount>0)
                                                 <span class="sticker">-{{$discount}}%</span>
                                                 @endif
                                                @if($item_pro->count==0)
                                                <span class="sticker-het">Hết hàng</span>
                                                @endif
                                              
                                            </div>
                                             <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        
                                                        <div class="rating-box">
                                                            @php
                                                            $total_rate=$item_pro->one_rate+$item_pro->two_rate+$item_pro->three_rate+$item_pro->four_rate+$item_pro->five_rate;
                                                            if($total_rate!=0){
                                                            $total_rate_tb=round(($item_pro->one_rate+$item_pro->two_rate*2+$item_pro->three_rate*3+$item_pro->four_rate*4+$item_pro->five_rate*5)/$total_rate);
                                                            }else{
                                                                $total_rate_tb=0;
                                                            }
                                                            @endphp
                                                             @if($total_rate_tb!=0)
                                                            <ul class="rating">
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
                                                    </div>
                                                     <br />
                                                     <h4><a class="product_name" href="{{URL::to('/'.$item_pro->slug)}}">{{ \Illuminate\Support\Str::limit($item_pro->name, 80, '...') }}</a></h4>
                                                      <div class="price-box"> 
                                                      
                                                        @if($stt==0)
                                                         <span class="new-price">{{number_format($item_pro->price).' '.'VNĐ'}}</span>
                                                        @else
                                                        <span class="new-price new-price-2">{{number_format($price).' '.'VNĐ'}}</span>
                                                        <span class="old-price">{{number_format($item_pro->price).' '.'VNĐ'}}</span>
                                                       
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
                                    @endif
                                    @if($dem==4)
                                        <div style="width: 100%;height: 10px"></div>
                                        <?php $dem=0; ?>
                                    @endif
                                    @endforeach         
                            </div>
                              <div style="margin-top: 50px">{{$product->links()}}</div>
                        </div>
                    </div>
                </div>
            </div>
@endsection