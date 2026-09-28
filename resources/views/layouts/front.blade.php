<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="theme-color" content="#18176B">
<title>@yield('title', setting('page_title', __('front.page_title')))</title>
<meta name="description" content="@yield('meta_description', setting('meta_description', __('front.meta_description')))">
@foreach (LaravelLocalization::getSupportedLocales() as $code => $props)
<link rel="alternate" hreflang="{{ $code }}" href="{{ LaravelLocalization::getLocalizedURL($code, null, [], true) }}">
@endforeach
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&family=Manrope:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@1,600;1,700&display=swap" rel="stylesheet">
<link href="{{ asset('assets_front/css/style.css') }}?v={{ filemtime(base_path('assets_front/css/style.css')) }}" rel="stylesheet">
<script>document.documentElement.classList.add('js');</script>
@stack('styles')
</head>
<body class="{{ app()->getLocale() === 'en' ? 'lang-en' : 'lang-ar' }} @yield('body_class')">

@include('front.includes.navbar')

<main id="main">
@yield('content')
</main>

@include('front.includes.footer')

@include('front.partials.lightbox')

<script src="{{ asset('assets_front/js/app.js') }}?v={{ filemtime(base_path('assets_front/js/app.js')) }}"></script>
@stack('scripts')

</body>
</html>
