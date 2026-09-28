@extends('layouts.front')
@section('title', __('front.all_clients') . ' — ' . setting('site_name'))

@section('content')

<header class="page-hero">
  <div class="container">
    <nav class="crumbs" aria-label="breadcrumb"><a href="{{ route('home') }}">{{ setting('site_name') }}</a><span>/</span>{{ __('front.all_clients') }}</nav>
    <p class="eyebrow eyebrow-light">{{ setting('portfolio_label') }}</p>
    <h1 class="page-title">{{ __('front.all_clients') }}</h1>
    <p class="page-sub">{{ __('front.all_clients_sub') }}</p>
    <span class="page-count">{{ trans_choice('front.clients_count', $portfolioItems->count(), ['n' => $portfolioItems->count()]) }}</span>
  </div>
</header>

<section class="section">
  <div class="container">
    @if($portfolioItems->isEmpty())
      <p class="empty-note">{{ __('front.no_clients') }}</p>
    @else
    <div class="clients-grid clients-grid-all">
      @foreach($portfolioItems as $work)
        @include('front.partials.client-card')
      @endforeach
    </div>
    @endif
  </div>
</section>

<section class="final-cta">
  <div class="container final-cta-inner r">
    <h2>{{ __('front.start_similar') }}</h2>
    <a href="{{ route('home') }}#contact" class="btn btn-light">{{ __('front.nav_cta') }}</a>
  </div>
</section>

@endsection
