@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')
	<div class="app-title">
		<div>
			<h1><i class="fas fa-tachometer-alt"></i> Dashboard User</h1>
			<p>Detail transaksi anda</p>
		</div>
		<ul class="app-breadcrumb breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="fas fa-home fa-lg"></i></a></li>
			<li class="breadcrumb-item active">dashboard</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-6 col-lg-3">
			<div class="widget-small primary coloured-icon">
				<i class="icon fas fa-coins fa-3x"></i>
				<div class="info">
					<h4>Poin Anda</h4>
					<p><b>150</b></p>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-lg-3">
			<div class="widget-small primary coloured-icon">
				<i class="icon fas fa-user-friends fa-3x"></i>
				<div class="info">
					<h4>Total Referral Anda</h4>
					<p><b>15</b></p>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-lg-3">
			<div class="widget-small info coloured-icon">
				<i class="icon fas fa-coins fa-3x"></i>
				<div class="info">
					<h4>Point Diterima</h4>
					<p><b>15</b></p>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-lg-3">
			<div class="widget-small warning coloured-icon">
				<i class="icon fas fa-coins fa-3x"></i>
				<div class="info">
					<h4>Point Redeem</h4>
					<p><b>15</b></p>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<div class="tile">
				<div class="tile-title">Monthly Transaction</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	
@endsection