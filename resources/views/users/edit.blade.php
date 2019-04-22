@extends('layouts.app')

@section('title')
    - Edit User
@endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fas fa-tachometer-alt"></i> User</h1>
            <p>Edit user # {{ $user->identity->full_name }}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home fa-lg"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">user</a></li>
            <li class="breadcrumb-item active">edit</li>
        </ul>
    </div>

    <form action="{{ route('admin.users.update', $user->id) }}" method="post">
		@csrf
		<input type="hidden" name="_method" value="PUT">
		<div class="form-row">
			<div class="col-lg-7">
				<div class="tile">
					<div class="tile-title line-head">Identitas Pribadi</div>
					<div class="form-group row">
						<label for="full_name" class="col-form-label col-lg-3">Nama Lengkap</label>
						<div class="col-lg-6">
							<input type="text" name="full_name" id="full_name" class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" placeholder="Nama Lengkap" value="{{ $user->identity->full_name }}">
							@if ($errors->has('full_name'))
								<div class="invalid-feedback">{{ $errors->first('full_name') }}</div>
							@endif
						</div>
					</div>
					<div class="form-group row">
						<label for="mobile_number" class="col-form-label col-lg-3">No. HP</label>
						<div class="col-lg-6">
							<input type="text" name="mobile_number" id="mobile_number" class="form-control {{ $errors->has('mobile_number') ? 'is-invalid' : '' }}" placeholder="No Handphone" value="{{ $user->identity->mobile_number }}">
							@if ($errors->has('mobile_number'))
								<div class="invalid-feedback">{{ $errors->first('mobile_number') }}</div>
							@endif
						</div>
					</div>
					<div class="form-group row mb-2">
						<label for="address" class="col-form-label col-lg-3">Alamat</label>
						<div class="col-lg-8">
							<input type="text" name="address" id="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" placeholder="Alamat Jalan" value="{{ $user->identity->address }}">
							@if ($errors->has('address'))
								<div class="invalid-feedback">{{ $errors->first('address') }}</div>
							@endif
						</div>
					</div>
					<div class="form-group row mb-2">
						<label for="city" class="col-form-label col-lg-3">Kota / Kabupaten</label>
						<div class="col-lg-6">
							<input type="text" name="city" id="city" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" placeholder="Kota / Kabupaten" value="{{ $user->identity->city }}">
							@if ($errors->has('city'))
								<div class="invalid-feedback">{{ $errors->first('city') }}</div>
							@endif
						</div>
					</div>
					<div class="form-group row mb-2">
						<label for="state" class="col-form-label col-lg-3">Provinsi</label>
						<div class="col-lg-6">
							<input type="text" name="state" id="state" class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" placeholder="Provinsi" value="{{ $user->identity->state }}">
							@if ($errors->has('state'))
								<div class="invalid-feedback">{{ $errors->first('state') }}</div>
							@endif
						</div>
					</div>
					<div class="form-group row">
						<label for="zip_code" class="col-form-label col-lg-3">Kode Pos</label>
						<div class="col-lg-3">
							<input type="text" name="zip_code" id="zip_code" class="form-control {{ $errors->has('zip_code') ? 'is-invalid' : '' }}" placeholder="Kode Pos" value="{{ $user->identity->zip_code }}">
							@if ($errors->has('zip_code'))
								<div class="invalid-feedback">{{ $errors->first('zip_code') }}</div>
							@endif
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-lg-5">
				<div class="tile">
                    <div class="tile-title line-head">Informasi Akun</div>
                    
                    <div class="form-group row">
						<label for="email" class="col-form-label col-lg-3">Email</label>
						<div class="col-lg-6">
							<input type="email" id="email" class="form-control-plaintext" value="{{ $user->email }}" readonly>
							@if ($errors->has('email'))
								<div class="invalid-feedback">{{ $errors->first('email') }}</div>
							@endif
						</div>
                    </div>

                    <div class="form-group row">
						<label for="password" class="col-form-label col-lg-3">Password</label>
						<div class="col-lg-6">
							<input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Password" autocomplete="current-password">
							@if ($errors->has('password'))
								<div class="invalid-feedback">{{ $errors->first('password') }}</div>
							@endif
						</div>
                    </div>

                    <div class="form-group row">
						<label for="password_confirmation" class="col-form-label col-lg-3">Ulangi Password</label>
						<div class="col-lg-6">
							<input type="password" name="password_confirmation" id="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" placeholder="Password Confirmation">
							@if ($errors->has('password_confirmation'))
								<div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
							@endif
						</div>
                    </div>
                    
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="col-12">
				<div class="tile">
					<div class="tile-title-w-btn">
						<h5 class="title text-danger">
							<p>Harap Periksa Kembali sebelum Menyimpan data.</p>
							<small><em>Klik tombol Save untuk melakukan perubahan</em></small>
						</h5>
						<p>
							<a href="{{ route('admin.users') }}" class="btn btn-danger rounded-0"><i class="fas fa-times mr-2"></i> Batal</a>
							<button type="submit" class="btn btn-success rounded-0"><i class="fas fa-save mr-2"></i> Save</button>
						</p>
					</div>
				</div>
			</div>
		</div>
	</form>

@endsection