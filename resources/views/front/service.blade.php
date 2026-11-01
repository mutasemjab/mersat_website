@extends('layouts.front')
@section('title', $service->title . ' — ' . setting('site_name'))
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($service->description), 160))

@section('content')

{{-- ── Service Hero ── --}}
<header class="service-hero">
  @if($service->image_url)
  <img class="service-hero-bg" src="{{ $service->image_url }}" alt="{{ $service->title }}" loading="eager" fetchpriority="high">
  @endif
  <div class="service-hero-shade"></div>
  <div class="container service-hero-body">
    <nav class="crumbs" aria-label="breadcrumb">
      <a href="{{ route('home') }}">{{ setting('site_name') }}</a>
      <span>/</span>
      <a href="{{ route('home') }}#services">{{ __('front.services_label') }}</a>
    </nav>
    <h1 class="page-title">{{ $service->title }}</h1>
    @if($service->description)
    <p class="service-hero-sub r">{{ $service->description }}</p>
    @endif
  </div>
</header>

{{-- ── Content ── --}}
@if($service->content)
<section class="section service-content-section">
  <div class="container">
    <div class="service-content r">
      {!! $service->content !!}
    </div>
  </div>
</section>
@endif

{{-- ── CTA ── --}}
<section class="final-cta">
  <div class="container final-cta-inner r">
    <h2>{{ setting('cta_title_1') }} {{ setting('cta_title_2') }} <em>{{ setting('cta_title_em') }}</em></h2>
    <p>{{ setting('cta_text') }}</p>
    <a href="{{ route('home') }}#contact" class="btn btn-light">{{ setting('cta_btn_text') }}</a>
  </div>
</section>

@endsection
