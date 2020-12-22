@extends('pages.layout.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if(session('status'))
                    @if(session('status')=='true')
                        <div class="alert alert-success" role="alert">
                         Link xác thực đã được gửi vào email của bạn! Bạn hãy vào email kiểm tra và xác thực!
                        </div>
                    @else
                        <div class="alert alert-danger" role="alert">
                                Không tồn tại email này!
                            </div>
                    @endif
                    @else
                    @endif

                    <form method="POST" action="{{ route('post.reset.password') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Địa chỉ Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Gửi link phục hồi mật khẩu') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
