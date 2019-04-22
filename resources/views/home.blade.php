@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')
	<div class="app-title">
		<div>
			<h1><i class="fas fa-tachometer-alt"></i> Dashboard Admin</h1>
			<p>Ringkasan transaksi</p>
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
					<h4>Verified Member</h4>
					<p><b>{{ $verified_member }}</b></p>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-lg-4">
			<div class="widget-small warning coloured-icon">
				<i class="icon fas fa-user-plus fa-3x"></i>
				<div class="info">
					<h4><em>Unverified</em> Member</h4>
					<p><b>{{ $unverified_member }}</b></p>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-lg-4">
			<div class="widget-small info coloured-icon">
				<i class="icon fas fa-coins fa-3x"></i>
				<div class="info">
					<h4>Platinum Member</h4>
					<p><b>{{ $platinum_member }}</b></p>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<div class="tile">
				<div class="tile-title-w-btn">
					<h5 class="title">10 Transaksi Terakhir</h5>
					<p>
						<a href="{{ route('admin.transactions') }}" class="btn btn-primary btn-icon" target="_blank">
							<i class="fas fa-th-list"></i> Show All
						</a>
					</p>
				</div>
				<div class="table-responsive">
					<table class="table table-sm table-striped">
						<thead>
							<tr>
								<th style="width: 30%">Tanggal</th>
								<th class="text-center" style="width: 20%">Point Earned</th>
								<th class="text-center" style="width: 20%">Point Redeem</th>
								<th class="text-center" style="width: 30%">Status</th>
							</tr>
						</thead>
						<tbody>
							@if (isset($transactions) && !is_null($transactions))
								@foreach ($transactions as $transaction)
									<tr>
										<td>{{ $transaction->invoice_date }}</td>
										<td class="text-right pr-4">{{ $transaction->detail->point_earned }}</td>
										<td class="text-right pr-4">{{ $transaction->detail->point_redeem }}</td>
										<td class="{!! $transaction->getStatusIdentifier()['text-class'] !!}">{!! $transaction->getStatusIdentifier()['label'] !!}</td>
									</tr>
								@endforeach
							@else
								<tr>
									<th colspan="5" class="text-center text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp;No data available</th>
								</tr>
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	
@endsection