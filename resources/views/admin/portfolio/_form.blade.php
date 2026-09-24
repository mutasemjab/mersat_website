<x-admin.tr-input name="title" :label="__('messages.client_name')" :values="$item->getTranslations('title')" />
<x-admin.tr-input name="tag" :label="__('messages.field.tag')" :values="$item->getTranslations('tag')" />
<x-admin.tr-input name="description" type="textarea" :rows="5" :required="false" :label="__('messages.client_description')" :values="$item->getTranslations('description')" />

<x-admin.media-input :label="__('messages.client_cover')" kind="image" :required="true"
    file="image" link="image_link" remove="remove_image"
    :value="$item->getRawOriginal('image')" :url="$item->image_url" />

<x-admin.media-input :label="__('messages.portfolio_hover_video')" kind="video"
    file="video" link="video_link" remove="remove_video"
    :value="$item->getRawOriginal('video')" :url="$item->video_url" />

<div class="mb-3">
    <label class="form-label">{{ __('messages.client_website') }}</label>
    <input type="url" name="url" dir="ltr" value="{{ old('url', $item->url) }}" placeholder="https://"
           class="form-control @error('url') is-invalid @enderror">
    <div class="form-text">{{ __('messages.portfolio_url_hint') }}</div>
    @error('url')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
</div>

{{-- Gallery: the work done for this client --}}
<hr class="my-4">
<h3 class="h6 fw-bold mb-1"><i class="bi bi-images"></i> {{ __('messages.client_gallery') }}</h3>
<p class="form-text mt-0 mb-3">{{ __('messages.client_gallery_hint') }}</p>

@if ($item->exists && $item->media->isNotEmpty())
<div class="gallery-admin mb-3">
    @foreach ($item->media as $media)
    <label class="gallery-admin-item">
        @if ($media->type === 'image')
            <img src="{{ $media->url }}" alt="">
        @elseif ($media->embed_url)
            <span class="gallery-admin-embed"><i class="bi bi-play-btn"></i><small dir="ltr">{{ \Illuminate\Support\Str::limit($media->path, 40) }}</small></span>
        @else
            <video src="{{ $media->url }}" muted preload="metadata"></video>
        @endif
        <span class="form-check small mb-0">
            <input type="checkbox" class="form-check-input" name="remove_media[]" value="{{ $media->id }}">
            <span class="form-check-label text-danger">{{ __('messages.Delete') }}</span>
        </span>
    </label>
    @endforeach
</div>
@endif

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">{{ __('messages.gallery_upload') }}</label>
        <input type="file" name="gallery_files[]" multiple accept="image/jpeg,image/png,image/webp,image/gif,video/mp4,video/webm,video/quicktime"
               class="form-control @error('gallery_files') is-invalid @enderror @error('gallery_files.*') is-invalid @enderror">
        <div class="form-text">{{ __('messages.gallery_upload_hint') }}</div>
        @error('gallery_files')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        @foreach ($errors->get('gallery_files.*') as $messages)
            <div class="invalid-feedback d-block">{{ $messages[0] }}</div>
        @endforeach
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('messages.gallery_links') }}</label>
        <textarea name="gallery_links" rows="3" dir="ltr" placeholder="https://www.youtube.com/watch?v=...&#10;https://vimeo.com/..."
                  class="form-control @error('gallery_links') is-invalid @enderror">{{ old('gallery_links') }}</textarea>
        <div class="form-text">{{ __('messages.gallery_links_hint') }}</div>
        @error('gallery_links')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
    </div>
</div>
