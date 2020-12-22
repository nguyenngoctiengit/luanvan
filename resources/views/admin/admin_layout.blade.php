<!DOCTYPE html>
<head>
<title>Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('/backend/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
{{-- <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'> --}}
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('/backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('/backend/css/font-awesome.css')}}" rel="stylesheet"> 
{{-- <link rel="stylesheet" href="{{asset('/backend/css/morris.css')}}" type="text/css"/> --}}
<!-- calendar -->
<link rel="stylesheet" href="{{asset('/backend/css/monthly.css')}}">
<link rel="stylesheet" href="{{asset('/frontend/css/sweetalert.css')}}">
<link rel="stylesheet" href="{{asset('/backend/css/jquery.dataTables.min.css')}}">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{asset('/frontend/js/numeral.min.js')}}"></script>
<script src="{{asset('/backend/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('/backend/js/raphael-min.js')}}"></script>
<script src="{{asset('/frontend/js/sweetalert.min.js')}}"></script>
<script src="{{asset('/backend/js/jquery.dataTables.min.js')}}"></script>

{{-- <script src="{{asset('/backend/js/morris.js')}}"></script> --}}
</head>
<body>
<input type="hidden" class="url_ajax" value="{{URL::to('/')}}">
<input type="hidden" class="url_" value="{{URL::to('/uploads/')}}">
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="{{URL::to('/dashboard')}}" class="logo">
        ADMIN
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->

<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{URL::to('/backend/images/2.png')}}">
                <span class="username">
                	<?php
					$name = Session::get('name');
					if($name){
						echo $name;
						
					}
					?>

                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i>Đăng xuất</a></li>
                <li><a href="{{URL::to('/thay-doi-password')}}">Thay đổi mật khẩu</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{URL::to('/dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Tổng quan</span>
                    </a>
                </li>
                  <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản lý banner</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-banner')}}">Thêm banner</a></li>
                        <li><a href="{{URL::to('/all-banner')}}">Liệt kê banner</a></li>
                      
                    </ul>
                </li>
                 <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản lý mức giá</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-loc-product')}}">Thêm mức giá</a></li>
                        <li><a href="{{URL::to('/all-loc-product')}}">Liệt kê mức giá</a></li>
                      
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Chi tiết hình ảnh</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-image')}}">Thêm hình ảnh cho sản phẩm</a></li>
                        <li><a href="{{URL::to('/all-image')}}">Liệt kê hình ảnh của sản phẩm</a></li>
                      
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh mục sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-category-product')}}">Thêm danh mục sản phẩm</a></li>
						<li><a href="{{URL::to('/all-category-product')}}">Liệt kê danh mục sản phẩm</a></li>
                      
                    </ul>
                </li>
                 <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Thương hiệu sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-brand-product')}}">Thêm hiệu sản phẩm</a></li>
						<li><a href="{{URL::to('/all-brand-product')}}">Liệt kê thương hiệu sản phẩm</a></li>
                      
                    </ul>
                </li>
                  <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-product')}}">Thêm sản phẩm</a></li>
						<li><a href="{{URL::to('/all-product')}}">Liệt kê sản phẩm</a></li>
                      
                    </ul>
                </li>
                <?php
                $id_nhanvien = Session::get('id');
                if($dsuser){
                foreach ($dsuser as $key => $value) {
                    if($value->id == $id_nhanvien){
                      
                        if ($value->phancap_id == 1) {
                            ?>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản lí nhân viên</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/manage-user')}}">Quản lí thành viên công ty</a></li>
                        <li><a href="{{URL::to('/add-user')}}">Thêm thành viên công ty</a></li>
                    </ul>
                </li>
                 <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản lí khuyến mãi</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/all-khuyenmai')}}">Khuyến mãi</a></li>     
                    </ul>
                </li>
                 <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản lý phiếu nhập sản phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/all-phieunhap-product')}}">Liệt kê phiếu nhập sản phẩm</a></li>
                      
                    </ul>
                </li>
                 <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Thống kê</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/thong-ke-don-hang')}}">Thống kê đơn hàng</a></li>
                       <li><a href="{{URL::to('/thong-ke-san-pham')}}">Thống kê sản phẩm</a></li>
                    </ul>
                </li>
                  <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản lý đơn hàng</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/all-order')}}">Liệt kê danh sách đơn hàng</a></li>
                      
                    </ul>
                </li>
                <?php
                        }
                    }
                }
            }
             ?>
             
            </ul>            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
        @yield('admin_content')
    </section>
 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
			</div>
		  </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{asset('/backend/js/ajax.js')}}"></script>
<script src="{{asset('/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('/backend/js/scripts.js')}}"></script>
<script src="{{asset('/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('/backend/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('/backend/js/jquery.scrollTo.js')}}"></script>
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script> --}}


<!-- morris JavaScript -->	

{{-- <script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script> --}}
<!-- calendar -->
	<script type="text/javascript" src="{{asset('/backend/js/monthly.js')}}"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}
        function confirm_delete() {
          return confirm('are you sure?');
      }

        $('.check_order').click(function(){
         
            let id=$(this).data('id_order');
            let url_ajax=$('.url_ajax').val();
            $.ajax({
                method:'get',
                 url:url_ajax+'/check-status/'+id,
                 success:function(data){
                    if(data.flag==true){
                         swal({
                            title:"Đơn hàng có thể đáp ứng được!",
                            closeOnConfirm:true,
                            closeOnCancel:true,
                        });
                    }
                    else{
                        var html='';
                        for (var i = 0; i < data.message.length; i++) {
                            html+=data.message[i].name+' hiện tại có '+data.message[i].count+' sản phẩm'+' thiếu '+(parseInt(data.message[i].quantity-parseInt(data.message[i].count)))+' so với đơn hàng là '+data.message[i].quantity+'\n';
                        }
                        swal({
                            title:"Đơn hàng không đủ cung ứng!",
                            text:html,
                            closeOnConfirm:true,
                            closeOnCancel:true,
                        });
                    }
                 }
            });
       });
        $('.change_status').click(function(){
             if(confirm_delete()){
           let id=$(this).data('id_order');
           let status=$('.select_status_'+id).val();
           let url_ajax=$('.url_ajax').val();
           
           $.ajax({
            method:'get',
            url:url_ajax+'/change-status/'+id,
            data:{status:status},
            success:function(data){
                if(data){
                    var html='';
                        let array=[{value:'0',name:'Đã hủy'},{value:'1',name:'Chưa xử lý'},{value:'2',name:'Đã xử lý'},{value:'3',name:'Đã hoàn thành'}];
                        if(data.status==1){
                            if(status==2){
                                 alert(data.message);
                                 if(data.success==false){
                                  for (var i = 0; i < array.length; i++) {
                                 if(array[i].value==data.status){
                                    html+=`<option selected value="`+array[i].value+`">`+array[i].name+`</option>`;
                                }else{ 
                                    html+=`<option value="`+array[i].value+`">`+array[i].name+`</option>`;
                                }
                            }
                             $('.select_status_'+id).html(html); 
                        }
                        else{
                             $('#name_duyet_'+id).html(data.name); 
                             $('#check_order_'+id).hide();
                        }
                            }
                            else if(status==3){
                                alert(data.message);
                                for (var i = 0; i < array.length; i++) {
                                 if(array[i].value==data.status){
                                    html+=`<option selected value="`+array[i].value+`">`+array[i].name+`</option>`;
                                }else{
                                    html+=`<option value="`+array[i].value+`">`+array[i].name+`</option>`;
                                }
                            }
                             $('.select_status_'+id).html(html); 
                            }
                            else if(status==1){
                                alert(data.message);
                            }else{
                                alert(data.message);
                                $('.select_status_'+id).attr('disabled','disabled');
                                $('#change_status_'+id).attr('disabled','disabled');
                            }

                        }else if(data.status==2){
                            if(status==0){
                                 alert(data.message);
                                  for (var i = 0; i < array.length; i++) {
                                 if(array[i].value==status){
                                    html+=`<option selected>`+array[i].name+`</option>`;
                                }else{
                                    html+=`<option>`+array[i].name+`</option>`
                                }
                            }
                             $('.select_status_'+id).html(html); 
                            $('.select_status_'+id).attr('disabled','disabled');
                            $('#change_status_'+id).attr('disabled','disabled');
                            }
                            else if(status==1){
                                alert(data.message);
                                for (var i = 0; i < array.length; i++) {
                                 if(array[i].value==data.status){
                                    html+=`<option selected value="`+array[i].value+`">`+array[i].name+`</option>`;
                                }else{
                                    html+=`<option value="`+array[i].value+`">`+array[i].name+`</option>`;
                                }
                            }
                            $('.select_status_'+id).html(html); 
                            }
                            else if(status==2){
                                alert(data.message);
                            }else{
                                 alert(data.message);
                                  for (var i = 0; i < array.length; i++) {
                                 if(array[i].value==status){
                                    html+=`<option selected value="`+array[i].value+`">`+array[i].name+`</option>`;
                                }else{
                                    html+=`<option value="`+array[i].value+`">`+array[i].name+`</option>`;
                                }
                            }
                            $('.select_status_'+id).html(html); 
                            $('.select_status_'+id).attr('disabled','disabled');
                            $('#change_status_'+id).attr('disabled','disabled');
                            }

                        }else{
                             alert(data.message);
                             for (var i = 0; i < array.length; i++) {
                                 if(array[i].value==data.status){
                                    html+=`<option selected>`+array[i].name+`</option>`;
                                }else{
                                    html+=`<option>`+array[i].name+`</option>`;
                                }
                            }
                           $('.select_status_'+id).html(html); 
                            $('.select_status_'+id).attr('disabled','disabled');
                            $('#change_status_'+id).attr('disabled','disabled');
                        }
                }
            }
           });
        }});

        $('.btn-xem-chitiet').click(function(){
             let id=$(this).data('id_order');
             let url_ajax=$('.url_ajax').val();
             let urlImage=$('.url_').val();
              $.ajax({
                  method:'get',
                   url:url_ajax+'/view-ct/'+id,
                   success:function(data){
                    var html="";
                    var shipping=`<tr>
                        <th style="text-align:center">ID</th>
                        <th style="text-align:center;">Tên người nhận</th>
                        <th colspan="2" style="text-align:center">Địa chỉ</th>
                        <th style="text-align:center">Số điện thoại</th>
                        <th style="text-align:center">Email</th>
                        <th style="text-align:center">Phương thức thanh toán</th>
                        </tr>
                        <tr>
                        <td style="text-align:center;">`+data.shipping.id+`</td>
                        <td style="text-align:center;">`+data.shipping.name+`</td>
                        <td colspan="2" style="text-align:center;">`+data.shipping.address+`</td>
                        <td style="text-align:center;">`+data.shipping.phone+`</td>
                        <td style="text-align:center;width:100px;word-break: break-all;">`+data.shipping.email+`</td>
                        <td style="text-align:center;">`+(data.shipping.payment==1?"Thanh toán trực tiếp":"Chuyển khoản")+`</td>
                        </tr>
                        `;
                        for (var i in data.all_ct_donhang) {
                            html+=`<tr>
                            <td colspan="3" style="text-align: center;">`+data.all_ct_donhang[i].name+`</td>
                            <td style="text-align: center;"><img width="50px" src="`+urlImage+`/product/`+data.all_ct_donhang[i].image+`"></td>
                            <td style="text-align: center;">`+data.all_ct_donhang[i].price+` VND</td>
                            <td style="text-align:center">`+data.all_ct_donhang[i].quantity+`</td>
                            </tr>
                            `;
                        }
                        var ctdh=`
                        <tr>          
                        <th colspan="3" style="text-align:center;">Tên hàng</th>
                        <th style="text-align:center;">Hình ảnh</th>
                        <th style="text-align:center;width:200px">Giá</th>
                        <th style="text-align:center;width:200px">Số lượng</th>
                        <td><input name="btnDong" id="`+id+`" style="width:120px;height:30px;padding:5px" type="button" value="Đóng chi tiết" class="btn btn-danger dong_ct"></td>
                        </tr>
                        `+html+shipping;

                        $('td[id="'+id+'"]').html(ctdh);
                        $('.dong_ct').click(function(){
                            var id=$(this).attr('id');
                            $('td[id="'+id+'"]').html("");
            });
                   }

              });
        });
       $('.chitiet-phieunhap').click(function(){
        let id=$(this).data('id_phieunhap');
        $('.thaydoimau').removeAttr("style","background:red");
        $('#thaydoimau-'+id).attr("style","background:red");
        let url_ajax=$('.url_ajax').val();
         let urlImage=$('.url_').val();
          $.ajax({
                  method:'get',
                   url:url_ajax+'/all-chitiet-phieunhap/'+id,
                   success:function(data){
                    if(Object.keys(data).length<=3){
                        $('#xem-ct-pn').attr("style","height:auto");
                     }
                     else{
                        $('#xem-ct-pn').attr("style","height:200px");
                     }
                     var html="";
                     for (var i in data) {
                         html+=`<tr><td width="98px">`+data[i].id+`</td>
                        <td width="100px">`+data[i].quantity+`</td>
                        <td width="120px">`+data[i].product_id+`</td>
                        <td style="line-height:20px" width="367px">`+data[i].name+`</td>
                        <td width="100px"><img width="50px" src="`+urlImage+`/product/`+data[i].image+`"></td>
                        <td width="100px"><a class="sua-ct-phieunhap-window button" href="#sua-ct-phieunhap-box" data-id_ct_phieunhap="`+data[i].id+`"><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                        <a data-id_ct_phieunhap="`+data[i].id+`" class="xoa-ct-phieunhap-window button" href="#xoa-ct-phieunhap-box"><i class="fa fa-times text-danger text"></i></a>
                        </td>
                         </tr>`;
                     }

                     $('#xem-ct-pn').html(html);
                     $('a.xoa-ct-phieunhap-window').click(function(){
                        let id=$(this).data('id_ct_phieunhap');
                        let url_ajax=$('.url_ajax').val();
                        $.ajax({
                            method:'get',
                            url:url_ajax+'/delete-chitiet-phieunhap/'+id,
                            success:function(data){
                                if(data=="true")
                                {
                                    alert('Xóa thành công!');
                                    location.reload();
                                }
                                else{
                                    alert('Xóa thất bại! Kiểm tra lại số lượng sản phẩm');
                                }
                            }
                        });
                    });
                     $('a.sua-ct-phieunhap-window').click(function(){
                         let id=$(this).data('id_ct_phieunhap');
                         _ajax=$('.url_ajax').val();
                         var loginBox = $(this).attr('href');
                         $('body').append('<div id="over">');
                         $(loginBox).fadeIn(300);
                         $.ajax({
                            method:'get',
                            url:url_ajax+'/edit-chitiet-phieunhap/'+id,
                            success:function(data){
                                $('.rm-quantity-sua').remove();
                                $('.quantity-sua').val(data.ct_phieunhap.quantity);
                                var html='';
                                for (var i in data.product) {
                                    if(data.ct_phieunhap.product_id==data.product[i].id){
                                        html+=`<option selected value="`+data.product[i].id+`">`+data.product[i].id+`-`+data.product[i].name+`</option>`;
                                    }
                                    html+=`<option value="`+data.product[i].id+`">`+data.product[i].id+`-`+data.product[i].name+`</option>`;
                                }

                                $('.id-product').html(html);    
                                $('.id-ct-phieunhap').val(id);      
                            }
                        });
                         return false;
                     });


                   }
               });
       });


 $('a.them-ct-phieunhap-window').click(function() {
        let id=$(this).data('id_phieunhap');
        let url_ajax=$('.url_ajax').val();
        //lấy giá trị thuộc tính href - chính là phần tử "#login-box"
        var loginBox = $(this).attr('href');
 
        //cho hiện hộp đăng nhập trong 300ms
        $(loginBox).fadeIn(300);
 
        // thêm phần tử id="over" vào sau body
        $('body').append('<div id="over">');
        $('#over').fadeIn(300);
        $.ajax({
            method:'get',
             url:url_ajax+'/add-chitiet-phieunhap/'+id,
             success:function(data){
                var html='';
                $('.rm-quantity').remove();

                for (var i = 0; i < data.length; i++) {
                    html+=`<option value="`+data[i].id+`">`+data[i].id+`-`+data[i].name+`</option>`;
                }

                $('.product_phieunhap').html(html);    
                $('.id_phieunhap').val(id);
                $('.quantity').val(1);      
             }
        });
        return false;
 });
 

  $('a.them-phieunhap-window').click(function() {
        //lấy giá trị thuộc tính href - chính là phần tử "#login-box"
        var loginBox = $(this).attr('href');
        //cho hiện hộp đăng nhập trong 300ms
        $(loginBox).fadeIn(300);
        // thêm phần tử id="over" vào sau body
        $('body').append('<div id="over">');
        $('#over').fadeIn(300);
        $('.rm-title').remove();
        $('.rm-date').remove();
        return false;
 });

  $('a.sua-phieunhap-window').click(function() {
     let id=$(this).data('id_phieunhap');
        let url_ajax=$('.url_ajax').val();
        //lấy giá trị thuộc tính href - chính là phần tử "#login-box"
        var loginBox = $(this).attr('href');
        //cho hiện hộp đăng nhập trong 300ms
        $(loginBox).fadeIn(300);
        // thêm phần tử id="over" vào sau body
        $('body').append('<div id="over">');
        $('#over').fadeIn(300);
      $.ajax({
            method:'get',
             url:url_ajax+'/edit-phieunhap-product/'+id,
             success:function(data){
                $('.rm-title').remove();
                $('.rm-date').remove();
                $('.title-phieunhap-sua').val(data.title); 
                $('.date-phieunhap-sua').val(data.ngaynhap);  
                $('.id_phieunhap-sua').val(id);         
             }
        });
        return false;
 });

 $('a.xoa-phieunhap-window').click(function() {
     let id=$(this).data('id_phieunhap');
     let url_ajax=$('.url_ajax').val();
      $.ajax({
            method:'get',
             url:url_ajax+'/delete-phieunhap-product/'+id,
             success:function(data){
                if(data=="true")
                {
                    alert('Xóa thành công!');
                    location.reload();
                }
                else{
                    alert('Xóa thất bại!');
                }
             }
        });
 });

 // khi click đóng hộp thoại
 $(document).on('click', "a.close, #over", function() {
       $('#over, .them-ct-phieunhap').fadeOut(300 , function() {
           $('#over').remove();
       });
      return false;
 });
  $(document).on('click', "a.close, #over", function() {
       $('#over, .sua-ct-phieunhap').fadeOut(300 , function() {
           $('#over').remove();
       });
      return false;
 });

 $(document).on('click', "a.close, #over", function() {
       $('#over, .them-phieunhap').fadeOut(300 , function() {
           $('#over').remove();
       });
      return false;
 });
  $(document).on('click', "a.close, #over", function() {
       $('#over, .sua-phieunhap').fadeOut(300 , function() {
           $('#over').remove();
       });
      return false;
 });

 $('.them-ptn').click(function(){
    let url_ajax=$('.url_ajax').val();
    let id_phieunhap=$('.id_phieunhap').val();
    let id_sanpham=$('.product_phieunhap').val();
    let quantity=$('.quantity').val();
    var _token = $('input[name="_token"]').val();
    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    $.ajax({
        url:url_ajax+'/save-chitiet-phieunhap',
        method:'POST',
        data:{id_phieunhap:id_phieunhap,id_sanpham:id_sanpham,quantity:quantity},
        success:function(data){
           if(data.success==0){
                        $('.rm-quantity').remove();
                        if(data.error['quantity']){
                            $('.quantity').after(`<p class="rm-quantity" style="color:red">`+data.error['quantity'][0]+`</p>`); 
                        }
                        alert("Bạn chưa nhập số lượng!");
            }else{
                 location.reload();
                alert('Thêm thành công!');
            }
        }
    });
 });
 // ----------------------------------------------------------
 $('.btn-them-phieunhap').click(function(){
    let url_ajax=$('.url_ajax').val();
    let title=$('.title-phieunhap').val();
    let date=$('.date-phieunhap').val();
    var _token = $('input[name="_token"]').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
     $.ajax({
        url:url_ajax+'/save-phieunhap-product',
        method:'POST',
        data:{title:title,date:date},
        success:function(data){
            if(data.success==0){
                        $('.rm-title').remove();
                        $('.rm-date').remove();
                        if(data.error['title']){
                            $('.title-phieunhap').after(`<p class="rm-title" style="color:red">`+data.error['title'][0]+`</p>`); 
                        }
                        if(data.error['date']){
                            $('.date-phieunhap').after(`<p class="rm-date" style="color:red">`+data.error['date'][0]+`</p>`);  
                        }
                        alert("Bạn chưa nhập đủ thông tin bắt buộc!");
            }else{
                 location.reload();
                alert('Thêm thành công!');
            }
           
        }
    });
 });
