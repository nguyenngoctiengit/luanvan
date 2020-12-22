/*--------------------------------------------------
Template Name: limupa;
Description: limupa - Digital Products Store ECommerce Bootstrap 4 Template;
Template URI:;
Author Name:HasTech;
Author URI:;
Version: 1;
Note: main.js, All Default Scripting Languages For This Theme Included In This File.
-----------------------------------------------------
		CSS INDEX
		================
		01. Li's Meanmenu
		02. Header Dropdown
		03. Li's Sticky Menu Activation
		04. Nice Select
		05. Main Slider Activision
		06. Li's Product Activision
		07. Li's Product Activision
		08. Countdown
		09. Tooltip Active
		10. Scroll Up
		11. Category Menu
		12. Li's Product Activision
		13. FAQ Accordion
		14. Toggle Function Active
		15. Li's Blog Gallery Slider
		16. Counter Js
		17. Price slider
		18. Category menu Activation
		19. Featured Product active
		20. Featured Product 2 active
		21. Modal Menu Active
		22. Cart Plus Minus Button
		23. Single Prduct Carousel Activision
		24. Star Rating Js
		25. Zoom Product Venobox
		26. WOW

		-----------------------------------------------------------------------------------*/
		(function ($) {
			"use Strict";

			/*----------------------------------------*/
/* 	01. Li's Meanmenu
/*----------------------------------------*/
jQuery('.hb-menu nav').meanmenu({
	meanMenuContainer: '.mobile-menu',
	meanScreenWidth: "991"
})
/*----------------------------------------*/
 /*  02. Header Dropdown
 /*----------------------------------------*/
 	// Li's Dropdown Menu
 	$('.ht-setting-trigger, .ht-currency-trigger, .ht-language-trigger, .hm-minicart-trigger, .cw-sub-menu').on('click', function (e) {
 		e.preventDefault();
 		$(this).toggleClass('is-active');
 		$(this).siblings('.ht-setting, .ht-currency, .ht-language, .minicart, .cw-sub-menu li').slideToggle();
 	});
 	$('.ht-setting-trigger.is-active').siblings('.catmenu-body').slideDown();
 	/*----------------------------------------*/
/* 03. Li's Sticky Menu Activation
/*----------------------------------------*/
$(window).on('scroll',function() {
	if ($(this).scrollTop() > 300) {
		$('.header-sticky').addClass("sticky");
	} else {
		$('.header-sticky').removeClass("sticky");
	}
});
/*----------------------------------------*/
/*  04. Nice Select
/*----------------------------------------*/
$(document).ready(function() {
	$('.nice-select').niceSelect();
});
/*----------------------------------------*/
/* 05. Main Slider Activision
/*----------------------------------------*/
$(".slider-active").owlCarousel({
	loop: true,
	margin: 0,
	nav: true,
	autoplay: true,
	items: 1,
	autoplayTimeout: 5000,
	navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
	dots: true,
	autoHeight: true,
	lazyLoad: true
});
/*----------------------------------------*/
/* 06. Li's Product Activision
/*----------------------------------------*/
$(".product-active").owlCarousel({
	loop: false,
	nav: true,
	dots: false,
	autoplay: false,
	autoplayTimeout: 5000,
	navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
	item: 0,
	responsive: {
		0: {
			items: 1
		},
		480: {
			items: 2
		},
		768: {
			items: 3
		},
		992: {
			items: 4
		},
		1200: {
			items: 5
		}
	}
});
/*----------------------------------------*/
/* 07. Li's Product Activision
/*----------------------------------------*/
$(".special-product-active").owlCarousel({
	loop: true,
	nav: false,
	dots: false,
	autoplay: false,
	autoplayTimeout: 5000,
	navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-left"></i>'],
	item: 4,
	responsive: {
		0: {
			items: 1
		},
		480: {
			items: 1
		},
		768: {
			items: 2
		},
		992: {
			items: 3
		},
		1200: {
			items: 4
		}
	}
});
/*----------------------------------------*/
/* 09. Tooltip Active
/*----------------------------------------*/
$('.product-action a, .social-link a').tooltip({
	animated: 'fade',
	placement: 'top',
	container: 'body'
});
/*----------------------------------------*/
/* 10. Scroll Up
/*----------------------------------------*/
$.scrollUp({
	scrollText: '<i class="fa fa-angle-double-up"></i>',
	easingType: 'linear',
	scrollSpeed: 900
});
/*----------------------------------------*/
/* 11. Category Menu
/*----------------------------------------*/
$('.rx-parent').on('click', function(){
	$('.rx-child').slideToggle();
	$(this).toggleClass('rx-change');
});
	//    category heading
	$('.category-heading').on('click', function(){
		$('.category-menu-list').slideToggle(300);
	});	
	/*-- Category Menu Toggles --*/
	function categorySubMenuToggle() {
		var screenSize = $(window).width();
		if ( screenSize <= 991) {
			$('#cate-toggle .right-menu > a').prepend('<i class="expand menu-expand"></i>');
			$('.category-menu .right-menu ul').slideUp();
		} else {
			$('.category-menu .right-menu > a i').remove();
			$('.category-menu .right-menu ul').slideDown();
		}
	}
	categorySubMenuToggle();
	$(window).resize(categorySubMenuToggle);

	/*-- Category Sub Menu --*/
	function categoryMenuHide(){
		var screenSize = $(window).width();
		if ( screenSize <= 991) {
			$('.category-menu-list').hide();
		} else {
			$('.category-menu-list').show();
		}
	}
	categoryMenuHide();
	$(window).resize(categoryMenuHide);
	$('.category-menu-hidden').find('.category-menu-list').hide();
	$('.category-menu-list').on('click', 'li a, li a .menu-expand', function(e) {
		var $a = $(this).hasClass('menu-expand') ? $(this).parent() : $(this);
		if ($a.parent().hasClass('right-menu')) {
			if ($a.attr('href') === '#' || $(this).hasClass('menu-expand')) {
				if ($a.siblings('ul:visible').length > 0) $a.siblings('ul').slideUp();
				else {
					$(this).parents('li').siblings('li').find('ul:visible').slideUp();
					$a.siblings('ul').slideDown();
				}
			}
		}
		if ($(this).hasClass('menu-expand') || $a.attr('href') === '#') {
			e.preventDefault();
			return false;
		}
	});
	/*----------------------------------------*/
/* 12. Li's Product Activision
/*----------------------------------------*/
$(".li-featured-product-active").owlCarousel({
	loop: true,
	nav: false,
	dots: false,
	margin: 30,
	autoplay: false,
	autoplayTimeout: 5000,
	navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-left"></i>'],
	item: 2,
	responsive: {
		0: {
			items: 1
		},
		480: {
			items: 2
		},
		768: {
			items: 2
		},
		992: {
			items: 2
		},
		1200: {
			items: 2
		}
	}
});
/*----------------------------------------*/
/* 13. FAQ Accordion
/*----------------------------------------*/
$('.card-header a').on('click', function() {
	$('.card').removeClass('actives');
	$(this).parents('.card').addClass('actives');
});
/*----------------------------------------*/
/* 14. Toggle Function Active
/*----------------------------------------*/ 
	// showlogin toggle
	$('#showlogin').on('click', function() {
		$('#checkout-login').slideToggle(900);
	});
	// showlogin toggle
	$('#showcoupon').on('click', function() {
		$('#checkout_coupon').slideToggle(900);
	});
	// showlogin toggle
	$('#cbox').on('click', function() {
		$('#cbox-info').slideToggle(900);
	});

	// showlogin toggle
	$('#ship-box').on('click', function() {
		$('#ship-box-info').slideToggle(1000);
	});
	/*----------------------------------------*/
/* 15. Li's Blog Gallery Slider
/*----------------------------------------*/ 
var gallery = $('.li-blog-gallery-slider');
gallery.slick({
	arrows: false,
	autoplay: true,
	autoplaySpeed: 5000,
	pauseOnFocus: false,
	pauseOnHover: false,
	fade: true,
	dots: true,
	infinite: true,
	slidesToShow: 1,
	responsive: [
	{
		breakpoint: 768,
		settings: {
			arrows: false,
		}
	},
	]
});

 /* 18. Category menu Activation
 /*----------------------------------------*/
 $('.category-sub-menu li.has-sub > a').on('click', function () {
 	$(this).removeAttr('href');
 	var element = $(this).parent('li');
 	if (element.hasClass('open')) {
 		element.removeClass('open');
 		element.find('li').removeClass('open');
 		element.find('ul').slideUp();
 	} else {
 		element.addClass('open');
 		element.children('ul').slideDown();
 		element.siblings('li').children('ul').slideUp();
 		element.siblings('li').removeClass('open');
 		element.siblings('li').find('li').removeClass('open');
 		element.siblings('li').find('ul').slideUp();
 	}
 });
 /*----------------------------------------*/
 /* 19. Featured Product active
 /*----------------------------------------*/
 $('.featured-product-active').owlCarousel({
 	loop: true,
 	nav: true,
 	autoplay: false,
 	autoplayTimeout: 5000,
 	navText: ['<i class="ion-ios-arrow-back"></i>', '<i class="ion-ios-arrow-forward"></i>'],
 	item: 3,
 	responsive: {
 		0: {
 			items: 1
 		},
 		768: {
 			items: 2
 		},
 		992: {
 			items: 2
 		},
 		1100: {
 			items: 2
 		},
 		1200: {
 			items: 2
 		}
 	}
 })
 /*----------------------------------------*/
/* 20. Featured Product 2 active
/*----------------------------------------*/
$('.featured-product-active-2').owlCarousel({
	loop: true,
	nav: true,
	autoplay: false,
	autoplayTimeout: 5000,
	navText: ['<i class="ion-ios-arrow-back"></i>', '<i class="ion-ios-arrow-forward"></i>'],
	item: 3,
	responsive: {
		0: {
			items: 1
		},
		768: {
			items: 2
		},
		992: {
			items: 1
		},
		1100: {
			items: 1
		},
		1200: {
			items: 1
		}
	}
})
/*----------------------------------------*/
 /* 21. Modal Menu Active
 /*----------------------------------------*/ 
 $('.product-details-images').each(function(){
 	var $this = $(this);
 	var $thumb = $this.siblings('.product-details-thumbs, .tab-style-left');
 	$this.slick({
 		arrows: false,
 		slidesToShow: 1,
 		slidesToScroll: 1,
 		autoplay: false,
 		autoplaySpeed: 5000,
 		dots: false,
 		infinite: true,
 		centerMode: false,
 		centerPadding: 0,
 		asNavFor: $thumb,
 	});
 });
 $('.product-details-thumbs').each(function(){
 	var $this = $(this);
 	var $details = $this.siblings('.product-details-images');
 	$this.slick({
 		slidesToShow: 4,
 		slidesToScroll: 1,
 		autoplay: false,
 		autoplaySpeed: 5000,
 		dots: false,
 		infinite: true,
 		focusOnSelect: true,
 		centerMode: true,
 		centerPadding: 0,
 		prevArrow: '<span class="slick-prev"><i class="fa fa-angle-left"></i></span>',
 		nextArrow: '<span class="slick-next"><i class="fa fa-angle-right"></i></span>',
 		asNavFor: $details,
 	});
 });
 $('.tab-style-left, .tab-style-right').each(function(){
 	var $this = $(this);
 	var $details = $this.siblings('.product-details-images');
 	$this.slick({
 		slidesToShow: 3,
 		slidesToScroll: 1,
 		autoplay: false,
 		autoplaySpeed: 5000,
 		dots: false,
 		infinite: true,
 		focusOnSelect: true,
 		vertical: true,
 		centerPadding: 0,
 		prevArrow: '<span class="slick-prev"><i class="fa fa-angle-down"></i></span>',
 		nextArrow: '<span class="slick-next"><i class="fa fa-angle-up"></i></span>',
 		asNavFor: $details,
 	});
 });
 /*----------------------------------------*/
/* 22. Cart Plus Minus Button
/*----------------------------------------*/
$(".cart-plus-minus").append('<div class="dec qtybutton"><i class="fa fa-angle-down"></i></div><div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>');

/*----------------------------------------*/
/* 23. Single Prduct Carousel Activision
/*----------------------------------------*/
$(".sp-carousel-active").owlCarousel({
	loop: true,
	nav: false,
	dots: false,
	autoplay: false,
	autoplayTimeout: 5000,
	navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-left"></i>'],
	item: 4,
	responsive: {
		0: {
			items: 1
		},
		480: {
			items: 2
		},
		768: {
			items: 2
		},
		992: {
			items: 3
		},
		1200: {
			items: 4
		}
	}
});
/*----------------------------------------*/
/* 24. Star Rating Js
/*----------------------------------------*/
$(function() {
	$('.star-rating').barrating({
		theme: 'fontawesome-stars'
	});
});
/*----------------------------------------*/
/* 25. Zoom Product Venobox
/*----------------------------------------*/
$('.venobox').venobox({
	spinner:'wave',
	spinColor:'#cb9a00',
});
/*----------------------------------------*/
var urlImage=$('.url_public').val();
var url_asset=$('.url_asset').val();
$('.add-cart').click(function(ev){
	var arr=[];
	var check=null;
	try{
		var da=1;
		var key=JSON.parse(localStorage.getItem("giohang"));
		for(var i=0;i<key.data.length;i++){
			if(key.data[i].id==ev.target.dataset.productid){
				var daa={
					"id":key.data[i].id,
					"soluong":key.data[i].soluong+1,
				}
				arr.push(daa);
				check=1;
			}else{
				var daa={
					"id":key.data[i].id,
					"soluong":key.data[i].soluong,
				}
				arr.push(daa);
			}
			if(i==key.data.length-1){
				if(check==null){
					var daa={
						"id":parseInt(ev.target.dataset.productid),
						"soluong":1,
					}
					arr.push(daa);
				}
			}
		}
		localStorage.removeItem("giohang");
	}catch{}

	localStorage.setItem("giohang",'{"data":'+JSON.stringify(arr)+'}');
});     
var mini_image=$('.mini_image').val();			
// --------------------------------------------------------------------

$('.add-to-cart').click(function(){
	var id=$(this).data('id_product');
	var cart_product_id=$('.cart_product_id_'+id).val();
	var cart_product_name=$('.cart_product_name_'+id).val();
	var cart_product_image=$('.cart_product_image_'+id).val();
	var cart_product_price=$('.cart_product_price_'+id).val();
	var cart_product_qty=$('.cart_product_quantity_'+id).val();
	var cart_product_slug=$('.cart_product_slug_'+id).val();
	var _token=$('input[name="_token"]').val();
	var url=$('.form').attr('action'); 
	var show_cart=$('.show_cart').val();
	var kt_account=$('.kt_account').val();
	$.ajax({
		method:'POST',
		url:url,  
		data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,cart_product_slug:cart_product_slug,_token:_token},
		success:function(data){
			var total=0;
			for (var i in data) {
				total+=parseInt(data[i].product_price)*parseInt(data[i].product_qty);
			}
			var number=numeral(total);
			$('.item-text').html(number.format('0,0')+` VND<span class="cart-item-count count-cart">

				`+Object.keys(data).length+`</span>`);
			var html="";
			for (var i in data) {
				var price=numeral(data[i].product_price);
				html+=	`<li>
				<a href="`+url_asset+`/`+data[i].product_slug+`" class="minicart-product-image">
				<img src="`+urlImage+`/product/`+data[i].product_image+`"alt="cart products">
				</a>
				<div class="minicart-product-details">
				<h6><a href="`+url_asset+`/`+data[i].product_slug+`">`+data[i].product_name+`</a></h6>
				<span>`+price.format('0,0')+` x `+data[i].product_qty+`</span>
				</div>
				</li>`;
			}
			$('.minicart-product-list').html(html);
			
			$('.minicart-total').html(`TỔNG TIỀN: <span>`+number.format('0,0')+` VND</span>`);
			if(kt_account==1){
				$('.checkout').html(`
					<span>Checkout</span>
					`);
				$('.checkout').attr("class","li-button li-button-fullwidth");
				$('.checkout_menu').html(`<a href="`+url_asset+`/checkout">Thanh toán</a>`);
			}
			swal({
				title:"Đã thêm sản phẩm vào giỏ hàng",
				text:"Bạn có thể tiếp tục mua hàng or tới giỏ hàng để tiến hành thanh toán",
				showCancelButton: true,
				cancelButtonText: "Xem tiếp",
				confirmButtonClass: "btn-success",
				confirmButtonText: "Đi đến giỏ hàng!",
				closeOnConfirm: false,
			},
			function(){
				window.location.href =show_cart;
			}
			);
		},

	});

});
//-----------------------------------------------------------------------
$("#hideOnClick").click(function(e) {
	swal({
		title:"Thông báo!",
		text:"Đăng ký đang xử lý",
		type:"warning",
		closeOnConfirm:true,
		closeOnCancel:true,
	});
	$(e.toElement).hide();
});
//----------------------------------------------------------------------
$('.send_order').click(function(){
	swal({
		title:"Xác nhận đơn hàng",
		text:"Đơn hàng sẽ không được hoàn trả khi đặt,bạn có muốn đặt không?",
		type:"warning",
		showCancelButton:true,
		confirmButtonClass:"btn-danger",
		confirmButtonText:"Cảm ơn mua hàng!",
		cancelButtonText:"Đóng chưa mua",
		closeOnConfirm:false,
		closeOnCancel:false,
	},
	function(isConfirm){
		if(isConfirm){
			swal({
				title:"Thông báo!",
				text:"Đơn hàng đang xử lý",
				type:"warning",
				closeOnConfirm:true,
				closeOnCancel:true,
			});
			var email=$('.email').val();
			var name=$('.name').val();
			var phone=$('.phone').val();
			var address=$('.address').val();
			var notes=$('.notes').val();
			var method=$('.method').val();	
			var url=window.location.href;
			var _token = $('input[name="_token"]').val();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				url:url,
				method:'POST',
				data:{email:email,name:name,phone:phone,address:address,notes:notes,method:method},
				success:function(data){
					if(data.success==0){
						$('.rm-name').remove();
						$('.rm-phone').remove();
						$('.rm-address').remove();
						$('.rm-email').remove();
						if(data.error['name']){
							$('.name').after(`<p class="rm-name" style="color:red">`+data.error['name'][0]+`</p>`);	
						}
						if(data.error['phone']){
							$('.phone').after(`<p class="rm-phone" style="color:red">`+data.error['phone'][0]+`</p>`);	
						}
						if(data.error['address']){
							$('.address').after(`<p class="rm-address" style="color:red">`+data.error['address'][0]+`</p>`);	
						}
						if(data.error['email']){	
							$('.email').after(`<p class="rm-email" style="color:red">`+data.error['email'][0]+`</p>`);	
						}
						swal('Thông tin đơn hàng chưa chính xác!','Hủy gửi đơn hàng','error');
					}
					else if(data.success==-1){
						$('.email').after(`<p class="rm-email" style="color:red">`+data.error+`</p>`);
						swal('Thông tin đơn hàng chưa chính xác!','Hủy gửi đơn hàng','error');	
					}
					else if(data.success==1){
						$('#after_title_count').html(`Cung ứng thiếu`);
						for (var c in data.cart) {
							let dem=0;
							for (var j in data.product_0) {
								if(data.product_0[j].id==data.cart[c].product_id){
									dem++;
									$('#product_count_thieu_'+data.product_0[j].id).html(`-`+data.product_0[j].count+`</td>`);
									break;
								}
							}
							
						}	
						swal('Sản phẩm cung ứng không đủ!','Hủy gửi đơn hàng','error');
					}
					else{
						swal('Đơn hàng','Gửi thành công','success');

						window.setTimeout(function(){ 
							document.location=window.location.href+'/danh-gia/'+data.order;
						} ,3000);				
					}
				}
			});			
		}else{
			swal('Đơn hàng','Hủy gửi đơn hàng','error');
		}
	}
	);
});
//----------------------------------------------------------------------
$('.huydonhang').click(function(){
	var id=$(this).data('id');
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
		url:url_asset+'/user/huy-don-hang',
		method:'post',
		data:{id:id},
		success:function(data){
			if(data.status=="0")
			{
				$('.status_'+id).html("Đơn hàng đã hủy");
				alert('Đơn hàng đã hủy');
			}
			else if(data.status=="2")
			{
				$('.status_'+id).html("Đã xử lý");
				alert('Đơn hàng da duyệt nên không thể hủy! Bạn vui lòng liên hệ bộ phân đơn hàng sớm nhất có thể!');
			}
			else if(data.status=="3")
			{
				alert('Đơn hàng này đã thanh toán!');
			}
		}
	});
});
//----------------------------------------------------------------------
$('.btn-quickview').click(function(){
	var id=$(this).data('id_product');
	$.ajax({
		type:'get',
		url:url_asset+'/quick-view/'+id,
		data:{id:id},
		success:function(data){
			$('.name-quickview').html(data.product.name_pro);
			$('#image-lg').html(`<img src="`+urlImage+`/product/`+data.product.image+`">`);
			$('.product-details-ref').html(data.product.name_cate);
			var real_price=0;
			if(data.discount!=null){
				var price_old=numeral(data.product.price);
				var price_new=numeral(data.product.price-(data.product.price*data.discount)/100);
				$('.new-price-2').html(price_new.format('0,0')+` VND`);
				$('.new-price-3').html(`<strike>`+price_old.format('0,0')+`</strike> VND`);
				real_price=data.product.price-(data.product.price*data.discount)/100;
			}
			else{
				var price_old=numeral(data.product.price);
				$('.new-price-3').html('');
				$('.new-price-2').html(price_old.format('0,0')+` VND`);
				real_price=data.product.price;
			}
			$('.model-mota').html(data.product.mota);
			$('.wishlist-btn').attr("href",url_asset+`/wishlist/add-wishlist/`+data.product.id_product);
			$('#model-add-cart').attr("action",url_asset+`/add-cart/`);
			$('#id_product').attr("value",data.product.id_product);
			$('#name_product').attr("value",data.product.name_pro);
			$('#image_product').attr("value",data.product.image);
			$('#price_product').attr("value",real_price);
			$('#slug_product').attr("value",data.product.slug);
			$('#count_product').attr("value",1);
			$('#status_product').html();
			if(data.product.count==0){
				$('#btn-submit-model').attr("disabled","disabled");
				$('#status_product').html("Hết hàng")
			}
			else{
				$('#btn-submit-model').removeAttr("disabled");
				$('#status_product').html("Còn hàng")
				$('#count_product').attr("max",data.product.count);
			}
			
			var total_rate=parseInt(data.product.one_rate)+parseInt(data.product.two_rate)+parseInt(data.product.three_rate)+parseInt(data.product.four_rate)+parseInt(data.product.five_rate);
			if(total_rate!=0){
				total_rate_tb=Math.round((parseInt(data.product.one_rate)+parseInt(data.product.two_rate*2)+parseInt(data.product.three_rate*3)+parseInt(data.product.four_rate*4)+parseInt(data.product.five_rate*5))/total_rate);
			}else{
				total_rate_tb=0;
			}
			var html='';
			
			$('#rating').html('');
			if(total_rate_tb!=0){
			for(var i=1;i<=5;i++){
				if(i<=total_rate_tb){
					html+=`<li><i class="fa fa-star-o"></i></li>`;
				}
				else{
				    html+=`<li class="no-star"><i class="fa fa-star-o"></i></li>`;
				}
			}
		}else{
			html+='Chưa có đánh giá';
		}
				$('#rating').html(html);
		}
});
});
//-----------------------------------------------------------------------
$('.ctdh').click(function(){
	var id=$(this).attr('id');
	$.ajax({
		url:url_asset+'/user/chi-tiet-don-hang/'+id,
		method:'get',
		data:{id:id},
		success:function(data){
			var html="";
			debugger
			for (var i in data) {
				html+=`<tr>
				<td>`+data[i].name+`</td>
				<td><img width="50px" src="`+urlImage+`/product/`+data[i].image+`"></td>
				<td>`+numeral(data[i].price).format('0,0')+` VND</td>
				<td style="text-align:center">`+data[i].quantity+`</td>
				</tr>`;
			}
			var ctdh=`<h5>Chi tiết đơn đặt hàng</h5>
			<table style="background:#FDF5E6" class="table">
			<thead>
			<tr>          
			<td>Tên hàng</td>
			<td>Hình ảnh</td>
			<td>Giá</td>
			<td style="text-align:center">Số lượng</td>
			</tr>
			</thead>
			<tbody>
			`+html+`
			</tbody>
			</table>
			<input name="btnDong" id="`+id+`" style="width:120px;height:30px;padding:5px" type="button" value="Đóng chi tiết" class="btn btn-danger dong_ct">
			`;
			$('div[id="'+id+'"]').html(ctdh);
			$('.dong_ct').click(function(){
				var id=$(this).attr('id');
				$('div[id="'+id+'"]').html("");
			});
		}
	})
});;
//---------------------------------------------------------------------
$('.form-group a').click(function(){	
	let $this=$(this);
	if($this.hasClass('active')){
		$this.parents('.form-group').find('input').attr('type','password');
		$this.removeClass('active');
	}else{
		$this.parents('.form-group').find('input').attr('type','text');
		$this.addClass('active');
	}
});    
// ---------------------------------------------------------------------
$('.send-binhluan').click(function(){
	swal({
		title: "Xác nhận đánh giá bình luận",
		text: "Đánh giá, bình luận sẽ được gửi đi! Bạn có muốn gửi không?",
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: "Cảm ơn đã quan tâm!",
		cancelButtonText: "Đóng không gửi",
		closeOnConfirm: false,
		closeOnCancel: false
	},
	function(isConfirm){
		if (isConfirm) {
			var email = $('.email').val();
			var name = $('.author').val();	
			var comment = $('.comment').val();
			var rate = $('.star-rating').val();
			var _token = $('input[name="_token"]').val();
			var url=$('.form-comment').attr('action');                                 
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type: 'POST',
				url:url,                          
				data:{email:email,name:name,comment:comment,rate:rate},
				success:function(data){
					if(data.success==0){
						$('.rm-name').remove();
						$('.rm-email').remove();
						$('.rm-comment').remove();
						if(data.error['name']){
							$('.email').after(`<p class="rm-email" style="color:red">`+data.error['email'][0]+`</p>`);	
						}
						if(data.error['name']){
							$('.author').after(`<p class="rm-name" style="color:red">`+data.error['name'][0]+`</p>`);	
						}
						if(data.error['comment']){
							$('.comment').after(`<p class="rm-comment" style="color:red">`+data.error['comment'][0]+`</p>`);	
						}
						swal("Đóng", "Đánh giá và bình luận chưa được gửi, làm ơn hoàn tất thông tin", "error");
					}
					else{
					var html='';
					for(var i=0;i<5;i++){
						if(i<parseInt(rate)){
							html+=`	<li style="display: inline;border: none;padding: 10px;"><i class="fa fa-star-o"></i></li>`;
						}else{
							html+=`<li style="display: inline;border: none;padding: 10px;" class="no-star"><i class="fa fa-star-o"></i></li>`;
						}
					}
					var today = new Date();
					var dd = today.getDate();
					dd=dd+"";
					while(dd.length<2) dd="0"+dd;
					var mm = today.getMonth()+1; 
					mm=mm+"";
					while(mm.length<2) mm="0"+mm;
					var yyyy = today.getFullYear();
					var hh = today.getHours();
					hh=hh+"";
					while(hh.length<2) hh="0"+hh;
					var mmmm = today.getMinutes();
					mmmm=mmmm+"";
					while(mmmm.length<2) mmmm="0"+mmmm;
					var ss = today.getSeconds();
					ss=ss+"";
					while(ss.length<2) ss="0"+ss;
					var key=yyyy+`-`+mm+`-`+dd+' '+hh+':'+mmmm+':'+ss;
					$('#li-com').prepend(`
						<li>
						<div class="author-avatar pt-15">
						<img width="80px" src="`+urlImage+`/avatar/`+data+`" alt="User">
						</div>
						<div class="comment-body pl-15">
						<ul style="margin:none" class="rating">
						`+html+`
						</ul>			
						<h5 class="comment-author pt-15">`+name+`</h5>
						<div class="comment-post-date">
						`+key+`
						</div>
						<p>`+comment+`</p>
						</div>
						</li>
						`);
					swal("Gửi", "Đánh giá và bình luận của bạn đã được gửi thành công", "success");
					$("#mymodal").modal('hide');
				}
			},
				error:function(ex){
					alert("Looix:"+ex.status);
				}
			});
		} else {
			swal("Đóng", "Đánh giá và bình luận chưa được gửi, làm ơn hoàn tất thông tin", "error");
		}
	});
});                 
/* 26. WOW
/*----------------------------------------*/
// new WOW().init();
})(jQuery);
/*----------------------------------------------------------------------------------------------------*/
/*------------------------------------------> The End <-----------------------------------------------*/
/*----------------------------------------------------------------------------------------------------*/