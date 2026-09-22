@php
    $fPhone = setting('contact_phone');
    $fEmail = setting('contact_email');
@endphp
<footer>
  <div class="footer-main">
    <!-- LEFT -->
    <div class="f-brand">
      @include('front.partials.logo', ['style' => 'height:46px;filter:brightness(0) invert(1);margin-bottom:1.2rem;display:block;'])
      <h4>{{ setting('footer_title') }}</h4>
      <small>{{ setting('footer_subtitle') }}</small>
    </div>

    <!-- CENTER -->
    <div class="f-center">
      <div class="f-socials">
        @foreach ($socialLinks as $link)
        <a href="{{ $link->url }}" class="fsoc" title="{{ __('messages.platform.' . $link->platform) }}" target="_blank" rel="noopener">
          @include('front.partials.social-icon', ['platform' => $link->platform])
        </a>
        @endforeach
      </div>
    </div>

    <!-- RIGHT -->
    <div class="f-contact">
      @if ($fPhone)
      <div class="f-ci">
        <div class="f-ci-icon"><svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8 19.79 19.79 0 01.01 1.18 2 2 0 012 .01h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 14.92z"/></svg></div>
        <div class="f-ci-v"><a href="tel:{{ preg_replace('/[^\d+]/', '', $fPhone) }}" dir="ltr">{{ $fPhone }}</a></div>
      </div>
      @endif
      @if ($fEmail)
      <div class="f-ci">
        <div class="f-ci-icon"><svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div>
        <div class="f-ci-v"><a href="mailto:{{ $fEmail }}">{{ $fEmail }}</a></div>
      </div>
      @endif
      <div class="f-ci">
        <div class="f-ci-icon"><svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
        <div class="f-ci-v">{{ setting('contact_location') }}<small>{{ setting('contact_location_sub') }}</small></div>
      </div>
    </div>
  </div>

  <div class="footer-bot">
    <p>© {{ date('Y') }} {{ setting('footer_copyright') }}</p>
    <a href="#hero" class="footer-bot-arrow" onclick="window.scrollTo({top:0,behavior:'smooth'});return false;" aria-label="{{ __('front.scroll_top') }}">
      <svg viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg>
    </a>
  </div>
</footer>
