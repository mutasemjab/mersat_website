@php
    $fPhone = setting('contact_phone');
    $fEmail = setting('contact_email');
    $fHome = request()->routeIs('home') ? '' : route('home');
@endphp
<footer class="site-footer">
  <div class="container footer-main">
    <div class="f-brand">
      <a href="{{ route('home') }}" class="f-logo">@include('front.partials.logo')</a>
      <p class="f-tagline">{{ setting('footer_title') }} <span>{{ setting('footer_subtitle') }}</span></p>
      @if ($socialLinks->isNotEmpty())
      <div class="socials">
        @foreach ($socialLinks as $link)
        <a href="{{ $link->url }}" class="soc" title="{{ __('messages.platform.' . $link->platform) }}" aria-label="{{ __('messages.platform.' . $link->platform) }}" target="_blank" rel="noopener">
          @include('front.partials.social-icon', ['platform' => $link->platform])
        </a>
        @endforeach
      </div>
      @endif
    </div>

    <div class="f-col">
      <h3>{{ __('front.quick_links') }}</h3>
      <ul>
        <li><a href="{{ $fHome }}#services">{{ __('front.nav_services') }}</a></li>
        <li><a href="{{ route('portfolio.index') }}">{{ __('front.all_clients') }}</a></li>
        <li><a href="{{ $fHome }}#about">{{ __('front.nav_about') }}</a></li>
        <li><a href="{{ $fHome }}#global">{{ __('front.nav_global') }}</a></li>
        <li><a href="{{ $fHome }}#contact">{{ __('front.nav_contact') }}</a></li>
      </ul>
    </div>

    <div class="f-col">
      <h3>{{ __('front.nav_contact') }}</h3>
      <ul class="f-contact">
        @if ($fPhone)
        <li><svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8 19.79 19.79 0 01.01 1.18 2 2 0 012 .01h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 14.92z"/></svg><a href="tel:{{ preg_replace('/[^\d+]/', '', $fPhone) }}" dir="ltr">{{ $fPhone }}</a></li>
        @endif
        @if ($fEmail)
        <li><svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg><a href="mailto:{{ $fEmail }}">{{ $fEmail }}</a></li>
        @endif
        <li><svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg><span>{{ setting('contact_location') }}<small>{{ setting('contact_location_sub') }}</small></span></li>
      </ul>
    </div>
  </div>

  <div class="container footer-bot">
    <p>© {{ date('Y') }} {{ setting('footer_copyright') }}</p>
    <button type="button" class="to-top" data-top aria-label="{{ __('front.scroll_top') }}">
      <svg viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg>
    </button>
  </div>
</footer>
