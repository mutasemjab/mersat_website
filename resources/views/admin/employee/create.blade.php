@extends('admin.layouts.app')
@section('title', __('messages.add_new', ['name' => __('messages.employee_one')]))

@section('content')

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title">{{ __('messages.add_new', ['name' => __('messages.employee_one')]) }}</h1>
        <p class="page-sub">{{ __('messages.employee_create_desc') }}</p>
    </div>
    <a href="{{ route('admin.employee.index') }}" class="btn-outline-sm">
        <i class="bi bi-arrow-left back-icon"></i> {{ __('messages.back_to_list') }}
    </a>
</div>

<form action="{{ route('admin.employee.store') }}" method="POST">
    @csrf
    @include('admin.employee._form', ['employee' => null, 'assignedRoles' => []])

    <div class="d-flex gap-2 mt-4 pb-4">
        <button type="submit" class="btn-primary-sm"><i class="bi bi-save"></i> {{ __('messages.Save') }}</button>
        <a href="{{ route('admin.employee.index') }}" class="btn-outline-sm">{{ __('messages.Cancel') }}</a>
    </div>
</form>

@endsection
