@extends('layouts.app')

@section('title')
    - Detail Transaksi
@endsection

@section('content')
    <div class="app-title">
		<div>
			<h1><i class="fas fa-user"></i> Detail Transaksi</h1>
			<p>Riwayat transaksi member</p>
		</div>
		<ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home fa-lg"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('member') }}">member</a></li>
            <li class="breadcrumb-item active">Transaction</li>
		</ul>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="tile">
                <div class="tile-title-w-btn">
                    <h3 class="title">Riwayat Transaksi</h3>
                    <p>
                        <a href="{{ route('member') }}" class="btn btn-danger btn-icon rounded-0"><i class="fas fa-times"></i></a>
                    </p>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-hover" id="tbl-transaction">
                        <thead>
                            <tr>
                                <th style="width: 25%">No. Invoice</th>
                                <th style="width: 25%">Tanggal</th>
                                <th style="width: 10%">Total Poin Masuk</th>
                                <th style="width: 10%">Total Poin Keluar</th>
                                <th style="width: 30%" class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($transactions->total() > 0)
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->invoice_number }}</td>
                                        <td>{{ $transaction->invoice_date }}</td>
                                        <td>{{ $transaction->detail->point_earned }}</td>
                                        <td>{{ $transaction->detail->point_redeem }}</td>
                                        <td class="{{ $transaction->getStatusIdentifier()['text-class'] }}">{!! $transaction->getStatusIdentifier()['label'] !!}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="5" class="text-danger">No data available</th>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection