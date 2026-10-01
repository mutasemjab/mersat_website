{{-- Size is set on the tag too, so a large logo stays a small thumbnail even if the stylesheet is cached --}}
<td><img src="{{ $item->logo_url }}" alt="" class="thumb-logo" width="96" height="48" style="width:96px;height:48px;object-fit:contain;" loading="lazy"></td>
<td class="fw-semibold">{{ $item->name ?: '—' }}</td>
@include('admin.crud._status')
