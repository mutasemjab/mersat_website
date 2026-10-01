
<hr class="my-4">
<div class="row g-3 align-items-end">
    <div class="col-md-3">
        <label class="form-label"><?php echo e(__('messages.field.sort_order')); ?></label>
        <input type="number" min="0" name="sort_order" value="<?php echo e(old('sort_order', $item->sort_order)); ?>"
               class="form-control <?php $__errorArgs = ['sort_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <div class="form-text"><?php echo e(__('messages.sort_order_hint')); ?></div>
    </div>
    <div class="col-md-4">
        <input type="hidden" name="is_active" value="0">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1"
                   <?php echo e(old('is_active', $item->is_active ? 1 : 0) ? 'checked' : ''); ?>>
            <label class="form-check-label" for="is_active"><?php echo e(__('messages.show_on_website')); ?></label>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\mersat\resources\views/admin/crud/_common.blade.php ENDPATH**/ ?>