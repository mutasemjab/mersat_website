<?php $__env->startSection('body_class', 'page-home'); ?>

<?php $__env->startSection('content'); ?>


<section id="hero" class="hero" data-interval="5000" style="--interval:5000ms" aria-roledescription="carousel" aria-label="<?php echo e(setting('site_name')); ?>">
  <div class="hero-slides">
    <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="hero-slide <?php echo e($loop->first ? 'is-active' : ''); ?>" aria-hidden="<?php echo e($loop->first ? 'false' : 'true'); ?>">
      <?php if($slide['image']): ?>
      <img src="<?php echo e($slide['image']); ?>" alt="" <?php if(!$loop->first): ?> loading="lazy" <?php else: ?> fetchpriority="high" <?php endif; ?>>
      <?php endif; ?>
      <?php if($slide['video']): ?>
      <video muted loop playsinline preload="<?php echo e($loop->first ? 'auto' : 'none'); ?>" <?php if($slide['image']): ?> poster="<?php echo e($slide['image']); ?>" <?php endif; ?>><source src="<?php echo e($slide['video']); ?>"></video>
      <?php endif; ?>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
  <div class="hero-shade"></div>

  <div class="container hero-inner">
    <div class="hero-texts">
      <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="hero-text <?php echo e($loop->first ? 'is-active' : ''); ?>" aria-hidden="<?php echo e($loop->first ? 'false' : 'true'); ?>">
        <?php if($slide['kicker']): ?><p class="hero-kicker"><?php echo e($slide['kicker']); ?></p><?php endif; ?>
        <<?php echo e($loop->first ? 'h1' : 'h2'); ?> class="hero-title">
          <span class="ht-line"><?php echo e($slide['title']); ?></span>
          <?php if($slide['highlight']): ?><span class="ht-line ht-hl"><?php echo e($slide['highlight']); ?></span><?php endif; ?>
        </<?php echo e($loop->first ? 'h1' : 'h2'); ?>>
        <?php if($slide['subtitle']): ?><p class="hero-sub"><?php echo e($slide['subtitle']); ?></p><?php endif; ?>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="hero-btns">
      <a href="<?php echo e(setting('hero_btn1_url', '#portfolio')); ?>" class="btn btn-light"><?php echo e(setting('hero_btn1_text')); ?></a>
      <a href="<?php echo e(setting('hero_btn2_url', '#contact')); ?>" class="btn btn-ghost"><?php echo e(setting('hero_btn2_text')); ?></a>
    </div>
  </div>

  <?php if(count($slides) > 1): ?>
  <div class="container hero-controls">
    <div class="hero-count" aria-live="polite"><b class="hc-cur">01</b><span>/</span><?php echo e(str_pad(count($slides), 2, '0', STR_PAD_LEFT)); ?></div>
    <div class="hero-dots">
      <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <button type="button" class="hero-dot <?php echo e($loop->first ? 'is-active' : ''); ?>" aria-label="<?php echo e(__('front.slide_n', ['n' => $loop->iteration])); ?>"><i></i></button>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="hero-arrows">
      <button type="button" class="hero-arrow" data-dir="-1" aria-label="<?php echo e(__('front.prev_slide')); ?>"><svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg></button>
      <button type="button" class="hero-arrow" data-dir="1" aria-label="<?php echo e(__('front.next_slide')); ?>"><svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg></button>
    </div>
  </div>
  <?php endif; ?>
</section>


<?php if($tickerItems->isNotEmpty()): ?>
<div class="ticker" aria-hidden="true">
  <div class="ticker-track">
    <?php for($rep = 0; $rep < 2; $rep++): ?>
      <?php $__currentLoopData = $tickerItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tick): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <span><?php echo e($tick->title); ?></span><i class="tdot"></i>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endfor; ?>
  </div>
</div>
<?php endif; ?>


