@php
    use App\Helpers\Formatter;
@endphp

<!DOCTYPE html>
<html>

<head>
    <title>Nota Transaksi {{ $order->order_code }}</title>
    <style>
        /* CSS khusus untuk printer thermal */
        body {
            /* Pastikan body menggunakan font monospasi */
            font-family: 'Consolas', monospace;
            font-size: 10pt;
            width: 80mm;
            /* Lebar nota standar */
        }

        @media print {
            body {
                width: 80mm;
                margin: 0;
                padding: 10px;
            }

            .no-print {
                display: none;
            }

            /* Hilangkan header/footer bawaan browser */
            @page {
                margin: 0;
                size: 80mm auto;
            }
        }

        .text-center {
            text-align: center;
        }

        .dashed-line {
            border-top: 1px dashed #000;
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Styling umum untuk tabel item */
        .item-table th,
        .item-table td {
            padding: 1px 0;
        }

        /* Kolom Menu */
        .col-menu {
            text-align: left;
        }

        /* Kolom Qty */
        .col-qty {
            text-align: center;
        }

        /* Kolom Harga Satuan & Total */
        .col-price,
        .col-total {
            text-align: right;
        }

        /* Hilangkan padding default pada elemen p */
        p {
            margin: 0;
            padding: 0;
        }

        /* Style untuk total/pembayaran agar rata kiri/kanan */
        .receipt-data {
            display: flex;
            justify-content: space-between;
            line-height: 1.5;
            /* Spasi baris untuk pembacaan */
        }
    </style>
</head>

<body onload="window.print()">
    <div class="text-center">
        <h4>Nama Warung Anda</h4>
        <p>Jl. Contoh No. 123</p><br>
    </div>

    <div class="dashed-line"></div>

    <div style="line-height: 1.5;">
        <p>No. Transaksi: {{ $order->order_code }}</p>
        <p>Tanggal: {{ Formatter::dateFormat($order->order_date) }}</p><br>
        <p>Customer: {{ $order->cust_name }}</p>
        <p>Pembayaran: {{ $order->payment_method }}</p>
    </div>

    <div class="dashed-line"></div><br>

    <table class="item-table">
        <tbody>
            @foreach($order->orderDetails as $item)
                <tr>
                    {{-- Baris 1: Nama Menu --}}
                    <td class="col-menu">{{ $item->item_name }}</td>
                </tr>
                <tr>
                    {{-- Baris 2: Detail Qty x Harga --}}
                    <td class="col-menu col-detail">
                        {{ $item->qty }} x {{ number_format($item->price, 0, '.', ',') }}
                    </td>
                    {{-- Kolom Total diisi dengan total per item --}}
                    <td class="col-total">
                        {{ number_format($item->qty * $item->price, 0, '.', ',') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- KELOMPOK TOTAL JUMLAH --}}
    <div class="receipt-data">
        <span><b>TOTAL:</b></span>
        <span><b>{{ Formatter::moneyFormat($order->total_amount) }}</b></span>
    </div><br>

    <div class="dashed-line"></div>

    {{-- LOGIKA KONDISIONAL UNTUK TUNAI DAN KEMBALIAN --}}
    {{-- Tampilkan HANYA JIKA payment_method BUKAN 'Transfer' dan BUKAN 'QRIS' --}}
    @unless ($order->payment_method == 'Transfer' || $order->payment_method == 'QRIS')
        <div class="receipt-data">
            <span><b>Tunai:</b></span>
            <span><b>{{ Formatter::moneyFormat($order->cash_paid) }}</b></span>
        </div>
        {{-- Hanya tampilkan Kembalian jika Kembalian > 0 (artinya cash_paid > total_amount) --}}
        @if ($order->change_amount > 0)
            <div class="receipt-data">
                <span>Kembalian:</span>
                <span>{{ Formatter::moneyFormat($order->change_amount) }}</span>
            </div>
        @endif
        <div class="dashed-line"></div>
    @endunless
    {{--AKHIR LOGIKA KONDISIONAL--}}

    <div class="text-center" style="padding-top: 5px;">
        <p><b>** Terima Kasih **</b></p>
        <small>Layanan ini didukung oleh [Nama Aplikasi Anda]</small>
    </div>

    {{-- Tombol Tutup Jendela (Hanya muncul di layar, tidak dicetak) --}}
    <div class="no-print text-center" style="padding-top: 20px;">
        <button onclick="window.close()">Tutup Jendela</button>
    </div>

    <script>
        // Memastikan fungsi cetak terpanggil dan menutup jendela setelah selesai
        window.onload = function () {
            window.print();
            // Memberi waktu untuk printer memproses sebelum menutup jendela
            setTimeout(function () {
                window.close();
            }, 1000);
        }
    </script>
</body>

</html>