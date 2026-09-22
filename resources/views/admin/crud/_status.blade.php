<td>{{ $item->sort_order }}</td>
<td>
    @if ($item->is_active)
        <span class="pill pill-success">{{ __('messages.Active') }}</span>
    @else
        <span class="pill pill-neutral">{{ __('messages.Inactive') }}</span>
    @endif
</td>
