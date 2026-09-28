{{-- One image / video of the work (home gallery + client page). Opens in the lightbox. --}}
@php
    $kind = $media->type === 'image' ? 'image' : ($media->embed_url ? 'embed' : 'video');
    $src = $kind === 'embed' ? $media->embed_url : $media->url;
    $caption = $caption ?? '';
@endphp
<figure class="work-item r" data-kind="{{ $kind === 'image' ? 'photo' : 'video' }}">
  <button type="button" class="work-thumb {{ $kind !== 'image' ? 'is-video' : '' }}" data-lightbox data-type="{{ $kind }}" data-src="{{ $src }}" data-caption="{{ $caption }}" aria-label="{{ $caption ?: __('front.client_work') }}">
    @if ($media->thumb_url)
      <img src="{{ $media->thumb_url }}" alt="{{ $caption }}" loading="lazy" @class(['is-yt' => $kind === 'embed'])>
    @elseif ($kind === 'video')
      <video src="{{ $media->url }}#t=0.5" muted playsinline preload="metadata"></video>
    @else
      <span class="work-placeholder"></span>
    @endif
    @if ($kind !== 'image')
      <span class="play-badge"><svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg></span>
    @else
      <span class="zoom-badge"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><line x1="16.5" y1="16.5" x2="21" y2="21"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg></span>
    @endif
  </button>
  @isset($clientLink)
  <figcaption><a href="{{ $clientLink }}">{{ $caption }}</a></figcaption>
  @endisset
</figure>
