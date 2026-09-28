<td>
    <img src="{{ $item->image_url }}" alt="" class="thumb-sm">
    @if ($item->video)
        <i class="bi bi-camera-video text-muted ms-1" title="{{ __('messages.field.video') }}"></i>
    @endif
</td>
<td class="fw-semibold">
    {{ $item->getTranslation('title', 'en', false) }} <span class="text-primary">{{ $item->getTranslation('highlight', 'en', false) }}</span>
    <div class="text-muted small" dir="rtl">{{ $item->getTranslation('title', 'ar', false) }} {{ $item->getTranslation('highlight', 'ar', false) }}</div>
</td>
@include('admin.crud._status')
