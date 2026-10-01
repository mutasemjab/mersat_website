<?php $__env->startSection('title', __('messages.page_dashboard')); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title"><?php echo e(__('messages.page_dashboard')); ?></h1>
        <p class="page-sub"><?php echo e(__('messages.welcome_back')); ?></p>
    </div>
    <a href="<?php echo e(route('home')); ?>" target="_blank" class="btn-outline-sm">
        <i class="bi bi-box-arrow-up-right"></i> <?php echo e(__('messages.view_website')); ?>

    </a>
</div>

<?php
    $cards = [
        ['icon' => 'bi-grid-3x3-gap', 'color' => '#2563eb', 'bg' => '#eff6ff', 'value' => $servicesCount,  'label' => 'services',        'route' => 'admin.service.index',   'perm' => 'service-table'],
        ['icon' => 'bi-collection-play', 'color' => '#7c3aed', 'bg' => '#f5f3ff', 'value' => $portfolioCount, 'label' => 'portfolio_items', 'route' => 'admin.portfolio.index', 'perm' => 'portfolio-table'],
        ['icon' => 'bi-geo-alt', 'color' => '#059669', 'bg' => '#ecfdf5', 'value' => $locationsCount, 'label' => 'locations',       'route' => 'admin.location.index',  'perm' => 'location-table'],
        ['icon' => 'bi-envelope', 'color' => '#d97706', 'bg' => '#fffbeb', 'value' => $unreadCount,    'label' => 'unread_messages',  'route' => 'admin.message.index',   'perm' => 'message-table'],
    ];
?>

<div class="row g-3 mb-4">
    <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-6 col-xl-3">
        <a href="<?php echo e(Gate::allows($card['perm']) ? route($card['route']) : '#'); ?>" class="text-decoration-none">
            <div class="stat-card">
                <div class="stat-icon" style="background:<?php echo e($card['bg']); ?>;color:<?php echo e($card['color']); ?>">
                    <i class="bi <?php echo e($card['icon']); ?>"></i>
                </div>
                <div class="stat-value"><?php echo e($card['value']); ?></div>
                <div class="stat-label"><?php echo e(__('messages.' . $card['label'])); ?></div>
            </div>
        </a>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div class="panel-card">
    <div class="panel-card-header d-flex align-items-center justify-content-between">
        <h2 class="panel-card-title"><i class="bi bi-envelope"></i> <?php echo e(__('messages.latest_messages')); ?></h2>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('message-table')): ?>
        <a href="<?php echo e(route('admin.message.index')); ?>" class="btn-outline-sm"><?php echo e(__('messages.view_all')); ?></a>
        <?php endif; ?>
    </div>
    <div class="panel-card-body p-0">
        <div class="table-responsive">
            <table class="data-table">
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $latest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <div class="<?php echo e($msg->is_read ? '' : 'fw-bold'); ?>"><?php echo e($msg->name); ?></div>
                            <div class="small text-muted" dir="ltr"><?php echo e($msg->email); ?></div>
                        </td>
                        <td class="small text-muted cell-clip"><?php echo e(\Illuminate\Support\Str::limit($msg->message, 70)); ?></td>
                        <td class="small text-muted"><?php echo e($msg->created_at->diffForHumans()); ?></td>
                        <td>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('message-table')): ?>
                            <a href="<?php echo e(route('admin.message.show', $msg->id)); ?>" class="btn-icon-sm btn-edit"><i class="bi bi-eye"></i></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-4 d-block mb-2"></i><?php echo e(__('messages.no_messages_found')); ?>

                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mersat\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>