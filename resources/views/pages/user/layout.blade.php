@extends('pages.layout.layout')
@section('content')
<div class="row">
  <div class="col-2" style="margin-left: 70px">
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('user.edit.info')}}">
        <div class="sidebar-brand-icon">
          <img src="{{URL::to('/uploads/avatar/'.\Auth::user()->avatar)}}">
        </div>
        <div class="sidebar-brand-text mx-3">{{ \Illuminate\Support\Str::limit(\Auth::user()->name, 20, '...') }}</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li id="loadQLDH" class="nav-item {{\Request::route()->getName()=='user.dashboard'?'active':''}}">
        <a class="nav-link" href="{{route('user.dashboard')}}">
          <span>Quản lý đơn hàng</span></a>
        </li>
        <hr class="sidebar-divider">
       
      
      <li id="loadCNTT" class="nav-item {{\Request::route()->getName()=='user.edit.info'?'active':''}}">
        <a class="nav-link" href="{{route('user.edit.info')}}">
          <span>Cập nhật thông tin</span>
        </a>
      </li>
       <hr class="sidebar-divider">
    <li class="nav-item {{\Request::route()->getName()=='user.edit.password'?'active':''}}">
      <a class="nav-link" href="{{route('user.edit.password')}}">
        <i class="fas fa-fw fa-palette"></i>
        <span>Thay đổi mật khẩu</span>
      </a>
    </li>
    @if(\Auth::check())
    @if(\Auth::user()->active==1)
      <hr class="sidebar-divider">
     <li class="nav-item {{\Request::route()->getName()=='get.resend'?'active':''}}">
      <a class="nav-link" href="{{route('get.resend')}}">
        <i class="fas fa-fw fa-palette"></i>
        <span>Gửi link kích hoạt tài khoản</span>
      </a>
    </li>
    @endif
    @endif
</ul>
</div>
	@yield('content1')
</div>
@endsection
