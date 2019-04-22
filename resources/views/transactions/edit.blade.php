@extends('layouts.app')

@section('title')
    - Edit Transaction
@endsection

@section('content')
    <div class="app-title">
		<div>
			<h1><i class="fas fa-cart-plus"></i> Edit Transaksi</h1>
			<p>Form Transaksi poin member</p>
		</div>
		<ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home fa-lg"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.transactions') }}">transaction</a></li>
			<li class="breadcrumb-item active">edit</li>
		</ul>
    </div>

    <form action="{{ route('admin.transactions.update', $transaction->id) }}" method="post">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <div class="form-row justify-content-center">
            <div class="col-lg-6">
                <div class="tile">
                    <h3 class="tile-title line-head">Informasi Transaksi</h3>
                    <div class="form-group row">
                        <label for="member_id" class="col-form-label col-lg-4">Member</label>
                        <div class="col-lg-8">
                            <input type="text" id="member_id" class="form-control-plaintext" value="{{ $members[$transaction->member_id] }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="invoice_date" class="col-form-label col-lg-4">Tanggal Invoice</label>
                        <div class="col-lg-4">
                            <input type="date" name="invoice_date" id="invoice_date" class="form-control {{ $errors->has('invoice_date') ? 'is-invalid' : '' }}" value="{{ $transaction->invoice_date }}" required>
                            @if ($errors->has('invoice_date'))
                                <div class="invalid-feedback">{{ $errors->first('invoice_date') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-form-label col-lg-4">Keterangan</label>
                        <div class="col-lg-8">
                            <textarea name="description" id="description" rows="1" class="form-control">{{ $transaction->description }}</textarea>
                            @if ($errors->has('description'))
                                <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="tile">
                    <h3 class="tile-title line-head">Detail Transaksi</h3>

                    <div class="form-group row">
                        <label for="point_earned" class="col-form-label col-lg-4">Poin Masuk</label>
                        <div class="col-lg-4">
                            <input type="number" name="point_earned" id="point_earned" class="form-control {{ $errors->has('point_earned') ? 'is-invalid' : '' }}" value="{{ $transaction->detail->point_earned }}">
                            @if ($errors->has('point_earned'))
                                <div class="invalid-feedback">{{ $errors->first('point_earned') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="point_redeem" class="col-form-label col-lg-4">Poin Keluar</label>
                        <div class="col-lg-4">
                            <input type="number" name="point_redeem" id="point_redeem" class="form-control {{ $errors->has('point_redeem') ? 'is-invalid' : '' }}" value="{{ $transaction->detail->point_redeem }}">
                            @if ($errors->has('point_redeem'))
                                <div class="invalid-feedback">{{ $errors->first('point_redeem') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="transaction_status" class="col-form-label col-lg-4">Status</label>
                        <div class="col-lg-4">
                            <select name="transaction_status" id="transaction_status" class="form-control">
                                @foreach ($status as $key => $value)
                                    <option value="{{ $key }}" {{ $transaction->transaction_status == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="form-row justify-content-center">
            <div class="col-lg-10">
                <div class="tile">
                    <div class="tile-title-w-btn">
                        <h3 class="title text-danger"><i class="fas fa-exclamation-triangle"></i> Harap cek data sebelum mengupdate data transaksi</h3>
                        <p>
                            <a href="{{ route('admin.transactions') }}" class="btn btn-danger rounded-0"><i class="fas fa-times"></i> Batal</a>
                            <button type="submit" class="btn btn-success rounded-0"><i class="fas fa-save"></i> Simpan</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </form>

@endsection