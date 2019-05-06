@extends('layouts.app')

@section('title', '- Edit Role')
    
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fas fa-users"></i> Edit Role</h1>
            <p>Form edit level role</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home fa-lg"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.roles') }}">role</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ul>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('admin.roles.update', $role->id) }}" method="post">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="tile">
                    <div class="tile-title-w-btn">
                        <h5 class="title">Edit Role</h5>
                        <p>
                            <a href="{{ route('admin.roles') }}" class="btn btn-danger btn-icon rounded-0"><i class="fas fa-times"></i></a>
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="role_name">Role Name</label>
                        <input type="text" name="role_name" id="role_name" class="form-control {{ $errors->has('role_name') ? 'is-invalid' : '' }}" value="{{ $role->role_name }}" required autofocus>
                        @if ($errors->has('role_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('role_name') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ $role->is_active ? 'checked' : '' }}>
                            <label for="is_active" class="form-check-label">Active</label>
                        </div>
                    </div>
                    <div class="tile-footer text-right">
                        <div class="form-group">
                            <div class="btn-group btn-group-lg">
                                <a href="{{ route('admin.roles') }}" class="btn btn-danger rounded-0 mx-2"><i class="fas fa-times"></i> Batal</a>
                                <button type="submit" class="btn btn-success rounded-0 mx-2"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
