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
		
		<div class="col-12">
			<div class="widget-small danger coloured-icon">
				<i class="icon fas fa-exclamation-triangle fa-3x"></i>
				<div class="info">
					<h4>Status Verifikasi</h4>
					<p class="text-danger"><b>Akun anda belum diverifikasi, silahkan check email anda untuk melakukan verifikasi</b></p>
				</div>
			</div>
		</div>

    </div>

@endsection