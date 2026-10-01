
<a href="<?php echo e(route('portfolio.show', $work->id)); ?>" class="client-card r" style="--d:<?php echo e(($loop->index % 4) * 80); ?>ms">
  <div class="cc-media">
    <img src="<?php echo e($work->image_url); ?>" alt="<?php echo e($work->title); ?>" loading="lazy">
    <?php if($work->video_url): ?>
    <video muted loop playsinline preload="none" data-hover-video><source src="<?php echo e($work->video_url); ?>"></video>
    <?php endif; ?>
  </div>
  <div class="cc-body">
    <span class="cc-tag"><?php echo e($work->tag); ?></span>
    <h3 class="cc-title"><?php echo e($work->title); ?></h3>
  </div>
  <span class="cc-arrow" aria-hidden="true"><svg viewBox="0 0 24 24"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="8 7 17 7 17 16"/></svg></span>
</a>
<?php /**PATH C:\xampp\htdocs\mersat\resources\views/front/partials/client-card.blade.php ENDPATH**/ ?>