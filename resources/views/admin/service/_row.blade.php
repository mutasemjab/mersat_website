<td>
    @if ($item->image_url)
        <img src="{{ $item->image_url }}" alt="" class="thumb-sm thumb-icon">
    @else
        <span class="pill pill-info">{{ __('messages.icon.' . $item->icon) }}</span>
    @endif
</td>
<td class="fw-semibold">
    {{ $item->getTranslation('title', 'en', false) }}
    <span class="text-muted mx-1">/</span>
    <span dir="rtl">{{ $item->getTranslation('title', 'ar', false) }}</span>
</td>
<td class="text-muted small cell-clip">{{ $item->getTranslation('description', 'en', false) }}</td>
@include('admin.crud._status')
