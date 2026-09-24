<div class="mb-3">
    <label class="form-label">{{ __('messages.field.country_code') }} <span class="text-danger">*</span></label>
    <select name="country_code" class="form-select @error('country_code') is-invalid @enderror" required>
        <option value="">{{ __('messages.choose_country') }}</option>
        @foreach (\App\Support\WorldMap::countryNames() as $code => $name)
            <option value="{{ $code }}" @selected(old('country_code', $item->country_code) === $code)>{{ $name }}</option>
        @endforeach
    </select>
    <div class="form-text">{{ __('messages.country_map_hint') }}</div>
    @error('country_code')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
</div>
<x-admin.tr-input name="city" :label="__('messages.field.city')" :values="$item->getTranslations('city')" />
<x-admin.tr-input name="description" :label="__('messages.field.description')" :values="$item->getTranslations('description')" />
