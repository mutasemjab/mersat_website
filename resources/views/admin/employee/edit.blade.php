@extends('admin.layouts.app')
@section('title', __('messages.edit_item', ['name' => __('messages.employee_one')]) . ': ' . $employee->name)

@section('content')

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title">{{ __('messages.edit_item', ['name' => __('messages.employee_one')]) }}</h1>
        <p class="page-sub">{{ $employee->name }}</p>
    </div>
    <a href="{{ route('admin.employee.index') }}" class="btn-outline-sm">
        <i class="bi bi-arrow-left back-icon"></i> {{ __('messages.back_to_list') }}
    </a>
</div>

<form action="{{ route('admin.employee.update', $employee->id) }}" method="POST">
    @csrf @method('PUT')
    @include('admin.employee._form')

    <div class="d-flex gap-2 mt-4 pb-4">
        <button type="submit" class="btn-primary-sm"><i class="bi bi-save"></i> {{ __('messages.save_changes') }}</button>
        <a href="{{ route('admin.employee.index') }}" class="btn-outline-sm">{{ __('messages.Cancel') }}</a>
    </div>
</form>

@endsection
