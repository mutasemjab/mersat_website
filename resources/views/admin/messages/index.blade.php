@extends('admin.layouts.app')
@section('title', __('messages.contact_messages'))

@section('content')

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title">{{ __('messages.contact_messages') }}</h1>
        <p class="page-sub">{{ __('messages.contact_messages_desc') }}</p>
    </div>
</div>

<div class="row g-3 mb-3">
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-value">{{ $total }}</div>
            <div class="stat-label">{{ __('messages.all_messages') }}</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-value">{{ $unread }}</div>
            <div class="stat-label"><span class="pill pill-warning">{{ __('messages.unread') }}</span></div>
        </div>
    </div>
</div>

<div class="panel-card mb-3">
    <div class="panel-card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-12 col-md-6">
                <input type="text" name="search" value="{{ request('search') }}"
                       class="form-control form-control-sm" placeholder="{{ __('messages.search_messages_ph') }}">
            </div>
            <div class="col-6 col-md-3">
                <select name="status" class="form-select form-select-sm no-select2">
                    <option value="">{{ __('messages.All Status') }}</option>
                    <option value="unread" @selected(request('status') === 'unread')>{{ __('messages.unread') }}</option>
                    <option value="read" @selected(request('status') === 'read')>{{ __('messages.read') }}</option>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn-primary-sm"><i class="bi bi-search"></i></button>
            </div>
            @if (request('search') || request('status'))
            <div class="col-auto">
                <a href="{{ route('admin.message.index') }}" class="btn-outline-sm"><i class="bi bi-x"></i> {{ __('messages.Reset') }}</a>
            </div>
            @endif
        </form>
    </div>
</div>

<div class="panel-card">
    <div class="panel-card-body p-0">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>{{ __('messages.sender') }}</th>
                        <th>{{ __('messages.field.service') }}</th>
                        <th>{{ __('messages.field.message') }}</th>
                        <th>{{ __('messages.date') }}</th>
                        <th>{{ __('messages.Status') }}</th>
                        <th>{{ __('messages.Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($messages as $msg)
                    <tr>
                        <td>
                            <div class="{{ $msg->is_read ? '' : 'fw-bold' }}">{{ $msg->name }}</div>
                            <div class="small text-muted" dir="ltr">{{ $msg->email }}</div>
                        </td>
                        <td class="small">{{ $msg->service ?: '—' }}</td>
                        <td class="small text-muted cell-clip">{{ \Illuminate\Support\Str::limit($msg->message, 80) }}</td>
                        <td class="small text-muted">{{ $msg->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <span class="pill {{ $msg->is_read ? 'pill-neutral' : 'pill-warning' }}">
                                {{ $msg->is_read ? __('messages.read') : __('messages.unread') }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.message.show', $msg->id) }}" class="btn-icon-sm btn-edit" title="{{ __('messages.View') }}">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @can('message-delete')
                                <form action="{{ route('admin.message.destroy', $msg->id) }}" method="POST" class="d-inline"
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
                        <td colspan="6" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                            {{ __('messages.no_messages_found') }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if ($messages->hasPages())
    <div class="panel-card-body border-top pt-3">{{ $messages->links() }}</div>
    @endif
</div>

@endsection
