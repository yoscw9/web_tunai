<?php
    use App\Helpers\Formatter;
?>



<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/flatpickr/flatpickr.css')); ?>" />
    <!-- Row Group CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css')); ?>">
    <!-- Form Validation -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')); ?>" />
<?php $__env->stopPush(); ?>

<?php $__env->startPush('js'); ?>
    <!-- Vendors JS -->
    <script src="<?php echo e(asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Daftar </span> Pesanan
        </h4>

        <?php echo $__env->make('admin.components.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
                                <th>Subtotal</th>
                                <th>Pembayaran</th>
                                <th>Tgl. Pesan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="<?php echo e($loop->odd ? 'odd' : 'even'); ?>">
                                    <td><?php echo e($item->no_transaksi); ?></td>
                                    <td><?php echo e(Formatter::moneyFormat($item->subtotal)); ?></td>
                                    <td><?php echo e($item->pembayaran); ?></td>
                                    <td><?php echo e(Formatter::dateFormat($item->created_at)); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('orders.detail', $item)); ?>" class="btn btn-sm btn-primary" hint="Edit Kategori">
                                            <i class="bx bxs-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <div class="m-3">
                        <?php echo e($orders->links()); ?>

                    </div>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tunai_app\resources\views/admin/pages/orders.blade.php ENDPATH**/ ?>