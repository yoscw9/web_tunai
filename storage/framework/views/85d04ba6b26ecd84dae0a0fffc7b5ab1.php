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
            <span class="text-muted fw-light">Daftar </span>Paket Menu
        </h4>

        <?php echo $__env->make('admin.components.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- DataTable with Buttons -->
        <div class="card" x-data="dataMaster">
            <div class="card-datatable table-responsive">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="card-header flex-column flex-md-row">
                        <div class="head-label text-center">
                            <h5 class="card-title mb-0">Data Paket Menu</h5>
                        </div>
                        <div class="dt-action-buttons text-end pt-3 pt-md-0">
                            <div class="dt-buttons">
                                <a href="<?php echo e(route('packages.create')); ?>" class="dt-button create-new btn btn-primary"
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
                                <th>Nama Paket</th>
                                <th>Menu</th>
                                <th>Status</th>
                                <th>Tanggal Input</th>
                                <th>Tanggal Diedit</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $paketMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($package->nama_paket); ?></td>
                                    <td>
                                        <?php $__currentLoopData = $package->menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="badge bg-primary"><?php echo e($menu->nama_menu); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td><?php echo e($package->status); ?></td>
                                    <td><?php echo e(Formatter::dateFormat($package->created_at)); ?></td>
                                    <td><?php echo e(Formatter::dateFormat($package->updated_at)); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('packagemenus.edit', $package->id)); ?>" class="btn btn-sm btn-warning">
                                            <i class="bx bxs-edit"></i>
                                        </a>
                                        <button @click="axiosDelete('<?php echo e(route('packagemenus.destroy', $package->id)); ?>')"
                                            class="btn btn-sm btn-danger">
                                            <i class="bx bxs-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <div class="m-3">
                        <?php echo e($paketMenus->links()); ?>

                    </div>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tunai_app\resources\views/admin/pages/packages-menu.blade.php ENDPATH**/ ?>