@extends('layouts.front')
@section('body_class', 'page-home')

@section('content')

{{-- ═══ HERO SLIDER ═══ --}}
<section id="hero" class="hero" data-interval="5000" style="--interval:5000ms" aria-roledescription="carousel" aria-label="{{ setting('site_name') }}">
  <div class="hero-slides">
    @foreach ($slides as $slide)
    <div class="hero-slide {{ $loop->first ? 'is-active' : '' }}" aria-hidden="{{ $loop->first ? 'false' : 'true' }}">
      @if ($slide['image'])
      <img src="{{ $slide['image'] }}" alt="" @if(!$loop->first) loading="lazy" @else fetchpriority="high" @endif>
      @endif
      @if ($slide['video'])
      <video muted loop playsinline preload="{{ $loop->first ? 'auto' : 'none' }}" @if($slide['image']) poster="{{ $slide['image'] }}" @endif><source src="{{ $slide['video'] }}"></video>
      @endif
    </div>
    @endforeach
  </div>
  <div class="hero-shade"></div>

  <div class="container hero-inner">
    <div class="hero-texts">
      @foreach ($slides as $slide)
      <div class="hero-text {{ $loop->first ? 'is-active' : '' }}" aria-hidden="{{ $loop->first ? 'false' : 'true' }}">
        @if ($slide['kicker'])<p class="hero-kicker">{{ $slide['kicker'] }}</p>@endif
        <{{ $loop->first ? 'h1' : 'h2' }} class="hero-title">
          <span class="ht-line">{{ $slide['title'] }}</span>
          @if ($slide['highlight'])<span class="ht-line ht-hl">{{ $slide['highlight'] }}</span>@endif
        </{{ $loop->first ? 'h1' : 'h2' }}>
        @if ($slide['subtitle'])<p class="hero-sub">{{ $slide['subtitle'] }}</p>@endif
      </div>
      @endforeach
    </div>
    <div class="hero-btns">
      <a href="{{ setting('hero_btn1_url', '#portfolio') }}" class="btn btn-light">{{ setting('hero_btn1_text') }}</a>
      <a href="{{ setting('hero_btn2_url', '#contact') }}" class="btn btn-ghost">{{ setting('hero_btn2_text') }}</a>
    </div>
  </div>

  @if (count($slides) > 1)
  <div class="container hero-controls">
    <div class="hero-count" aria-live="polite"><b class="hc-cur">01</b><span>/</span>{{ str_pad(count($slides), 2, '0', STR_PAD_LEFT) }}</div>
    <div class="hero-dots">
      @foreach ($slides as $slide)
      <button type="button" class="hero-dot {{ $loop->first ? 'is-active' : '' }}" aria-label="{{ __('front.slide_n', ['n' => $loop->iteration]) }}"><i></i></button>
      @endforeach
    </div>
    <div class="hero-arrows">
      <button type="button" class="hero-arrow" data-dir="-1" aria-label="{{ __('front.prev_slide') }}"><svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg></button>
      <button type="button" class="hero-arrow" data-dir="1" aria-label="{{ __('front.next_slide') }}"><svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg></button>
    </div>
  </div>
  @endif
</section>

{{-- ═══ TICKER ═══ --}}
@if($tickerItems->isNotEmpty())
<div class="ticker" aria-hidden="true">
  <div class="ticker-track">
    @for($rep = 0; $rep < 2; $rep++)
      @foreach($tickerItems as $tick)
    <span>{{ $tick->title }}</span><i class="tdot"></i>
      @endforeach
    @endfor
  </div>
</div>
@endif

{{-- ═══ SERVICES ═══ --}}
<section id="services" class="section">
  <div class="container">
    <div class="sec-head sec-head-split">
      <div>
        <p class="eyebrow r">{{ setting('services_label') }}</p>
        <h2 class="sec-title r">{{ setting('services_title_1') }} <em>{{ setting('services_title_2') }}</em></h2>
      </div>
      <div class="sec-head-side r">
        <p>{{ setting('services_text') }}</p>
        <a href="{{ setting('services_btn_url', '#contact') }}" class="link-arrow">{{ setting('services_btn_text') }}</a>
      </div>
    </div>

    <div class="srv-grid">
      @foreach($services as $service)
      <article class="srv-card r" style="--d:{{ ($loop->index % 5) * 70 }}ms">
        <span class="srv-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
        <div class="srv-icon">
          @if($service->image_url)
          <img src="{{ $service->image_url }}" alt="">
          @else
          @include('front.partials.service-icon', ['icon' => $service->icon])
          @endif
        </div>
        <h3>{{ $service->title }}</h3>
        <p>{{ $service->description }}</p>
      </article>
      @endforeach
    </div>
  </div>
