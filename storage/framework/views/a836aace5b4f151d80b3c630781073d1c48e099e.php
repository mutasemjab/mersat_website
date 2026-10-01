
<td><img src="<?php echo e($item->logo_url); ?>" alt="" class="thumb-logo" width="96" height="48" style="width:96px;height:48px;object-fit:contain;" loading="lazy"></td>
<td class="fw-semibold"><?php echo e($item->name ?: '—'); ?></td>
<?php echo $__env->make('admin.crud._status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\mersat\resources\views/admin/logo/_row.blade.php ENDPATH**/ ?>