@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')
	<div class="app-title">
		<div>
			<h1><i class="fas fa-users"></i> Daftar User</h1>
			<p>daftar semua user</p>
		</div>
		<ul class="app-breadcrumb breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="fas fa-home fa-lg"></i></a></li>
			<li class="breadcrumb-item active">user</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="tile">
				<div class="tile-title-w-btn">
					<h5 class="title">Daftar User</h5>
					<p>
						<a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-icon">
							<i class="fas fa-plus"></i> Tambah User
						</a>
					</p>
				</div>
				<div class="table-responsive">
					<table class="table table-sm">
						<thead>
							<tr>
								<th style="width: 35%">Nama</th>
								<th style="width: 25%">Email</th>
								<th style="width: 20%">Level</th>
								<th style="width: 10%">Point</th>
								<th style="width: 10%" class="text-center"><i class="fas fa-cog"></i></th>
							</tr>
						</thead>
						<tbody>
							@if ($users->total() > 0)
								@foreach ($users as $key => $user)
									<tr class="{{ $user->isAdmin() ? 'text-danger' : '' }}" data-id="{{ $user->id }}">
										<td>{{ $user->identity->full_name }}</td>
										<td>{{ $user->email }}</td>
										<td>{!! $user->isAdmin() ? $user->member->role->role_name : (isset($user->member->member_type) ? $user->member->member_type->member_type_name : '') !!}</td>
										<td>{{ isset($user->member) ? $user->member->current_point : '' }}</td>
										<td class="justify-content-center">
											<a href="{{ route('admin.users.view', $user->id) }}" class="px-2 btn-link" title="View Detail"><i class="fas fa-eye"></i></a>
											<a href="{{ route('admin.users.edit', $user->id) }}" class="px-2 btn-link text-info" title="Edit User"><i class="fas fa-edit"></i></a>
											@if (!$user->isAdmin())
												<a href="{{ route('admin.users.delete', $user->id) }}" class="px-2 btn-link text-danger delete-user" title="Delete User"><i class="fas fa-trash"></i></a>
											@endif
										</td>
									</tr>
								@endforeach
							@else
								<tr>
									<th colspan="5" class="text-center text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp;No data available</th>
								</tr>
							@endif
						</tbody>
					</table>
					<div class="justify-content-stretch">
						{{ $users->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>
	<script>
		$(function () {
			$('.delete-user').on('click', function (e) {
				e.preventDefault();
				let url = $(this).attr('href');
				swal({
                    title: "Hapus data User",
                    text: "Seluruh data user, member dan transaksi juga akan terhapus jika user dihapus!",
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
                            dataType: 'json',
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