//------------------------------------------------------------------

 $('.sua-ct-pn').click(function(){
    let url_ajax=$('.url_ajax').val();
    let id_ct_phieunhap=$('.id-ct-phieunhap').val();
    let id_sanpham=$('.id-product').val();
    let quantity=$('.quantity-sua').val();
    var _token = $('input[name="_token"]').val();
    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    $.ajax({
        url:url_ajax+'/update-chitiet-phieunhap',
        method:'POST',
        data:{id_ct_phieunhap:id_ct_phieunhap,id_sanpham:id_sanpham,quantity:quantity},
        success:function(data){
            if(data=="true"){
           location.reload();
           alert('Cập nhật thành công!');
       }else{
            if(data.success==0){
                        $('.rm-quantity-sua').remove();
                        if(data.error['quantity']){
                            $('.quantity-sua').after(`<p class="rm-quantity-sua" style="color:red">`+data.error['quantity'][0]+`</p>`); 
                        }
                        alert("Bạn chưa nhập số lượng!");
            }else{
                alert('Cập nhật thất bại! Kiểm tra lại số lượng sản phẩm!');
            }         
       }
        }
    });
 });

// ---------------------------------------------------------------

$('.btn-sua-phieunhap').click(function(){
    let url_ajax=$('.url_ajax').val();
    let title=$('.title-phieunhap-sua').val();
    let date=$('.date-phieunhap-sua').val();
    let id_phieunhap=$('.id_phieunhap-sua').val();
    var _token = $('input[name="_token"]').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
     $.ajax({
        url:url_ajax+'/update-phieunhap-product',
        method:'POST',
        data:{title:title,date:date,id_phieunhap:id_phieunhap},
        success:function(data){
         if(data.success==0){
                        $('.rm-title').remove();
                        $('.rm-date').remove();
                        if(data.error['title']){
                            $('.title-phieunhap-sua').after(`<p class="rm-title" style="color:red">`+data.error['title'][0]+`</p>`); 
                        }
                        if(data.error['date']){
                            $('.date-phieunhap-sua').after(`<p class="rm-date" style="color:red">`+data.error['date'][0]+`</p>`);  
                        }
                        alert("Bạn chưa nhập đủ thông tin bắt buộc!");
            }else{
                 location.reload();
                alert('Sửa thành công!');
            }
        }
    });
 });
