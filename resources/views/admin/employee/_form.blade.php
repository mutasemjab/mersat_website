{{-- Shared by create / edit. $employee is null when creating. --}}
@php
    $editing = isset($employee) && $employee;
    $checked = old('roles') !== null ? array_map('intval', old('roles', [])) : ($assignedRoles ?? []);
@endphp

<div class="row g-4">

    {{-- Account info --}}
    <div class="col-12 col-xl-7">
        <div class="panel-card h-100">
            <div class="panel-card-header">
                <h2 class="panel-card-title"><i class="bi bi-person-badge"></i> {{ __('messages.account_info') }}</h2>
            </div>
            <div class="panel-card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">{{ __('messages.full_name') }} <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $employee->name ?? '') }}"
                               class="form-control @error('name') is-invalid @enderror" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('messages.username_label') }} <span class="text-danger">*</span></label>
                        <input type="text" name="username" value="{{ old('username', $employee->username ?? '') }}"
                               class="form-control @error('username') is-invalid @enderror" autocomplete="off" required>
                        @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('messages.field.email') }}</label>
                        <input type="email" name="email" value="{{ old('email', $employee->email ?? '') }}"
                               class="form-control @error('email') is-invalid @enderror" autocomplete="off">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">
                            {{ $editing ? __('messages.new_password') : __('messages.password_label') }}
                            @if(!$editing)<span class="text-danger">*</span>@endif
                            @if($editing)<small class="text-muted">({{ __('messages.leave_blank_keep') }})</small>@endif
                        </label>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               autocomplete="new-password" @if(!$editing) required @endif>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('messages.confirm_password') }}</label>
                        <input type="password" name="password_confirmation" class="form-control"
                               autocomplete="new-password" @if(!$editing) required @endif>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Roles --}}
    <div class="col-12 col-xl-5">
        <div class="panel-card h-100">
            <div class="panel-card-header">
                <h2 class="panel-card-title"><i class="bi bi-shield-lock"></i> {{ __('messages.Roles') }}</h2>
            </div>
            <div class="panel-card-body">
                @if ($roles->isEmpty())
                    <p class="text-muted small mb-0">
                        {{ __('messages.no_roles_yet') }}
                        <a href="{{ route('admin.role.create') }}">{{ __('messages.create_role_now') }}</a>
                    </p>
                @else
                <div class="d-flex flex-column gap-2">
                    @foreach ($roles as $role)
                    @php $isChecked = in_array($role->id, $checked); @endphp
                    <label class="d-flex align-items-center gap-2 p-2 rounded border cursor-pointer role-item {{ $isChecked ? 'selected' : '' }}">
                        <input type="checkbox" name="roles[]" value="{{ $role->id }}" class="role-checkbox" {{ $isChecked ? 'checked' : '' }}>
                        <span class="fw-semibold">{{ $role->name }}</span>
                    </label>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>

</div>

@push('styles')
<style>
.cursor-pointer { cursor: pointer; }
.role-item { cursor: pointer; transition: background .15s, border-color .15s; }
.role-item:hover, .role-item.selected { background: var(--primary-light, #eff6ff); border-color: #60a5fa !important; }
</style>
@endpush

@push('scripts')
<script>
document.querySelectorAll('.role-checkbox').forEach(function (cb) {
    cb.addEventListener('change', function () {
        this.closest('.role-item').classList.toggle('selected', this.checked);
    });
});
</script>
@endpush
