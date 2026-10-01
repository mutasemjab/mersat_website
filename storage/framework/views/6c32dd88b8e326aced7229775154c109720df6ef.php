
<?php $logo = setting_media('site_logo'); ?>
<?php if($logo): ?>
    <img src="<?php echo e($logo); ?>" alt="<?php echo e(setting('site_name')); ?>" <?php if(isset($style)): ?> style="<?php echo e($style); ?>" <?php endif; ?>>
<?php else: ?>
    <span class="logo-text" <?php if(isset($style)): ?> style="<?php echo e($style); ?>" <?php endif; ?>><?php echo e(setting('site_name')); ?></span>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\mersat\resources\views/front/partials/logo.blade.php ENDPATH**/ ?>