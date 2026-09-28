{{-- Client card (home page + all clients page). Opens the client's page. --}}
<a href="{{ route('portfolio.show', $work->id) }}" class="client-card r" style="--d:{{ ($loop->index % 4) * 80 }}ms">
  <div class="cc-media">
    <img src="{{ $work->image_url }}" alt="{{ $work->title }}" loading="lazy">
    @if($work->video_url)
    <video muted loop playsinline preload="none" data-hover-video><source src="{{ $work->video_url }}"></video>
    @endif
  </div>
  <div class="cc-body">
    <span class="cc-tag">{{ $work->tag }}</span>
    <h3 class="cc-title">{{ $work->title }}</h3>
  </div>
  <span class="cc-arrow" aria-hidden="true"><svg viewBox="0 0 24 24"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="8 7 17 7 17 16"/></svg></span>
</a>
