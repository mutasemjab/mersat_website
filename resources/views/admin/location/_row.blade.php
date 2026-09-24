<td class="fw-semibold">
    {{ $item->getTranslation('city', 'en', false) }}
    <span class="text-muted mx-1">/</span>
    <span dir="rtl">{{ $item->getTranslation('city', 'ar', false) }}</span>
</td>
<td class="small">
    @if (\App\Support\WorldMap::has($item->country_code))
        {{ \App\Support\WorldMap::countryNames()[$item->country_code] }}
    @else
        <span class="text-danger"><i class="bi bi-exclamation-circle"></i> {{ __('messages.choose_country') }}</span>
    @endif
</td>
<td class="text-muted small">{{ $item->getTranslation('description', 'en', false) }}</td>
@include('admin.crud._status')
