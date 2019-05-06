@extends('layouts.app')

@section('title', '- Roles')

@section('content')
    <div class="app-title">
        <div>
        <h1><i class="fas fa-users"></i> Daftar Role</h1></div>

        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home fa-lg"></i></a></li>
            <li class="breadcrumb-item active">role</li>
        </ul>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="tile">
                <div class="tile-title-w-btn line-head">
                    <h5 class="title">Role level</h5>
                    <p>
                        <a href="{{ route('admin.roles.create') }}" class='btn btn-primary btn-icon'>
                            <i class="fas fa-plus"></i> Tambah Role
                        </a>
                    </p>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th style='width: 50%'>Role</th>
                                <th style='width: 30%'>Status</th>
                                <th style='width: 20%' class='text-center'><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($roles->count() > 0)
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{ $role->role_name }}</td>
                                        <td>{!! $role->getActiveIdentifier($role->is_active)['label'] !!}</td>
                                        <td class='text-center'>
											<a href="{{ route('admin.roles.edit', $role->id) }}" class="px-2 btn-link text-info" title="Edit Role"><i class="fas fa-edit"></i></a>
											<a href="{{ route('admin.roles.delete', $role->id) }}" class="px-2 btn-link text-danger delete-role" title="Delete Role"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>
<script>
    $(function () {
        $('.delete-role').on('click', function (e) {
            e.preventDefault();
            let url = $(this).attr('href');
            swal({
                    title: "Hapus Role",
                    text: "Data User tidak akan dihapus, namun data role user akan dihapus jika role dihapus!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, Hapus data!",
                    cancelButtonText: "Batal!",
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {_method: 'delete'},
                            success: function (response) {
                                window.location.reload();
                            }
                        });
                    }
                });
        })
    })
</script>
@endsection