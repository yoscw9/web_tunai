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
            <span class="text-muted fw-light">Daftar </span>Rempeyek
        </h4>

        @include('components.alert')

        <!-- DataTable with Buttons -->
        <div class="card" x-data="dataMaster">
            <div class="card-datatable table-responsive">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="card-header flex-column flex-md-row">
                        <div class="head-label text-center">
                            <h5 class="card-title mb-0">Data Menu</h5>
                        </div>
                        <div class="dt-action-buttons text-end pt-3 pt-md-0">
                            <div class="dt-buttons">
                                <a href="{{ route('rempeyek.create') }}" class="dt-button create-new btn btn-primary"
                                    type="button">
                                    <span>
                                        <i class="bx bx-plus me-sm-1"></i>
                                        <span class="d-none d-sm-inline-block">Tambah Data</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <table class="datatables-basic table border-top dataTable no-footer dtr-column mb-2">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Tanggal Input</th>
                                <th>Tanggal Diedit</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rempeyek as $item)
                                <tr class="{{ $loop->odd ? 'odd' : 'even' }}">
                                    <td>{{ $item->name }}</td>
                                    <td>{{ Formatter::moneyFormat($item->price) }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ Formatter::dateFormat($item->created_at) }}</td>
                                    <td>{{ Formatter::dateFormat($item->updated_at) }}</td>
                                    <td>
                                        <a href="{{ route('rempeyek.edit', $item) }}" class="btn btn-sm btn-warning" hint="Edit Menu"><i
                                                class="bx bxs-edit"></i></a>
                                        <button @click="axiosDelete('{{ route('rempeyek.destroy', $item) }}')"
                                            class="btn btn-sm btn-danger"><i class="bx bxs-trash" hint="Hapus Menu"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="m-3">
                        {{ $rempeyek->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection