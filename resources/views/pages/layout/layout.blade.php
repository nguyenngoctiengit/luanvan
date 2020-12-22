<!doctype html>
<html class="no-js" lang="zxx">
<head>  
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Shop Balo chính hãng</title>
    <meta name="description" content="Mua Balo chính hãng">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/frontend/images/header/logo.png')}} ">
    <link rel="stylesheet" href="{{asset('/frontend/css/material-design-iconic-font.min.css')}}">
    <link rel="stylesheet" href="{{asset('/frontend/css/ruang-admin.css')}}">
    <link rel="stylesheet" href="{{asset('/frontend/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('/frontend/css/fontawesome-stars.css')}}">
    <link rel="stylesheet" href="{{asset('/frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('/frontend/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('/frontend/css/venobox.css')}}">
    <link rel="stylesheet" href="{{asset('/frontend/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('/frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/frontend/css/helper.css')}}">
    <link rel="stylesheet" href="{{asset('/frontend/style.css')}}">
    <link rel="stylesheet" href="{{asset('/frontend/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('/frontend/css/sweetalert.css')}}">
    <script src="{{asset('/frontend/js/numeral.min.js')}}"></script>
    <!-- jQuery-V1.12.4 -->
<script src="{{asset('/frontend/js/vendor/jquery-1.12.4.min.js')}}"></script>
   
