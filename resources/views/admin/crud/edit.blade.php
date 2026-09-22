@extends('admin.layouts.app')
@section('title', __('messages.edit_item', ['name' => $singular]))

@section('content')

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title">{{ __('messages.edit_item', ['name' => $singular]) }}</h1>
        <p class="page-sub">{{ __('messages.both_languages_hint') }}</p>
    </div>
    <a href="{{ route($route . '.index') }}" class="btn-outline-sm">
        <i class="bi bi-arrow-left back-icon"></i> {{ __('messages.back_to_list') }}
    </a>
</div>

<form action="{{ route($route . '.update', $item->id) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="panel-card">
        <div class="panel-card-body">
            @include($view . '._form')
            @include('admin.crud._common')
        </div>
    </div>

    <div class="d-flex gap-2 mt-4 pb-4">
        <button type="submit" class="btn-primary-sm"><i class="bi bi-save"></i> {{ __('messages.save_changes') }}</button>
        <a href="{{ route($route . '.index') }}" class="btn-outline-sm">{{ __('messages.Cancel') }}</a>
    </div>
</form>

@endsection
