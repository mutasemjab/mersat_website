@extends('admin.layouts.app')
@section('title', $plural)

@section('content')

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title">{{ $plural }}</h1>
        <p class="page-sub">{{ __('messages.manage_list_desc') }}</p>
    </div>
    @can($perm . '-add')
    <a href="{{ route($route . '.create') }}" class="btn-primary-sm">
        <i class="bi bi-plus-circle"></i> {{ __('messages.add_new', ['name' => $singular]) }}
    </a>
    @endcan
</div>

<div class="panel-card">
    <div class="panel-card-header d-flex align-items-center justify-content-between">
        <h2 class="panel-card-title"><i class="bi bi-list-ul"></i> {{ $plural }}</h2>
        <span class="pill pill-info">{{ $items->total() }}</span>
    </div>
    <div class="panel-card-body p-0">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        @foreach ($columns as $column)
                            <th>{{ __('messages.field.' . $column) }}</th>
                        @endforeach
                        <th>{{ __('messages.Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        @include($view . '._row', ['item' => $item])
                        <td>
                            <div class="d-flex gap-1">
                                @can($perm . '-edit')
                                <a href="{{ route($route . '.edit', $item->id) }}" class="btn-icon-sm btn-edit" title="{{ __('messages.Edit') }}">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @endcan
                                @can($perm . '-delete')
                                <form action="{{ route($route . '.destroy', $item->id) }}" method="POST" class="d-inline"
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
                        <td colspan="{{ count($columns) + 2 }}" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                            {{ __('messages.no_records') }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if ($items->hasPages())
    <div class="panel-card-body border-top pt-3">{{ $items->links() }}</div>
    @endif
</div>

@endsection
