

<?php $__env->startSection('content'); ?>
<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="py-3 mb-4"><?php echo e($title); ?></h4>
    <div class="card mb-4">
        <div class="card-body">
            <?php $__currentLoopData = $form; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $input): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row mb-3">
                    <label class="col-sm-2 form-label" for="basic-icon-default-message"><?php echo e($input['label']); ?></label>
                    <div class="col-sm-10">
                    <?php switch($input['type']):
                        case ('file'): ?>
                            <input type="file" name="<?php echo e($input['name']); ?>" class="form-control" accept="<?php echo e($input['accept']); ?>" />
                            <?php break; ?>
                        <?php case ('textarea'): ?>
                            <textarea name="<?php echo e($input['name']); ?>" class="form-control" placeholder="<?php echo e($input['placeholder']); ?>"><?php echo e(isset($input['value']) ? $input['value'] : old($input['name'])); ?></textarea>
                            <?php break; ?>
                        <?php case ('password'): ?>
                        <input type="<?php echo e($input['type']); ?>" name="<?php echo e($input['name']); ?>" class="form-control" placeholder="<?php echo e($input['placeholder']); ?>" />
                            <?php break; ?>
                        <?php default: ?>
                        <input type="<?php echo e($input['type']); ?>" name="<?php echo e($input['name']); ?>" class="form-control" placeholder="<?php echo e($input['placeholder']); ?>" value="<?php echo e(isset($input['value']) ? $input['value'] : old($input['name'])); ?>" />
                    <?php endswitch; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="row justify-content-end">
                <div class="col-sm-10">
                    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-info">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tunai_app\resources\views/forms/show.blade.php ENDPATH**/ ?>