{{-- Site logo (uploaded in the admin) or, until one is uploaded, the site name as text --}}
@php $logo = setting_media('site_logo'); @endphp
@if ($logo)
    <img src="{{ $logo }}" alt="{{ setting('site_name') }}" @isset($style) style="{{ $style }}" @endisset>
@else
    <span class="logo-text" @isset($style) style="{{ $style }}" @endisset>{{ setting('site_name') }}</span>
@endif