</head>
<body>
    <input type="hidden" class="url_public" value="{{URL::to('/uploads/')}}">
     <input type="hidden" class="url_asset" value="{{URL::to('/')}}">
    <!-- Begin Body Wrapper -->
    <div class="body-wrapper">
        <!-- Begin Header Area -->
        <header>
            <!-- Begin Header Top Area -->
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <!-- Begin Header Top Left Area -->
                        <div class="col-lg-3 col-md-4">
                            <div class="header-top-left">
                                <ul class="phone-wrap">
                                    <li><span>Số điện thoại:</span><a href="">079 437 5598</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Header Top Left Area End Here -->
                        <!-- Begin Header Top Right Area -->
                        <div class="col-lg-6 col-md-5 test-message" style="text-align:center">
                            @if(session()->has('message'))
                                {{session()->get('message')}}
                            @endif
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="header-top-right">
                                <ul class="ht-menu">
                                    <!-- Begin Setting Area -->
                                    <li>
                                        <div class="ht-setting-trigger"><span>Tài khoản</span></div>
                                        <div class="setting ht-setting">
                                            <ul class="ht-setting-list">
                                             
                                                @if(Auth::check())

                                                <li><a href="{{route('user.dashboard')}}">Quản lý</a></li>
                                                @if(Auth::user()->active==2)
                                                 <input type="hidden" class="kt_account" value="1">
                                                @if(Session::get('cart')==true)
                                                <li class="checkout_menu"><a href="{{URL::to('/checkout')}}">Thanh toán</a></li>
                                                @else
                                                <li class="checkout_menu"></li>
                                                @endif
                                                @else
                                                 <li><a>Tài khoản chưa active</a></li>
                                                
                                                @endif
                                                <li><a href="{{route('get.logout')}}">Đăng xuất</a></li>
                                                @else
                                                <li><a href="{{route('get.register')}}">Đăng ký</a></li>
                                                <li><a href="{{route('get.login')}}">Đăng nhập</a></li>
                                                @endif
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Header Top Right Area End Here -->
                    </div>
                </div>
            </div>
            <!-- Header Top Area End Here -->
            <!-- Begin Header Middle Area -->
            <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
                <div class="container">
                    <div class="row">
                        <!-- Begin Header Logo Area -->
                        <div class="col-lg-3">
                            <div class="logo pb-sm-30 pb-xs-30">
                                <a href="{{route('home')}}">
                                    <img width="200px" height="47px" src="{{URL::to('/frontend/images/header/logo.png')}}" alt="">
                                </a>
                            </div>
                        </div>
                        <!-- Header Logo Area End Here -->
                        <!-- Begin Header Middle Right Area -->
                        <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                        <div class="row">
                        <div class="col-lg-8">
                            <!-- Begin Header Middle Searchbox Area -->
                            <table>
                                <tbody>
                                    <tr>
                                        <td style="width: 250px;"><image style="margin-right: 10px" height="55px" src="{{URL::to('/frontend/images/header/icon-20sp-20chinh-20hang.png')}}">
                                            <strong style="color: #ffffff;z-index:99;position:absolute;margin-top: 10px">Hàng hiệu chính hãng</strong>
                                            <strong style="color: #FFC526;z-index:99;position:absolute;margin-top: 30px">Cam kết 100%</strong>
                                        </td>

                                        <td style="width: 250px;"><image style="margin-left: 20px" height="55px" src="{{URL::to('/frontend/images/header/doi-tra-hang3.png')}}">
                                            <strong style="color: #ffffff;z-index:99;position:absolute;margin-top: 10px">Đổi trả 90 ngày</strong>
                                            <strong style="color: #FFC526;z-index:99;position:absolute;margin-top: 30px">Miễn phí</strong>
                                        </td>
                                        <td style="width: 250px;"><image height="55px" src="{{URL::to('/frontend/images/header/bao-hanh3.png')}}">
                                            <strong style="color: #ffffff;z-index:99;position:absolute;margin-top: 10px">Bảo hành 2 năm</strong>
                                            <strong style="color: #FFC526;z-index:99;position:absolute;margin-top: 30px">Miễn phí</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                         
                            <!-- Header Middle Searchbox Area End Here -->
                            <!-- Begin Header Middle Right Area -->
                        </div>
                            <div class="header-middle-right col-lg-4"> 
                                <ul class="hm-menu">
                                    <!-- Begin Header Middle Wishlist Area -->
                                    @if(\Auth::check())
                                    @php
                                    $id_wishlist=\Auth::user()->id_wishlist;
                                    @endphp
                                    @if($id_wishlist!=null)
                                     @php
                                    $count=DB::table('chitiet_wishlist')->where('id_wishlist',$id_wishlist)->count();
                                    @endphp
                                    <li class="hm-wishlist">
                                        <a href="{{route('wishlist.index',['id'=>$id_wishlist])}}">
                                            <span class="cart-item-count wishlist-item-count">{{$count}}</span>
                                            <i class="fa fa-heart-o"></i>
                                        </a>
                                    </li>
                                    @endif
                                    @endif
                                    <li class="hm-minicart">

                                        <div class="hm-minicart-trigger">
                                            @if(Session::get('cart')==true)
                                            @php 
                                            $total=0;
                                            @endphp
                                            @foreach(Session::get('cart') as $key=>$cart)
                                            @php 
                                            $subtotal=$cart['product_price']*$cart['product_qty'];
                                            $total+=$subtotal;
                                            @endphp
                                            @endforeach
                                            <span class="item-icon"></span>
                                            <span class="item-text">{{number_format($total).' '}}VND
                                                <span class="cart-item-count count-cart">

                                                {{count(Session::get('cart'))}}</span>

                                            </span>

                                            @else
                                            <span class="item-icon"></span>
                                            <span class="item-text">0 VND
                                                <span class="cart-item-count count-cart">0
                                                </span>
                                                @endif
                                            </div>
                                            <span></span>
                                            <div class="minicart">
                                                <ul class="minicart-product-list">
                                                    @if(Session::get('cart')==true)      
                                                    @foreach(Session::get('cart') as $key=>$cart)
                                                    <li>
                                                     <a href="{{URL::to('/'.$cart['product_slug'])}}" class="minicart-product-image">
                                                        <img src="{{URL::to('/uploads/product/'.$cart['product_image'])}}" alt="cart products">
                                                    </a>
                                                    <div class="minicart-product-details">
                                                        <h6><a href="{{URL::to('/'.$cart['product_slug'])}}">{{$cart['product_name']}}</a></h6>
                                                        <span>{{number_format($cart['product_price'])}} VND x {{$cart['product_qty']}}</span>
                                                    </div>
                                                  {{--   <button class="close" title="Remove">
                                                        <i class="fa fa-close"></i>
                                                    </button> --}}
                                                </li>
                                                @endforeach
                                                @endif                  
                                            </ul>
                                            @if(Session::get('cart')==true)
                                            <p class="minicart-total">Tổng tiền: <span>{{number_format($total).' '}}VND</span></p>
                                            @else
                                            <p class="minicart-total">Tổng tiền: <span>0 VND</span></p>
                                            @endif
                                            <div class="minicart-button">
                                                <a href="{{URL::to('/show-cart')}}" class="li-button li-button-fullwidth li-button-dark">
                                                    <span>Xem giỏ hàng</span>
                                                </a>
                                                @if(Auth::check())
                                                @if(Auth::user()->active==2)
                                                @if(Session::get('cart')==true)
                                               <a href="{{URL::to('/checkout')}}" class="li-button li-button-fullwidth">
                                                    <span>Thanh toán</span>
                                                </a>
                                                @else
                                                <a href="{{URL::to('/checkout')}}" class="checkout">
                                                </a>
                                                @endif
                                                @endif
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                    <!-- Header Mini Cart Area End Here -->
                                </ul>
                            </div>
                            </div>
                            <!-- Header Middle Right Area End Here -->
                        </div>
                        <!-- Header Middle Right Area End Here -->
                    </div>
                </div>
            </div>
            <!-- Header Middle Area End Here -->
            <!-- Begin Header Bottom Area -->
            <div class="header-bottom header-sticky d-none d-lg-block d-xl-block">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Begin Header Bottom Menu Area -->
                            <div class="hb-menu hb-menu-2 d-xl-block">                              
                                <nav>
                                    <ul>
                                        <li><a href="{{route('home')}}">Home</a>                                      
                                        </li>                                        
                                        <li><a href="{{route('khuyenmai.index')}}">Khuyến mãi</a>                                               
                                        </li>
                                        <li class="megamenu-static-holder"><a href="{{route('news.index')}}">Tin tức</a>                                                
                                        </li>
                                        <li><a href="{{route('about.us')}}">About Us</a></li>
                                      
                                        <!-- Begin Header Bottom Menu Information Area -->
                                        <li style="margin-top: 7px" class="hb-info f-right p-0 d-sm-none d-lg-block">
                                <form method="get" action="{{route('get.search')}}" class="hm-searchbox">
                                <button class="icon_btn"><i class="fa fa-search"></i></button>
                                <input class="keywords_submit" type="text" name="keywords_submit" placeholder="Nhập từ khóa cần tìm ...">
                                <button class="li-btn" type="submit">Tìm kiếm</button>
                                </form>
                                        </li>
                                        <!-- Header Bottom Menu Information Area End Here -->
                                    </ul>
                                </nav>
                            </div>
                            <!-- Header Bottom Menu Area End Here -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header Bottom Area End Here -->
        </header>
        <!-- Header Area End Here -->   
        @yield('content')                 
        <!-- Begin Footer Area -->
        <div class="footer">
            <!-- Begin Footer Static Top Area -->
            <div class="footer-static-top">
                <div class="container">
                    <!-- Begin Footer Shipping Area -->
                    <div class="footer-shipping pt-60 pb-55 pb-xs-25">
                        <div class="row">
                            <!-- Begin Li's Shipping Inner Box Area -->
                            <div class="col-lg-3 col-md-6 col-sm-6 pb-sm-55 pb-xs-55">
                                <div class="li-shipping-inner-box">
                                    <div class="shipping-icon">
                                        <img src="{{URL::to('/frontend/images/footer/1.png')}}" alt="Shipping Icon">
                                    </div>
                                    <div class="shipping-text">
                                        <h2>Giao hàng miễn phí</h2>
                                        <p>Trả hàng miễn phí và kiểm tra thông tin đơn hàng.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Li's Shipping Inner Box Area End Here -->
                            <!-- Begin Li's Shipping Inner Box Area -->
                            <div class="col-lg-3 col-md-6 col-sm-6 pb-sm-55 pb-xs-55">
                                <div class="li-shipping-inner-box">
                                    <div class="shipping-icon">
                                        <img src="{{URL::to('/frontend/images/footer/2.png')}}" alt="Shipping Icon">
                                    </div>
                                    <div class="shipping-text">
                                        <h2>Thanh toán an toàn</h2>
                                        <p>Những phương thức thanh toán phổ biến nhất.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Li's Shipping Inner Box Area End Here -->
                            <!-- Begin Li's Shipping Inner Box Area -->
                            <div class="col-lg-3 col-md-6 col-sm-6 pb-xs-30">
                                <div class="li-shipping-inner-box">
                                    <div class="shipping-icon">
                                        <img src="{{URL::to('/frontend/images/footer/3.png')}}" alt="Shipping Icon">
                                    </div>
                                    <div class="shipping-text">
                                        <h2>Mua sắm uy tín</h2>
                                        <p>Bảo vệ quyền lợi người mua.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Li's Shipping Inner Box Area End Here -->
                            <!-- Begin Li's Shipping Inner Box Area -->
                            <div class="col-lg-3 col-md-6 col-sm-6 pb-xs-30">
                                <div class="li-shipping-inner-box">
                                    <div class="shipping-icon">
                                        <img src="{{URL::to('/frontend/images/footer/4.png')}}" alt="Shipping Icon">
                                    </div>
                                    <div class="shipping-text">
                                        <h2>Trung tâm trợ giúp 24/7</h2>
                                        <p>Bạn có thắc mắc? Hãy gọi cho chúng tôi.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Li's Shipping Inner Box Area End Here -->
                        </div>
                    </div>
                    <!-- Footer Shipping Area End Here -->
                </div>
            </div>
            <!-- Footer Static Top Area End Here -->
            <!-- Begin Footer Static Middle Area -->
            <div class="footer-static-middle">
                <div class="container">
                    <div class="footer-logo-wrap pt-50 pb-35">
                        <div class="row">
                            <!-- Begin Footer Logo Area -->
                            <div class="col-lg-4 col-md-6">
                                <div style="padding-top: 10px" class="footer-logo">
                                    <img width="300px" src="{{URL::to('/frontend/images/header/logo.png')}}" alt="Footer Logo">
                                    <p class="info">Chúng tôi là một nhóm D16_TH10 phát triển chuyên cung cấp những mẫu Balo tốt và chất lượng nhất đến những khách hàng.</p>
                                </div>
                                <ul style="margin-top: -10px" class="des">
                                    <li>
                                        <span>Địa chỉ: </span>42 Phạm Thị Tánh Phường 4 Quận 8 TPHCM
                                    </li>
                                </ul>
                            </div>
                            <!-- Footer Logo Area End Here -->
                            <!-- Begin Footer Block Area -->
                            <div class="col-lg-2 col-md-3 col-sm-6">
                                <div class="footer-block">
                                    <h3 class="footer-block-title">Sản phẩm</h3>
                                    <ul>
                                        <li><a href="">Sale OFF</a></li>
                                        <li><a href="">Sản phẩm mới</a></li>
                                        <li><a href="">Sản phẩm tốt nhất</a></li>
                                        <li><a href="">Liên hệ chúng tôi</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Footer Block Area End Here -->
                            <!-- Begin Footer Block Area -->
                            <div class="col-lg-2 col-md-3 col-sm-6">
                                <div class="footer-block">
                                    <h3 class="footer-block-title">Công ty</h3>
                                    <ul>
                                        <li><a href="">Vận chuyển</a></li>
                                        <li><a href="">Pháp lý</a></li>
                                        <li><a href="{{route('about.us')}}">Thông tin chúng tôi</a></li>
                                        <li><a href="">Liên hệ chúng tôi</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Footer Block Area End Here -->
                            <!-- Begin Footer Block Area -->
                            <div class="col-lg-4">
                                <div class="footer-block">
                                    <h3 class="footer-block-title">Follow Us</h3>
                                    <ul class="social-link">
                                        <li class="twitter">
                                            <a href="https://twitter.com/" data-toggle="tooltip" target="_blank" title="Twitter">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li class="rss">
                                            <a href="https://rss.com/" data-toggle="tooltip" target="_blank" title="RSS">
                                                <i class="fa fa-rss"></i>
                                            </a>
                                        </li>
                                        <li class="google-plus">
                                            <a href="https://www.plus.google.com/discover" data-toggle="tooltip" target="_blank" title="Google Plus">
                                                <i class="fa fa-google-plus"></i>
                                            </a>
                                        </li>
                                        <li class="facebook">
                                            <a href="https://www.facebook.com/" data-toggle="tooltip" target="_blank" title="Facebook">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="youtube">
                                            <a href="https://www.youtube.com/" data-toggle="tooltip" target="_blank" title="Youtube">
                                                <i class="fa fa-youtube"></i>
                                            </a>
                                        </li>
                                        <li class="instagram">
                                            <a href="https://www.instagram.com/" data-toggle="tooltip" target="_blank" title="Instagram">
                                                <i class="fa fa-instagram"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div style="clear:both"></div>
                                  <ul style="margin-top: 10px" class="des">
                                    <li>
                                        <span>Phone: </span><a>079 437 5598</a>
                                    </li>
                                    <li>
                                        <span>Email: </span><a>DH51604025@student.stu.edu.vn</a>
                                    </li>
                                </ul>
                                <div>
                                  
                            </div>
                    </div>
                    <!-- Footer Block Area End Here -->
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Static Middle Area End Here -->
   
