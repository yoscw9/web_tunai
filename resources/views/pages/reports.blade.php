@php
    use App\Helpers\Formatter;
@endphp

@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="py-3 mb-4">Laporan Penjualan</h4>
        <div class="card mb-4">
            <div class="card-body">

                @include('components.alert')

                <div class="mb-3">
                    <form action="{{ route('reports.index') }}" method="get">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label class="form-label">Dari Tanggal</label>
                                <input type="date" class="form-control" name="from_date" id="from_date"
                                    value="{{ request('from_date') == null ? $before->format('Y-m-d') : request('from_date') }}" />
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label">Sampai Tanggal</label>
                                <input type="date" class="form-control" name="to_date" id="to_date"
                                    value="{{ request('to_date') == null ? $now->format('Y-m-d') : request('to_date') }}" />
                            </div>
                            <div class="col-12 col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="datatables-basic table border-top dataTable no-footer dtr-column mb-2">
                    <thead>
                        <tr>
                            <th>No. Transaksi</th>
                            <th>Tgl. Pesan</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item)
                            <tr class="{{ $loop->odd ? 'odd' : 'even' }}">
                                <td><a href="{{ route('orders.show', $item) }}">{{ $item->order_code }}</a></td>
                                <td>{{ Formatter::dateFormat($item->created_at) }}</td>
                                <td>{{ Formatter::moneyFormat($item->total_amount) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2" class="text-center"><b>SUBTOTAL</b></td>
                            <td><b>{{ Formatter::moneyFormat($orders->sum('total_amount')) }}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection