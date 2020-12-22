@extends('pages.user.layout')
@section('content1')

<div class="col-9" style="padding-left: 30px">
	@if (session('success'))
	<div class="alert alert-success">
		{{ session('success') }}
	</div>
	@endif
	@if (session('danger'))
	<div class="alert alert-danger">
		{{ session('danger') }}
	</div>
	@endif
	<div class="col-lg-8 col-md-12 order-2 order-lg-1">
		<div class="contact-form-content pt-sm-55 pt-xs-55">
		
			<h3 class="contact-page-title">Thay đổi mật khẩu</h3>
			<div class="contact-form">
				<form method="POST" action="{{route('post.password')}}" enctype="multipart/form-data">
					@csrf
					<div class="form-group" style="position: relative;">
						<label>Mật khẩu cũ<span class="required">*</span></label>
						<input value="" placeholder="*********" type="password" name="password_old" id="password_old" required>
						<a style="position: absolute;top:65%;right: 10px;color: #333" href="javascript:void(0)"><i class="fa fa-eye"></i></a>
						<p style="color: red">{!! $errors->first('password_old') !!}</p>
					</div>
					<div class="form-group" style="position: relative;">
						<label>Mật khẩu mới<span class="required">*</span></label>
						<input value="" placeholder="*********" type="password" name="password_new" id="password_new" required>
						<a style="position: absolute;top:65%;right: 10px;color: #333" href="javascript:void(0)"><i class="fa fa-eye"></i></a>
						<p style="color: red">{!! $errors->first('password_new') !!}</p>
					</div>
					<div class="form-group" style="position: relative;">
						<label>Nhập lại mật khẩu mới<span class="required">*</span></label>
						<input value="" placeholder="*********" type="password" name="password_confirm" id="password_confirm" required>
						<a style="position: absolute;top:65%;right: 10px;color: #333" href="javascript:void(0)"><i class="fa fa-eye"></i></a>
						<p style="color: red">{!! $errors->first('password_confirm') !!}</p>
					</div>
					<div class="form-group">
						<button type="submit" value="submit" id="submit" class="li-btn-3">Thay đổi</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
@endsection