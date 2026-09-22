<td class="fw-semibold" dir="ltr">{{ $item->value }}{{ $item->suffix }}</td>
<td>
    {{ $item->getTranslation('label', 'en', false) }}
    <span class="text-muted mx-1">/</span>
    <span dir="rtl">{{ $item->getTranslation('label', 'ar', false) }}</span>
</td>
@include('admin.crud._status')