<section id="services" class="section">
  <div class="container">
    <div class="sec-head sec-head-split">
      <div>
        <p class="eyebrow r"><?php echo e(setting('services_label')); ?></p>
        <h2 class="sec-title r"><?php echo e(setting('services_title_1')); ?> <em><?php echo e(setting('services_title_2')); ?></em></h2>
      </div>
      <div class="sec-head-side r">
        <p><?php echo e(setting('services_text')); ?></p>
        <a href="<?php echo e(setting('services_btn_url', '#contact')); ?>" class="link-arrow"><?php echo e(setting('services_btn_text')); ?></a>
      </div>
    </div>

    <div class="srv-grid">
      <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <article class="srv-card r" style="--d:<?php echo e(($loop->index % 5) * 70); ?>ms">
        <span class="srv-num"><?php echo e(str_pad($loop->iteration, 2, '0', STR_PAD_LEFT)); ?></span>
        <div class="srv-icon">
          <?php if($service->image_url): ?>
          <img src="<?php echo e($service->image_url); ?>" alt="">
          <?php else: ?>
          <?php echo $__env->make('front.partials.service-icon', ['icon' => $service->icon], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php endif; ?>
        </div>
        <h3><?php echo e($service->title); ?></h3>
        <p><?php echo e($service->description); ?></p>
      </article>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</section>


<section class="statement" aria-label="<?php echo e(setting('services_visual_2')); ?>">
  <div class="container statement-inner r">
    <span><?php echo e(setting('services_visual_1')); ?></span>
    <span class="st-hl"><?php echo e(setting('services_visual_2')); ?></span>
    <span><?php echo e(setting('services_visual_3')); ?></span>
  </div>
</section>


<?php if($clientLogos->isNotEmpty()): ?>
<?php
    // Enough logos: scrolling rows (two rows from 10 logos). Few logos: a still, centred grid.
    $marquee = $clientLogos->count() >= 6;
    $rows = $marquee && $clientLogos->count() >= 10
        ? [$clientLogos->nth(2), $clientLogos->nth(2, 1)]
        : [$clientLogos];
?>
<section id="clients" class="section logos-section">
  <div class="container">
    <div class="sec-head sec-head-center">
      <p class="eyebrow r"><?php echo e(__('front.logos_label')); ?></p>
      <h2 class="sec-title r"><?php echo e(__('front.logos_title')); ?> <em><?php echo e(__('front.logos_title_hl')); ?></em></h2>
    </div>
  </div>

  <?php if($marquee): ?>
  <div class="logo-marquee r">
    <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php $reps = max(1, (int) ceil(8 / $row->count())); ?>
    <div class="logo-row <?php echo e($loop->odd ? '' : 'logo-row-rev'); ?>" style="--dur:<?php echo e(max(25, $row->count() * $reps * 4)); ?>s">
      <div class="logo-track">
        <?php for($copy = 0; $copy < 2; $copy++): ?>
          <?php for($rep = 0; $rep < $reps; $rep++): ?>
            <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="logo-card" <?php if($copy || $rep): ?> aria-hidden="true" <?php endif; ?>>
              <img src="<?php echo e($logo->logo_url); ?>" alt="<?php echo e(($copy || $rep) ? '' : $logo->name); ?>" loading="lazy">
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endfor; ?>
        <?php endfor; ?>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
  <?php else: ?>
  <div class="container">
    <div class="logo-grid">
      <?php $__currentLoopData = $clientLogos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="logo-card r" style="--d:<?php echo e($loop->index * 70); ?>ms"><img src="<?php echo e($logo->logo_url); ?>" alt="<?php echo e($logo->name); ?>" loading="lazy"></div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
  <?php endif; ?>
</section>
<?php endif; ?>


<section id="portfolio" class="section section-tint">
  <div class="container">
    <div class="sec-head sec-head-split">
      <div>
        <p class="eyebrow r"><?php echo e(setting('portfolio_label')); ?></p>
        <h2 class="sec-title r"><?php echo e(setting('portfolio_title_1')); ?> <em><?php echo e(setting('portfolio_title_2')); ?></em></h2>
      </div>
      <div class="sec-head-side r">
        <a href="<?php echo e(route('portfolio.index')); ?>" class="btn btn-outline"><?php echo e(setting('portfolio_btn_text')); ?></a>
      </div>
    </div>

    <div class="clients-grid">
      <?php $__currentLoopData = $portfolioItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $work): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('front.partials.client-card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="center-cta r">
      <a href="<?php echo e(route('portfolio.index')); ?>" class="btn btn-primary"><?php echo e(__('front.view_more')); ?></a>
    </div>
  </div>
</section>


<?php if($workMedia->isNotEmpty()): ?>
<section id="work" class="section">
  <div class="container">
    <div class="sec-head sec-head-split">
      <div>
        <p class="eyebrow r"><?php echo e(__('front.work_label')); ?></p>
        <h2 class="sec-title r"><?php echo e(__('front.work_title')); ?> <em><?php echo e(__('front.work_title_hl')); ?></em></h2>
      </div>
      <div class="filter-tabs r" role="tablist">
        <button type="button" class="is-active" data-filter="all"><?php echo e(__('front.filter_all')); ?></button>
        <button type="button" data-filter="photo"><?php echo e(__('front.filter_photos')); ?></button>
        <button type="button" data-filter="video"><?php echo e(__('front.filter_videos')); ?></button>
      </div>
    </div>
    <div class="work-grid">
      <?php $__currentLoopData = $workMedia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('front.partials.work-item', ['caption' => $media->item->title, 'clientLink' => route('portfolio.show', $media->portfolio_item_id)], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</section>
<?php endif; ?>


<section id="about" class="section">
  <div class="container about-grid">
    <?php $aboutVideo = setting_media('about_video'); $aboutPoster = setting_media('about_poster'); ?>
    <div class="about-media r">
      <div class="about-frame">
        <?php if($aboutPoster): ?><img src="<?php echo e($aboutPoster); ?>" alt="<?php echo e(setting('about_label')); ?>" loading="lazy"><?php endif; ?>
        <?php if($aboutVideo): ?>
        <video autoplay muted loop playsinline preload="metadata" <?php if($aboutPoster): ?> poster="<?php echo e($aboutPoster); ?>" <?php endif; ?>><source src="<?php echo e($aboutVideo); ?>"></video>
        <?php endif; ?>
      </div>
      <div class="about-badge">
        <b dir="ltr"><?php echo e(setting('about_badge_number')); ?></b>
        <span><?php echo e(setting('about_badge_line1')); ?><br><?php echo e(setting('about_badge_line2')); ?></span>
      </div>
    </div>

    <div class="about-copy">
      <p class="eyebrow r"><?php echo e(setting('about_label')); ?></p>
      <h2 class="sec-title r"><?php echo e(setting('about_title_1')); ?> <em><?php echo e(setting('about_title_2')); ?></em></h2>
      <p class="lead r"><?php echo e(setting('about_text_1')); ?></p>
      <p class="r"><?php echo e(setting('about_text_2')); ?></p>
      <p class="about-countries r"><?php echo e(setting('about_countries')); ?></p>

      <?php if($stats->isNotEmpty()): ?>
      <div class="stats r">
        <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="stat">
          <div class="stat-n" dir="ltr"><span data-count="<?php echo e($stat->value); ?>"><?php echo e($stat->value); ?></span><?php echo e($stat->suffix); ?></div>
          <div class="stat-l"><?php echo e($stat->label); ?></div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>


<section id="global" class="section section-dark">
  
  <div class="container global-grid">
    <div class="global-main">
      <div class="global-copy">
        <p class="eyebrow r"><?php echo e(setting('global_label')); ?></p>
        <h2 class="sec-title r"><?php echo e(setting('global_title_1')); ?> <em><?php echo e(setting('global_title_2')); ?></em></h2>
        <p class="r"><?php echo e(setting('global_text')); ?></p>
      </div>
      <div class="world-map-wrap r">
        <?php echo $__env->make('front.partials.world-map', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    </div>
    <ul class="locations r">
      <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <li class="g-loc" data-cc="<?php echo e($loc->country_code); ?>">
        <span class="g-dot"></span>
        <span><b><?php echo e($loc->city); ?></b><small><?php echo e($loc->description); ?></small></span>
      </li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
  </div>
</section>


<?php
  $cPhone = setting('contact_phone');
  $cEmail = setting('contact_email');
  $cWa    = setting('contact_whatsapp');
  $cWaDigits = preg_replace('/\D+/', '', (string) $cWa);
?>
<section id="contact" class="section section-tint">
  <div class="container contact-card r">
    <div class="contact-info">
      <p class="eyebrow eyebrow-light"><?php echo e(setting('contact_label')); ?></p>
      <h2 class="sec-title"><?php echo e(setting('contact_title_1')); ?> <?php echo e(setting('contact_title_2')); ?> <em><?php echo e(setting('contact_title_em')); ?></em></h2>
      <p class="contact-desc"><?php echo e(setting('contact_desc')); ?></p>

      <ul class="c-details">
        <?php if($cPhone): ?>
        <li>
          <span class="c-ico"><svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8 19.79 19.79 0 01.01 1.18 2 2 0 012 .01h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 14.92z"/></svg></span>
          <span><small><?php echo e(__('front.label_phone')); ?></small><a href="tel:<?php echo e(preg_replace('/[^\d+]/', '', $cPhone)); ?>" dir="ltr"><?php echo e($cPhone); ?></a></span>
        </li>
        <?php endif; ?>
        <?php if($cEmail): ?>
        <li>
          <span class="c-ico"><svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></span>
          <span><small><?php echo e(__('front.label_email')); ?></small><a href="mailto:<?php echo e($cEmail); ?>"><?php echo e($cEmail); ?></a></span>
        </li>
        <?php endif; ?>
        <?php if($cWaDigits): ?>
        <li>
          <span class="c-ico"><svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></span>
          <span><small><?php echo e(__('front.label_whatsapp')); ?></small><a href="https://wa.me/<?php echo e($cWaDigits); ?>" target="_blank" rel="noopener" dir="ltr"><?php echo e($cWa); ?></a></span>
        </li>
        <?php endif; ?>
        <li>
          <span class="c-ico"><svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg></span>
          <span><small><?php echo e(__('front.label_location')); ?></small><?php echo e(setting('contact_location')); ?> · <?php echo e(setting('contact_location_sub')); ?></span>
        </li>
      </ul>

      <?php if($socialLinks->isNotEmpty()): ?>
      <div class="socials socials-light">
        <?php $__currentLoopData = $socialLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e($link->url); ?>" class="soc" title="<?php echo e(__('messages.platform.' . $link->platform)); ?>" aria-label="<?php echo e(__('messages.platform.' . $link->platform)); ?>" target="_blank" rel="noopener">
          <?php echo $__env->make('front.partials.social-icon', ['platform' => $link->platform], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <?php endif; ?>
    </div>

    <div class="contact-form-wrap">
      <p class="eyebrow"><?php echo e(setting('contact_form_label')); ?></p>
      <h3 class="form-title"><?php echo e(setting('contact_form_title_1')); ?> <em><?php echo e(setting('contact_form_title_em')); ?></em></h3>
      <form class="c-form" id="contact-form" action="<?php echo e(route('contact.store')); ?>" method="POST" novalidate
            data-sending="<?php echo e(__('front.form_sending')); ?>" data-error="<?php echo e(__('front.form_error')); ?>" data-label="<?php echo e(setting('contact_form_btn')); ?>">
        <?php echo csrf_field(); ?>
        <input type="text" name="website" class="hp" tabindex="-1" autocomplete="off" aria-hidden="true">
        <div class="form-msg <?php if(session('contact_success')): ?> ok <?php elseif($errors->any()): ?> err <?php endif; ?>" id="form-msg" role="status">
          <?php if(session('contact_success')): ?><?php echo e(session('contact_success')); ?><?php elseif($errors->any()): ?><?php echo e($errors->first()); ?><?php endif; ?>
        </div>
        <div class="frow">
          <label class="ff"><span><?php echo e(__('front.form_name')); ?></span><input type="text" name="name" value="<?php echo e(old('name')); ?>" placeholder="<?php echo e(__('front.ph_name')); ?>" required maxlength="150" autocomplete="name"></label>
          <label class="ff"><span><?php echo e(__('front.form_email')); ?></span><input type="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(__('front.ph_email')); ?>" required maxlength="150" dir="ltr" autocomplete="email"></label>
        </div>
        <div class="frow">
          <label class="ff"><span><?php echo e(__('front.form_phone')); ?></span><input type="tel" name="phone" value="<?php echo e(old('phone')); ?>" placeholder="<?php echo e(__('front.ph_phone')); ?>" maxlength="50" dir="ltr" autocomplete="tel"></label>
          <label class="ff"><span><?php echo e(__('front.form_business')); ?></span><input type="text" name="business_name" value="<?php echo e(old('business_name')); ?>" placeholder="<?php echo e(__('front.ph_business')); ?>" maxlength="150" autocomplete="organization"></label>
        </div>
        <label class="ff">
          <span><?php echo e(__('front.form_service')); ?></span>
          <select name="service">
            <option value=""><?php echo e(__('front.ph_service')); ?></option>
            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($service->getTranslation('title', 'en')); ?>" <?php if(old('service') === $service->getTranslation('title', 'en')): echo 'selected'; endif; ?>><?php echo e($service->title); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <option value="Full Package" <?php if(old('service') === 'Full Package'): echo 'selected'; endif; ?>><?php echo e(__('front.full_package')); ?></option>
          </select>
        </label>
        <label class="ff"><span><?php echo e(__('front.form_message')); ?></span><textarea name="message" placeholder="<?php echo e(__('front.ph_message')); ?>" required maxlength="3000" rows="4"><?php echo e(old('message')); ?></textarea></label>
        <button type="submit" id="sbtn" class="btn btn-primary btn-block"><?php echo e(setting('contact_form_btn')); ?></button>
      </form>
    </div>
  </div>
</section>


<section class="final-cta">
  <div class="container final-cta-inner r">
    <h2><?php echo e(setting('cta_title_1')); ?> <?php echo e(setting('cta_title_2')); ?> <em><?php echo e(setting('cta_title_em')); ?></em></h2>
    <p><?php echo e(setting('cta_text')); ?></p>
    <a href="<?php echo e(setting('cta_btn_url', '#contact')); ?>" class="btn btn-light"><?php echo e(setting('cta_btn_text')); ?></a>
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mersat\resources\views/front/home.blade.php ENDPATH**/ ?>