</div>
<!-- Footer Area End Here -->
<!-- Begin Quick View | Modal Area -->              
<div class="modal fade modal-wrapper" id="exampleModalCenter" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-inner-area row">
                    <div class="col-lg-5 col-md-6 col-sm-6">
                     <!-- Product Details Left -->
                     <div class="product-details-left">
                        <div class="product-details-images slider-navigation-1">
                              <div id="image-lg" class="lg-image">
                            </div>
                        </div>
                   
                    </div>
                    <!--// Product Details Left -->
                </div>

                <div class="col-lg-7 col-md-6 col-sm-6">
                    <div class="product-details-view-content pt-60">
                        <div class="product-info">
                            <h2 class="name-quickview"></h2>
                            <span class="product-details-ref"></span>
                            <div class="rating-box pt-20">
                                <ul id="rating" class="rating rating-with-review-item">
                                </ul>
                            </div>
                            <div class="price-box pt-20">
                                <span class="new-price new-price-2"></span>
                                <span style="margin-left: 50px" class="new-price-3"></span>
                            </div>
                            <div class="product-desc">
                                <p>
                                    <span class="model-mota">
                                    </span>
                                </p>
                            </div>
                            <p>Trạng thái: <span id="status_product" style="color: red"></span></p>
                            <div class="single-add-to-cart">
                                <form id="model-add-cart" action="#" method="GET" class="cart-quantity">
                                     @csrf
                                        <label>Số lượng</label>
                                        <input id="count_product" name="count" min="1" style="width: 20%" value="1" type="number">
                                            <input id="id_product" type="hidden" value="" name="id">
                                            <input id="name_product" type="hidden" value="" name="name">
                                            <input id="image_product" type="hidden" value="" name="image">
                                            <input id="price_product" type="hidden" value="" name="price">
                                            <input id="slug_product" type="hidden" value="" name="slug">
                                    <button id="btn-submit-model" type="submit" class="btn btn-default add-to-cart" data-id_product="0">Thêm giỏ hàng</button>
                                </form>
                            </div>
                            <div class="product-additional-info pt-25">
                                <a class="wishlist-btn" href="#"><i class="fa fa-heart-o"></i>Thêm yêu thích</a>
                                <div class="product-social-sharing pt-25">
                                    <ul>
                                        <li class="facebook"><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
                                        <li class="twitter"><a href="#"><i class="fa fa-twitter"></i>Twitter</a></li>
                                        <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i>Google +</a></li>
                                        <li class="instagram"><a href="#"><i class="fa fa-instagram"></i>Instagram</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>   
