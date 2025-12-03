<!-- Favicon -->
<link rel="icon" type="image/x-icon" href="<?php echo e(asset('assets/img/favicon/favicon.ico')); ?>" />

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

<?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

<!-- Icons. Uncomment required icon fonts -->
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/fonts/boxicons.css')); ?>" />

<!-- Core CSS -->
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/css/core.css')); ?>" class="template-customizer-core-css" />
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/css/theme-default.css')); ?>"
    class="template-customizer-theme-css" />
<link rel="stylesheet" href="<?php echo e(asset('assets/css/demo.css')); ?>" />

<!-- Vendors CSS -->
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/apex-charts/apex-charts.css')); ?>" />

<?php echo $__env->yieldPushContent('css'); ?>

<!-- Helpers -->
<script src="<?php echo e(asset('assets/vendor/js/helpers.js')); ?>"></script>

<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
<script src="<?php echo e(asset('assets/js/config.js')); ?>"></script><?php /**PATH C:\xampp\htdocs\tunai_app\resources\views/admin/components/link.blade.php ENDPATH**/ ?>