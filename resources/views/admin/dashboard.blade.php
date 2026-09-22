@extends('admin.layouts.app')

@section('title', __('messages.page_dashboard'))

@section('content')

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title">{{ __('messages.page_dashboard') }}</h1>
        <p class="page-sub">{{ __('messages.welcome_back') }}</p>
    </div>
    <a href="{{ route('home') }}" target="_blank" class="btn-outline-sm">
        <i class="bi bi-box-arrow-up-right"></i> {{ __('messages.view_website') }}
    </a>
</div>

@php
    $cards = [
        ['icon' => 'bi-grid-3x3-gap', 'color' => '#2563eb', 'bg' => '#eff6ff', 'value' => $servicesCount,  'label' => 'services',        'route' => 'admin.service.index',   'perm' => 'service-table'],
        ['icon' => 'bi-collection-play', 'color' => '#7c3aed', 'bg' => '#f5f3ff', 'value' => $portfolioCount, 'label' => 'portfolio_items', 'route' => 'admin.portfolio.index', 'perm' => 'portfolio-table'],
        ['icon' => 'bi-geo-alt', 'color' => '#059669', 'bg' => '#ecfdf5', 'value' => $locationsCount, 'label' => 'locations',       'route' => 'admin.location.index',  'perm' => 'location-table'],
        ['icon' => 'bi-envelope', 'color' => '#d97706', 'bg' => '#fffbeb', 'value' => $unreadCount,    'label' => 'unread_messages',  'route' => 'admin.message.index',   'perm' => 'message-table'],
    ];
@endphp

<div class="row g-3 mb-4">
    @foreach ($cards as $card)
    <div class="col-6 col-xl-3">
        <a href="{{ Gate::allows($card['perm']) ? route($card['route']) : '#' }}" class="text-decoration-none">
            <div class="stat-card">
                <div class="stat-icon" style="background:{{ $card['bg'] }};color:{{ $card['color'] }}">
                    <i class="bi {{ $card['icon'] }}"></i>
                </div>
                <div class="stat-value">{{ $card['value'] }}</div>
                <div class="stat-label">{{ __('messages.' . $card['label']) }}</div>
            </div>
        </a>
    </div>
    @endforeach
</div>

<div class="panel-card">
    <div class="panel-card-header d-flex align-items-center justify-content-between">
        <h2 class="panel-card-title"><i class="bi bi-envelope"></i> {{ __('messages.latest_messages') }}</h2>
        @can('message-table')
        <a href="{{ route('admin.message.index') }}" class="btn-outline-sm">{{ __('messages.view_all') }}</a>
        @endcan
    </div>
    <div class="panel-card-body p-0">
        <div class="table-responsive">
            <table class="data-table">
                <tbody>
                    @forelse ($latest as $msg)
                    <tr>
                        <td>
                            <div class="{{ $msg->is_read ? '' : 'fw-bold' }}">{{ $msg->name }}</div>
                            <div class="small text-muted" dir="ltr">{{ $msg->email }}</div>
                        </td>
                        <td class="small text-muted cell-clip">{{ \Illuminate\Support\Str::limit($msg->message, 70) }}</td>
                        <td class="small text-muted">{{ $msg->created_at->diffForHumans() }}</td>
                        <td>
                            @can('message-table')
                            <a href="{{ route('admin.message.show', $msg->id) }}" class="btn-icon-sm btn-edit"><i class="bi bi-eye"></i></a>
                            @endcan
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-4 d-block mb-2"></i>{{ __('messages.no_messages_found') }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
