@extends('pages.layout.layout')
@section('content') 
<div class="page-section mb-60">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-3 col-xs-12"></div>
			<div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
				<!-- Login Form s-->
				@if (\Session::has('success'))
				<div class="alert alert-success">
					<ul>
						<li>{!! \Session::get('success') !!}</li>
					</ul>
				</div>
				@elseif( \Session::get('fail'))
				<div class="alert alert-danger">
					<ul>
						<li>{!! \Session::get('fail') !!}</li>
					</ul>
				</div>
				@else
				
				@endif
				<form id="pform" action="{{route('post.register')}}" method="POST">
					@csrf
					<div class="login-form">
						<h4 class="login-title">Đăng ký</h4>
						<div class="row">							
							<div class="col-md-12 col-12 mb-20">
								<label>Họ tên</label>
								<input value="{{ old('name') }}" name="name" class="mb-0" type="text" placeholder="Họ tên">
								<p style="color: red">{!! $errors->first('name') !!}</p>
							</div>
							<div class="col-md-12 mb-20">
								<label>Địa chỉ Email</label>
								<input value="{{ old('email') }}" name="email" class="mb-0" type="email" placeholder="Địa chỉ Email">
								<p style="color: red">{!! $errors->first('email') !!}</p>
							</div>
							<div class="col-md-6 mb-20">
								<label>Mật khẩu</label>
								<input name="password" class="mb-0" type="password" placeholder="Mật khẩu">
								<p style="color: red">{!! $errors->first('password') !!}</p>
							</div>
							<div class="col-md-6 mb-20">
								<label>Nhập lại mật khẩu</label>
								<input name="confirmpass" class="mb-0" type="password" placeholder="Nhập lại mật khẩu">
								<p style="color: red">{!! $errors->first('confirmpass') !!}</p>
							</div>

							<div class="col-12">
								<button id="hideOnClick" class="register-button mt-0">Đăng ký</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection