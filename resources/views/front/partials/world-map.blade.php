{{--
    World map of the "Worldwide presence" section.
    Countries of the active locations (admin → Locations → country) light up; every other country stays dimmed.
    Arcs connect the first location (headquarters) to the others.
--}}
@php
    $map = \App\Support\WorldMap::data();
    $pins = $locations->filter(fn ($l) => \App\Support\WorldMap::has($l->country_code))->unique('country_code')->values();
    $lit = $pins->pluck('country_code')->flip();
    $hq = $pins->first();
@endphp
<svg class="world-map-svg" viewBox="0 0 {{ $map['width'] }} {{ $map['height'] }}" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="{{ $pins->map(fn ($l) => $l->city)->join(', ') }}">
  <defs>
    <filter id="wm-glow" x="-50%" y="-50%" width="200%" height="200%"><feGaussianBlur stdDeviation="4" result="b"/><feMerge><feMergeNode in="b"/><feMergeNode in="SourceGraphic"/></feMerge></filter>
  </defs>

  <g class="wm-land">
    @foreach ($map['countries'] as $code => $country)
      @if ($country['d'] && !isset($lit[$code]))<path d="{{ $country['d'] }}"/>@endif
    @endforeach
  </g>

  <g class="wm-lit" filter="url(#wm-glow)">
    @foreach ($pins as $loc)
      @php $country = $map['countries'][$loc->country_code]; @endphp
      @if ($country['d'])<path d="{{ $country['d'] }}" data-cc="{{ $loc->country_code }}"><title>{{ $loc->city }}</title></path>@endif
    @endforeach
  </g>

  @if ($hq)
  @php $from = $map['countries'][$hq->country_code]; @endphp
  <g class="wm-arcs">
    @foreach ($pins->slice(1) as $loc)
      @php
        $to = $map['countries'][$loc->country_code];
        $dist = hypot($to['x'] - $from['x'], $to['y'] - $from['y']);
        $cx = ($from['x'] + $to['x']) / 2;
        $cy = min($from['y'], $to['y']) - max(12, $dist * .28);
      @endphp
      <path d="M{{ $from['x'] }} {{ $from['y'] }} Q{{ round($cx, 1) }} {{ round($cy, 1) }} {{ $to['x'] }} {{ $to['y'] }}" style="animation-delay:-{{ $loop->index * .7 }}s"/>
    @endforeach
  </g>
  @endif

  <g class="wm-pins">
    @foreach ($pins as $loc)
      @php $country = $map['countries'][$loc->country_code]; @endphp
      <g class="wm-pin {{ $loop->first ? 'hq' : '' }}" data-cc="{{ $loc->country_code }}" transform="translate({{ $country['x'] }} {{ $country['y'] }})">
        <title>{{ $loc->city }}</title>
        <circle class="wm-pulse" r="{{ $loop->first ? 6 : 4 }}" style="animation-delay:{{ $loop->index * .4 }}s"/>
        <circle class="wm-dot" r="{{ $loop->first ? 4 : 3 }}"/>
      </g>
    @endforeach
  </g>
</svg>
