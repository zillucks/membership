@extends('layouts.app')

@section('title')
    Data User
@endsection

@section('content')
    <div class="app-title">
        <div>
			<h1>
                <i class="fas fa-user-plus"></i> User # {{ $user->identity->full_name }}
            </h1>
            <p>Detail User</p>
		</div>
		<ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home fa-lg"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">user</a></li>
			<li class="breadcrumb-item active">view</li>
		</ul>
    </div>
    <div class="form-row justify-content-center user">
        <div class="col-md-3">
            <div class="tile p-0">
                <nav class="nav nav-tabs flex-column user-tabs">
                    <a class="flex-sm-fill nav-link text-sm-center" href="#profile" id="profile-tab" data-toggle="tab" role="tab">Data Pribadi</a>
                    @if (!$user->isAdmin())
                        <a class="flex-sm-fill nav-link text-sm-center {{ is_null($user->member) ? 'disabled' : '' }}" href="#member" id="member-tab" data-toggle="tab" role="tab">Data Member</a>
                    @endif
                </nav>
            </div>
        </div>
        <div class="col-md-9">
            <div class="mx-2 my-4">
                <div class="tab-content">
                    <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab"></div>
                    @if (!is_null($user->member))
                        <div class="tab-pane fade" id="member" role="tabpanel" aria-labelledby="member-tab"></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('.tab-content').find('.tab-pane').each(function (index, data) {
                let $tab = '{{$tab}}';
                $(this).load('/admin/users/{{ $user->id }}/show-tab/' + data.id, function (result) {
                    $(this).html(result);
                    $('.user-tabs a[id="'+ $tab +'"]').tab('show');
                });
            });
        });
    </script>
@endsection