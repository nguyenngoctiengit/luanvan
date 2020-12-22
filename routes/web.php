<?php

use Illuminate\Support\Facades\Route;
Route::group(['namespace'=>'Auth'],function(){
	Route::get('dang-ky','RegisterController@getRegister')->name('get.register');
	Route::post('dang-ky','RegisterController@postRegister')->name('post.register');
	Route::get('xac-nhan-tai-khoan','RegisterController@verifyAccount')->name('user.verify.account');
	Route::get('/resend-code-active','RegisterController@resendCodeActive')->name('get.resend')->middleware('UserRole');;
	Route::get('dang-nhap','LoginController@getLogin')->name('get.login');
	Route::post('dang-nhap','LoginController@postLogin')->name('post.login');

	Route::get('dang-xuat','LoginController@getLogout')->name('get.logout');

	Route::get('/lay-lai-mat-khau','ForgotPasswordController@getFormResetPassword')->name('get.reset.password');
	Route::post('/lay-lai-mat-khau','ForgotPasswordController@sendCodeResetPassword')->name('post.reset.password');
	Route::get('/reset/password','ForgotPasswordController@resetPassword')->name('get.link.reset.password');
	Route::post('/reset/password','ForgotPasswordController@saveResetPassword');
});
Route::get('insert',function(){
		for($i=30;$i<=47;$i++){
		DB::table('product')->where('id',$i)->update(['danhgia_id'=>$i]);
	}
	echo "Success";
});

Route::get('/','frontend\HomeController@index')->name('home');

Route::get('/quick-view/{id}','frontend\HomeController@quickview');
Route::post('/binh-luan/{product_id}','frontend\HomeController@binhluan');

Route::post('/add-cart-ajax','frontend\CartController@add_cart_ajax');
Route::get('add-cart','frontend\CartController@add_cart');
Route::get('/show-cart','frontend\CartController@show_cart')->name('show.cart');
Route::post('/update-cart','frontend\CartController@update_cart');
Route::get('/delete-cart/{id}/x','frontend\CartController@delete_cart');
Route::get('/delete-all-cart','frontend\CartController@delete_all_cart');

Route::group(['namespace'=>'frontend'],function(){
	Route::get('/checkout','CheckoutController@getCheckout')->name('get.checkout')->middleware('Checkout');
	Route::post('/checkout','CheckoutController@postCheckout')->name('post.checkout');
	Route::get('/checkout/danh-gia/{id}','CheckoutController@showDanhgia');
	Route::post('/danh-gia','CheckoutController@storeDanhgia');
	Route::group(['prefix'=>'user','middleware'=>['UserRole']],function(){
	Route::get('/','UserController@index')->name('user.dashboard');
	Route::get('/chi-tiet-don-hang/{id}','UserController@showChitiet')->name('user.chitiet.donhang');
	Route::post('/huy-don-hang','UserController@deleteDonhang');
	Route::get('/info','UserController@editInfo')->name('user.edit.info');
	Route::post('/info/update','UserController@updateInfo')->name('post.user');

	Route::get('password','UserController@editPassword')->name('user.edit.password');
	Route::post('/password/update','UserController@updatePassword')->name('post.password');

	});
	Route::group(['prefix'=>'tin-tuc'],function(){
			Route::get('/','NewsController@index')->name('news.index');
			Route::get('/{slug}','NewsController@showChitiet')->name('chitiettintuc');
			Route::post('/binh-luan/{id}/{slug}','NewsController@storeComment');
	});

	Route::group(['prefix'=>'wishlist','middleware'=>['Wishlist']],function(){
		Route::get('/{id}','WishlistController@index')->name('wishlist.index');
		Route::get('/add-wishlist/{idproduct}','WishlistController@insert')->name('wishlist.add');
		Route::get('/delete-wishlist/{idctwishlist}','WishlistController@delete')->name('wishlist.delete');
	});
	Route::get('/balo/tim-kiem','HomeController@search')->name('get.search');
	Route::get('/balo/tim-kiem-category/{slug}','HomeController@category')->name('get.search.category');		
		Route::get('/khuyenmai','KhuyenmaiController@index')->name('khuyenmai.index');
	Route::get('/about-us','HomeController@aboutUs')->name('about.us');
});
$url_current=url()->current();
$url_root=url('/').'/';
$data=explode($url_root,$url_current);
if(count($data)>1){
$slug_exit_pro=DB::table('product')->where('slug',$data[1])->count();
$slug_exit_km=DB::table('khuyenmai')->where('slug',$data[1])->count();
$slug_cate=DB::table('category_product')->where('slug',$data[1])->count();
if($slug_exit_pro>0){
Route::get('/{product_slug}','frontend\HomeController@show_detail_product');
}
elseif($slug_exit_km>0){
	Route::get('/{slug}','frontend\KhuyenmaiController@showChitiet');
}
elseif($slug_cate>0){
	Route::get('/{slug}','frontend\HomeController@category');
}
}

