<?php
    use App\Helpers\Formatter;
?>

<!DOCTYPE html>
<html>

<head>
    <title>Nota Transaksi <?php echo e($order->order_code); ?></title>
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
        <p>No. Transaksi: <?php echo e($order->order_code); ?></p>
        <p>Tanggal: <?php echo e(Formatter::dateFormat($order->order_date)); ?></p><br>
        <p>Customer: <?php echo e($order->cust_name); ?></p>
        <p>Pembayaran: <?php echo e($order->payment_method); ?></p>
    </div>

    <div class="dashed-line"></div><br>

    <table class="item-table">
        <tbody>
            <?php $__currentLoopData = $order->orderDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    
                    <td class="col-menu"><?php echo e($item->item_name); ?></td>
                </tr>
                <tr>
                    
                    <td class="col-menu col-detail">
                        <?php echo e($item->qty); ?> x <?php echo e(number_format($item->price, 0, '.', ',')); ?>

                    </td>
                    
                    <td class="col-total">
                        <?php echo e(number_format($item->qty * $item->price, 0, '.', ',')); ?>

                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    
    <div class="receipt-data">
        <span><b>TOTAL:</b></span>
        <span><b><?php echo e(Formatter::moneyFormat($order->total_amount)); ?></b></span>
    </div><br>

    <div class="dashed-line"></div>

    
    
    <?php if (! ($order->payment_method == 'Transfer' || $order->payment_method == 'QRIS')): ?>
        <div class="receipt-data">
            <span><b>Tunai:</b></span>
            <span><b><?php echo e(Formatter::moneyFormat($order->cash_paid)); ?></b></span>
        </div>
        
        <?php if($order->change_amount > 0): ?>
            <div class="receipt-data">
                <span>Kembalian:</span>
                <span><?php echo e(Formatter::moneyFormat($order->change_amount)); ?></span>
            </div>
        <?php endif; ?>
        <div class="dashed-line"></div>
    <?php endif; ?>
    

    <div class="text-center" style="padding-top: 5px;">
        <p><b>** Terima Kasih **</b></p>
        <small>Layanan ini didukung oleh [Nama Aplikasi Anda]</small>
    </div>

    
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

</html><?php /**PATH C:\xampp\htdocs\tunai_app\resources\views/forms/nota.blade.php ENDPATH**/ ?>