{{-- Client card (home page + portfolio page). Opens the client's page. --}}
<a href="{{ route('portfolio.show', $work->id) }}" class="pg-item r {{ $loop->index % 5 ? 'd' . ($loop->index % 5) : '' }}" aria-label="{{ $work->title }}">
  <div class="pg-bg" style="background-image:url('{{ $work->image_url }}');"></div>
  @if($work->video_url)
  <video class="pg-vid" muted loop playsinline preload="none"><source src="{{ $work->video_url }}"></video>
  @endif
  <div class="pg-cover"></div>
  <div class="pg-info"><div class="pg-tag">{{ $work->tag }}</div><div class="pg-title">{{ $work->title }}</div></div>
  <div class="pg-arrow"><svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></div>
</a>
