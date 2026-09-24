@extends('layouts.front')


@section('content')

<!-- HERO -->
<section id="hero">
  @php $heroVideo = setting_media('hero_video'); $heroPoster = setting_media('hero_poster'); @endphp
  @if($heroPoster)<div class="hero-poster" style="background-image:url('{{ $heroPoster }}');"></div>@endif
  <video id="hero-vid" autoplay muted loop playsinline preload="auto" @if($heroPoster) poster="{{ $heroPoster }}" @endif>
    @if($heroVideo)<source src="{{ $heroVideo }}">@endif
  </video>
  <div class="hero-overlay"></div>

  <svg class="hero-rope" viewBox="0 0 90 900" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M45 0 C65 70 25 140 45 210 C65 280 25 350 45 420 C65 490 25 560 45 630 C65 700 25 770 45 840 C65 900 45 900 45 900" stroke="white" stroke-width="3.5" stroke-dasharray="10 6"/>
    <path d="M28 0 C48 70 8 140 28 210 C48 280 8 350 28 420 C48 490 8 560 28 630 C48 700 8 770 28 840" stroke="white" stroke-width="2.5" stroke-dasharray="8 7" opacity=".55"/>
    <circle cx="45" cy="120" r="10" fill="none" stroke="white" stroke-width="3"/>
    <circle cx="28" cy="330" r="10" fill="none" stroke="white" stroke-width="3"/>
    <circle cx="45" cy="540" r="10" fill="none" stroke="white" stroke-width="3"/>
    <circle cx="28" cy="750" r="10" fill="none" stroke="white" stroke-width="3"/>
  </svg>

  <svg class="hero-ship" viewBox="0 0 600 280" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M55 215 L545 215 L518 255 L82 255 Z" fill="white"/>
    <path d="M82 255 L518 255 L498 275 L102 275 Z" fill="white" opacity=".65"/>
    <rect x="105" y="175" width="390" height="42" fill="white" opacity=".82"/>
    <rect x="260" y="120" width="160" height="57" fill="white" opacity=".78"/>
    <rect x="278" y="130" width="30" height="20" fill="white" opacity=".3"/>
    <rect x="320" y="130" width="30" height="20" fill="white" opacity=".3"/>
    <rect x="362" y="130" width="26" height="20" fill="white" opacity=".3"/>
    <line x1="155" y1="18" x2="155" y2="177" stroke="white" stroke-width="5.5"/>
    <line x1="280" y1="8" x2="280" y2="177" stroke="white" stroke-width="5.5"/>
    <path d="M155 20 L248 40 L248 152 L155 175 Z" fill="white" opacity=".18" stroke="white" stroke-width="1.5"/>
    <path d="M280 10 L385 34 L385 138 L280 175 Z" fill="white" opacity=".2" stroke="white" stroke-width="1.5"/>
    <line x1="155" y1="20" x2="105" y2="177" stroke="white" stroke-width="1.5" opacity=".35"/>
    <line x1="155" y1="20" x2="280" y2="8" stroke="white" stroke-width="2.5" opacity=".5"/>
    <line x1="280" y1="8" x2="400" y2="142" stroke="white" stroke-width="1.5" opacity=".35"/>
    <rect x="440" y="140" width="22" height="38" fill="white" opacity=".68"/>
    <line x1="280" y1="8" x2="280" y2="30" stroke="white" stroke-width="2"/>
    <path d="M280 8 L325 18 L280 28 Z" fill="white" opacity=".6"/>
  </svg>

  <div class="hero-body">
    <div class="hero-kicker"><span>{{ setting('hero_kicker') }}</span></div>
    <h1 class="ht">{{ setting('hero_title_1') }}<br><span class="thin">{{ setting('hero_title_thin') }}</span> <em class="glow-word">{{ setting('hero_title_glow') }}</em></h1>
    <p class="hero-sub">{{ setting('hero_subtitle') }}</p>
    <div class="hero-btns">
      <a href="{{ setting('hero_btn1_url', '#portfolio') }}" class="btn-w">{{ setting('hero_btn1_text') }}</a>
      <a href="{{ setting('hero_btn2_url', '#contact') }}" class="btn-b">{{ setting('hero_btn2_text') }}</a>
    </div>
  </div>
  <div class="hero-scroll"><span>{{ setting('hero_scroll') }}</span><div class="scroll-ln"></div></div>
</section>

<!-- TICKER -->
@if($tickerItems->isNotEmpty())
<div class="ticker">
  <div class="ticker-track">
    @for($rep = 0; $rep < 2; $rep++)
      @foreach($tickerItems as $tick)
    <span>{{ $tick->title }}<span class="tdot"></span></span>
      @endforeach
    @endfor
  </div>
</div>
@endif

<!-- SERVICES -->
<section id="services" class="sec">
  <svg class="sec-deco" style="top:50%;right:-120px;transform:translateY(-50%);opacity:.04;width:520px;" viewBox="0 0 500 500" fill="none">
    <circle cx="250" cy="250" r="240" stroke="white" stroke-width="2.5"/>
    <circle cx="250" cy="250" r="200" stroke="white" stroke-width="1" stroke-dasharray="4 6"/>
    <circle cx="250" cy="250" r="160" stroke="white" stroke-width="1.5"/>
    <circle cx="250" cy="250" r="60" stroke="white" stroke-width="2"/>
    <circle cx="250" cy="250" r="18" fill="white"/>
    <polygon points="250,25 260,238 250,262 240,238" fill="white"/>
    <polygon points="250,475 260,262 250,238 240,262" fill="white" opacity=".4"/>
    <line x1="250" y1="8" x2="250" y2="38" stroke="white" stroke-width="4"/>
    <line x1="250" y1="462" x2="250" y2="492" stroke="white" stroke-width="2.5"/>
    <line x1="8" y1="250" x2="38" y2="250" stroke="white" stroke-width="2.5"/>
    <line x1="462" y1="250" x2="492" y2="250" stroke="white" stroke-width="2.5"/>
    <text x="250" y="20" text-anchor="middle" fill="white" font-size="20" font-family="serif" font-weight="bold">N</text>
    <text x="250" y="494" text-anchor="middle" fill="white" font-size="16" font-family="serif">S</text>
    <text x="494" y="256" text-anchor="middle" fill="white" font-size="16" font-family="serif">E</text>
    <text x="10" y="256" text-anchor="middle" fill="white" font-size="16" font-family="serif">W</text>
  </svg>

  <div class="wrap">
    <div class="srv-intro">
      <div class="srv-intro-txt">
        <p class="sl r">{{ setting('services_label') }}</p>
        <h2 class="st r d1">{{ setting('services_title_1') }}<br><em>{{ setting('services_title_2') }}</em></h2>
        <p class="r d2">{{ setting('services_text') }}</p>
      </div>
      <a href="{{ setting('services_btn_url', '#contact') }}" class="btn-b r" style="font-size:11px;padding:11px 24px;white-space:nowrap;">{{ setting('services_btn_text') }}</a>
    </div>

    <!-- Cinematic floating visual element -->
    @php $servicesVideo = setting_media('services_video'); @endphp
    <div class="srv-visual r d1" style="max-width:1260px;margin-bottom:4rem;">
      @if($servicesVideo)
      <video autoplay muted loop playsinline preload="auto">
        <source src="{{ $servicesVideo }}">
      </video>
      @endif
      <div class="srv-visual-beam"></div>
      <div class="srv-visual-text">
        <span>{{ setting('services_visual_1') }}<br><em>{{ setting('services_visual_2') }}</em><br>{{ setting('services_visual_3') }}</span>
      </div>
    </div>
  </div>

  <div class="srv-grid" style="max-width:1260px;margin:0 auto;padding:0 5vw;">
    @foreach($services as $service)
    <div class="srv-card r {{ $loop->index % 5 ? 'd' . ($loop->index % 5) : '' }}">
      <span class="srv-card-n">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
      @if($service->image_url)
      <img class="srv-card-icon" src="{{ $service->image_url }}" alt="">
      @else
      @include('front.partials.service-icon', ['icon' => $service->icon])
      @endif
      <h3>{{ $service->title }}</h3>
      <p>{{ $service->description }}</p>
    </div>
    @endforeach
  </div>
</section>

<!-- PORTFOLIO -->
<section id="portfolio" class="sec" style="padding-bottom:4rem;">
  <svg class="sec-deco" style="bottom:-60px;left:-60px;opacity:.05;width:380px;" viewBox="0 0 350 440" fill="none">
    <circle cx="175" cy="75" r="55" stroke="white" stroke-width="8"/><circle cx="175" cy="75" r="18" stroke="white" stroke-width="7"/>
    <line x1="175" y1="130" x2="175" y2="360" stroke="white" stroke-width="8"/>
    <path d="M60 185 L140 185 L175 130" stroke="white" stroke-width="7" stroke-linecap="round"/>
    <path d="M290 185 L210 185 L175 130" stroke="white" stroke-width="7" stroke-linecap="round"/>
    <path d="M175 360 C115 338 55 298 38 250 M175 360 C235 338 295 298 312 250" stroke="white" stroke-width="7" stroke-linecap="round"/>
    <ellipse cx="175" cy="12" rx="18" ry="10" stroke="white" stroke-width="5"/><ellipse cx="175" cy="36" rx="10" ry="18" stroke="white" stroke-width="5"/>
  </svg>

  <div class="wrap">
    <div class="port-intro">
      <div>
        <p class="sl r">{{ setting('portfolio_label') }}</p>
        <h2 class="st r d1">{{ setting('portfolio_title_1') }}<br><em>{{ setting('portfolio_title_2') }}</em></h2>
      </div>
      <a href="{{ route('portfolio.index') }}" class="btn-b r" style="font-size:11px;padding:11px 24px;">{{ setting('portfolio_btn_text') }}</a>
    </div>
  </div>
  <div class="port-grid" style="max-width:1260px;margin:0 auto;padding:0 5vw;">
    @foreach($portfolioItems as $work)
      @include('front.partials.client-card')
    @endforeach
  </div>
  <div class="port-more r">
    <a href="{{ route('portfolio.index') }}" class="btn-w">{{ __('front.view_more') }}</a>
  </div>
</section>

<!-- ABOUT -->
<section id="about" class="sec">
  <svg class="sec-deco" style="top:20px;right:-50px;opacity:.05;width:360px;" viewBox="0 0 360 210" fill="none">
    <path d="M30 165 L330 165 L310 195 L50 195 Z" fill="white"/>
    <rect x="55" y="132" width="250" height="35" fill="white" opacity=".82"/>
    <rect x="165" y="90" width="120" height="44" fill="white" opacity=".78"/>
    <line x1="100" y1="14" x2="100" y2="134" stroke="white" stroke-width="4"/>
    <line x1="190" y1="7" x2="190" y2="134" stroke="white" stroke-width="4"/>
    <path d="M100 16 L168 32 L168 118 L100 132 Z" fill="white" opacity=".2" stroke="white" stroke-width="1.5"/>
    <path d="M190 9 L262 27 L262 112 L190 132 Z" fill="white" opacity=".22" stroke="white" stroke-width="1.5"/>
    <line x1="100" y1="16" x2="55" y2="134" stroke="white" stroke-width="1.2" opacity=".4"/>
    <line x1="100" y1="16" x2="190" y2="7" stroke="white" stroke-width="2" opacity=".5"/>
    <line x1="190" y1="7" x2="272" y2="113" stroke="white" stroke-width="1.2" opacity=".4"/>
    <rect x="286" y="112" width="16" height="24" fill="white" opacity=".65"/>
  </svg>

  <div class="wrap">
    <div class="about-grid">
      <div class="r">
        @php $aboutVideo = setting_media('about_video'); $aboutPoster = setting_media('about_poster'); @endphp
        {{-- The image is always there underneath; the video (if any) plays on top and hides itself if it can't load --}}
        <div class="about-vid-box">
          @if($aboutPoster)<img class="about-img" src="{{ $aboutPoster }}" alt="{{ setting('about_label') }}">@endif
          @if($aboutVideo)
          <video class="media-fallback" autoplay muted loop playsinline preload="auto" @if($aboutPoster) poster="{{ $aboutPoster }}" @endif>
            <source src="{{ $aboutVideo }}">
          </video>
          @endif
          <div class="about-tag"><div class="big" dir="ltr">{{ setting('about_badge_number') }}</div><div class="sm">{{ setting('about_badge_line1') }}<br>{{ setting('about_badge_line2') }}</div></div>
        </div>
      </div>
      <div>
        <p class="sl r">{{ setting('about_label') }}</p>
        <h2 class="st r d1">{{ setting('about_title_1') }}<br><em>{{ setting('about_title_2') }}</em></h2>
        <p class="r d2" style="font-size:15px;line-height:1.95;color:var(--muted);font-weight:300;margin-top:1.4rem;">{{ setting('about_text_1') }}</p>
        <p class="r d2" style="font-size:15px;line-height:1.95;color:var(--muted);font-weight:300;margin-top:1rem;">{{ setting('about_text_2') }}</p>
        <p class="about-countries r d3">{{ setting('about_countries') }}</p>
        <div class="about-stats">
          @foreach($stats as $stat)
          <div class="astat r d{{ min($loop->iteration, 4) }}"><div class="n" dir="ltr"><span data-t="{{ $stat->value }}">0</span>{{ $stat->suffix }}</div><div class="l">{{ $stat->label }}</div></div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

<!-- GLOBAL -->
<section id="global">
  <svg class="sec-deco" style="top:0;left:50%;transform:translateX(-50%);opacity:.04;width:100%;" viewBox="0 0 1400 50" fill="none">
    <g>
      <ellipse cx="25" cy="25" rx="20" ry="11" stroke="white" stroke-width="4"/><ellipse cx="55" cy="25" rx="11" ry="20" stroke="white" stroke-width="4"/>
      <ellipse cx="85" cy="25" rx="20" ry="11" stroke="white" stroke-width="4"/><ellipse cx="115" cy="25" rx="11" ry="20" stroke="white" stroke-width="4"/>
      <ellipse cx="145" cy="25" rx="20" ry="11" stroke="white" stroke-width="4"/><ellipse cx="175" cy="25" rx="11" ry="20" stroke="white" stroke-width="4"/>
      <ellipse cx="205" cy="25" rx="20" ry="11" stroke="white" stroke-width="4"/><ellipse cx="235" cy="25" rx="11" ry="20" stroke="white" stroke-width="4"/>
      <ellipse cx="265" cy="25" rx="20" ry="11" stroke="white" stroke-width="4"/><ellipse cx="295" cy="25" rx="11" ry="20" stroke="white" stroke-width="4"/>
      <ellipse cx="325" cy="25" rx="20" ry="11" stroke="white" stroke-width="4"/><ellipse cx="355" cy="25" rx="11" ry="20" stroke="white" stroke-width="4"/>
      <ellipse cx="385" cy="25" rx="20" ry="11" stroke="white" stroke-width="4"/><ellipse cx="415" cy="25" rx="11" ry="20" stroke="white" stroke-width="4"/>
      <ellipse cx="445" cy="25" rx="20" ry="11" stroke="white" stroke-width="4"/><ellipse cx="475" cy="25" rx="11" ry="20" stroke="white" stroke-width="4"/>
      <ellipse cx="505" cy="25" rx="20" ry="11" stroke="white" stroke-width="4"/><ellipse cx="535" cy="25" rx="11" ry="20" stroke="white" stroke-width="4"/>
      <ellipse cx="565" cy="25" rx="20" ry="11" stroke="white" stroke-width="4"/><ellipse cx="595" cy="25" rx="11" ry="20" stroke="white" stroke-width="4"/>
      <ellipse cx="625" cy="25" rx="20" ry="11" stroke="white" stroke-width="4"/><ellipse cx="655" cy="25" rx="11" ry="20" stroke="white" stroke-width="4"/>
      <ellipse cx="685" cy="25" rx="20" ry="11" stroke="white" stroke-width="4"/><ellipse cx="715" cy="25" rx="11" ry="20" stroke="white" stroke-width="4"/>
      <ellipse cx="745" cy="25" rx="20" ry="11" stroke="white" stroke-width="4"/><ellipse cx="775" cy="25" rx="11" ry="20" stroke="white" stroke-width="4"/>
      <ellipse cx="805" cy="25" rx="20" ry="11" stroke="white" stroke-width="4"/><ellipse cx="835" cy="25" rx="11" ry="20" stroke="white" stroke-width="4"/>
      <ellipse cx="865" cy="25" rx="20" ry="11" stroke="white" stroke-width="4"/><ellipse cx="895" cy="25" rx="11" ry="20" stroke="white" stroke-width="4"/>
      <ellipse cx="925" cy="25" rx="20" ry="11" stroke="white" stroke-width="4"/><ellipse cx="955" cy="25" rx="11" ry="20" stroke="white" stroke-width="4"/>
      <ellipse cx="985" cy="25" rx="20" ry="11" stroke="white" stroke-width="4"/><ellipse cx="1015" cy="25" rx="11" ry="20" stroke="white" stroke-width="4"/>
      <ellipse cx="1045" cy="25" rx="20" ry="11" stroke="white" stroke-width="4"/><ellipse cx="1075" cy="25" rx="11" ry="20" stroke="white" stroke-width="4"/>
      <ellipse cx="1105" cy="25" rx="20" ry="11" stroke="white" stroke-width="4"/><ellipse cx="1135" cy="25" rx="11" ry="20" stroke="white" stroke-width="4"/>
      <ellipse cx="1165" cy="25" rx="20" ry="11" stroke="white" stroke-width="4"/><ellipse cx="1195" cy="25" rx="11" ry="20" stroke="white" stroke-width="4"/>
      <ellipse cx="1225" cy="25" rx="20" ry="11" stroke="white" stroke-width="4"/><ellipse cx="1255" cy="25" rx="11" ry="20" stroke="white" stroke-width="4"/>
      <ellipse cx="1285" cy="25" rx="20" ry="11" stroke="white" stroke-width="4"/><ellipse cx="1315" cy="25" rx="11" ry="20" stroke="white" stroke-width="4"/>
      <ellipse cx="1345" cy="25" rx="20" ry="11" stroke="white" stroke-width="4"/><ellipse cx="1375" cy="25" rx="11" ry="20" stroke="white" stroke-width="4"/>
    </g>
  </svg>

  <div class="global-inner">
    <div class="global-txt">
      <p class="sl r">{{ setting('global_label') }}</p>
      <h2 class="st r d1">{{ setting('global_title_1') }}<br><em>{{ setting('global_title_2') }}</em></h2>
      <p class="r d2">{{ setting('global_text') }}</p>
      <div class="global-locations r d3">
        @foreach($locations as $loc)
        <div class="g-loc" data-cc="{{ $loc->country_code }}"><div class="g-loc-dot"></div><div><div class="g-loc-city">{{ $loc->city }}</div><div class="g-loc-country">{{ $loc->description }}</div></div></div>
        @endforeach
      </div>
    </div>

    <!-- World map: our countries light up -->
    <div class="world-map-wrap r d2">
      @include('front.partials.world-map')
    </div>
  </div>
</section>

<!-- CONTACT -->
<section id="contact">
  <svg class="sec-deco" style="bottom:-60px;right:-60px;opacity:.04;width:380px;z-index:3;" viewBox="0 0 360 360" fill="none">
    <circle cx="180" cy="180" r="170" stroke="white" stroke-width="2"/><circle cx="180" cy="180" r="130" stroke="white" stroke-width="1" stroke-dasharray="3 5"/><circle cx="180" cy="180" r="70" stroke="white" stroke-width="1.5"/>
    <circle cx="180" cy="180" r="15" fill="white"/>
    <polygon points="180,20 188,170 180,192 172,170" fill="white"/>
    <polygon points="180,340 188,192 180,170 172,192" fill="white" opacity=".4"/>
    <text x="180" y="14" text-anchor="middle" fill="white" font-size="14" font-family="serif" font-weight="bold">N</text>
  </svg>

  @php
    $cPhone = setting('contact_phone');
    $cEmail = setting('contact_email');
    $cWa    = setting('contact_whatsapp');
    $cWaDigits = preg_replace('/\D+/', '', (string) $cWa);
    $contactVideo = setting_media('contact_video');
  @endphp
  <div class="contact-wrap">
    <div class="contact-left">
      @if($contactVideo)
      <video autoplay muted loop playsinline preload="auto">
        <source src="{{ $contactVideo }}">
      </video>
      @endif
      <div class="contact-glow"></div>
      <div class="contact-left-inner">
        <p class="sl r">{{ setting('contact_label') }}</p>
        <h2 class="st r d1" style="font-size:clamp(2rem,4vw,3.2rem);">{{ setting('contact_title_1') }}<br>{{ setting('contact_title_2') }}<br><em>{{ setting('contact_title_em') }}</em></h2>
        <p class="desc r d2">{{ setting('contact_desc') }}</p>
        <div class="c-details r d2">
          @if($cPhone)
          <div class="cdi">
            <div class="cdi-icon"><svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8 19.79 19.79 0 01.01 1.18 2 2 0 012 .01h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 14.92z"/></svg></div>
            <div><div class="cdi-l">{{ __('front.label_phone') }}</div><div class="cdi-v"><a href="tel:{{ preg_replace('/[^\d+]/', '', $cPhone) }}" dir="ltr">{{ $cPhone }}</a></div></div>
          </div>
          @endif
          @if($cEmail)
          <div class="cdi">
            <div class="cdi-icon"><svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div>
            <div><div class="cdi-l">{{ __('front.label_email') }}</div><div class="cdi-v"><a href="mailto:{{ $cEmail }}">{{ $cEmail }}</a></div></div>
          </div>
          @endif
          <div class="cdi">
            <div class="cdi-icon"><svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
            <div><div class="cdi-l">{{ __('front.label_location') }}</div><div class="cdi-v">{{ setting('contact_location') }}<small>{{ setting('contact_location_sub') }}</small></div></div>
          </div>
          @if($cWaDigits)
          <div class="cdi">
            <div class="cdi-icon"><svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div>
            <div><div class="cdi-l">{{ __('front.label_whatsapp') }}</div><div class="cdi-v"><a href="https://wa.me/{{ $cWaDigits }}" target="_blank" rel="noopener" dir="ltr">{{ $cWa }}</a></div></div>
          </div>
          @endif
        </div>
        <div class="c-socials r d3">
          @foreach($socialLinks as $link)
          <a href="{{ $link->url }}" class="csoc" title="{{ __('messages.platform.' . $link->platform) }}" target="_blank" rel="noopener">
            @include('front.partials.social-icon', ['platform' => $link->platform])
          </a>
          @endforeach
        </div>
      </div>
    </div>
    <div class="contact-right">
      <p class="sl r">{{ setting('contact_form_label') }}</p>
      <h2 class="st r d1" style="font-size:clamp(2rem,3.5vw,2.8rem);">{{ setting('contact_form_title_1') }} <em>{{ setting('contact_form_title_em') }}</em></h2>
      <form class="c-form r d2" id="contact-form" action="{{ route('contact.store') }}" method="POST" novalidate
            data-sending="{{ __('front.form_sending') }}" data-error="{{ __('front.form_error') }}" data-label="{{ setting('contact_form_btn') }}">
        @csrf
        <input type="text" name="website" class="hp" tabindex="-1" autocomplete="off" aria-hidden="true">
        <div class="form-msg @if(session('contact_success')) ok @elseif($errors->any()) err @endif" id="form-msg" role="status">
          @if(session('contact_success')){{ session('contact_success') }}@elseif($errors->any()){{ $errors->first() }}@endif
        </div>
        <div class="frow">
          <div class="ff"><label>{{ __('front.form_name') }}</label><input type="text" name="name" value="{{ old('name') }}" placeholder="{{ __('front.ph_name') }}" required maxlength="150"></div>
          <div class="ff"><label>{{ __('front.form_email') }}</label><input type="email" name="email" value="{{ old('email') }}" placeholder="{{ __('front.ph_email') }}" required maxlength="150" dir="ltr"></div>
        </div>
        <div class="frow">
          <div class="ff"><label>{{ __('front.form_phone') }}</label><input type="tel" name="phone" value="{{ old('phone') }}" placeholder="{{ __('front.ph_phone') }}" maxlength="50" dir="ltr"></div>
          <div class="ff"><label>{{ __('front.form_business') }}</label><input type="text" name="business_name" value="{{ old('business_name') }}" placeholder="{{ __('front.ph_business') }}" maxlength="150"></div>
        </div>
        <div class="ff">
          <label>{{ __('front.form_service') }}</label>
          <select name="service">
            <option value="">{{ __('front.ph_service') }}</option>
            @foreach($services as $service)
            <option value="{{ $service->getTranslation('title', 'en') }}" @selected(old('service') === $service->getTranslation('title', 'en'))>{{ $service->title }}</option>
            @endforeach
            <option value="Full Package" @selected(old('service') === 'Full Package')>{{ __('front.full_package') }}</option>
          </select>
        </div>
        <div class="ff"><label>{{ __('front.form_message') }}</label><textarea name="message" placeholder="{{ __('front.ph_message') }}" required maxlength="3000">{{ old('message') }}</textarea></div>
        <button type="submit" id="sbtn" class="btn-submit">{{ setting('contact_form_btn') }}</button>
      </form>
    </div>
  </div>
</section>

<!-- FINAL CTA -->
<section id="final-cta">
  <div class="final-cta-inner r">
    <h2>{{ setting('cta_title_1') }}<br>{{ setting('cta_title_2') }} <em>{{ setting('cta_title_em') }}</em></h2>
    <p>{{ setting('cta_text') }}</p>
    <a href="{{ setting('cta_btn_url', '#contact') }}">{{ setting('cta_btn_text') }}</a>
  </div>
</section>
@endsection
