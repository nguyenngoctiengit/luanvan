@extends('pages.user.layout')
@section('content1')
{{-- <style type="text/css">
	#loadCNTT{
		background-color: blue;
	}
</style> --}}
<div class="col-9" style="padding-left: 30px">
	
	<div class="col-lg-8 col-md-12 order-2 order-lg-1">
		<div class="contact-form-content pt-sm-55 pt-xs-55">
			@if (session('success'))
			<div class="alert alert-success">
				{{ session('success') }}
			</div>
			@endif
			<h3 class="contact-page-title">Cập nhật thông tin cá nhân</h3>
			<div class="contact-form">
				<form method="POST" action="{{route('post.user')}}" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label>Email</label>
						<input readonly="readonly" value="{{$user->email}}" type="email" name="email" id="email" required>
					</div>
					<div class="form-group">
						<label>Tên</label>
						<input placeholder="Name" value="{{$user->name}}" type="text" name="name" id="name" required>
						 <p style="color: red">{!! $errors->first('name') !!}</p>
					</div>
					<div class="form-group">
						<label>Số điện thoại</label>
						<input placeholder="Phone" value="{{$user->phone}}" type="text" name="phone" id="phone">
						 <p style="color: red">{!! $errors->first('phone') !!}</p>
					</div>
					<div class="form-group file">
						<label>Ảnh đại diện</label>
						<input type="file" style="line-height: unset;height: unset;" name="avatar">
						 <p style="color: red">{!! $errors->first('avatar') !!}</p>
					</div>
					<div class="form-group mb-30">
						<label>Địa chỉ nhận hàng</label>
						<textarea placeholder="Address" name="address" id="address" >{{$user->address}}</textarea>
						 <p style="color: red">{!! $errors->first('address') !!}</p>
					</div>
					
					<div class="form-group">
						<button type="submit" value="submit" id="submit" class="li-btn-3">Cập nhật</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
@endsection