</section>

{{-- ═══ STATEMENT BAND ═══ --}}
<section class="statement" aria-label="{{ setting('services_visual_2') }}">
  <div class="container statement-inner r">
    <span>{{ setting('services_visual_1') }}</span>
    <span class="st-hl">{{ setting('services_visual_2') }}</span>
    <span>{{ setting('services_visual_3') }}</span>
  </div>
</section>

{{-- ═══ CLIENT LOGOS ═══ --}}
@if($clientLogos->isNotEmpty())
@php
    // Always a single row: it scrolls endlessly (the list is repeated so the loop has no gap);
    // app.js stops it and centres the logos when they all fit on screen.
    $reps = max(1, (int) ceil(8 / $clientLogos->count()));
@endphp
<section id="clients" class="section logos-section">
  <div class="container">
    <div class="sec-head sec-head-center">
      <p class="eyebrow r">{{ __('front.logos_label') }}</p>
      <h2 class="sec-title r">{{ __('front.logos_title') }} <em>{{ __('front.logos_title_hl') }}</em></h2>
    </div>
  </div>

  <div class="logo-marquee r" data-logos="{{ $clientLogos->count() }}">
    <div class="logo-row" style="--dur:{{ max(25, $clientLogos->count() * $reps * 4) }}s">
      <div class="logo-track">
        @for($copy = 0; $copy < 2; $copy++)
          @for($rep = 0; $rep < $reps; $rep++)
            @foreach($clientLogos as $logo)
            <div class="logo-card" @if($copy || $rep) aria-hidden="true" data-copy @endif>
              <img src="{{ $logo->logo_url }}" alt="{{ ($copy || $rep) ? '' : $logo->name }}">
            </div>
            @endforeach
          @endfor
        @endfor
      </div>
    </div>
  </div>
</section>
@endif

{{-- ═══ CLIENTS ═══ --}}
<section id="portfolio" class="section section-tint">
  <div class="container">
    <div class="sec-head sec-head-split">
      <div>
        <p class="eyebrow r">{{ setting('portfolio_label') }}</p>
        <h2 class="sec-title r">{{ setting('portfolio_title_1') }} <em>{{ setting('portfolio_title_2') }}</em></h2>
      </div>
      <div class="sec-head-side r">
        <a href="{{ route('portfolio.index') }}" class="btn btn-outline">{{ setting('portfolio_btn_text') }}</a>
      </div>
    </div>

    <div class="clients-grid">
      @foreach($portfolioItems as $work)
        @include('front.partials.client-card')
      @endforeach
    </div>

    <div class="center-cta r">
      <a href="{{ route('portfolio.index') }}" class="btn btn-primary">{{ __('front.view_more') }}</a>
    </div>
  </div>
</section>

