<td><?php echo e($item->sort_order); ?></td>
<td>
    <?php if($item->is_active): ?>
        <span class="pill pill-success"><?php echo e(__('messages.Active')); ?></span>
    <?php else: ?>
        <span class="pill pill-neutral"><?php echo e(__('messages.Inactive')); ?></span>
    <?php endif; ?>
</td>
<?php /**PATH C:\xampp\htdocs\mersat\resources\views/admin/crud/_status.blade.php ENDPATH**/ ?>