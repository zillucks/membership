@extends('layouts.app')

@section('title')
    - Dashboard Area Member
@endsection

@section('content')
    <div class="app-title">
		<div>
			<h1><i class="fas fa-tachometer-alt"></i> Dashboard Member</h1>
			<p>Ringkasan Member</p>
		</div>
		<ul class="app-breadcrumb breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="fas fa-home fa-lg"></i></a></li>
			<li class="breadcrumb-item active">dashboard</li>
		</ul>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-4">
			<div class="widget-small primary coloured-icon">
				<i class="icon fas fa-users fa-3x"></i>
				<div class="info">
					<h4>Level Member</h4>
					<p><b>{{ $user->member->member_type->member_type_name }}</b></p>
				</div>
			</div>
        </div>
        
        <div class="col-md-6 col-lg-4">
			<div class="widget-small warning coloured-icon">
				<i class="icon fas fa-users fa-3x"></i>
				<div class="info">
					<h4>Point</h4>
					<p><b>{{ is_null($user->member->current_point) ? 0 : $user->member->current_point }}</b></p>
				</div>
			</div>
        </div>

        <div class="col-md-6 col-lg-4">
			<div class="widget-small primary coloured-icon">
				<i class="icon fas fa-users fa-3x"></i>
				<div class="info">
					<h4>Status Verifikasi</h4>
					<p class="{{ $user->isVerified() ? 'text-success' : 'text-danger' }}"><b>{!! $user->verification_status->label !!}</b></p>
				</div>
			</div>
        </div>

    </div>

@endsection