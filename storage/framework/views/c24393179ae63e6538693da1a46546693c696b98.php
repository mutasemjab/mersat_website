<?php $__env->startSection('title', $plural); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title"><?php echo e($plural); ?></h1>
        <p class="page-sub"><?php echo e(__('messages.manage_list_desc')); ?></p>
    </div>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($perm . '-add')): ?>
    <a href="<?php echo e(route($route . '.create')); ?>" class="btn-primary-sm">
        <i class="bi bi-plus-circle"></i> <?php echo e(__('messages.add_new', ['name' => $singular])); ?>

    </a>
    <?php endif; ?>
</div>

<div class="panel-card">
    <div class="panel-card-header d-flex align-items-center justify-content-between">
        <h2 class="panel-card-title"><i class="bi bi-list-ul"></i> <?php echo e($plural); ?></h2>
        <span class="pill pill-info"><?php echo e($items->total()); ?></span>
    </div>
    <div class="panel-card-body p-0">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th><?php echo e(__('messages.field.' . $column)); ?></th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <th><?php echo e(__('messages.Actions')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($item->id); ?></td>
                        <?php echo $__env->make($view . '._row', ['item' => $item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <td>
                            <div class="d-flex gap-1">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($perm . '-edit')): ?>
                                <a href="<?php echo e(route($route . '.edit', $item->id)); ?>" class="btn-icon-sm btn-edit" title="<?php echo e(__('messages.Edit')); ?>">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($perm . '-delete')): ?>
                                <form action="<?php echo e(route($route . '.destroy', $item->id)); ?>" method="POST" class="d-inline"
                                      onsubmit="return confirm('<?php echo e(__('messages.confirm_delete')); ?>')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn-icon-sm btn-delete" title="<?php echo e(__('messages.Delete')); ?>">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="<?php echo e(count($columns) + 2); ?>" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                            <?php echo e(__('messages.no_records')); ?>

                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if($items->hasPages()): ?>
    <div class="panel-card-body border-top pt-3"><?php echo e($items->links()); ?></div>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mersat\resources\views/admin/crud/index.blade.php ENDPATH**/ ?>