{{-- ═══ WORK GALLERY (images & videos from the clients' galleries) ═══ --}}
@if($workMedia->isNotEmpty())
<section id="work" class="section">
  <div class="container">
    <div class="sec-head sec-head-split">
      <div>
        <p class="eyebrow r">{{ __('front.work_label') }}</p>
        <h2 class="sec-title r">{{ __('front.work_title') }} <em>{{ __('front.work_title_hl') }}</em></h2>
      </div>
      <div class="filter-tabs r" role="tablist">
        <button type="button" class="is-active" data-filter="all">{{ __('front.filter_all') }}</button>
        <button type="button" data-filter="photo">{{ __('front.filter_photos') }}</button>
        <button type="button" data-filter="video">{{ __('front.filter_videos') }}</button>
      </div>
    </div>
    <div class="work-grid">
      @foreach($workMedia as $media)
        @include('front.partials.work-item', ['caption' => $media->item->title, 'clientLink' => route('portfolio.show', $media->portfolio_item_id)])
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- ═══ ABOUT ═══ --}}
<section id="about" class="section">
  <div class="container about-grid">
    @php $aboutVideo = setting_media('about_video'); $aboutPoster = setting_media('about_poster'); @endphp
    <div class="about-media r">
      <div class="about-frame">
        @if($aboutPoster)<img src="{{ $aboutPoster }}" alt="{{ setting('about_label') }}" loading="lazy">@endif
        @if($aboutVideo)
        <video autoplay muted loop playsinline preload="metadata" @if($aboutPoster) poster="{{ $aboutPoster }}" @endif><source src="{{ $aboutVideo }}"></video>
        @endif
      </div>
      <div class="about-badge">
        <b dir="ltr">{{ setting('about_badge_number') }}</b>
        <span>{{ setting('about_badge_line1') }}<br>{{ setting('about_badge_line2') }}</span>
      </div>
    </div>

    <div class="about-copy">
      <p class="eyebrow r">{{ setting('about_label') }}</p>
      <h2 class="sec-title r">{{ setting('about_title_1') }} <em>{{ setting('about_title_2') }}</em></h2>
      <p class="lead r">{{ setting('about_text_1') }}</p>
      <p class="r">{{ setting('about_text_2') }}</p>
      <p class="about-countries r">{{ setting('about_countries') }}</p>

      @if($stats->isNotEmpty())
      <div class="stats r">
        @foreach($stats as $stat)
        <div class="stat">
          <div class="stat-n" dir="ltr"><span data-count="{{ $stat->value }}">{{ $stat->value }}</span>{{ $stat->suffix }}</div>
          <div class="stat-l">{{ $stat->label }}</div>
        </div>
        @endforeach
      </div>
      @endif
    </div>
  </div>
</section>

{{-- ═══ WORLDWIDE ═══ --}}
<section id="global" class="section section-dark">
  {{-- Heading, text and map share the wide column; the countries list sits beside them --}}
  <div class="container global-grid">
    <div class="global-main">
      <div class="global-copy">
        <p class="eyebrow r">{{ setting('global_label') }}</p>
        <h2 class="sec-title r">{{ setting('global_title_1') }} <em>{{ setting('global_title_2') }}</em></h2>
        <p class="r">{{ setting('global_text') }}</p>
      </div>
      <div class="world-map-wrap r">
        @include('front.partials.world-map')
      </div>
    </div>
    <ul class="locations r">
      @foreach($locations as $loc)
      <li class="g-loc" data-cc="{{ $loc->country_code }}">
        <span class="g-dot"></span>
        <span><b>{{ $loc->city }}</b><small>{{ $loc->description }}</small></span>
      </li>
      @endforeach
    </ul>
  </div>
</section>

{{-- ═══ CONTACT ═══ --}}
@php
  $cPhone = setting('contact_phone');
  $cEmail = setting('contact_email');
  $cWa    = setting('contact_whatsapp');
  $cWaDigits = preg_replace('/\D+/', '', (string) $cWa);
@endphp
<section id="contact" class="section section-tint">
  <div class="container contact-card r">
    <div class="contact-info">
      <p class="eyebrow eyebrow-light">{{ setting('contact_label') }}</p>
      <h2 class="sec-title">{{ setting('contact_title_1') }} {{ setting('contact_title_2') }} <em>{{ setting('contact_title_em') }}</em></h2>
      <p class="contact-desc">{{ setting('contact_desc') }}</p>

      <ul class="c-details">
        @if($cPhone)
        <li>
          <span class="c-ico"><svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8 19.79 19.79 0 01.01 1.18 2 2 0 012 .01h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 14.92z"/></svg></span>
          <span><small>{{ __('front.label_phone') }}</small><a href="tel:{{ preg_replace('/[^\d+]/', '', $cPhone) }}" dir="ltr">{{ $cPhone }}</a></span>
        </li>
        @endif
        @if($cEmail)
        <li>
          <span class="c-ico"><svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></span>
          <span><small>{{ __('front.label_email') }}</small><a href="mailto:{{ $cEmail }}">{{ $cEmail }}</a></span>
        </li>
        @endif
        @if($cWaDigits)
        <li>
          <span class="c-ico"><svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></span>
          <span><small>{{ __('front.label_whatsapp') }}</small><a href="https://wa.me/{{ $cWaDigits }}" target="_blank" rel="noopener" dir="ltr">{{ $cWa }}</a></span>
        </li>
        @endif
        <li>
          <span class="c-ico"><svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg></span>
          <span><small>{{ __('front.label_location') }}</small>{{ setting('contact_location') }} · {{ setting('contact_location_sub') }}</span>
        </li>
      </ul>

      @if($socialLinks->isNotEmpty())
      <div class="socials socials-light">
        @foreach($socialLinks as $link)
        <a href="{{ $link->url }}" class="soc" title="{{ __('messages.platform.' . $link->platform) }}" aria-label="{{ __('messages.platform.' . $link->platform) }}" target="_blank" rel="noopener">
          @include('front.partials.social-icon', ['platform' => $link->platform])
        </a>
        @endforeach
      </div>
      @endif
    </div>

    <div class="contact-form-wrap">
      <p class="eyebrow">{{ setting('contact_form_label') }}</p>
      <h3 class="form-title">{{ setting('contact_form_title_1') }} <em>{{ setting('contact_form_title_em') }}</em></h3>
      <form class="c-form" id="contact-form" action="{{ route('contact.store') }}" method="POST" novalidate
            data-sending="{{ __('front.form_sending') }}" data-error="{{ __('front.form_error') }}" data-label="{{ setting('contact_form_btn') }}">
        @csrf
        <input type="text" name="website" class="hp" tabindex="-1" autocomplete="off" aria-hidden="true">
        <div class="form-msg @if(session('contact_success')) ok @elseif($errors->any()) err @endif" id="form-msg" role="status">
          @if(session('contact_success')){{ session('contact_success') }}@elseif($errors->any()){{ $errors->first() }}@endif
        </div>
        <div class="frow">
          <label class="ff"><span>{{ __('front.form_name') }}</span><input type="text" name="name" value="{{ old('name') }}" placeholder="{{ __('front.ph_name') }}" required maxlength="150" autocomplete="name"></label>
          <label class="ff"><span>{{ __('front.form_email') }}</span><input type="email" name="email" value="{{ old('email') }}" placeholder="{{ __('front.ph_email') }}" required maxlength="150" dir="ltr" autocomplete="email"></label>
        </div>
        <div class="frow">
          <label class="ff"><span>{{ __('front.form_phone') }}</span><input type="tel" name="phone" value="{{ old('phone') }}" placeholder="{{ __('front.ph_phone') }}" maxlength="50" dir="ltr" autocomplete="tel"></label>
          <label class="ff"><span>{{ __('front.form_business') }}</span><input type="text" name="business_name" value="{{ old('business_name') }}" placeholder="{{ __('front.ph_business') }}" maxlength="150" autocomplete="organization"></label>
        </div>
        <label class="ff">
          <span>{{ __('front.form_service') }}</span>
          <select name="service">
            <option value="">{{ __('front.ph_service') }}</option>
            @foreach($services as $service)
            <option value="{{ $service->getTranslation('title', 'en') }}" @selected(old('service') === $service->getTranslation('title', 'en'))>{{ $service->title }}</option>
            @endforeach
            <option value="Full Package" @selected(old('service') === 'Full Package')>{{ __('front.full_package') }}</option>
          </select>
        </label>
        <label class="ff"><span>{{ __('front.form_message') }}</span><textarea name="message" placeholder="{{ __('front.ph_message') }}" required maxlength="3000" rows="4">{{ old('message') }}</textarea></label>
        <button type="submit" id="sbtn" class="btn btn-primary btn-block">{{ setting('contact_form_btn') }}</button>
      </form>
    </div>
  </div>
</section>

{{-- ═══ FINAL CTA ═══ --}}
<section class="final-cta">
  <div class="container final-cta-inner r">
    <h2>{{ setting('cta_title_1') }} {{ setting('cta_title_2') }} <em>{{ setting('cta_title_em') }}</em></h2>
    <p>{{ setting('cta_text') }}</p>
    <a href="{{ setting('cta_btn_url', '#contact') }}" class="btn btn-light">{{ setting('cta_btn_text') }}</a>
  </div>
</section>
@endsection
