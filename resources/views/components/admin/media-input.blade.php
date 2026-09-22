{{--
    Image / video field: upload a file (saved with uploadImage()) or paste an external link.
    file / link / remove : HTML input names;  fileDot / linkDot : validation keys
    value : value stored in the database;  url : its public URL
--}}
@props(['label', 'kind' => 'image', 'file', 'link', 'remove', 'fileDot' => null, 'linkDot' => null, 'value' => null, 'url' => null, 'required' => false])
@php
    $fileDot = $fileDot ?? $file;
    $linkDot = $linkDot ?? $link;
    $external = $value && preg_match('#^(https?:)?//#i', $value);
    $accept = $kind === 'video' ? 'video/mp4,video/webm,video/quicktime' : 'image/jpeg,image/png,image/webp,image/gif';
@endphp
<div class="mb-3 media-field">
    <label class="form-label">
        {{ $label }} @if($required)<span class="text-danger">*</span>@endif
    </label>

    @if ($url)
        <div class="media-current mb-2">
            @if ($kind === 'video')
                <video src="{{ $url }}" muted preload="metadata" controls></video>
            @else
                <img src="{{ $url }}" alt="">
            @endif
            <label class="form-check mb-0 small">
                <input type="checkbox" class="form-check-input" name="{{ $remove }}" value="1">
                <span class="form-check-label text-danger">{{ __('messages.remove_current') }}</span>
            </label>
        </div>
    @endif

    <div class="row g-2">
        <div class="col-md-6">
            <input type="file" name="{{ $file }}" accept="{{ $accept }}"
                   class="form-control @error($fileDot) is-invalid @enderror">
            @error($fileDot)<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
            <input type="text" name="{{ $link }}" dir="ltr" placeholder="{{ __('messages.or_paste_link') }}"
                   value="{{ old($linkDot, $external ? $value : '') }}"
                   class="form-control @error($linkDot) is-invalid @enderror">
            @error($linkDot)<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="form-text">{{ $kind === 'video' ? __('messages.video_hint') : __('messages.image_hint') }}</div>
</div>
