<div class="alert alert-info small d-flex gap-2 align-items-start">
    <i class="bi bi-info-circle mt-1"></i>
    <span><?php echo e(__('messages.logo_hint')); ?></span>
</div>

<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.media-input','data' => ['label' => __('messages.field.logo'),'kind' => 'image','required' => true,'file' => 'logo','link' => 'logo_link','remove' => 'remove_logo','value' => $item->getRawOriginal('logo'),'url' => $item->logo_url]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('admin.media-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.field.logo')),'kind' => 'image','required' => true,'file' => 'logo','link' => 'logo_link','remove' => 'remove_logo','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->getRawOriginal('logo')),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->logo_url)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

<div class="mb-3">
    <label class="form-label"><?php echo e(__('messages.logo_name')); ?></label>
    <input type="text" name="name" value="<?php echo e(old('name', $item->name)); ?>" maxlength="150"
           class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
    <div class="form-text"><?php echo e(__('messages.logo_name_hint')); ?></div>
    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback d-block"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<?php /**PATH C:\xampp\htdocs\mersat\resources\views/admin/logo/_form.blade.php ENDPATH**/ ?>