<div class="alert alert-info small d-flex gap-2 align-items-start">
    <i class="bi bi-info-circle mt-1"></i>
    <span>{{ __('messages.logo_hint') }}</span>
</div>

<x-admin.media-input :label="__('messages.field.logo')" kind="image" :required="true"
    file="logo" link="logo_link" remove="remove_logo"
    :value="$item->getRawOriginal('logo')" :url="$item->logo_url" />

<div class="mb-3">
    <label class="form-label">{{ __('messages.logo_name') }}</label>
    <input type="text" name="name" value="{{ old('name', $item->name) }}" maxlength="150"
           class="form-control @error('name') is-invalid @enderror">
    <div class="form-text">{{ __('messages.logo_name_hint') }}</div>
    @error('name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
</div>
