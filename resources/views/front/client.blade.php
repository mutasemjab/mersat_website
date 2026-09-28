@extends('layouts.front')
@section('title', $client->title . ' — ' . setting('site_name'))
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($client->description ?: $client->title), 160))

@section('content')

@php
    $photos = $client->media->where('type', 'image')->count();
    $videos = $client->media->count() - $photos;
@endphp

<header class="client-hero">
  <img class="client-hero-bg" src="{{ $client->image_url }}" alt="">
  <div class="client-hero-shade"></div>
  <div class="container client-hero-body">
    <nav class="crumbs" aria-label="breadcrumb"><a href="{{ route('home') }}">{{ setting('site_name') }}</a><span>/</span><a href="{{ route('portfolio.index') }}">{{ __('front.all_clients') }}</a></nav>
    <span class="cc-tag">{{ $client->tag }}</span>
    <h1 class="page-title">{{ $client->title }}</h1>
  </div>
</header>

<section class="section client-section">
  <div class="container">
    <div class="client-intro">
      <div class="client-desc r">
        @if($client->description)
          {!! nl2br(e($client->description)) !!}
        @else
          <p class="muted">{{ $client->tag }}</p>
        @endif
      </div>
      <aside class="client-facts r">
        <dl>
          <div><dt>{{ __('front.fact_field') }}</dt><dd>{{ $client->tag }}</dd></div>
          @if($photos)<div><dt>{{ __('front.filter_photos') }}</dt><dd>{{ $photos }}</dd></div>@endif
          @if($videos)<div><dt>{{ __('front.filter_videos') }}</dt><dd>{{ $videos }}</dd></div>@endif
        </dl>
        @if($client->url)
        <a href="{{ $client->url }}" class="btn btn-primary btn-block" target="_blank" rel="noopener">
          {{ __('front.visit_website') }}
          <svg viewBox="0 0 24 24"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="8 7 17 7 17 16"/></svg>
        </a>
        @endif
      </aside>
    </div>

    <div class="sec-head sec-head-split client-work-head">
      <h2 class="sec-title sec-title-sm">{{ __('front.client_work') }}</h2>
      @if($photos && $videos)
      <div class="filter-tabs" role="tablist">
        <button type="button" class="is-active" data-filter="all">{{ __('front.filter_all') }}</button>
        <button type="button" data-filter="photo">{{ __('front.filter_photos') }}</button>
        <button type="button" data-filter="video">{{ __('front.filter_videos') }}</button>
      </div>
      @endif
    </div>

    @if($client->media->isEmpty())
      <p class="empty-note">{{ __('front.no_work_yet') }}</p>
    @else
    <div class="work-grid">
      @foreach($client->media as $media)
        @include('front.partials.work-item', ['caption' => $client->title])
      @endforeach
    </div>
    @endif

    <nav class="client-nav">
      @if($prev)
      <a href="{{ route('portfolio.show', $prev->id) }}" class="cn-prev"><small>{{ __('front.prev_client') }}</small>{{ $prev->title }}</a>
      @else <span></span> @endif
      <a href="{{ route('portfolio.index') }}" class="cn-all" aria-label="{{ __('front.back_to_clients') }}">
        <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
      </a>
      @if($next)
      <a href="{{ route('portfolio.show', $next->id) }}" class="cn-next"><small>{{ __('front.next_client') }}</small>{{ $next->title }}</a>
      @else <span></span> @endif
    </nav>
  </div>
</section>

<section class="final-cta">
  <div class="container final-cta-inner r">
    <h2>{{ __('front.start_similar') }}</h2>
    <a href="{{ route('home') }}#contact" class="btn btn-light">{{ __('front.nav_cta') }}</a>
  </div>
</section>

@endsection
