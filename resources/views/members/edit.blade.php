@extends('layouts.app')

@section('title')
    - Edit Member
@endsection

@section('content')
    <div class="app-title">
		<div>
			<h1><i class="fas fa-tachometer-alt"></i> Member</h1>
			<p>Edit member # {{ $member->identity->full_name }} - <em>{{ $member->member_code }}</em></p>
		</div>
		<ul class="app-breadcrumb breadcrumb">
			<li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home fa-lg"></i></a></li>
			<li class="breadcrumb-item"><a href="{{ route('admin.members') }}">member</a></li>
			<li class="breadcrumb-item active">edit</li>
		</ul>
	</div>

	<form action="{{ route('admin.members.update', $member->id) }}" method="post">
		@csrf
		<input type="hidden" name="_method" value="PUT">
		<div class="form-row">
			<div class="col-lg-7">
				<div class="tile">
					<div class="tile-title line-head">Identitas Pribadi</div>
					<div class="form-group row">
						<label for="full_name" class="col-form-label col-lg-3">Nama Lengkap</label>
						<div class="col-lg-6">
							<input type="text" name="full_name" id="full_name" class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" placeholder="Nama Lengkap" value="{{ $member->identity->full_name }}">
							@if ($errors->has('full_name'))
								<div class="invalid-feedback">{{ $errors->first('full_name') }}</div>
							@endif
						</div>
					</div>
					<div class="form-group row">
						<label for="mobile_number" class="col-form-label col-lg-3">No. HP</label>
						<div class="col-lg-6">
							<input type="text" name="mobile_number" id="mobile_number" class="form-control {{ $errors->has('mobile_number') ? 'is-invalid' : '' }}" placeholder="No Handphone" value="{{ $member->identity->mobile_number }}">
							@if ($errors->has('mobile_number'))
								<div class="invalid-feedback">{{ $errors->first('mobile_number') }}</div>
							@endif
						</div>
					</div>
					<div class="form-group row mb-2">
						<label for="address" class="col-form-label col-lg-3">Alamat</label>
						<div class="col-lg-8">
							<input type="text" name="address" id="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" placeholder="Alamat Jalan" value="{{ $member->identity->address }}">
							@if ($errors->has('address'))
								<div class="invalid-feedback">{{ $errors->first('address') }}</div>
							@endif
						</div>
					</div>
					<div class="form-group row mb-2">
						<label for="city" class="col-form-label col-lg-3">Kota / Kabupaten</label>
						<div class="col-lg-6">
							<input type="text" name="city" id="city" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" placeholder="Kota / Kabupaten" value="{{ $member->identity->city }}">
							@if ($errors->has('city'))
								<div class="invalid-feedback">{{ $errors->first('city') }}</div>
							@endif
						</div>
					</div>
					<div class="form-group row mb-2">
						<label for="state" class="col-form-label col-lg-3">Provinsi</label>
						<div class="col-lg-6">
							<input type="text" name="state" id="state" class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" placeholder="Provinsi" value="{{ $member->identity->state }}">
							@if ($errors->has('state'))
								<div class="invalid-feedback">{{ $errors->first('state') }}</div>
							@endif
						</div>
					</div>
					<div class="form-group row">
						<label for="zip_code" class="col-form-label col-lg-3">Kode Pos</label>
						<div class="col-lg-3">
							<input type="text" name="zip_code" id="zip_code" class="form-control {{ $errors->has('zip_code') ? 'is-invalid' : '' }}" placeholder="Kode Pos" value="{{ $member->identity->zip_code }}">
							@if ($errors->has('zip_code'))
								<div class="invalid-feedback">{{ $errors->first('zip_code') }}</div>
							@endif
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-lg-5">
				<div class="tile">
					<div class="tile-title line-head">Data Member</div>

					<div class="form-group row">
						<label for="current_point" class="col-form-label col-lg-3">Poin</label>
						<div class="col-lg-4">
							<input type="number" name="current_point" id="current_point" class="form-control {{ $errors->has('current_point') ? 'is-invalid' : '' }}" value="{{ $member->current_point }}">
							@if ($errors->has('current_point'))
								<div class="invalid-feedback">{{ $errors->first('current_point') }}</div>
							@endif
						</div>
					</div>
					<div class="form-group row">
						<label for="referral_code" class="col-form-label col-lg-3">Kode Referral</label>
						<div class="col-lg-4">
							<input type="text" name="referral_code" id="referral_code" class="form-control {{ $errors->has('referral_code') ? 'is-invalid' : '' }}" placeholder="Kode Referral" value="{{ $member->referral_code }}">
							@if ($errors->has('referral_code'))
								<div class="invalid-feedback">{{ $errors->first('referral_code') }}</div>
							@endif
						</div>
					</div>
					<div class="form-group row">
						<label for="referral_id" class="col-form-label col-lg-3">Referral</label>
						<div class="col-lg-6">
							<select name="referral_id" id="referral_id" class="form-control {{ $errors->has('referral_id') ? 'is-invalid' : '' }}">
								<option value="">Pilih Referral</option>
								@foreach ($referrals as $item => $label)
									<option value="{{ $item }}" {{ $member->referral_id == $item ? 'selected' : '' }}>{{ $label }}</option>
								@endforeach
							</select>
							@if ($errors->has('referral_code'))
								<div class="invalid-feedback">{{ $errors->first('referral_code') }}</div>
							@endif
						</div>
					</div>
					<div class="form-group row">
						<label for="member_type_id" class="col-form-label col-lg-3">Level</label>
						<div class="col-lg-5">
							<select name="member_type_id" id="member_type_id" class="form-control {{ $errors->has('member_type_id') ? 'is-invalid' : '' }}">
								<option value="">Pilih Level</option>
								@foreach ($types as $key => $label)
									<option value="{{ $key }}" {{ $key === $member->member_type_id ? 'selected' : '' }}>{{ $label }}</option>
								@endforeach
							</select>
							@if ($errors->has('member_type_id'))
								<div class="invalid-feedback">{{ $errors->first('member_type_id') }}</div>
							@endif
						</div>
					</div>
					<div class="form-group row">
						<label for="registration_date" class="col-form-label col-lg-3">Tanggal Registrasi</label>
						<div class="col-lg-5">
							<input type="text" name="registration_date" id="registration_date" class="form-control {{ $errors->has('registration_date') ? 'is-invalid' : '' }}" placeholder="Tanggal Registrasi" value="{{ $member->registration_date }}">
							@if ($errors->has('registration_date'))
								<div class="invalid-feedback">{{ $errors->first('registration_date') }}</div>
							@endif
						</div>
					</div>
					<div class="form-group row">
						<label for="verified_at" class="col-form-label col-lg-3">Tanggal Verifikasi</label>
						<div class="col-lg-5">
							<input type="text" name="verified_at" id="verified_at" class="form-control {{ $errors->has('verified_at') ? 'is-invalid' : '' }}" placeholder="Tanggal Verifikasi" value="{{ $member->verified_at }}">
							@if ($errors->has('verified_at'))
								<div class="invalid-feedback">{{ $errors->first('verified_at') }}</div>
							@endif
						</div>
					</div>
					<div class="form-group row">
						<label for="is_verified" class="col-form-label col-lg-3">Status Verifikasi</label>
						<div class="col-lg-5">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" name="is_verified" id="is_verified" value=1 {{ $member->is_verified ? 'checked' : '' }}>
								<label class="form-check-label ml-2" for="is_verified">{{ $member->is_verified ? 'Terverifikasi' : 'Belum Verifikasi' }}</label>
							</div>
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
							<a href="{{ route('admin.members') }}" class="btn btn-danger rounded-0"><i class="fas fa-times mr-2"></i> Batal</a>
							<button type="submit" class="btn btn-success rounded-0"><i class="fas fa-save mr-2"></i> Save</button>
						</p>
					</div>
				</div>
			</div>
		</div>
	</form>

@endsection

@section('scripts')
	<script src="{{ asset('js/plugins/bootstrap-datepicker.min.js') }}"></script>
	<script>
		$(function () {
			$('#registration_date').datepicker({
				format: 'yyyy-mm-dd',
				autoclose: true,
				todayHighlight: true
			});

			$('#verified_at').datepicker({
				format: 'yyyy-mm-dd',
				autoclose: true,
				todayHighlight: true
			});

			$('#is_verified').on('change', function () {
				if ($(this).prop('checked') == true) {
					$(this).next('.form-check-label').text('Terverifikasi');
				}
				else {
					$(this).next('.form-check-label').text('Belum Verifikasi');
				}
			});
		})
	</script>
@endsection