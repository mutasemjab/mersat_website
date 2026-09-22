@extends('admin.layouts.app')
@section('title', __('messages.Roles'))

@section('content')

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title">{{ __('messages.Roles') }}</h1>
        <p class="page-sub">{{ __('messages.roles_desc') }}</p>
    </div>
    @can('role-add')
    <a href="{{ route('admin.role.create') }}" class="btn-primary-sm">
        <i class="bi bi-plus-circle"></i> {{ __('messages.add_new', ['name' => __('messages.role_one')]) }}
    </a>
    @endcan
</div>

<div class="panel-card mb-3">
    <div class="panel-card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-12 col-md-6">
                <input type="text" name="search" value="{{ request('search') }}"
                    class="form-control form-control-sm" placeholder="{{ __('messages.role_search_ph') }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn-primary-sm"><i class="bi bi-search"></i></button>
            </div>
            @if (request('search'))
            <div class="col-auto">
                <a href="{{ route('admin.role.index') }}" class="btn-outline-sm"><i class="bi bi-x"></i> {{ __('messages.Reset') }}</a>
            </div>
            @endif
        </form>
    </div>
</div>

<div class="panel-card">
    <div class="panel-card-header d-flex align-items-center justify-content-between">
        <h2 class="panel-card-title"><i class="bi bi-shield-lock"></i> {{ __('messages.Roles') }}</h2>
        <span class="pill pill-info">{{ $roles->total() }}</span>
    </div>
    <div class="panel-card-body p-0">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('messages.role_name') }}</th>
                        <th>{{ __('messages.permissions_count') }}</th>
                        <th>{{ __('messages.Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $role)
                    <tr>
                        <td>{{ $loop->iteration + ($roles->currentPage() - 1) * $roles->perPage() }}</td>
                        <td><span class="fw-semibold">{{ $role->name }}</span></td>
                        <td>
                            <span class="pill pill-{{ $role->permissions_count > 0 ? 'success' : 'neutral' }}">
                                {{ $role->permissions_count }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                @can('role-edit')
                                <a href="{{ route('admin.role.edit', $role->id) }}" class="btn-icon-sm btn-edit" title="{{ __('messages.Edit') }}">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @endcan
                                @can('role-delete')
                                <form action="{{ route('admin.role.destroy', $role->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-icon-sm btn-delete" title="{{ __('messages.Delete') }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                            {{ __('messages.no_records') }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if ($roles->hasPages())
    <div class="panel-card-body border-top pt-3">{{ $roles->links() }}</div>
    @endif
</div>

@endsection
