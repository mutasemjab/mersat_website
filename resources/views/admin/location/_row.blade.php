<td class="fw-semibold">
    {{ $item->getTranslation('city', 'en', false) }}
    <span class="text-muted mx-1">/</span>
    <span dir="rtl">{{ $item->getTranslation('city', 'ar', false) }}</span>
</td>
<td class="text-muted small">{{ $item->getTranslation('description', 'en', false) }}</td>
@include('admin.crud._status')
