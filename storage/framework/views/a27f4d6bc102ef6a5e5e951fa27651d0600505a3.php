<?php $__env->startSection('title', __('messages.add_new', ['name' => $singular])); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title"><?php echo e(__('messages.add_new', ['name' => $singular])); ?></h1>
        <p class="page-sub"><?php echo e(__('messages.both_languages_hint')); ?></p>
    </div>
    <a href="<?php echo e(route($route . '.index')); ?>" class="btn-outline-sm">
        <i class="bi bi-arrow-left back-icon"></i> <?php echo e(__('messages.back_to_list')); ?>

    </a>
</div>

<form action="<?php echo e(route($route . '.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="panel-card">
        <div class="panel-card-body">
            <?php echo $__env->make($view . '._form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('admin.crud._common', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

    <div class="d-flex gap-2 mt-4 pb-4">
        <button type="submit" class="btn-primary-sm"><i class="bi bi-save"></i> <?php echo e(__('messages.Save')); ?></button>
        <a href="<?php echo e(route($route . '.index')); ?>" class="btn-outline-sm"><?php echo e(__('messages.Cancel')); ?></a>
    </div>
</form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mersat\resources\views/admin/crud/create.blade.php ENDPATH**/ ?>