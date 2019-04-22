@extends('layouts.blank')

@section('subtitle')
    - Register
@endsection

@section('content')
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    
    <section class="login-content">
        <div class="logo">
            <h1>{{ config('app.name', 'My Website') }}</h1>
        </div>
        
        <div class="login-box" style="min-width: 450px!important; min-height: 600px!important">
            <form class="login-form" action="{{ route('register') }}" method="post">
                @csrf
                <h3 class="login-head">
                    <i class="fas fa-lg fa-user-plus"></i> <span>Register</span>
                </h3>
                <div class="form-group">
                    <label for="full_name">FULL NAME</label>
                    <input type="text" name="full_name" id="full_name" class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" required autofocus autocomplete="name">
                    @if ($errors->has('full_name'))
                        <div class="invalid-feedback">{{ $errors->first('full_name') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">EMAIL</label>
                    <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" required autocomplete="email">
                    @if ($errors->has('email'))
                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="mobile_number" class="control-label">MOBILE NUMBER</label>
                    <input type="text" name="mobile_number" id="mobile_number" class="form-control {{ $errors->has('mobile_number') ? 'is-invalid' : '' }}" required autocomplete="mobile">
                    @if ($errors->has('mobile_number'))
                        <div class="invalid-feedback">{{ $errors->first('mobile_number') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">PASSWORD</label>
                    <input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" required>
                    @if ($errors->has('password'))
                        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="control-label">CONFIRM PASSWORD</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" required>
                    @if ($errors->has('password_confirmation'))
                        <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="referral_code" class="control-label">KODE REFERRAL</label>
                    <input type="text" name="referral_code" id="referral_code" class="form-control {{ $errors->has('referral_code') ? 'is-invalid' : '' }}" autocomplete="off">
                    @if ($errors->has('referral_code'))
                        <div class="invalid-feedback">{{ $errors->first('referral_code') }}</div>
                    @endif
                </div>
                <div class="form-group btn-container pt-4">
					<button class="btn btn-primary btn-block"><i class="fas fa-lock fa-lg pr-2"></i>REGISTER</button>
                </div>
                <div class="form-group text-center mt-2">
					<span class="text-muted">Sudah punya akun?</span>
					<a href="{{ route('login') }}">Klik untuk Login</a>
				</div>
            </form>
        </div>

    </section>

@endsection