@extends('admin.layouts.app')
@section('title', __('messages.edit_item', ['name' => __('messages.role_one')]) . ': ' . $role->name)

@section('content')

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title">{{ __('messages.edit_item', ['name' => __('messages.role_one')]) }}</h1>
        <p class="page-sub">{{ $role->name }}</p>
    </div>
    <a href="{{ route('admin.role.index') }}" class="btn-outline-sm">
        <i class="bi bi-arrow-left back-icon"></i> {{ __('messages.back_to_list') }}
    </a>
</div>

<form action="{{ route('admin.role.update', $role->id) }}" method="POST">
    @csrf @method('PATCH')
    @include('admin.roles._form')

    <div class="d-flex gap-2 pb-4">
        <button type="submit" class="btn-primary-sm"><i class="bi bi-save"></i> {{ __('messages.save_changes') }}</button>
        <a href="{{ route('admin.role.index') }}" class="btn-outline-sm">{{ __('messages.Cancel') }}</a>
    </div>
</form>

@endsection