//backend
//login
Route::get('/admin','backend\AdminController@index');
Route::post('/admin-dashboard','backend\AdminController@dashboard');
Route::get('/dashboard','backend\AdminController@show_dashboard');
Route::get('/logout','backend\AdminController@logout');

//Category Product
Route::get('/add-category-product','backend\CategoryProduct@add_category_product');
Route::get('/edit-category-product/{id}','backend\CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{id}','backend\CategoryProduct@delete_category_product');
Route::get('/all-category-product','backend\CategoryProduct@all_category_product');
Route::post('/save-category-product','backend\CategoryProduct@save_category_product');
Route::post('/update-category-product/{id}','backend\CategoryProduct@update_category_product');
//Brand Product
Route::get('/add-brand-product','backend\BrandProduct@add_brand_product');
Route::get('/edit-brand-product/{id}','backend\BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{id}','backend\BrandProduct@delete_brand_product');
Route::get('/all-brand-product','backend\BrandProduct@all_brand_product');
Route::post('/save-brand-product','backend\BrandProduct@save_brand_product');
Route::post('/update-brand-product/{id}','backend\BrandProduct@update_brand_product');
//Banner Product
Route::get('/add-banner','backend\BannerController@add_banner');
Route::get('/edit-banner/{id}','backend\BannerController@edit_banner');
Route::get('/delete-banner/{id}','backend\BannerController@delete_banner');
Route::get('/all-banner','backend\BannerController@all_banner');
Route::post('/save-banner','backend\BannerController@save_banner');
Route::post('/update-banner','backend\BannerController@update_banner');

//Lọc giá
Route::get('/add-loc-product','backend\LocPriceController@add_loc_product');
Route::get('/edit-loc-product/{id}','backend\LocPriceController@edit_loc_product');
Route::get('/delete-loc-product/{id}','backend\LocPriceController@delete_loc_product');
Route::get('/all-loc-product','backend\LocPriceController@all_loc_product');
Route::post('/save-loc-product','backend\LocPriceController@save_loc_product');
Route::post('/update-loc-product','backend\LocPriceController@update_loc_product');

//product
Route::get('/add-product','backend\ProductController@add_product');
Route::get('/edit-product/{product_id}','backend\ProductController@edit_product');
Route::get('/delete-product/{product_id}','backend\ProductController@delete_product');
Route::get('/all-product','backend\ProductController@all_product');
Route::get('/unactive-product/{product_id}','backend\ProductController@unactive_product');
Route::get('/active-product/{product_id}','backend\ProductController@active_product');
Route::post('/save-product','backend\ProductController@save_product');
Route::post('/update-product/{product_id}','backend\ProductController@update_product');
Route::get('/detail-product/{product_id}','backend\ProductController@detail_product');
Route::get('/thong-ke-san-pham','backend\ProductController@thongke');
Route::get('/san-pham-danh-gia','backend\ProductController@sanpham_danhgia');
Route::get('/san-pham-ban-chay','backend\ProductController@sanpham_banchay');
Route::get('/san-pham-ton-kho','backend\ProductController@sanpham_tonkho');
Route::get('/san-pham-khuyen-mai','backend\ProductController@sanpham_khuyenmai');