<!-- Quick View | Modal Area End Here -->
</div>

<!-- Body Wrapper End Here -->
<!-- Popper js -->
<script src="{{asset('/frontend/js/vendor/popper.min.js')}}"></script>
<!-- Bootstrap V4.1.3 Fremwork js -->
<script src="{{asset('/frontend/js/bootstrap.min.js')}}"></script>
<!-- Meanmenu js -->
<script src="{{asset('/frontend/js/jquery.meanmenu.min.js')}}"></script>
<!-- Wow.min js -->
{{-- <script src="{{asset('/frontend/js/wow.min.js')}}"></script> --}}
<!-- Slick Carousel js -->
<script src="{{asset('/frontend/js/slick.min.js')}}"></script>
<!-- Owl Carousel-2 js -->
<script src="{{asset('/frontend/js/owl.carousel.min.js')}}"></script>
<!-- Magnific popup js -->
{{-- <script src="{{asset('/frontend/js/jquery.magnific-popup.min.js')}}"></script> --}}
<!-- Isotope js -->
{{-- <script src="{{asset('/frontend/js/isotope.pkgd.min.js')}}"></script> --}}
<!-- loaded js -->
{{-- <script src="{{asset('/frontend/js/imagesloaded.pkgd.min.js')}}"></script> --}}
<!-- Mixitup js -->
{{-- <script src="{{asset('/frontend/js/jquery.mixitup.min.js')}}"></script> --}}
<!-- Countdown -->
{{-- <script src="{{asset('/frontend/js/jquery.countdown.min.js')}}"></script> --}}
<!-- Counterup -->
{{-- <script src="{{asset('/frontend/js/jquery.counterup.min.js')}}"></script> --}}
<!-- Waypoints -->
{{-- <script src="{{asset('/frontend/js/waypoints.min.js')}}"></script> --}}
<!-- Barrating -->
<script src="{{asset('/frontend/js/jquery.barrating.min.js')}}"></script>
<!-- Jquery-ui -->
{{-- <script src="{{asset('/frontend/js/jquery-ui.min.js')}}"></script> --}}
<!-- Venobox -->
<script src="{{asset('/frontend/js/venobox.min.js')}}"></script>
<!-- Nice Select js -->
<script src="{{asset('/frontend/js/jquery.nice-select.min.js')}}"></script>
<!-- ScrollUp js -->
<script src="{{asset('/frontend/js/scrollUp.min.js')}}"></script>
<!-- Sweelart -->
<script src="{{asset('/frontend/js/sweetalert.min.js')}}"></script>

<!-- Main/Activator js -->
<script src="{{asset('/frontend/js/main.js')}}"></script>
</body>

<!-- index30:23-->
</html>


