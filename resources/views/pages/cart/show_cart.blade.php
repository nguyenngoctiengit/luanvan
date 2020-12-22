@extends('pages.layout.layout')
@section('content')
 <div style="margin-top: -20px" class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>   
                        <li class="active">Giỏ hàng</li> 
                    </ul>           
                </div>
            </div>  
        </div>      
 <!--Shopping Cart Area Strat-->
            <div style="margin-top: 20px" class="Shopping-cart-area pt-60 pb-60">
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
                            <form action="{{URL::to('/update-cart')}}" method="post">
                                @csrf
                                <div class="table-content table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="li-product-remove">Xóa</th>
                                                <th class="li-product-thumbnail">Hình ảnh</th>
                                                <th class="cart-product-name">Sản phẩm</th>
                                                <th class="li-product-price">Giá</th>
                                                <th class="li-product-quantity">Số lượng</th>
                                                <th class="li-product-subtotal">Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tblbody">
                                            @if(Session::get('cart')==true)
                                             @php 
                                           $total=0;
                                            @endphp
                                            @foreach(Session::get('cart') as $key=>$cart)

                                            @php 
                                            $subtotal=$cart['product_price']*$cart['product_qty'];
                                            $total+=$subtotal;
                                            $count=App\model\frontend\Product::where('id',$cart['product_id'])->first();
                                            @endphp
                                            <tr>
                                               
                                                <td class="li-product-remove"><a href="{{URL::to('/delete-cart/'.$cart['session_id'].'/x')}}"><i class="fa fa-times"></i></a></td>
                                                <td class="li-product-thumbnail"><a href="{{URL::to('/'.$cart['product_slug'])}}"><img width="90px" src="{{asset('/uploads/product/'.$cart['product_image'])}}" alt="Li's Product Image"></a></td>
                                                <td class="li-product-name"><a href="{{URL::to('/'.$cart['product_slug'])}}">{{$cart['product_name']}}</a></td>
                                                <td class="li-product-price"><span class="amount">{{number_format($cart['product_price']).' '}}VND</span></td>
                                                <td class="quantity">                                             
                                                        <input max="{{$count->count}}" min="1" style="max-width:80px;background-color: white!important;border:none;font-weight: bold;font-size: large;text-align: center;" type="number" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}">
                                                   
                                                </td>
                                                <td class="product-subtotal"><span class="amount">{{number_format($subtotal).' '}}VND</span></td>

                                            </tr>
                                           
                                            @endforeach
                                            @else
                                            <?php
                                            $total=0;
                                             echo "Làm ơn thêm sản phẩm vào giỏ hàng"; ?>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="coupon-all">
                                            <div class="coupon2">
                                                <input class="button" name="update_cart" value="Cập nhật giỏ hàng" type="submit">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7 ml-auto">
                                        <div class="cart-page-total">
                                            <a href="{{URL::to('/delete-all-cart')}}">Xóa tất cả</a>
                                        </div>
                                    </div>
                                    <div class="col-md-5 ml-auto">
                                        <div class="cart-page-total">
                                            <h2>Cart totals</h2>
                                            <ul>
                                                <li>Subtotal <span>{{number_format($total).' '}}VND</span></li>
                                                <li>Total <span>{{number_format($total).' '}}VND</span></li>
                                            </ul>
                                            @if(Auth::check()&&Session::get('cart')==true&&Auth::user()->active==2)
                                            <a href="{{URL::to('/checkout')}}">Tiến hành thanh toán</a>
                                            @else
                                                @if(Session::get('cart')==false)
                                                 <a href="{{route('home')}}">Trở về trang chủ để tiến hành chọn sản phẩm</a>
                                                 @elseif(Auth::check()&&Auth::user()->active==1)
                                                  <a href="{{route('get.resend')}}">Gửi lại link xác nhận tài khoản</a>
                                                 @else
                                                 <a href="{{route('get.login')}}">Đăng nhập</a>
                                                @endif
                                             @endif
                                        </div>
                                    </div>
                                     
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--Shopping Cart Area End-->

@endsection
