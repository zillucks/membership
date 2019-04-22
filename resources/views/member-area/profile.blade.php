@extends('layouts.app')

@section('title')
    - Profile Member
@endsection

@section('content')
    <div class="app-title">
		<div>
			<h1><i class="fas fa-user"></i> Profil Member</h1>
			<p>Edit data member</p>
		</div>
		<ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home fa-lg"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('member') }}">member</a></li>
            <li class="breadcrumb-item active">Profile</li>
		</ul>
    </div>
    
    <form action="{{ route('member.update-profile') }}" method="post">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <div class="form-row">
            <div class="col-lg-6">
                <div class="tile">
                    <h3 class="tile-title line-head">Informasi Umum</h3>
                    <div class="form-group row">
                        <label for="full_name" class="col-form-label col-lg-4">Nama Lengkap</label>
                        <div class="col-lg-6">
                            <input type="text" name="full_name" id="full_name" class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" value="{{ $member->identity->full_name }}" required autofocus>
                            @if ($errors->has('full_name'))
                                <div class="invalid-feedback">{{ $errors->first('full_name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mobile_number" class="col-form-label col-lg-4">No. HP</label>
                        <div class="col-lg-6">
                            <input type="text" name="mobile_number" id="mobile_number" class="form-control {{ $errors->has('mobile_number') ? 'is-invalid' : '' }}" value="{{ $member->identity->mobile_number }}">
                            @if ($errors->has('mobile_number'))
                                <div class="invalid-feedback">{{ $errors->first('mobile_number') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-form-label col-lg-4">Alamat</label>
                        <div class="col-lg-6">
                            <input type="text" name="address" id="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" value="{{ $member->identity->address }}">
                            @if ($errors->has('address'))
                                <div class="invalid-feedback">{{ $errors->first('address') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="city" class="col-form-label col-lg-4">Kota</label>
                        <div class="col-lg-6">
                            <input type="text" name="city" id="city" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" value="{{ $member->identity->city }}">
                            @if ($errors->has('city'))
                                <div class="invalid-feedback">{{ $errors->first('city') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="state" class="col-form-label col-lg-4">Provinsi</label>
                        <div class="col-lg-6">
                            <input type="text" name="state" id="state" class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" value="{{ $member->identity->state }}">
                            @if ($errors->has('state'))
                                <div class="invalid-feedback">{{ $errors->first('state') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="zip_code" class="col-form-label col-lg-4">Kode Pos</label>
                        <div class="col-lg-3">
                            <input type="text" name="zip_code" id="zip_code" class="form-control {{ $errors->has('zip_code') ? 'is-invalid' : '' }}" value="{{ $member->identity->zip_code }}">
                            @if ($errors->has('zip_code'))
                                <div class="invalid-feedback">{{ $errors->first('zip_code') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="tile">
                    <h3 class="tile-title line-head">Data Member</h3>

                    <div class="form-group row">
                        <label for="member_type" class="col-form-label col-lg-4">Level Member</label>
                        <div class="col-lg-6">
                            <input type="text" id="member_type" class="form-control-plaintext" value="{{ $member->member_type->member_type_name }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="member_code" class="col-form-label col-lg-4">Kode Member</label>
                        <div class="col-lg-6">
                            <input type="text" id="member_code" class="form-control-plaintext" value="{{ $member->member_code }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="referral_code" class="col-form-label col-lg-4">Kode Referral</label>
                        <div class="col-lg-6">
                            <input type="text" id="referral_code" class="form-control-plaintext" value="{{ $member->referral_code }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="parent" class="col-form-label col-lg-4">Referral Anda</label>
                        <div class="col-lg-6">
                            <input type="text" id="parent" class="form-control-plaintext" value="{{ !is_null($member->referral) ? $member->referral->identity->full_name : '-' }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="verification_status" class="col-form-label col-lg-4">Status Verifikasi</label>
                        <div class="col-lg-6">
                            <p class="form-control-plaintext {{ Auth::user()->verification_status->text_class }}">{!! Auth::user()->verification_status->label !!}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="verified_at" class="col-form-label col-lg-4">Tanggal Verifikasi</label>
                        <div class="col-lg-6">
                            <input type="text" id="verified_at" class="form-control-plaintext" value="{{ Auth::user()->email_verified_at }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="tile">
                    <div class="row justify-content-between px-4 pb-0">
                        <h4 class="text-danger">Pastikan data yang anda inputkan sudah benar sebelum melakukan update data.</h4>
                        <div>
                            <button type="submit" class="btn btn-success rounded-0" id="btn-save">
                                <i class="fas fa-save pr-2"></i>Update Profil
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection