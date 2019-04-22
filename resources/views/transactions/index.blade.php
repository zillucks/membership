@extends('layouts.app')

@section('title')
    - Transaksi
@endsection

@section('content')
    <div class="app-title">
		<div>
			<h1><i class="fas fa-exchange-alt"></i> Transaksi</h1>
			<p>Daftar transaksi point member</p>
		</div>
		<ul class="app-breadcrumb breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="fas fa-home fa-lg"></i></a></li>
			<li class="breadcrumb-item active">transaction</li>
		</ul>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="tile">
                <div class="tile-title-w-btn line-head">
                    <h3 class="title">Daftar Transaksi</h3>
                    <p>
						<a href="{{ route('admin.transactions.create') }}" class="btn btn-primary btn-icon">
							<i class="fas fa-plus"></i> Tambah Transaksi
						</a>
					</p>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tbl-transaction">
                        <thead>
                            <tr>
                                <th style="width: 20%">No. Invoice</th>
                                <th style="width: 20%">Member</th>
                                <th style="width: 15%">Tanggal Transaksi</th>
                                <th style="width: 15%">Total Poin Masuk</th>
                                <th style="width: 15%">Total Poin Keluar</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 5%"><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody class="table-sm">
                            @if ($transactions->total() > 0)
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->invoice_number }}</td>
                                        <td>{{ $transaction->member->identity->full_name }}</td>
                                        <td>{{ $transaction->invoice_date }}</td>
                                        <td>{{ $transaction->detail->sum('point_earned') }}</td>
                                        <td>{{ $transaction->detail->sum('point_redeem') }}</td>
                                        <td class="{!! $transaction->getStatusIdentifier()['text-class'] !!}">{!! $transaction->getStatusIdentifier()['label'] !!}</td>
                                        <td class="d-flex justify-content-around">
                                            <a href="{{ route('admin.transactions.edit', $transaction->id) }}" class="text-info" title="Edit Transaksi"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('admin.transactions.delete', $transaction->id) }}" class="text-danger delete-data" title="Hapus Transaksi"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="6" class="text-danger">No data available</th>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {!! $transactions->links() !!}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>
    <script>
        $('.delete-data').on('click', function (e) {
            e.preventDefault();
            let url = $(this).attr('href');
            swal({
                title: "Hapus Data Transaksi",
                text: "Aksi ini akan mempengaruhi point member. Yakin hapus data transaksi?",
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
                            // console.log(response);
                            window.location.reload();
                        }
                    });
                }
            });
        })
    </script>
@endsection