//--------------------------Function hiển thị dialog và tắt------------------------------
    function view_khuyenmai(href){
        //cho hiện hộp khuyến mãi trong 300ms  
        $(href).fadeIn(300);
        // thêm phần tử id="over" vào sau body
        $('body').append('<div id="over">');
        $('#over').fadeIn(300);
        return false;
    }
    $(document).on('click', "a.close, #over", function() {
       $('#over, .khuyenmai').fadeOut(300 , function() {
           $('#over').remove();
       });
    return false;
 });
    var url_ajax=$('.url_ajax').val();
    var urlImage=$('.url_').val();
//-------------------------thêm khuyến mãi----------------------------------------
  $('a.them-khuyenmai-window').click(function() {
        //lấy giá trị thuộc tính href - chính là phần tử "#login-box"
        var khuyenmaiBox = $(this).attr('href');
        view_khuyenmai(khuyenmaiBox);
 });

$('#form-them-khuyenmai').on('submit',function(event){
     event.preventDefault();
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $.ajax({
        url:url_ajax+'/save-khuyenmai',
        method:'POST',
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data){
            debugger;
            if(data.success==0){
                $('#rm-content-them-khuyenmai').remove();
                $('#rm-title-them-khuyenmai').remove();
                $('#rm-slug-them-khuyenmai').remove();
                $('#rm-image-them-khuyenmai').remove();
                $('#rm-start-them-khuyenmai').remove();
                $('#rm-end-them-khuyenmai').remove();
                if(data.error['title']){
                    $('#title-them-khuyenmai').after(`<p id="rm-title-them-khuyenmai" style="color:red">`+data.error['title'][0]+`</p>`); 
                }
               if(data.error['slug']){
                    $('#slug-them-khuyenmai').after(`<p id="rm-slug-them-khuyenmai" style="color:red">`+data.error['slug'][0]+`</p>`); 
                }
                if(data.error['content']){
                    $('#content-them-khuyenmai').after(`<p id="rm-content-them-khuyenmai" style="color:red">`+data.error['content'][0]+`</p>`); 
                }
                if(data.error['hinh']){
                    $('#image-them-khuyenmai').after(`<p id="rm-image-them-khuyenmai" style="color:red">`+data.error['hinh'][0]+`</p>`); 
                }
                if(data.error['start']){
                    $('#start-them-khuyenmai').after(`<p id="rm-start-them-khuyenmai" style="color:red">`+data.error['start'][0]+`</p>`); 
                }
                if(data.error['end']){
                    $('#end-them-khuyenmai').after(`<p id="rm-end-them-khuyenmai" style="color:red">`+data.error['end'][0]+`</p>`); 
                }
                alert("Lỗi về dữ liệu nhập! Bạn vui lòng kiểm tra và nhập lại");
            }else{
               location.reload();
               alert('Thêm thành công!');
           }
        }
    });
});