//image 
Route::get('/add-image','backend\ImageController@add_image');
Route::get('/all-image','backend\ImageController@all_image');
Route::post('/save-image','backend\ImageController@ImageUpload');

//comment
Route::get('/delete-comment/{id}/{id_product}','backend\CommentController@delete_comment');
Route::get('/comment-product/{id}','backend\CommentController@comment_product')->name('get.listcomment');
//admin user
Route::get('/manage-user','backend\UserController@manage_user');
Route::get('/add-user','backend\UserController@add_user');
Route::post('/save-user','backend\UserController@save_user');
Route::get('/sua-admin/{id}','backend\UserController@sua_admin');
Route::get('/thay-doi-password','backend\UserController@editPassword');
Route::post('/thay-doi-password','backend\UserController@updatePassword');

//admin order
Route::get('/all-order','backend\OrderController@index');
Route::get('/check-status/{id}','backend\OrderController@check');
Route::get('/change-status/{id}','backend\OrderController@update');
Route::get('/view-ct/{id}','backend\OrderController@show_chitiet_donhang');
Route::get('tim-kiem-order','backend\OrderController@search');
Route::get('/thong-ke-don-hang','backend\OrderController@thongke');

//khuyen mai
Route::get('/all-khuyenmai','backend\KhuyenMaiController@all_khuyenmai');
Route::post('/save-khuyenmai','backend\KhuyenMaiController@save_khuyenmai');
Route::get('/delete-khuyenmai/{id}','backend\KhuyenMaiController@delete_khuyenmai');
Route::get('/edit-khuyenmai/{id}','backend\KhuyenMaiController@edit_khuyenmai');
Route::post('/update-khuyenmai','backend\KhuyenMaiController@update_khuyenmai');
Route::get('/all-chitietkhuyenmai/{id}','backend\KhuyenMaiController@all_chitietkhuyenmai');
Route::get('/add-chitiet-khuyenmai/{id}','backend\KhuyenMaiController@add_chitietkhuyenmai');
Route::get('/get-price-product/{id}','backend\KhuyenMaiController@get_price_product');
Route::post('/save-chitiet-khuyenmai','backend\KhuyenMaiController@save_chitietkhuyenmai');
Route::get('/delete-chitiet-khuyenmai/{id}','backend\KhuyenMaiController@delete_chitietkhuyenmai'); 
Route::get('/edit-chitiet-khuyenmai/{id}','backend\KhuyenMaiController@edit_chitietkhuyenmai'); 
Route::post('/update-chitiet-khuyenmai','backend\KhuyenMaiController@update_chitietkhuyenmai');


//phieunhap
Route::get('/edit-phieunhap-product/{id}','backend\PhieuNhapController@edit_phieunhap_product');
Route::get('/delete-phieunhap-product/{id}','backend\PhieuNhapController@delete_phieunhap_product');
Route::get('/all-phieunhap-product','backend\PhieuNhapController@all_phieunhap_product');
Route::post('/save-phieunhap-product','backend\PhieuNhapController@save_phieunhap_product');
Route::post('/update-phieunhap-product','backend\PhieuNhapController@update_phieunhap_product');
Route::get('/all-chitiet-phieunhap/{id}','backend\PhieuNhapController@all_chitiet_phieunhap');
Route::get('/add-chitiet-phieunhap/{id}','backend\PhieuNhapController@add_chitiet_phieunhap');
Route::post('/save-chitiet-phieunhap','backend\PhieuNhapController@save_chitiet_phieunhap');
Route::get('/delete-chitiet-phieunhap/{id}','backend\PhieuNhapController@delete_chitiet_phieunhap');
Route::get('/edit-chitiet-phieunhap/{id}','backend\PhieuNhapController@edit_chitiet_phieunhap');
Route::post('/update-chitiet-phieunhap','backend\PhieuNhapController@update_chitiet_phieunhap');