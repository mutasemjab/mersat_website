<x-admin.tr-input name="tag" :label="__('messages.field.tag')" :values="$item->getTranslations('tag')" />
<x-admin.tr-input name="title" :label="__('messages.field.title')" :values="$item->getTranslations('title')" />

<x-admin.media-input :label="__('messages.field.image')" kind="image" :required="true"
    file="image" link="image_link" remove="remove_image"
    :value="$item->getRawOriginal('image')" :url="$item->image_url" />

<x-admin.media-input :label="__('messages.portfolio_hover_video')" kind="video"
    file="video" link="video_link" remove="remove_video"
    :value="$item->getRawOriginal('video')" :url="$item->video_url" />

<div class="mb-3">
    <label class="form-label">{{ __('messages.field.url') }}</label>
    <input type="text" name="url" dir="ltr" value="{{ old('url', $item->url) }}" placeholder="https://"
           class="form-control @error('url') is-invalid @enderror">
    <div class="form-text">{{ __('messages.portfolio_url_hint') }}</div>
    @error('url')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
</div>