// ---------------------------End thêm khuyến mãi-----------------------------
// ----------------------------Xóa khuyến mãi-------------------------------
 $('a.xoa-khuyenmai-window').click(function() {
    var result=confirm("Bạn có muốn xóa?");
    if(result){
     let id=$(this).data('id_khuyenmai');
      $.ajax({
            method:'get',
             url:url_ajax+'/delete-khuyenmai/'+id,
             success:function(data){
                if(data=="true")
                {
                    alert('Xóa thành công!');
                    location.reload();
                }
                else{
                    alert(data.message);
                }
             }
        });
  }
 });
//-----------------------------End xóa khuyến mãi----------------------------
//--------------------------------Sửa khuyến mãi----------------------------
  $('a.sua-khuyenmai-window').click(function() {
        var khuyenmaiBox = $(this).attr('href');
        view_khuyenmai(khuyenmaiBox);
        let id=$(this).data('id_khuyenmai');
      $.ajax({
            method:'get',
             url:url_ajax+'/edit-khuyenmai/'+id,
             success:function(data){
                $('.rm-title').remove();
                $('.rm-date').remove();
                $('#value-title-sua-khuyenmai').val(data.subject); 
                $('#value-slug-sua-khuyenmai').val(data.slug); 
                $('#value-content-sua-khuyenmai').val(data.content); 
                $('#value-start-sua-khuyenmai').val(data.ngaybatdau); 
                $('#value-end-sua-khuyenmai').val(data.ngayketthuc); 
                $('#value-image-sua-khuyenmai').html(`<img width="150px" src="`+urlImage+`/khuyenmai/`+data.image+`">`); 
                $('#value-id-sua-khuyenmai').val(data.id); 
             }
        });
 });

