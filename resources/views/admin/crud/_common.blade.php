{{-- Fields shared by every content module: display order + visibility --}}
<hr class="my-4">
<div class="row g-3 align-items-end">
    <div class="col-md-3">
        <label class="form-label">{{ __('messages.field.sort_order') }}</label>
        <input type="number" min="0" name="sort_order" value="{{ old('sort_order', $item->sort_order) }}"
               class="form-control @error('sort_order') is-invalid @enderror">
        <div class="form-text">{{ __('messages.sort_order_hint') }}</div>
    </div>
    <div class="col-md-4">
        <input type="hidden" name="is_active" value="0">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1"
                   {{ old('is_active', $item->is_active ? 1 : 0) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">{{ __('messages.show_on_website') }}</label>
        </div>
    </div>
</div>
