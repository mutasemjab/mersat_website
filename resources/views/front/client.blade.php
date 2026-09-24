@extends('layouts.front')
@section('title', $client->title . ' — ' . setting('site_name'))
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($client->description ?: $client->title), 160))

@section('content')

<header class="client-hero">
  <div class="client-hero-bg" style="background-image:url('{{ $client->image_url }}');"></div>
  <div class="client-hero-shade"></div>
  <div class="wrap client-hero-body">
    <a href="{{ route('portfolio.index') }}" class="client-back"><svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>{{ __('front.back_to_clients') }}</a>
    <div class="pg-tag">{{ $client->tag }}</div>
    <h1>{{ $client->title }}</h1>
  </div>
</header>

<section class="sec page-sec">
  <div class="wrap">
    @if($client->description || $client->url)
    <div class="client-about r">
      @if($client->description)
      <div class="client-desc">{!! nl2br(e($client->description)) !!}</div>
      @endif
      @if($client->url)
      <a href="{{ $client->url }}" class="btn-w client-site" target="_blank" rel="noopener">
        {{ __('front.visit_website') }}
        <svg viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
      </a>
      @endif
    </div>
    @endif

    <p class="sl r" style="margin-top:4rem;">{{ __('front.client_work') }}</p>
    @if($client->media->isEmpty())
      <p class="empty-note" style="text-align:start;padding:1rem 0;">{{ __('front.no_work_yet') }}</p>
    @else
    {{-- Images first (a tidy grid), then the full-width videos --}}
    <div class="client-gallery">
      @foreach($client->media->sortBy(fn ($m) => $m->type === 'image' ? 0 : 1) as $media)
        @if($media->type === 'image')
        <button type="button" class="cg-item cg-img r" data-full="{{ $media->url }}" aria-label="{{ $client->title }}">
          <img src="{{ $media->url }}" alt="{{ $client->title }}" loading="lazy">
        </button>
        @elseif($media->embed_url)
        <div class="cg-item cg-wide cg-embed r">
          <iframe src="{{ $media->embed_url }}" title="{{ $client->title }}" loading="lazy" allow="autoplay; encrypted-media; picture-in-picture; fullscreen" allowfullscreen></iframe>
        </div>
        @else
        <div class="cg-item cg-wide r">
          <video src="{{ $media->url }}" controls playsinline preload="metadata"></video>
        </div>
        @endif
      @endforeach
    </div>
    @endif

    <nav class="client-nav">
      @if($prev)
      <a href="{{ route('portfolio.show', $prev->id) }}" class="client-nav-prev"><small>{{ __('front.prev_client') }}</small>{{ $prev->title }}</a>
      @else <span></span> @endif
      @if($next)
      <a href="{{ route('portfolio.show', $next->id) }}" class="client-nav-next"><small>{{ __('front.next_client') }}</small>{{ $next->title }}</a>
      @endif
    </nav>
  </div>
</section>

<section id="final-cta">
  <div class="final-cta-inner r">
    <h2>{{ __('front.start_similar') }}</h2>
    <a href="{{ route('home') }}#contact">{{ __('front.nav_cta') }}</a>
  </div>
</section>

{{-- Image viewer --}}
<div class="lightbox" id="lightbox" hidden>
  <button type="button" class="lb-close" aria-label="{{ __('front.close') }}">&times;</button>
  <button type="button" class="lb-prev" aria-label="{{ __('front.prev_client') }}"><svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg></button>
  <img alt="">
  <button type="button" class="lb-next" aria-label="{{ __('front.next_client') }}"><svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg></button>
</div>

@endsection
