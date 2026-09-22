{{-- Shared by create / edit. $role is null when creating. --}}
@php
    $checkedPerms = old('perms') !== null ? array_map('intval', old('perms', [])) : ($assigned ?? []);
@endphp

{{-- Role name --}}
<div class="panel-card mb-4">
    <div class="panel-card-header">
        <h2 class="panel-card-title"><i class="bi bi-tag"></i> {{ __('messages.role_info') }}</h2>
    </div>
    <div class="panel-card-body">
        <div class="col-12 col-md-5">
            <label class="form-label">{{ __('messages.role_name') }} <span class="text-danger">*</span></label>
            <input type="text" name="name" value="{{ old('name', $role->name ?? '') }}"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="{{ __('messages.role_name_ph') }}" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

{{-- Permissions --}}
<div class="panel-card mb-4">
    <div class="panel-card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
        <h2 class="panel-card-title"><i class="bi bi-shield-check"></i> {{ __('messages.permissions') }}</h2>
        <div class="d-flex gap-2">
            <button type="button" class="btn-outline-sm" id="btn-select-all">
                <i class="bi bi-check2-all"></i> {{ __('messages.select_all') }}
            </button>
            <button type="button" class="btn-outline-sm" id="btn-deselect-all">
                <i class="bi bi-x-circle"></i> {{ __('messages.deselect_all') }}
            </button>
        </div>
    </div>
    <div class="panel-card-body">
        <div class="row g-3">
            @foreach ($permGroups as $groupKey => $groupPerms)
            <div class="col-12 col-md-6 col-xl-4">
                <div class="perm-card">
                    <div class="perm-card-head d-flex align-items-center justify-content-between">
                        <span class="fw-semibold small">{{ __('messages.perm_group.' . $groupKey) }}</span>
                        <label class="d-flex align-items-center gap-1 mb-0 cursor-pointer">
                            <input type="checkbox" class="group-toggle" data-group="{{ $groupKey }}">
                            <span class="small text-muted">{{ __('messages.all') }}</span>
                        </label>
                    </div>
                    <div class="perm-card-body">
                        @foreach ($groupPerms as $perm)
                            @if (isset($allPerms[$perm]))
                            <label class="perm-item">
                                <input type="checkbox" name="perms[]" value="{{ $allPerms[$perm] }}"
                                       class="perm-checkbox group-{{ $groupKey }}"
                                       {{ in_array($allPerms[$perm], $checkedPerms) ? 'checked' : '' }}>
                                <span>{{ __('messages.perm.' . last(explode('-', $perm))) }}</span>
                            </label>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@push('styles')
<style>
.perm-card { border: 1px solid var(--border, #e5e7eb); border-radius: 8px; overflow: hidden; height: 100%; }
.perm-card-head { background: #f8fafc; padding: 8px 12px; border-bottom: 1px solid var(--border, #e5e7eb); }
.perm-card-body { padding: 10px 12px; display: flex; flex-wrap: wrap; gap: 6px 12px; }
.perm-item { display: flex; align-items: center; gap: 5px; cursor: pointer; font-size: .875rem; white-space: nowrap; }
.perm-item input[type=checkbox] { cursor: pointer; }
.cursor-pointer { cursor: pointer; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    function sync(toggle, checkboxes) {
        var all  = Array.from(checkboxes).every(function (c) { return c.checked; });
        var some = Array.from(checkboxes).some(function (c) { return c.checked; });
        toggle.checked = all;
        toggle.indeterminate = !all && some;
    }

    document.querySelectorAll('.group-toggle').forEach(function (toggle) {
        var checkboxes = document.querySelectorAll('.group-' + toggle.dataset.group);
        sync(toggle, checkboxes);

        toggle.addEventListener('change', function () {
            checkboxes.forEach(function (cb) { cb.checked = toggle.checked; });
            toggle.indeterminate = false;
        });
        checkboxes.forEach(function (cb) {
            cb.addEventListener('change', function () { sync(toggle, checkboxes); });
        });
    });

    function setAll(state) {
        document.querySelectorAll('.perm-checkbox').forEach(function (cb) { cb.checked = state; });
        document.querySelectorAll('.group-toggle').forEach(function (t) { t.checked = state; t.indeterminate = false; });
    }
    document.getElementById('btn-select-all').addEventListener('click', function () { setAll(true); });
    document.getElementById('btn-deselect-all').addEventListener('click', function () { setAll(false); });
});
</script>
@endpush
