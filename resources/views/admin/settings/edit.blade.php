@extends('admin.layouts.app')
@php
    $locale = app()->getLocale();
    $groupTitle = $def['title'][$locale] ?? $def['title']['en'];
@endphp
@section('title', $groupTitle)

@section('content')

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title"><i class="bi {{ $def['icon'] }} me-1"></i> {{ $groupTitle }}</h1>
        <p class="page-sub">{{ __('messages.content_page_desc') }}</p>
    </div>
    <a href="{{ route('home') }}" target="_blank" class="btn-outline-sm">
        <i class="bi bi-box-arrow-up-right"></i> {{ __('messages.view_website') }}
    </a>
</div>

<form action="{{ route('admin.setting.update', $group) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="panel-card">
        <div class="panel-card-body">
            @foreach ($def['fields'] as $key => $field)
                @php
                    $label = $field['label'][$locale] ?? $field['label']['en'];
                    $value = $values[$key] ?? null;
                @endphp

                @if (in_array($field['type'], ['image', 'video']))
                    <x-admin.media-input :label="$label" :kind="$field['type']"
                        :file="'f[' . $key . ']'" :link="'s[' . $key . ']'" :remove="'r[' . $key . ']'"
                        :fileDot="'f.' . $key" :linkDot="'s.' . $key"
                        :value="is_string($value) ? $value : null"
                        :url="is_string($value) ? media_url($value, \App\Models\Setting::MEDIA_FOLDER) : null" />

                @elseif ($field['tr'])
                    <x-admin.tr-input :name="$key" :label="$label" :input="'s[' . $key . ']'" :dot="'s.' . $key"
                        :type="$field['type'] === 'textarea' ? 'textarea' : 'text'"
                        :required="$field['required']" :values="is_array($value) ? $value : []" />

                @else
                    <div class="mb-3">
                        <label class="form-label">
                            {{ $label }} @if($field['required'])<span class="text-danger">*</span>@endif
                        </label>
                        <input type="{{ $field['type'] === 'email' ? 'email' : 'text' }}" name="s[{{ $key }}]" dir="ltr"
                               value="{{ old('s.' . $key, is_string($value) ? $value : '') }}"
                               class="form-control @error('s.' . $key) is-invalid @enderror"
                               @if($field['required']) required @endif>
                        @error('s.' . $key)<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <div class="d-flex gap-2 mt-4 pb-4">
        <button type="submit" class="btn-primary-sm"><i class="bi bi-save"></i> {{ __('messages.save_changes') }}</button>
        <a href="{{ route('admin.dashboard') }}" class="btn-outline-sm">{{ __('messages.Cancel') }}</a>
    </div>
</form>

@endsection
