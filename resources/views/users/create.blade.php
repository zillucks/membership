@extends('layouts.app')

@section('title')
    - Tambah User
@endsection

@section('content')
    <div class="app-title">
        <div>
			<h1><i class="fas fa-user-plus"></i> Tambah User</h1>
			<p>Tambah data user baru</p>
		</div>
		<ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home fa-lg"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">user</a></li>
			<li class="breadcrumb-item active">create</li>
		</ul>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <form action="{{ route('admin.users.store') }}" method="post">
                @csrf
                <div class="row mb-2">

                    <div class="col-lg-6">
                        <div class="tile">
                            <div class="tile-title">
                                <h5 class="title">Informasi Pribadi</h5>
                            </div>
                            <div class="form-group col-lg-8">
                                <label for="full_name">Nama Lengkap</label>
                                <input type="text" name="full_name" id="full_name" class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" placeholder="Nama Lengkap" value="{{ old('full_name') }}" required>
                                @if ($errors->has('full_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('full_name') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-lg-8">
                                <label for="mobile_number">No. HP</label>
                                <input type="text" name="mobile_number" id="mobile_number" class="form-control {{ $errors->has('mobile_number') ? 'is-invalid' : '' }}"  value="{{ old('mobile_number') }}" required>
                                @if ($errors->has('mobile_number'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('mobile_number') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-12">
                                <label for="address">Alamat Lengkap</label>
                                <input type="text" name="address" id="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" placeholder="Alamat Lengkap" value="{{ old('address') }}">
                                @if ($errors->has('address'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('address') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-lg-8">
                                <label for="city">Kota</label>
                                <input type="text" name="city" id="city" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" placeholder="Kota" value="{{ old('city') }}">
                                @if ($errors->has('city'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('city') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-lg-8">
                                <label for="state">Provinsi</label>
                                <input type="text" name="state" id="state" class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" placeholder="Provinsi" value="{{ old('state') }}">
                                @if ($errors->has('state'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('state') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="zip_code">Kode Pos</label>
                                <input type="text" name="zip_code" id="zip_code" class="form-control {{ $errors->has('zip_code') ? 'is-invalid' : '' }}" value="{{ old('zip_code') }}">
                                @if ($errors->has('zip_code'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('zip_code') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="tile">
                            <div class="tile-title">
                                <h5 class="title">Informasi Akun</h5>
                            </div>
                            <div class="form-group col-lg-8">
                                <label for="email">Alamat Email</label>
                                <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-lg-8">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="" required>
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-lg-8">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" placeholder="" required>
                                @if ($errors->has('password_confirmation'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password_confirmation') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group col-lg-8">
                                <div class="form-check">
                                    <input type="checkbox" name="is_admin" id="is_admin" class="form-check-input" value=true>
                                    <label for="is_admin" class="form-check-label">Input User sebagai Administrator</label>
                                </div>
                            </div>
                        </div>

                        <div class="tile" id="member-section">
                            <h4 class="title">Informasi Member</h4>
                            <div class="form-group col-lg-8">
                                <label for="member_type_id">Level</label>
                                <select name="member_type_id" id="member_type_id" class="form-control {{ $errors->has('member_type_id') ? 'is-invalid' : '' }}">
                                    <option value="">Pilih Level</option>
                                    @foreach ($memberTypeLists as $key => $label)
                                        <option value="{{ $key }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="tile">
                            <div class="tile-title-w-btn">
                                <h4 class="title text-danger"><i class="fas fa-exclamation-triangle"></i> Harap cek ulang data sebelum data disimpan</h4>
                                <div class="btn-group btn-group-lg">
                                    <a href="{{ route('admin.users') }}" class="btn btn-danger rounded-0 mx-2"><i class="fas fa-times"></i> Batal</a>
                                    <button type="submit" class="btn btn-success rounded-0 mx-2"><i class="fas fa-save"></i> Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/bootstrap-notify.min.js') }}"></script>
    @include('layouts.notify')
    <script>
        $(function () {
            $('#is_admin').on('change', function () {
                if ($(this).prop('checked')) {
                    $('#member-section').fadeOut();
                }
                else {
                    $('#member-section').fadeIn();
                }
            })
        })
    </script>
@endsection