<?php
    use App\Helpers\Formatter;
?>



<?php $__env->startSection('content'); ?>
<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="py-3 mb-4">Laporan Penjualan</h4>
    <div class="card mb-4">
        <div class="card-body">

            <?php echo $__env->make('admin.components.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="mb-3">
                <form action="<?php echo e(route('reports.index')); ?>" method="get">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <label class="form-label">Dari Tanggal</label>
                        <input type="date" class="form-control" name="from_date" id="from_date" value="<?php echo e(request('from_date') == null ? $before->format('Y-m-d') : request('from_date')); ?>" />
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label">Sampai Tanggal</label>
                        <input type="date" class="form-control" name="to_date" id="to_date" value="<?php echo e(request('to_date') == null ? $now->format('Y-m-d') : request('to_date')); ?>" />
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
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="<?php echo e($loop->odd ? 'odd' : 'even'); ?>">
                        <td><a href="<?php echo e(route('orders.show', $item)); ?>"><?php echo e($item->no_transaksi); ?></a></td>
                        <td><?php echo e(Formatter::dateFormat($item->created_at)); ?></td>
                        <td><?php echo e(Formatter::moneyFormat($item->subtotal)); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td colspan="2" class="text-center"><b>SUBTOTAL</b></td>
                        <td><b><?php echo e(Formatter::moneyFormat($orders->sum('subtotal'))); ?></b></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tunai_app\resources\views/admin/pages/reports.blade.php ENDPATH**/ ?>