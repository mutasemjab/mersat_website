<td class="fw-semibold">
    {{ $item->getTranslation('title', 'en', false) }}
    <span class="text-muted mx-1">/</span>
    <span dir="rtl">{{ $item->getTranslation('title', 'ar', false) }}</span>
</td>
@include('admin.crud._status')