$('#form-sua-khuyenmai').on('submit',function(event){
     event.preventDefault();
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
         $.ajax({
        url:url_ajax+'/update-khuyenmai',
        method:'POST',
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data){
            debugger;
            if(data.success==0){
                $('#rm-content-sua-khuyenmai').remove();
                $('#rm-title-sua-khuyenmai').remove();
                $('#rm-slug-sua-khuyenmai').remove();
                $('#rm-image-sua-khuyenmai').remove();
                $('#rm-start-sua-khuyenmai').remove();
                $('#rm-end-sua-khuyenmai').remove();
                if(data.error['title']){
                    $('#title-sua-khuyenmai').after(`<p id="rm-title-sua-khuyenmai" style="color:red">`+data.error['title'][0]+`</p>`); 
                }
               if(data.error['slug']){
                    $('#slug-sua-khuyenmai').after(`<p id="rm-slug-sua-khuyenmai" style="color:red">`+data.error['slug'][0]+`</p>`); 
                }
                if(data.error['content']){
                    $('#content-sua-khuyenmai').after(`<p id="rm-content-sua-khuyenmai" style="color:red">`+data.error['content'][0]+`</p>`); 
                }
                if(data.error['hinh']){
                    $('#image-sua-khuyenmai').after(`<p id="rm-image-sua-khuyenmai" style="color:red">`+data.error['hinh'][0]+`</p>`); 
                }
                if(data.error['start']){
                    $('#start-sua-khuyenmai').after(`<p id="rm-start-sua-khuyenmai" style="color:red">`+data.error['start'][0]+`</p>`); 
                }
                if(data.error['end']){
                    $('#end-sua-khuyenmai').after(`<p id="rm-end-sua-khuyenmai" style="color:red">`+data.error['end'][0]+`</p>`); 
                }
                alert("Lỗi về dữ liệu nhập! Bạn vui lòng kiểm tra và nhập lại");
            }else{
               location.reload();
               alert('Sửa thành công!');
           }
        }
    });
});
// -------------------------End sửa khuyến mãi----------------------------------
// -------------------------Chi tiết khuyến mãi--------------------------------
function datatable(id){
     var table=$('#dtVerticalScrollExample_'+id).DataTable({
        "scrollY": "200px",
        "searching": false,
        "scrollCollapse": true,
         "destroy": true,
        "columns": [
        { "data": "id","title":"ID" },
         { "data": "product_id","title":"ID product" },
        { "data": "name","title":"Name Product","width":"30%"},
        {
            'data': 'image',
            'title':'Image Product',
            'sortable': false,
            'searchable': false,
            'render': function (image) {
                if (!image) {
                    return 'N/A';
                } else {
                    return '<img src="'+urlImage+'/product/' + image + '" height="50px" width="50px" />';
                }
            }
        },
        {
          "data": "discount","title":"Discount" ,
          'render':function(discount){
            return discount+'%';
          }
        },
        { "data": "price","title":"Price" ,
            'render':function(price){
                var price=numeral(price);
               return price.format('0,0')+' '+'VND';
            }
        },
        {  
            "data":null,
            "title":"Price discount" ,
            'render':function(data,type,row){
             var price=row.price-(row.price*row.discount)/100;
             var price_format=numeral(price);
             return price_format.format('0,0')+' '+'VND';
            }
        },
        {
            "data":null,
            "title":"Action",
            "render":function(data,type,row){
                return '<a data-id_ctkhuyenmai="'+row.id+'" class="sua-ct-khuyenmai-window button" href="#sua-ct-khuyenmai-box"><i class="fa fa-pencil-square-o text-success text-active"></i></a><a data-id_ctkhuyenmai="'+row.id+'" class="xoa-ct-khuyenmai-window button" href="#xoa-ct-khuyenmai-box"><i class="fa fa-times text-danger text"></i></a>';
            }
        },
        ],
        "ajax": {
            "url": $('.url_ajax').val()+'/all-chitietkhuyenmai/'+id,
            "dataSrc": function ( json ) {
               return json;
           }
       }
   });
     return table;
}
  
$('.xem-ct-khuyenmai').click(async function(){
    datatable().clear();
    id=$(this).data('id_khuyenmai');
    $('.dataTables_length').addClass('bs-select');
   datatable(id);
    $('#dtVerticalScrollExample_'+id).fadeIn(300);

});
$('.xoa-xem-ct-khuyenmai').click(function(){
   id=$(this).data('id_khuyenmai');
    $('#dtVerticalScrollExample_'+id+'_wrapper').fadeOut(300);
});
// --------------------------End chi tiết khuyến mãi--------------------------
//----------------------------Xóa chi tiết khuyến mãi-------------------------
$(document).on('click','.xoa-ct-khuyenmai-window',function(){
    var result=confirm("Bạn có muốn xóa?");
    if(result){
    let id=$(this).data('id_ctkhuyenmai');
      $.ajax({
            method:'get',
             url:url_ajax+'/delete-chitiet-khuyenmai/'+id,
             success:function(data){
             debugger                  
                alert('Xóa thành công!');
                datatable().clear();
                datatable(data.id);
                // if(data.remove==true){
                //     $('#xoa-xem-ct-khuyenmai_'+id).before(`<a>fffffff</a>`);
                // }
             }
        });
  }
});
//-----------------------------End xóa chi tiết km------------------------------
//-----------------------------Sửa chi tiết khuyến mãi-----------------------

$(document).on('click','.sua-ct-khuyenmai-window',function(){
    let id=$(this).data('id_ctkhuyenmai');
    var khuyenmaiBox = $(this).attr('href');
    view_khuyenmai(khuyenmaiBox);
      $.ajax({
            method:'get',
             url:url_ajax+'/edit-chitiet-khuyenmai/'+id,
             success:function(data){
               $('#id-sua-ct-khuyenmai').val(data.product.id); 
               $('#ct-sua-id-khuyenmai').val(data.product.khuyenmai_id);
                var html='';
                for (var i = 0; i < data.ds_product.length; i++) {
                    if(data.ds_product[i].id==data.product.product_id){
                    html+=`<option selected value="`+data.ds_product[i].id+`">`+data.ds_product[i].id+`-`+data.ds_product[i].name+`</option>`;
                    }else{
                       html+=`<option value="`+data.ds_product[i].id+`">`+data.ds_product[i].id+`-`+data.ds_product[i].name+`</option>`; 
                    }
                }
                $('#select-sua-ctkm').html(html);
                $('#img-product-sua-ctkm').attr("src",urlImage+`/product/`+data.product.image);
                var price_format=numeral(data.product.price);
                $('#value-price-sua-ctkhuyenmai').val(price_format.format('0,0')+' '+'VND');
                $('#value-price-sua-ctkhuyenmai').text(data.product.price);
                $('#value-discount-sua-ctkhuyenmai').val(data.product.discount);
                var price_discount=data.product.price-(data.product.price*data.product.discount)/100;
                var price_discount_format=numeral(price_discount);
                $('#value-price-discount-sua-ctkhuyenmai').val(price_discount_format.format('0,0')+' '+'VND');
             }
        });
});

