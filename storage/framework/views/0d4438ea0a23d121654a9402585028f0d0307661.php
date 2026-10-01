
<?php
    $map = \App\Support\WorldMap::data();
    $pins = $locations->filter(fn ($l) => \App\Support\WorldMap::has($l->country_code))->unique('country_code')->values();
    $lit = $pins->pluck('country_code')->flip();
    $hq = $pins->first();
?>
<svg class="world-map-svg" viewBox="0 0 <?php echo e($map['width']); ?> <?php echo e($map['height']); ?>" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="<?php echo e($pins->map(fn ($l) => $l->city)->join(', ')); ?>">
  <defs>
    <filter id="wm-glow" x="-50%" y="-50%" width="200%" height="200%"><feGaussianBlur stdDeviation="4" result="b"/><feMerge><feMergeNode in="b"/><feMergeNode in="SourceGraphic"/></feMerge></filter>
  </defs>

  <g class="wm-land">
    <?php $__currentLoopData = $map['countries']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if($country['d'] && !isset($lit[$code])): ?><path d="<?php echo e($country['d']); ?>"/><?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </g>

  <g class="wm-lit" filter="url(#wm-glow)">
    <?php $__currentLoopData = $pins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php $country = $map['countries'][$loc->country_code]; ?>
      <?php if($country['d']): ?><path d="<?php echo e($country['d']); ?>" data-cc="<?php echo e($loc->country_code); ?>"><title><?php echo e($loc->city); ?></title></path><?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </g>

  <?php if($hq): ?>
  <?php $from = $map['countries'][$hq->country_code]; ?>
  <g class="wm-arcs">
    <?php $__currentLoopData = $pins->slice(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php
        $to = $map['countries'][$loc->country_code];
        $dist = hypot($to['x'] - $from['x'], $to['y'] - $from['y']);
        $cx = ($from['x'] + $to['x']) / 2;
        $cy = min($from['y'], $to['y']) - max(12, $dist * .28);
      ?>
      <path d="M<?php echo e($from['x']); ?> <?php echo e($from['y']); ?> Q<?php echo e(round($cx, 1)); ?> <?php echo e(round($cy, 1)); ?> <?php echo e($to['x']); ?> <?php echo e($to['y']); ?>" style="animation-delay:-<?php echo e($loop->index * .7); ?>s"/>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </g>
  <?php endif; ?>

  <g class="wm-pins">
    <?php $__currentLoopData = $pins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php $country = $map['countries'][$loc->country_code]; ?>
      <g class="wm-pin <?php echo e($loop->first ? 'hq' : ''); ?>" data-cc="<?php echo e($loc->country_code); ?>" transform="translate(<?php echo e($country['x']); ?> <?php echo e($country['y']); ?>)">
        <title><?php echo e($loc->city); ?></title>
        <circle class="wm-pulse" r="<?php echo e($loop->first ? 6 : 4); ?>" style="animation-delay:<?php echo e($loop->index * .4); ?>s"/>
        <circle class="wm-dot" r="<?php echo e($loop->first ? 4 : 3); ?>"/>
      </g>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </g>
</svg>
<?php /**PATH C:\xampp\htdocs\mersat\resources\views/front/partials/world-map.blade.php ENDPATH**/ ?>