@extends('layouts.app')

@section('title')
    - Edit Setting
@endsection

@section('content')
    <div class="app-title">
		<div>
			<h1><i class="fas fa-user-secret"></i> Edit Akun Member</h1>
			<p>Form edit akun member</p>
		</div>
		<ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home fa-lg"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.members') }}">member</a></li>
			<li class="breadcrumb-item active">account</li>
		</ul>
	</div>
	
	<form action="{{ route('admin.members.account.update', $member->id) }}" method="post">
		@csrf
		<input type="hidden" name="_method" value="PUT">
		<div class="form-row justify-content-center">
			<div class="col-lg-6">
				<div class="tile">
					<div class="tile-title-w-btn line-head">
						<h3 class="title">Edit Akun Member</h3>
						<p>
							<a href="{{ route('admin.members') }}" class="btn btn-danger rounded-0"><i class="fas fa-times"></i></a>
						</p>
					</div>
					<div class="form-group row">
						<label for="full_name" class="col-form-label col-lg-4">Nama Lengkap</label>
						<div class="col-lg-8">
							<input type="text" id="full_name" class="form-control-plaintext" value="{{ $member->identity->full_name }}" readonly>
						</div>
					</div>
					<div class="form-group row">
						<label for="email" class="col-form-label col-lg-4">Email</label>
						<div class="col-lg-8">
							<input type="email" id="email" class="form-control-plaintext" value="{{ $member->identity->user->email }}">
						</div>
					</div>
					<div class="form-group row">
						<label for="password" class="col-form-label col-lg-4">Password</label>
						<div class="col-lg-6">
							<input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" required autocomplete="new-password">
							@if ($errors->has('password'))
								<div class="invalid-feedback">{{ $errors->first('password') }}</div>
							@endif
						</div>
					</div>
					<div class="tile-footer">
						<div class="d-flex justify-content-between">
							<h5 class="text-danger">Klik tombol <strong class="text-success">Update Password</strong> untuk mengganti password</h5>
							<button type="submit" id="btn-save" class="btn btn-success rounded-0"><i class="fas fa-save pr-2"></i>Update Password</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
@endsection