$('#btn-tinh-gia-sua-ctkm').click(function(){
    var discount=$('#discount-input-sua-ct-km').val();
    var price=$('#value-price-sua-ctkhuyenmai').text();
    if(discount!=""&&price!=""){
        if(discount<=0||discount>100){
             alert("Dữ liệu nhập không chính xác!");
        }
        else{
      price= price-(price*discount)/100;
       var price_format=numeral(price);
       $('#result-tinh-gia-sua-ctkhuyenmai').val(price_format.format('0,0')+' '+'VND');
   }
    }else{
          alert("Chưa nhập dữ liệu");
    }
});

$('#btn-tinh-discount-sua-ctkm').click(function(){
    var price_input=$('#price-input-sua-ct-km').val();
    var price=$('#value-price-sua-ctkhuyenmai').text();
    if(price_input!=""&&price!=""){
        if(price_input<=1000||price_input>=price)
        {
            alert("Dữ liệu nhập không chính xác!");
        }
        else{
            var discount= 100-(price_input/price)*100;
            $('#result-tinh-discount-ctkhuyenmai').val(discount+"%");
        }
    }else{
        alert("Chưa nhập dữ liệu");
    }
});

$('#select-sua-ctkm').change(function(){
     var value=this.value;
        $.ajax({
           method:'get',
             url:url_ajax+'/get-price-product/'+value, 
              success:function(data){              
                var price_format=numeral(data.price);
                $('#value-price-sua-ctkhuyenmai').val(price_format.format('0,0')+' '+'VND');
                $('#value-price-sua-ctkhuyenmai').text(data.price);  
                var discount=$('#value-discount-sua-ctkhuyenmai').val();
                var price_discount=data.price-(data.price*discount)/100;
                var price_discount_format=numeral(price_discount);
                $('#value-price-discount-sua-ctkhuyenmai').val(price_discount_format.format('0,0')+' '+'VND'); 
              }
        });
   
    });
$('#value-discount-sua-ctkhuyenmai').change(function(){  
    var price=$('#value-price-sua-ctkhuyenmai').text();
    var discount=$(this).val();          
    var price_discount=price-(price*discount)/100;
    var price_discount_format=numeral(price_discount);
     $('#value-price-discount-sua-ctkhuyenmai').val(price_discount_format.format('0,0')+' '+'VND'); 
    });

$('#form-ct-sua-khuyenmai').on('submit',function(event){
     event.preventDefault();
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
         $.ajax({
        url:url_ajax+'/update-chitiet-khuyenmai',
        method:'POST',
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data){
            if(data.success==0){
                $('#rm-value-price-sua-ctkhuyenmai').remove();
                if(data.error['discount']){
                    $('#error-discount-sua-ctkm').after(`<p id="rm-value-price-sua-ctkhuyenmai" style="color:red;width:500px">`+data.error['discount'][0]+`</p>`); 
                }
                alert("Lỗi về dữ liệu nhập! Bạn vui lòng kiểm tra và nhập lại");
            }else{
              datatable().clear();
              datatable(data);
              alert('Sửa thành công!');
           }
        }
    });
});

//----------------------------------End-----------------------------------
// ---------------------Thêm chi tiết khuyến mãi---------------------------
  $('a.them-ct-khuyenmai-window').click(function() {
    let id=$(this).data('id_khuyenmai');
        var khuyenmaiBox = $(this).attr('href');
        $(khuyenmaiBox).attr("style","width:1300px;left:5%;right:15%");
       $.ajax({
            method:'get',
             url:url_ajax+'/add-chitiet-khuyenmai/'+id,
             success:function(data){
                $('#xoa-khuyenmai_'+id).hide();
                var html='';
                html+=`<option value="-1">Chưa chọn sản phẩm</option>`;
                for (var i = 0; i < data.length; i++) {
                    html+=`<option value="`+data[i].id+`">`+data[i].id+`-`+data[i].name+`</option>`;
                }
                $('#select-km-product-1').html(html);
                $('#select-km-product-2').html(html);
                $('#select-km-product-3').html(html);
                $('#select-km-product-4').html(html);
                $('#select-km-product-5').html(html); 
                $('#id-khuyenmai').val(id);
             }
        });
        view_khuyenmai(khuyenmaiBox);
 });
$('.select-product').change(function(){
     var value=this.value;
     var name=this.name;
    if(value!=-1){
        $.ajax({
           method:'get',
             url:url_ajax+'/get-price-product/'+value, 
              success:function(data){
               if(name=="id_product_1")
               {
                var price_format=numeral(data.price);
                $('#price-product-1').val(price_format.format('0,0')+' '+'VND');
                $('#price-product-1').text(data.price);
               }
               else if(name=="id_product_2"){
                   var price_format=numeral(data.price);
                   $('#price-product-2').val(price_format.format('0,0')+' '+'VND');
                   $('#price-product-2').text(data.price);
               }
               else if(name=="id_product_3"){
                   var price_format=numeral(data.price);
                   $('#price-product-3').val(price_format.format('0,0')+' '+'VND');
                   $('#price-product-3').text(data.price);
               }
               else if(name=="id_product_4"){
                   var price_format=numeral(data.price);
                   $('#price-product-4').val(price_format.format('0,0')+' '+'VND');
                   $('#price-product-4').text(data.price);
               }
               else if(name=="id_product_5"){
                   var price_format=numeral(data.price);
                   $('#price-product-5').val(price_format.format('0,0')+' '+'VND');
                   $('#price-product-5').text(data.price);
               }
               else{
                alert("Lỗi! Không tồn tại cột đó!");
            }
              }
        });
    }else{
        if(name=="id_product_1")
        {
            $('#price-product-1').val("");
        }
        else if(name=="id_product_2"){

         $('#price-product-2').val("");
        }
         else if(name=="id_product_3"){

           $('#price-product-3').val("");
        }
       else if(name=="id_product_4"){

           $('#price-product-4').val("");
        }
       else if(name=="id_product_5"){
           $('#price-product-5').val("");
        }
       else{
        alert("Lỗi! Không tồn tại cột đó!");
    }
    }
    });
$('#btn-tinh-gia-discount-1').click(function(){
    var discount=$('#txt-discount-product-1').val();
    var price=$('#price-product-1').text();
    if(discount!=""&&price!=""){
        if(discount<=0||discount>100){
             alert("Dữ liệu nhập không chính xác!");
        }
        else{
      price= price-(price*discount)/100;
       var price_format=numeral(price);
       $('#txt-result-discount-product-1').val(price_format.format('0,0')+' '+'VND');
   }
    }else{
          alert("Chưa nhập dữ liệu");
    }
});

$('#btn-tinh-phan-tram-1').click(function(){
    var price_input=$('#txt-price-product-1').val();
    var price=$('#price-product-1').text();
    if(price_input!=""&&price!=""){
        if(price_input<=1000||price_input>=price)
        {
            alert("Dữ liệu nhập không chính xác!");
        }
        else{
            var discount= 100-(price_input/price)*100;
            $('#txt-result-price-product-1').val(discount+"%");
        }
    }else{
        alert("Chưa nhập dữ liệu");
    }
});

