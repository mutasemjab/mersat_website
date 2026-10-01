<?php
    $otherLocale = app()->getLocale() === 'ar' ? 'en' : 'ar';
    $waDigits = preg_replace('/\D+/', '', (string) setting('contact_whatsapp'));
    // Section links jump within the home page, or back to it from the other pages
    $home = request()->routeIs('home') ? '' : route('home');
    $navLinks = [
        'services'  => __('front.nav_services'),
        'portfolio' => __('front.nav_portfolio'),
    ];
    // "Our clients" jumps to the logo wall, which only exists once a logo has been added
    if (\App\Models\ClientLogo::active()->exists()) {
        $navLinks['clients'] = __('front.nav_clients');
    }
    $navLinks += [
        'about'     => __('front.nav_about'),
        'global'    => __('front.nav_global'),
        'contact'   => __('front.nav_contact'),
    ];
    $langUrl = LaravelLocalization::getLocalizedURL($otherLocale, null, [], true);
?>

<a class="skip-link" href="#main"><?php echo e(__('front.skip_to_content')); ?></a>

<header class="site-header" id="nav">
  <div class="header-bar">
    <a href="<?php echo e(route('home')); ?>" class="brand" aria-label="<?php echo e(setting('site_name')); ?>"><?php echo $__env->make('front.partials.logo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></a>

    <nav class="main-nav" aria-label="<?php echo e(__('front.menu')); ?>">
      <ul>
        <?php $__currentLoopData = $navLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><a href="<?php echo e($home); ?>#<?php echo e($id); ?>" data-spy="<?php echo e($id); ?>"><?php echo e($label); ?></a></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </nav>

    <div class="header-actions">
      <a href="<?php echo e($langUrl); ?>" class="lang-switch" hreflang="<?php echo e($otherLocale); ?>" lang="<?php echo e($otherLocale); ?>"><?php echo e(__('front.switch_language')); ?></a>
      <a href="<?php echo e($home); ?>#contact" class="btn btn-primary btn-sm header-cta"><?php echo e(__('front.nav_cta')); ?></a>
      <button type="button" class="menu-toggle" aria-controls="mobile-menu" aria-expanded="false" aria-label="<?php echo e(__('front.menu')); ?>">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</header>


<div class="mobile-menu" id="mobile-menu" hidden>
  <nav aria-label="<?php echo e(__('front.menu')); ?>">
    <ol>
      <?php $__currentLoopData = $navLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <li style="--i:<?php echo e($loop->index); ?>"><a href="<?php echo e($home); ?>#<?php echo e($id); ?>"><span><?php echo e(str_pad($loop->iteration, 2, '0', STR_PAD_LEFT)); ?></span><?php echo e($label); ?></a></li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ol>
  </nav>
  <div class="mobile-menu-foot">
    <a href="<?php echo e($home); ?>#contact" class="btn btn-light"><?php echo e(__('front.nav_cta')); ?></a>
    <a href="<?php echo e($langUrl); ?>" class="lang-switch lang-switch-light" hreflang="<?php echo e($otherLocale); ?>" lang="<?php echo e($otherLocale); ?>"><?php echo e(__('front.switch_language')); ?></a>
  </div>
</div>

<button id="stt" type="button" aria-label="<?php echo e(__('front.scroll_top')); ?>">
  <svg viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg>
</button>

<?php if($waDigits): ?>
<a id="wa" href="https://wa.me/<?php echo e($waDigits); ?>" target="_blank" rel="noopener" title="<?php echo e(__('front.label_whatsapp')); ?>" aria-label="<?php echo e(__('front.label_whatsapp')); ?>">
  <?php echo $__env->make('front.partials.social-icon', ['platform' => 'whatsapp'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</a>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\mersat\resources\views/front/includes/navbar.blade.php ENDPATH**/ ?>