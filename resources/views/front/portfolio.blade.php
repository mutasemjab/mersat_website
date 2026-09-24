@extends('layouts.front')
@section('title', __('front.all_clients') . ' — ' . setting('site_name'))

@section('content')

<header class="page-head">
  <div class="wrap">
    <p class="sl r">{{ setting('portfolio_label') }}</p>
    <h1 class="st r d1">{{ __('front.all_clients') }}</h1>
    <p class="page-head-sub r d2">{{ __('front.all_clients_sub') }}</p>
  </div>
</header>

<section class="sec page-sec">
  @if($portfolioItems->isEmpty())
    <p class="empty-note">{{ __('front.no_clients') }}</p>
  @else
  <div class="port-grid" style="max-width:1260px;margin:0 auto;">
    @foreach($portfolioItems as $work)
      @include('front.partials.client-card')
    @endforeach
  </div>
  @endif
</section>

@endsection
