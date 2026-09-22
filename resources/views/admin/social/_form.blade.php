<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label">{{ __('messages.field.platform') }} <span class="text-danger">*</span></label>
        <select name="platform" class="form-select no-select2 @error('platform') is-invalid @enderror" required>
            @foreach (\App\Models\SocialLink::PLATFORMS as $platform)
                <option value="{{ $platform }}" @selected(old('platform', $item->platform) === $platform)>{{ __('messages.platform.' . $platform) }}</option>
            @endforeach
        </select>
        @error('platform')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-8">
        <label class="form-label">{{ __('messages.field.url') }} <span class="text-danger">*</span></label>
        <input type="text" name="url" dir="ltr" placeholder="https://" value="{{ old('url', $item->url) }}" required
               class="form-control @error('url') is-invalid @enderror">
        @error('url')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
    </div>
</div>
