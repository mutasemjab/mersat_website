@php
    $otherLocale = app()->getLocale() === 'ar' ? 'en' : 'ar';
    $waDigits = preg_replace('/\D+/', '', (string) setting('contact_whatsapp'));
    // Section links jump within the home page, or back to it from the other pages
    $home = request()->routeIs('home') ? '' : route('home');
    $navLinks = [
        'services'  => __('front.nav_services'),
        'portfolio' => __('front.nav_portfolio'),
        'about'     => __('front.nav_about'),
        'global'    => __('front.nav_global'),
        'contact'   => __('front.nav_contact'),
    ];
    $langUrl = LaravelLocalization::getLocalizedURL($otherLocale, null, [], true);
@endphp

<a class="skip-link" href="#main">{{ __('front.skip_to_content') }}</a>

<header class="site-header" id="nav">
  <div class="header-bar">
    <a href="{{ route('home') }}" class="brand" aria-label="{{ setting('site_name') }}">@include('front.partials.logo')</a>

    <nav class="main-nav" aria-label="{{ __('front.menu') }}">
      <ul>
        @foreach ($navLinks as $id => $label)
        <li><a href="{{ $home }}#{{ $id }}" data-spy="{{ $id }}">{{ $label }}</a></li>
        @endforeach
      </ul>
    </nav>

    <div class="header-actions">
      <a href="{{ $langUrl }}" class="lang-switch" hreflang="{{ $otherLocale }}" lang="{{ $otherLocale }}">{{ __('front.switch_language') }}</a>
      <a href="{{ $home }}#contact" class="btn btn-primary btn-sm header-cta">{{ __('front.nav_cta') }}</a>
      <button type="button" class="menu-toggle" aria-controls="mobile-menu" aria-expanded="false" aria-label="{{ __('front.menu') }}">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</header>

{{-- Mobile menu --}}
<div class="mobile-menu" id="mobile-menu" hidden>
  <nav aria-label="{{ __('front.menu') }}">
    <ol>
      @foreach ($navLinks as $id => $label)
      <li style="--i:{{ $loop->index }}"><a href="{{ $home }}#{{ $id }}"><span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>{{ $label }}</a></li>
      @endforeach
    </ol>
  </nav>
  <div class="mobile-menu-foot">
    <a href="{{ $home }}#contact" class="btn btn-light">{{ __('front.nav_cta') }}</a>
    <a href="{{ $langUrl }}" class="lang-switch lang-switch-light" hreflang="{{ $otherLocale }}" lang="{{ $otherLocale }}">{{ __('front.switch_language') }}</a>
  </div>
</div>

<button id="stt" type="button" aria-label="{{ __('front.scroll_top') }}">
  <svg viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg>
</button>

@if ($waDigits)
<a id="wa" href="https://wa.me/{{ $waDigits }}" target="_blank" rel="noopener" title="{{ __('front.label_whatsapp') }}" aria-label="{{ __('front.label_whatsapp') }}">
  @include('front.partials.social-icon', ['platform' => 'whatsapp'])
</a>
@endif
