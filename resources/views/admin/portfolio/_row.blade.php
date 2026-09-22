<td>
    @if ($item->image_url)
        <img src="{{ $item->image_url }}" alt="" class="thumb-sm">
    @endif
    @if ($item->video)
        <i class="bi bi-camera-video text-muted ms-1" title="{{ __('messages.field.video') }}"></i>
    @endif
</td>
<td class="fw-semibold">
    {{ $item->getTranslation('title', 'en', false) }}
    <div class="text-muted small" dir="rtl">{{ $item->getTranslation('title', 'ar', false) }}</div>
</td>
<td class="text-muted small">{{ $item->getTranslation('tag', 'en', false) }}</td>
@include('admin.crud._status')
