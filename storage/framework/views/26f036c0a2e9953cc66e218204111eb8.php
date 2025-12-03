

<?php $__env->startSection('content'); ?>
<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="py-3 mb-4"><?php echo e($title); ?></h4>
    <div class="card mb-4">
        <div class="card-body">

            <?php echo $__env->make('components.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
            <form action="<?php echo e($url); ?>" method="POST" enctype="multipart/form-data" x-data="{is_submit: false}" @submit="is_submit = !is_submit">
                <?php echo csrf_field(); ?>
                <?php $__currentLoopData = $form; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $input): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row mb-3">
                        <label class="col-sm-2 form-label d-flex align-items-center" for="basic-icon-default-message"><?php echo e($input['label']); ?></label>
                        <div class="col-sm-10">
                        <?php switch($input['type']):
                            case ('select'): ?>
                                <select name="<?php echo e($input['name']); ?>" class="form-control">
                                    <?php $__currentLoopData = $input['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            <?php break; ?>
                            <?php case ('file'): ?>
                                <input type="file" name="<?php echo e($input['name']); ?>" class="form-control" accept="<?php echo e($input['accept']); ?>" />
                            <?php break; ?>
                            <?php case ('textarea'): ?>
                                <textarea name="<?php echo e($input['name']); ?>" class="form-control" placeholder="<?php echo e($input['placeholder']); ?>"><?php echo e(old($input['name'])); ?></textarea>
                            <?php break; ?>
                            <?php case ('password'): ?>
                            <input type="<?php echo e($input['type']); ?>" name="<?php echo e($input['name']); ?>" class="form-control" placeholder="<?php echo e($input['placeholder']); ?>" />
                            <?php break; ?>
                            <?php default: ?>
                            <input type="<?php echo e($input['type']); ?>" name="<?php echo e($input['name']); ?>" class="form-control" placeholder="<?php echo e($input['placeholder']); ?>" value="<?php echo e(old($input['name'])); ?>" autocomplete="off" />
                        <?php endswitch; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary" x-bind:disabled="is_submit">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tunai_app\resources\views/forms/create.blade.php ENDPATH**/ ?>