@php
    use App\Helpers\Formatter;
@endphp

@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <!-- Row Group CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}">
    <!-- Form Validation -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
@endpush

@push('js')
    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Daftar </span> Pesanan
        </h4>

        @include('components.alert')

        <!-- DataTable with Buttons -->
        <div class="card" x-data="dataMaster">
            <div class="card-datatable table-responsive">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="card-header flex-column flex-md-row">
                        <div class="head-label text-center">
                            <h5 class="card-title mb-0">Data Pesanan</h5>
                        </div>
                    </div>

                    <table class="datatables-basic table border-top dataTable no-footer dtr-column mb-2">
                        <thead>
                            <tr>
                                <th>No. Transaksi</th>
                                <th>Pelanggan</th>
                                <th>Total</th>
                                <th>Pembayaran</th>
                                <th class="text-center">Status</th>
                                <th>Tgl. Pesan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                                {{-- Tambahkan highlight jika statusnya Belum Dibayar --}}
                                @php
                                    $rowClass = '';
                                    if ($item->payment_method === 'Tunai' && $item->payment_status === 'Belum Dibayar') {
                                        // Highlight merah untuk pesanan Tunai yang Belum Dibayar
                                        $rowClass = 'table-danger';
                                    }
                                @endphp

                                <tr class="{{ $loop->odd ? 'odd' : 'even' }} {{ $rowClass }}">
                                    <td>{{ $item->order_code }}</td>
                                    <td>{{ $item->cust_name }}</td>
                                    <td>{{ Formatter::moneyFormat($item->total_amount) }}</td>
                                    <td>{{ $item->payment_method }}</td>
                                    {{-- Kolom Status Pembayaran --}}
                                    <td class="text-center">
                                        @if ($item->payment_status === 'Dibayar')
                                            <span class="badge bg-label-success">Dibayar</span>
                                        @else
                                            <span class="badge bg-label-danger">Belum Dibayar</span>
                                        @endif
                                    </td>
                                    <td>{{ Formatter::dateFormat($item->created_at) }}</td>
                                    {{-- Kolom Aksi --}}
                                    <td class="text-center">
                                        {{-- Tombol Detail Pesanan (Show) --}}
                                        <a href="{{ route('orders.detail', $item) }}" class="btn btn-sm btn-primary"
                                            title="Lihat Detail">
                                            <i class="bx bx-show"></i>
                                        </a>

                                        {{-- HANYA TAMPILKAN TOMBOL EDIT JIKA METODE PEMBAYARAN ADALAH 'Tunai' DAN STATUSNYA 'Belum Dibayar' --}}
                                        @if ($item->payment_method === 'Tunai' && $item->payment_status === 'Belum Dibayar')
                                            <a href="{{ route('orders.edit', $item) }}" class="btn btn-sm btn-warning"
                                                title="Input Pembayaran Tunai">
                                                <i class="bx bxs-edit"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="m-3">
                        {{-- Pastikan pagination sudah diaktifkan di OrderController --}}
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection