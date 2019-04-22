@extends('layouts.blank')

@section('subtitle')
	- Please Login
@endsection

@section('content')
	<section class="material-half-bg">
		<div class="cover"></div>
	</section>
	<section class="login-content">
		<div class="logo">
			<h1>{{ config('app.name', 'My Website') }}</h1>
		</div>
		<div class="login-box">
			<form method="POST" class="login-form" action="{{ route('login') }}">
				@csrf
				<h3 class="login-head">
					<i class="fas fa-user fa-lg"></i> <span>SIGN IN</span>
				</h3>
				<div class="form-group">
					<label for="email" class="control-label">EMAIL</label>
					<input id="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Input Email" required autofocus>
					@if ($errors->has('email'))
						<div class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('email') }}</strong>
						</div>
					@endif
				</div>
				<div class="form-group">
					<label for="password" class="control-label">PASSWORD</label>
					<input id="password" type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Input Password" name="password" required>
					@if ($errors->has('password'))
						<div class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('password') }}</strong>
						</div>
					@endif
				</div>
				<div class="form-group">
					<div class="utility">
						<div class="form-check mb-2">
							<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

							<label class="form-check-label" for="remember">
								REMEMBER ME
							</label>
						</div>
						{{-- <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Forgot Password ?</a></p> --}}
					</div>
				</div>
				<div class="form-group btn-container">
					<button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
				</div>
				<div class="form-group text-center mt-2">
					<span class="text-muted">Belum punya akun?</span>
					<a href="{{ route('register') }}">Buat akun sekarang</a>
				</div>
			</form>
			{{-- <form method="POST" action="{{ route('password.email') }}" class="forget-form">
				@csrf
				<h3 class="login-head">
					<i class="fa fa-lg fa-fw fa-lock"></i>Reset Password
				</h3>
				<div class="form-group">
					<label for="email" class="control-label">EMAIL</label>
					<input type="email" class="form-control" name="email" placeholder="Email">
				</div>
				<div class="form-group btn-container">
					<button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
				</div>
				<div class="form-group mt-3">
					<p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
				</div>
			</form> --}}
		</div>
	</section>
@endsection

@section('scripts')
	<script type="text/javascript">
		// Login Page Flipbox control
		// $('.login-content [data-toggle="flip"]').click(function() {
		// 	$('.login-box').toggleClass('flipped');
		// 	return false;
		// });
	</script>
@endsection