<div class="row g-3 mb-3">
    <div class="col-md-3">
        <label class="form-label">{{ __('messages.field.value') }} <span class="text-danger">*</span></label>
        <input type="number" min="0" name="value" value="{{ old('value', $item->value) }}" required
               class="form-control @error('value') is-invalid @enderror">
        @error('value')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-3">
        <label class="form-label">{{ __('messages.field.suffix') }}</label>
        <input type="text" name="suffix" maxlength="10" dir="ltr" placeholder="+" value="{{ old('suffix', $item->suffix) }}"
               class="form-control @error('suffix') is-invalid @enderror">
        @error('suffix')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
<x-admin.tr-input name="label" :label="__('messages.field.label')" :values="$item->getTranslations('label')" />
