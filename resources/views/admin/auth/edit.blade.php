@extends('admin.layouts.app')
@section('title', __('messages.edit_admin_account'))

@section('content')

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title">{{ __('messages.edit_admin_account') }}</h1>
        <p class="page-sub">{{ __('messages.edit_account_desc') }}</p>
    </div>
</div>

<form action="{{ route('admin.login.update', $data->id) }}" method="POST">
    @csrf
    <div class="panel-card">
        <div class="panel-card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">{{ __('messages.username_label') }} <span class="text-danger">*</span></label>
                    <input name="username" class="form-control @error('username') is-invalid @enderror"
                           value="{{ old('username', $data->username) }}" required>
                    @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <label class="form-label">{{ __('messages.new_password') }}
                        <small class="text-muted">({{ __('messages.leave_blank_keep') }})</small>
                    </label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                           autocomplete="new-password">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{ __('messages.confirm_password') }}</label>
                    <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex gap-2 mt-4 pb-4">
        <button type="submit" class="btn-primary-sm"><i class="bi bi-save"></i> {{ __('messages.update') }}</button>
        <a href="{{ route('admin.dashboard') }}" class="btn-outline-sm">{{ __('messages.Cancel') }}</a>
    </div>
</form>

@endsection