// ----
$('#btn-tinh-gia-discount-2').click(function(){
    var discount=$('#txt-discount-product-2').val();
    var price=$('#price-product-2').text();
    if(discount!=""&&price!=""){
        if(discount<=0||discount>100){
             alert("Dữ liệu nhập không chính xác!");
        }
        else{
      price= price-(price*discount)/100;
       var price_format=numeral(price);
       $('#txt-result-discount-product-2').val(price_format.format('0,0')+' '+'VND');
   }
    }else{
          alert("Chưa nhập dữ liệu");
    }
});

$('#btn-tinh-phan-tram-2').click(function(){
    var price_input=$('#txt-price-product-2').val();
    var price=$('#price-product-2').text();
   if(price_input!=""&&price!=""){
        if(price_input<=1000||price_input>=price)
        {
            alert("Dữ liệu nhập không chính xác!");
        }
        else{
            var discount= 100-(price_input/price)*100;
            $('#txt-result-price-product-2').val(discount+"%");
        }
    }else{
        alert("Chưa nhập dữ liệu");
    }
});
// ---
$('#btn-tinh-gia-discount-3').click(function(){
    var discount=$('#txt-discount-product-3').val();
    var price=$('#price-product-3').text();
    if(discount!=""&&price!=""){
        if(discount<=0||discount>100){
             alert("Dữ liệu nhập không chính xác!");
        }
        else{
      price= price-(price*discount)/100;
       var price_format=numeral(price);
       $('#txt-result-discount-product-3').val(price_format.format('0,0')+' '+'VND');
   }
    }else{
          alert("Chưa nhập dữ liệu");
    }
});

$('#btn-tinh-phan-tram-3').click(function(){
    var price_input=$('#txt-price-product-3').val();
    var price=$('#price-product-3').text();
   if(price_input!=""&&price!=""){
        if(price_input<=1000||price_input>=price)
        {
            alert("Dữ liệu nhập không chính xác!");
        }
        else{
            var discount= 100-(price_input/price)*100;
            $('#txt-result-price-product-2').val(discount+"%");
        }
    }else{
        alert("Chưa nhập dữ liệu");
    }
});
// ---
$('#btn-tinh-gia-discount-4').click(function(){
    var discount=$('#txt-discount-product-4').val();
    var price=$('#price-product-4').text();
    if(discount!=""&&price!=""){
        if(discount<=0||discount>100){
             alert("Dữ liệu nhập không chính xác!");
        }
        else{
      price= price-(price*discount)/100;
       var price_format=numeral(price);
       $('#txt-result-discount-product-4').val(price_format.format('0,0')+' '+'VND');
   }
    }else{
          alert("Chưa nhập dữ liệu");
    }
});

$('#btn-tinh-phan-tram-4').click(function(){
    var price_input=$('#txt-price-product-4').val();
    var price=$('#price-product-4').text();
    if(price_input!=""&&price!=""){
        if(price_input<=1000||price_input>=price)
        {
            alert("Dữ liệu nhập không chính xác!");
        }
        else{
            var discount= 100-(price_input/price)*100;
            $('#txt-result-price-product-4').val(discount+"%");
        }
    }else{
        alert("Chưa nhập dữ liệu");
    }
});
// ---
$('#btn-tinh-gia-discount-5').click(function(){
    var discount=$('#txt-discount-product-5').val();
    var price=$('#price-product-5').text();
     if(discount!=""&&price!=""){
        if(discount<=0||discount>100){
             alert("Dữ liệu nhập không chính xác!");
        }
        else{
      price= price-(price*discount)/100;
       var price_format=numeral(price);
       $('#txt-result-discount-product-4').val(price_format.format('0,0')+' '+'VND');
   }
    }else{
          alert("Chưa nhập dữ liệu");
    }
});

$('#btn-tinh-phan-tram-5').click(function(){
    var price_input=$('#txt-price-product-5').val();
    var price=$('#price-product-5').text();

   if(price_input!=""&&price!=""){
        if(price_input<=1000||price_input>=price)
        {
            alert("Dữ liệu nhập không chính xác!");
        }
        else{
            var discount= 100-(price_input/price)*100;
            $('#txt-result-price-product-5').val(discount+"%");
        }
    }else{
        alert("Chưa nhập dữ liệu");
    }
});

