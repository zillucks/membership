@extends('layouts.app')

@section('title')
    - Data Member
@endsection

@section('content')
    <div class="app-title">
		<div>
			<h1><i class="fas fa-users"></i> Member</h1>
			<p>Data member</p>
		</div>
		<ul class="app-breadcrumb breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="fas fa-home fa-lg"></i></a></li>
			<li class="breadcrumb-item active">member</li>
		</ul>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="tile">
                <div class="tile-title-w-btn line-head">
                    <h5 class="title">Data Member</h5>
                </div>
                <form class="mb-2">
                    <div class="form-row">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="search" id="search" placeholder="Search" value="{{ request()->get('search') }}" autocomplete="name">
                        </div>
                    </div>
                </form>
                <table class="table table-sm table-hover" id="tbl-member">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Level</th>
                            <th>Nama</th>
                            <th>Poin</th>
                            <th>Referral</th>
                            <th>Status</th>
                            <th class="text-center"><i class="fas fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($members->total() > 0)
                            @foreach ($members as $member)
                                <tr class="{!! $member->verification_status->text_class !!}">
                                    <td>{{ $member->member_code }}</td>
                                    <td>{{ !is_null($member->member_type) ? $member->member_type->member_type_name : '' }}</td>
                                    <td>{{ $member->identity->full_name }}</td>
                                    <td>{{ $member->current_point }}</td>
                                    <td>{{ !is_null($member->referral) ? $member->referral->identity->full_name : '' }}</td>
                                    <td>{!! $member->verification_status->label !!}</td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <a href="{{ route('admin.members.account', $member->id) }}" class="text-muted" title="Setting"><i class="fas fa-user-secret"></i></a>
                                            <a href="{{ route('admin.members.edit', $member->id) }}" class="text-info" title="Edit Member"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('admin.members.delete', $member->id) }}" class="text-danger delete-data" title="Hapus Member"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th colspan="7" class="text-danger">No data available</th>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {!! $members->links() !!}
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>
    <script>
        $(function () {
            $('.delete-data').on('click', function (e) {
                e.preventDefault();
                let url = $(this).attr('href');
                swal({
                    title: "Hapus data member",
                    text: "Seluruh data transaksi juga akan terhapus jika member dihapus!",
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