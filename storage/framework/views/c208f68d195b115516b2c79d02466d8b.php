<?php
    use App\Helpers\Formatter;
?>



<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="py-3 mb-4">
            <a href="<?php echo e(route('orders.index')); ?>" class="text-muted fw-light">Daftar Pesanan</a> /  Edit Pesanan
        </h4>

        <?php echo $__env->make('components.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="card mb-4">
            <form action="<?php echo e(route('orders.update', $orders)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-sm-2 form-label d-flex align-items-end">Nomor Transaksi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" readonly value="<?php echo e($orders->order_code); ?>"
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 form-label d-flex align-items-end">Customer</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" readonly value="<?php echo e($orders->cust_name); ?>"
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 form-label d-flex align-items-end">Tanggal Pesan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" readonly
                                value="<?php echo e(Formatter::dateFormat($orders->order_date)); ?>" autocomplete="off" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 form-label d-flex align-items-end">Metode Pembayaran</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" readonly value="<?php echo e($orders->payment_method); ?>"
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="table table-responsive">
                            <table class="datatables-basic table border-top dataTable no-footer dtr-column mb-2">
                                <thead>
                                    <tr>
                                        <th>Menu</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $orders->orderDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="<?php echo e($loop->odd ? 'odd' : 'even'); ?>">
                                            <td><?php echo e($item->item_name); ?></td>
                                            <td><?php echo e($item->qty); ?></td>
                                            <td><?php echo e(Formatter::moneyFormat($item->price)); ?></td>
                                            <td><?php echo e(Formatter::moneyFormat($item->qty * $item->price)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td colspan="3" class="text-center"><b>SUBTOTAL</b></td>
                                        <td><b><?php echo e(Formatter::moneyFormat($orders->total_amount)); ?></b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 form-label d-flex align-items-end">Nominal Bayar</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="cash_paid_input" name="cash_paid"
                                value="<?php echo e($orders->cash_paid > 0 ? Formatter::moneyFormat($orders->cash_paid) : ''); ?>"
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 form-label d-flex align-items-end">Kembalian</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" readonly id="change_amount_input" name="change_amount"
                                value="<?php echo e($orders->change_amount > 0 ? Formatter::moneyFormat($orders->change_amount) : Formatter::moneyFormat(0)); ?>"
                                autocomplete="off" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <a href="<?php echo e(route('orders.index')); ?>" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <?php if($orders->payment_status == 'Dibayar'): ?>
                                <a href="<?php echo e(route('orders.print', ['id' => $orders->id])); ?>" target="_blank"
                                    class="btn btn-info">Cetak Ulang Struk</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        // Pastikan total_amount diambil dalam bentuk angka bersih (tanpa format)
        // Gunakan parseFloat dan pastikan nilai yang masuk adalah angka
        const totalAmount = parseFloat(<?php echo e($orders->total_amount); ?>);

        // Helper untuk membersihkan format (misal: "1.000.000" -> 1000000)
        function unformatMoney(value) {
            // Hapus semua karakter non-digit kecuali tanda koma jika Anda menggunakan koma sebagai desimal
            return parseFloat(value.replace(/[^0-9]/g, '')) || 0;
        }

        // Helper untuk memformat angka menjadi format Rupiah (tanpa simbol Rp)
        function formatMoney(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        const form = document.querySelector('form'); // Dapatkan elemen formulir
        const cashPaidInput = document.getElementById('cash_paid_input');
        const changeAmountInput = document.getElementById('change_amount_input');

        // Fungsi utama perhitungan
        function calculateChange() {
            let cashPaidClean = unformatMoney(cashPaidInput.value);
            let change = cashPaidClean - totalAmount;

            // Update nilai input nominal bayar dengan format saat user mengetik
            cashPaidInput.value = formatMoney(cashPaidClean);

            // Update nilai kembalian
            if (change > 0) {
                changeAmountInput.value = formatMoney(change);
            } else {
                // Jika kurang bayar atau pas, kembaliannya 0
                changeAmountInput.value = formatMoney(0);
            }
        }

        // Panggil fungsi saat input berubah
        cashPaidInput.addEventListener('input', calculateChange);

        // Panggil fungsi saat halaman dimuat untuk memastikan nilai awal terformat (jika ada nilai)
        calculateChange();

        // ✅ PERBAIKAN UTAMA: Validasi saat formulir disubmit
        form.addEventListener('submit', function (event) {
            let cashPaidClean = unformatMoney(cashPaidInput.value);

            // Lakukan pengecekan cash_paid < total_amount
            if (cashPaidClean < totalAmount) {
                alert("⚠️ Gagal menyimpan! Nominal Bayar harus lebih besar atau sama dengan Total Pesanan (" + formatMoney(totalAmount) + ").");
                event.preventDefault(); // Batalkan pengiriman formulir
                // Opsional: berikan fokus kembali ke input
                cashPaidInput.focus();
            }

            // Catatan: Jika Anda ingin mengizinkan Kurang Bayar untuk status tertentu
            // (misalnya: "Belum Dibayar" atau "DP"), Anda perlu membaca input status
            // pembayaran (payment_status) di sini dan menambahkan logika bersyarat.

        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tunai_app\resources\views/pages/orders/edit.blade.php ENDPATH**/ ?>