$('#form-them-ct-khuyenmai').on('submit',function(event){
     event.preventDefault();
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $.ajax({
        url:url_ajax+'/save-chitiet-khuyenmai',
        method:'POST',
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data){
            if(data.success==1&&data.sl_success>0){
                datatable().clear();
                datatable(data.khuyenmai_id);
                alert('Đã thêm '+data.sl_success+' sản phẩm vào khuyến mãi thành công!');
            }else if(data.sl_success==0){
                alert("Thêm thất bại! Bạn chưa chọn sản phẩm và nhập discount nào");
             }
             else{
                alert("Thêm thất bại!");
             }
               
        }
    });
});
// ----------------------End thêm chi tiết khuyến mãi-----------------------
//------------------------Thống kê đánh giá sản phẩm--------------------------
function datatable_SpDanhgia(){
    var caption = "Thống kê đánh giá sản phẩm";
    $('#dtVerticalScrollExample-spdanhgia').append('<caption style="font-size:25px;font-weight:600">'+caption+'<a id="dong-sp-danhgia" style="margin-left:30px;cursor: pointer">Đóng thống kê</a></caption>');
     var table=$('#dtVerticalScrollExample-spdanhgia').DataTable({
        "scrollY": "500px",
        "searching": false,
        "scrollCollapse": true,
         "destroy": true,
        "columns": [
          {
            "title":"Hạng",
            "data":"hang"
            },
         { "data": "id","title":"ID product" },
        { "data": "name","title":"Name Product","width":"30%"},
        {
            'data': 'image',
            'title':'Image Product',
            'sortable': false,
            'searchable': false,
            'render': function (image) {
                if (!image) {
                    return 'N/A';
                } else {
                    return '<img src="'+urlImage+'/product/' + image + '" height="50px" width="50px" />';
                }
            }
        },
       
         { "data": "one_rate","title":"1 sao" },
         { "data": "two_rate","title":"2 sao" },
         { "data": "three_rate","title":"3 sao" },
         { "data": "four_rate","title":"4 sao" },
         { "data": "five_rate","title":"5 sao" },
         { "data":"sum","title":"Sum" },
          {"data":"average", "title":"Average" },
          ],
        "ajax": {
            "url": $('.url_ajax').val()+'/san-pham-danh-gia',
            "dataSrc": function ( json ) {            
               debugger
               return json;
           }
       }
   });
     return table;
}
$('#thong-ke-sp-danh-gia').click(function(){
    debugger
    datatable_SpDanhgia().clear();
    datatable_SpDanhgia();
    $('#dtVerticalScrollExample-spdanhgia').fadeIn(300);
});
$(document).on('click','#dong-sp-danhgia',function(){
    $('#dtVerticalScrollExample-spdanhgia_wrapper').fadeOut(300);
});
// -----------------------------------End--------------------------------------
//---------------------------Thống kê sản phẩm bán-----------------------------
 function datatable_SpBanChay(){
     var x=$('#select_date_spbanchay').val();
    var caption = "Thống kê số lượng sản phẩm đã bán trong tháng ("+x+')';
    $('#dtVerticalScrollExample-spbanchay').append('<caption style="font-size:25px;font-weight:600">'+caption+'<a id="dong-sp-banchay" style="margin-left:30px;cursor: pointer">Đóng thống kê</a></caption>');
     var table=$('#dtVerticalScrollExample-spbanchay').DataTable({
        "scrollY": "500px",
        "searching": false,
        "scrollCollapse": true,
         "destroy": true,
        "columns": [
          {
            "title":"Hạng",
            "data":"hang"
            },
         { "data": "product_id","title":"ID product" },
        { "data": "name","title":"Name Product","width":"30%"},
        {
            'data': 'image',
            'title':'Image Product',
            'sortable': false,
            'searchable': false,
            'render': function (image) {
                if (!image) {
                    return 'N/A';
                } else {
                    return '<img src="'+urlImage+'/product/' + image + '" height="50px" width="50px" />';
                }
            }
        },
       
        { "data": "price","title":"Price" ,
            'render':function(price){
                var price=numeral(price);
               return price.format('0,0')+' '+'VND';
            }
        },
         {"data":"totalSLBan","title":"Số lượng bán"},
        ],

        "ajax": {
            "url": $('.url_ajax').val()+'/san-pham-ban-chay',
            "data":{'select_date':x},
            "dataSrc": function ( json ) {            
               debugger
               return json;
           }
       }
   });
     return table;
}
$('#thong-ke-sp-ban-chay').click(function(){
    datatable_SpBanChay().clear();
    datatable_SpBanChay();
    $('#dtVerticalScrollExample-spbanchay').fadeIn(300);
});
$(document).on('click','#dong-sp-banchay',function(){
    $('#dtVerticalScrollExample-spbanchay_wrapper').fadeOut(300);
});
//------------------------Thống kê sản phẩm tồn kho--------------------------
function datatable_SpTonKho(){
    var caption = "Thống kê số lượng sản phẩm đang tồn kho";
    $('#dtVerticalScrollExample-sptonkho').append('<caption style="font-size:25px;font-weight:600">'+caption+'<a id="dong-sp-tonkho" style="margin-left:30px;cursor: pointer">Đóng thống kê</a></caption>');
     var table=$('#dtVerticalScrollExample-sptonkho').DataTable({
        "scrollY": "500px",
        "searching": false,
        "scrollCollapse": true,
         "destroy": true,
        "columns": [
          {
            "title":"Hạng",
            "data":"hang"
            },
         { "data": "id","title":"ID product" },
        { "data": "name","title":"Name Product","width":"30%"},
        {
            'data': 'image',
            'title':'Image Product',
            'sortable': false,
            'searchable': false,
            'render': function (image) {
                if (!image) {
                    return 'N/A';
                } else {
                    return '<img src="'+urlImage+'/product/' + image + '" height="50px" width="50px" />';
                }
            }
        },
       
        { "data": "price","title":"Price" ,
            'render':function(price){
                var price=numeral(price);
               return price.format('0,0')+' '+'VND';
            }
        },
         {"data":"count","title":"Số lượng tồn kho"},
        ],

        "ajax": {
            "url": $('.url_ajax').val()+'/san-pham-ton-kho',
            "dataSrc": function ( json ) {            
               debugger
               return json;
           }
       }
   });
     return table;
}
$('#thong-ke-sp-ton-kho').click(function(){
    datatable_SpTonKho().clear();
    datatable_SpTonKho();
    $('#dtVerticalScrollExample-sptonkho').fadeIn(300);
});
$(document).on('click','#dong-sp-tonkho',function(){
    $('#dtVerticalScrollExample-sptonkho_wrapper').fadeOut(300);
});
// -----------------------------------End--------------------------------------
//------------------------Thống kê sản phẩm khuyến mãi--------------------------
function datatable_SpKhuyenmai(){
     var x=$('#select_date_spbanchay').val();
    var caption = "Thống kê khuyến mãi sản phẩm trong tháng ("+x+')';
    $('#dtVerticalScrollExample-spkhuyenmai').append('<caption style="font-size:25px;font-weight:600">'+caption+'<a id="dong-sp-khuyenmai" style="margin-left:30px;cursor: pointer">Đóng thống kê</a></caption>');
     var table=$('#dtVerticalScrollExample-spkhuyenmai').DataTable({
        "scrollY": "500px",
        "searching": false,
        "scrollCollapse": true,
         "destroy": true,
        "columns": [
          {
            "title":"Hạng","width":"auto",
            "data":"hang"
            },
         { "data": "product_id","title":"ID product","width":"auto" },
         { "data": "khuyenmai_id","title":"ID khuyến mãi","width":"auto" },
          { "data": "ngaybatdau","title":"Ngày bắt đầu","width":"auto" },
           { "data": "ngayketthuc","title":"Ngày kết thúc","width":"auto" },
        { "data": "name","title":"Name Product","width":"20%"},
        {
            'data': 'image',
            'title':'Image Product',
            'sortable': false,
            'searchable': false,
            'render': function (image) {
                if (!image) {
                    return 'N/A';
                } else {
                    return '<img src="'+urlImage+'/product/' + image + '" height="50px" width="50px" />';
                }
            }
        },
       
        { "data": "price","title":"Price" ,
            'render':function(price){
                var price=numeral(price);
               return price.format('0,0')+' '+'VND';
            }
        },
         {"data":"discount","title":"Discount(%)",
            'render':function(discount){
                return discount+' %'
            }
        },
          {  
            "data":null,
            "title":"Giá trừ" ,
            'render':function(data,type,row){
             var price=(row.price*row.discount)/100;
             var price_format=numeral(price);
             return price_format.format('0,0')+' '+'VND';
            }
        },
        ],

        "ajax": {
            "url": $('.url_ajax').val()+'/san-pham-khuyen-mai',
             "data":{'select_date':x},
            "dataSrc": function ( json ) {            
               debugger
               return json;
           }
       }
   });
     return table;
}
$('#thong-ke-sp-khuyen-mai').click(function(){
    datatable_SpKhuyenmai().clear();
    datatable_SpKhuyenmai();
    $('#dtVerticalScrollExample-spkhuyenmai').fadeIn(300);
});
$(document).on('click','#dong-sp-khuyenmai',function(){
    $('#dtVerticalScrollExample-spkhuyenmai_wrapper').fadeOut(300);
});
// -----------------------------------End--------------------------------------
		});
// $(document).ready(function(){
// })
	</script>
	<!-- //calendar -->
</body>
</html>
{{-- function service(url,data,result){
    $.ajax({
    url:"url",
    data:data",
    success:function(res){
    result(res)
}
})
}
service("","",function(data){
    
}) --}}