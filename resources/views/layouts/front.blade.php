<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', setting('page_title', __('front.page_title')))</title>
<meta name="description" content="@yield('meta_description', setting('meta_description', __('front.meta_description')))">
@foreach (LaravelLocalization::getSupportedLocales() as $code => $props)
<link rel="alternate" hreflang="{{ $code }}" href="{{ LaravelLocalization::getLocalizedURL($code, null, [], true) }}">
@endforeach
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<link href="{{ asset('assets_front/css/style.css') }}" rel="stylesheet">
@stack('styles')
</head>
<body class="{{ app()->getLocale() === 'en' ? 'lang-en' : 'lang-ar' }}">

<!-- ======= NAV ======= -->
@include('front.includes.navbar')

<!-- ======= CONTENT ======= -->
@yield('content')

<!-- ======= FOOTER ======= -->
@include('front.includes.footer')

<script src="{{ asset('assets_front/js/app.js') }}"></script>
@stack('scripts')

</body>
</html>
