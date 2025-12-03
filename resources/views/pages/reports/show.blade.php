@php
    use App\Helpers\Formatter;
@endphp


@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="py-3 mb-4">
            <a href="{{ route('reports.index') }}" class="text-muted fw-light">Laporan Penjualan</a> / Detail Penjualan
        </h4>
        <div class="card mb-4">
            <div class="card-body">
                <div class="row mb-3">
                    <label class="col-sm-2 form-label d-flex align-items-end">Nomor Transaksi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" readonly value="{{ $orders->order_code }}"
                            autocomplete="off" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 form-label d-flex align-items-end">Customer</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" readonly value="{{ $orders->cust_name }}"
                            autocomplete="off" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 form-label d-flex align-items-end">Tanggal Pesan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" readonly
                            value="{{ Formatter::dateFormat($orders->order_date) }}" autocomplete="off" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 form-label d-flex align-items-end">Metode Pembayaran</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" readonly value="{{ $orders->payment_method }}"
                            autocomplete="off" />
                    </div>
                </div>
                <div class="mb-3">
                    <div class="table table-responsive">
                        <table class="datatables-basic table border-top dataTable no-footer dtr-column mb-2">
                            <thead>
                                <tr>
                                    <th style="font-weight: bold;">Menu</th>
                                    <th style="font-weight: bold;">Harga</th>
                                    <th style="font-weight: bold;">Qty</th>
                                    <th style="font-weight: bold;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders->orderDetails as $item)
                                    <tr class="{{ $loop->odd ? 'odd' : 'even' }}">
                                        <td>{{ $item->item_name}}</td>
                                        <td>{{ number_format($item->price, 0, '.', ',') }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ number_format($item->qty * $item->price, 0, '.', ',') }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" class="text-center"><b>SUBTOTAL</b></td>
                                    <td><b>{{ Formatter::moneyFormat($orders->total_amount) }}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Logika Kondisional: Tampilkan HANYA JIKA payment_method BUKAN 'Transfer' dan BUKAN 'QRIS' --}}
                @unless ($orders->payment_method == 'Transfer' || $orders->payment_method == 'QRIS')
                    <div class="row mb-3">
                        <label class="col-sm-2 form-label d-flex align-items-end">Tunai</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" readonly
                                value="{{ Formatter::moneyFormat($orders->cash_paid) }}" autocomplete="off" />
                        </div>
                    </div>
                    @if ($orders->change_amount > 0)
                        <div class="row mb-3">
                            <label class="col-sm-2 form-label d-flex align-items-end">Kembalian</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly
                                    value="{{ Formatter::moneyFormat($orders->change_amount) }}" autocomplete="off" />
                            </div>
                        </div>
                    @endif
                @endunless
                {{-- Akhir Logika Kondisional --}}

                <div class="row">
                    <div class="col-sm-12">
                        <a href="{{ route('reports.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection