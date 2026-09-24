@php
    $otherLocale = app()->getLocale() === 'ar' ? 'en' : 'ar';
    $waDigits = preg_replace('/\D+/', '', (string) setting('contact_whatsapp'));
    // Section links jump within the home page, or back to it from the other pages
    $home = request()->routeIs('home') ? '' : route('home');
@endphp

<!-- LOADER -->
<div id="loader">
  <div class="ld-logo">@include('front.partials.logo')</div>
  <div class="ld-line"><div class="ld-fill" id="lf"></div></div>
  <div class="ld-pct" id="lp">0%</div>
</div>

<div id="cur"></div>
<div id="cur2"></div>

<button id="stt" onclick="window.scrollTo({top:0,behavior:'smooth'})" aria-label="{{ __('front.scroll_top') }}">
  <svg viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg>
</button>

@if ($waDigits)
<a id="wa" href="https://wa.me/{{ $waDigits }}" target="_blank" rel="noopener" title="{{ __('front.label_whatsapp') }}">
  @include('front.partials.social-icon', ['platform' => 'whatsapp'])
</a>
@endif

<!-- NAV -->
<nav id="nav">
  <a href="{{ route('home') }}" class="nav-logo">@include('front.partials.logo')</a>
  <ul class="nav-links">
    <li><a href="{{ $home }}#services">{{ __('front.nav_services') }}</a></li>
    <li><a href="{{ $home }}#portfolio">{{ __('front.nav_portfolio') }}</a></li>
    <li><a href="{{ $home }}#about">{{ __('front.nav_about') }}</a></li>
    <li><a href="{{ $home }}#global">{{ __('front.nav_global') }}</a></li>
    <li><a href="{{ $home }}#contact">{{ __('front.nav_contact') }}</a></li>
  </ul>
  <div class="nav-right">
    <a href="{{ LaravelLocalization::getLocalizedURL($otherLocale, null, [], true) }}" class="nav-lang" hreflang="{{ $otherLocale }}" lang="{{ $otherLocale }}">{{ __('front.switch_language') }}</a>
    <a href="{{ $home }}#contact" class="nav-cta">{{ __('front.nav_cta') }}</a>
  </div>
</nav>
