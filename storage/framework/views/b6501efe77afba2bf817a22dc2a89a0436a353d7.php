<?php
    $fPhone = setting('contact_phone');
    $fEmail = setting('contact_email');
    $fHome = request()->routeIs('home') ? '' : route('home');
?>
<footer class="site-footer">
  <div class="container footer-main">
    <div class="f-brand">
      <a href="<?php echo e(route('home')); ?>" class="f-logo"><?php echo $__env->make('front.partials.logo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></a>
      <p class="f-tagline"><?php echo e(setting('footer_title')); ?> <span><?php echo e(setting('footer_subtitle')); ?></span></p>
      <?php if($socialLinks->isNotEmpty()): ?>
      <div class="socials">
        <?php $__currentLoopData = $socialLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e($link->url); ?>" class="soc" title="<?php echo e(__('messages.platform.' . $link->platform)); ?>" aria-label="<?php echo e(__('messages.platform.' . $link->platform)); ?>" target="_blank" rel="noopener">
          <?php echo $__env->make('front.partials.social-icon', ['platform' => $link->platform], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <?php endif; ?>
    </div>

    <div class="f-col">
      <h3><?php echo e(__('front.quick_links')); ?></h3>
      <ul>
        <li><a href="<?php echo e($fHome); ?>#services"><?php echo e(__('front.nav_services')); ?></a></li>
        <li><a href="<?php echo e(route('portfolio.index')); ?>"><?php echo e(__('front.all_clients')); ?></a></li>
        <li><a href="<?php echo e($fHome); ?>#about"><?php echo e(__('front.nav_about')); ?></a></li>
        <li><a href="<?php echo e($fHome); ?>#global"><?php echo e(__('front.nav_global')); ?></a></li>
        <li><a href="<?php echo e($fHome); ?>#contact"><?php echo e(__('front.nav_contact')); ?></a></li>
      </ul>
    </div>

    <div class="f-col">
      <h3><?php echo e(__('front.nav_contact')); ?></h3>
      <ul class="f-contact">
        <?php if($fPhone): ?>
        <li><svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8 19.79 19.79 0 01.01 1.18 2 2 0 012 .01h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 14.92z"/></svg><a href="tel:<?php echo e(preg_replace('/[^\d+]/', '', $fPhone)); ?>" dir="ltr"><?php echo e($fPhone); ?></a></li>
        <?php endif; ?>
        <?php if($fEmail): ?>
        <li><svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg><a href="mailto:<?php echo e($fEmail); ?>"><?php echo e($fEmail); ?></a></li>
        <?php endif; ?>
        <li><svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg><span><?php echo e(setting('contact_location')); ?><small><?php echo e(setting('contact_location_sub')); ?></small></span></li>
      </ul>
    </div>
  </div>

  <div class="container footer-bot">
    <p>© <?php echo e(date('Y')); ?> <?php echo e(setting('footer_copyright')); ?></p>
    <button type="button" class="to-top" data-top aria-label="<?php echo e(__('front.scroll_top')); ?>">
      <svg viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg>
    </button>
  </div>
</footer>
<?php /**PATH C:\xampp\htdocs\mersat\resources\views/front/includes/footer.blade.php ENDPATH**/ ?>