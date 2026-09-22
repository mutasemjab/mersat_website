<x-admin.tr-input name="title" :label="__('messages.field.title')" :values="$item->getTranslations('title')" />
<x-admin.tr-input name="description" type="textarea" :label="__('messages.field.description')" :values="$item->getTranslations('description')" />

<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label">{{ __('messages.field.icon') }} <span class="text-danger">*</span></label>
        <select name="icon" class="form-select no-select2 @error('icon') is-invalid @enderror" required>
            @foreach (\App\Models\Service::ICONS as $icon)
                <option value="{{ $icon }}" @selected(old('icon', $item->icon) === $icon)>{{ __('messages.icon.' . $icon) }}</option>
            @endforeach
        </select>
        @error('icon')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-8">
        <x-admin.media-input :label="__('messages.service_custom_icon')" kind="image"
            file="image" link="image_link" remove="remove_image"
            :value="$item->getRawOriginal('image')" :url="$item->image_url" />
    </div>
</div>
