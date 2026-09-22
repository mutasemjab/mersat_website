@extends('admin.layouts.app')
@section('title', __('messages.message_details'))

@section('content')

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title">{{ __('messages.message_details') }}</h1>
        <p class="page-sub">{{ $message->created_at->format('Y-m-d H:i') }}</p>
    </div>
    <a href="{{ route('admin.message.index') }}" class="btn-outline-sm">
        <i class="bi bi-arrow-left back-icon"></i> {{ __('messages.back_to_list') }}
    </a>
</div>

<div class="row g-4">
    <div class="col-12 col-xl-8">
        <div class="panel-card h-100">
            <div class="panel-card-header">
                <h2 class="panel-card-title"><i class="bi bi-chat-left-text"></i> {{ __('messages.field.message') }}</h2>
            </div>
            <div class="panel-card-body">
                <p class="mb-0" style="white-space:pre-line">{{ $message->message }}</p>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-4">
        <div class="panel-card h-100">
            <div class="panel-card-header">
                <h2 class="panel-card-title"><i class="bi bi-person"></i> {{ __('messages.sender') }}</h2>
            </div>
            <div class="panel-card-body">
                <dl class="detail-list mb-0">
                    <dt>{{ __('messages.field.name') }}</dt>
                    <dd>{{ $message->name }}</dd>

                    <dt>{{ __('messages.field.email') }}</dt>
                    <dd dir="ltr" class="text-start"><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></dd>

                    <dt>{{ __('messages.field.phone') }}</dt>
                    <dd dir="ltr" class="text-start">{{ $message->phone ?: '—' }}</dd>

                    <dt>{{ __('messages.field.business_name') }}</dt>
                    <dd>{{ $message->business_name ?: '—' }}</dd>

                    <dt>{{ __('messages.field.service') }}</dt>
                    <dd>{{ $message->service ?: '—' }}</dd>
                </dl>

                <div class="d-flex gap-2 mt-4 flex-wrap">
                    <a href="mailto:{{ $message->email }}" class="btn-primary-sm"><i class="bi bi-envelope"></i> {{ __('messages.reply_by_email') }}</a>
                    @can('message-delete')
                    <form action="{{ route('admin.message.destroy', $message->id) }}" method="POST"
                          onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-outline-sm text-danger"><i class="bi bi-trash"></i> {{ __('messages.Delete') }}</button>
                    </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
