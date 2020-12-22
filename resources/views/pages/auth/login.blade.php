@extends('pages.layout.layout')
@section('content') 
<div class="page-section mb-60">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-3 col-xs-12"></div>
			<div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
			
				<!-- Login Form s-->
				<form action="{{route('post.login')}}" method="POST" >
					@csrf
					<div class="login-form">
						<h4 class="login-title">Đăng nhập</h4>
						@if (Session::has('fail'))
						<div class="alert alert-danger">
							<ul>
								<li>{!! Session::get('fail') !!}</li>
							</ul>
						</div>
						@endif
						@if (Session::has('success'))
						<div class="alert alert-success">
							<ul>
								<li>{!! Session::get('success') !!}</li>
							</ul>
						</div>
						@endif
						<div class="row">
							<div class="col-md-12 col-12 mb-20">
								<label>Địa chỉ Email</label>
								<input name="email" class="mb-0" type="email" placeholder="Email Address">
								<p style="color: red">{!! $errors->first('email') !!}</p>
							</div>
							<div class="col-12 mb-20">
								<label>Mật khẩu</label>
								<input name="password" class="mb-0" type="password" placeholder="Password">
								<p style="color: red">{!! $errors->first('password') !!}</p>
							</div>
							<div class="col-md-8">
								<div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
									<input name="remember" type="checkbox" id="remember_me">
									<label for="remember_me">Ghi nhớ mật khẩu</label>
								</div>
							</div>
							<div class="col-md-4 mt-10 mb-20 text-left text-md-right">
								<a href="{{route('get.reset.password')}}"> Quên mật khẩu?</a>
							</div>
							<div class="col-md-12">
								<button class="register-button mt-0">Đăng nhập</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
	@endsection