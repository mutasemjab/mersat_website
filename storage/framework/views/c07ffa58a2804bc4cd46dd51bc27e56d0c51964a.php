
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['label', 'kind' => 'image', 'file', 'link', 'remove', 'fileDot' => null, 'linkDot' => null, 'value' => null, 'url' => null, 'required' => false]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['label', 'kind' => 'image', 'file', 'link', 'remove', 'fileDot' => null, 'linkDot' => null, 'value' => null, 'url' => null, 'required' => false]); ?>
<?php foreach (array_filter((['label', 'kind' => 'image', 'file', 'link', 'remove', 'fileDot' => null, 'linkDot' => null, 'value' => null, 'url' => null, 'required' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<?php
    $fileDot = $fileDot ?? $file;
    $linkDot = $linkDot ?? $link;
    $external = $value && preg_match('#^(https?:)?//#i', $value);
    $accept = $kind === 'video' ? 'video/mp4,video/webm,video/quicktime' : 'image/jpeg,image/png,image/webp,image/gif';
?>
<div class="mb-3 media-field">
    <label class="form-label">
        <?php echo e($label); ?> <?php if($required): ?><span class="text-danger">*</span><?php endif; ?>
    </label>

    <?php if($url): ?>
        <div class="media-current mb-2">
            <?php if($kind === 'video'): ?>
                <video src="<?php echo e($url); ?>" muted preload="metadata" controls></video>
            <?php else: ?>
                <img src="<?php echo e($url); ?>" alt="">
            <?php endif; ?>
            <label class="form-check mb-0 small">
                <input type="checkbox" class="form-check-input" name="<?php echo e($remove); ?>" value="1">
                <span class="form-check-label text-danger"><?php echo e(__('messages.remove_current')); ?></span>
            </label>
        </div>
    <?php endif; ?>

    <div class="row g-2">
        <div class="col-md-6">
            <input type="file" name="<?php echo e($file); ?>" accept="<?php echo e($accept); ?>"
                   class="form-control <?php $__errorArgs = [$fileDot];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
            <?php $__errorArgs = [$fileDot];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback d-block"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="col-md-6">
            <input type="text" name="<?php echo e($link); ?>" dir="ltr" placeholder="<?php echo e(__('messages.or_paste_link')); ?>"
                   value="<?php echo e(old($linkDot, $external ? $value : '')); ?>"
                   class="form-control <?php $__errorArgs = [$linkDot];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
            <?php $__errorArgs = [$linkDot];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback d-block"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>
    <div class="form-text"><?php echo e($kind === 'video' ? __('messages.video_hint') : __('messages.image_hint')); ?></div>
</div>
<?php /**PATH C:\xampp\htdocs\mersat\resources\views/components/admin/media-input.blade.php ENDPATH**/ ?>