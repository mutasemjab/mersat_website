<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>" dir="<?php echo e(app()->getLocale() === 'ar' ? 'rtl' : 'ltr'); ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<meta name="theme-color" content="#18176B">
<title><?php echo $__env->yieldContent('title', setting('page_title', __('front.page_title'))); ?></title>
<meta name="description" content="<?php echo $__env->yieldContent('meta_description', setting('meta_description', __('front.meta_description'))); ?>">
<?php $__currentLoopData = LaravelLocalization::getSupportedLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $props): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<link rel="alternate" hreflang="<?php echo e($code); ?>" href="<?php echo e(LaravelLocalization::getLocalizedURL($code, null, [], true)); ?>">
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&family=Manrope:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@1,600;1,700&display=swap" rel="stylesheet">
<link href="<?php echo e(asset('assets_front/css/style.css')); ?>?v=<?php echo e(filemtime(base_path('assets_front/css/style.css'))); ?>" rel="stylesheet">
<script>document.documentElement.classList.add('js');</script>
<?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="<?php echo e(app()->getLocale() === 'en' ? 'lang-en' : 'lang-ar'); ?> <?php echo $__env->yieldContent('body_class'); ?>">

<?php echo $__env->make('front.includes.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<main id="main">
<?php echo $__env->yieldContent('content'); ?>
</main>

<?php echo $__env->make('front.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('front.partials.lightbox', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script src="<?php echo e(asset('assets_front/js/app.js')); ?>?v=<?php echo e(filemtime(base_path('assets_front/js/app.js'))); ?>"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\mersat\resources\views/layouts/front.blade.php ENDPATH**/ ?>