<td><img src="{{ $item->logo_url }}" alt="" class="thumb-logo"></td>
<td class="fw-semibold">{{ $item->name ?: '—' }}</td>
@include('admin.crud._status')
