@extends('admin.layouts.app')

@section('title', 'แก้ไขคำขอใบเสนอราคา')

@section('content')
    <x-admin.page-header title="แก้ไข: {{ $quoteRequest->name }}">
        ส่งเมื่อ {{ $quoteRequest->created_at?->format('d/m/Y H:i') }}
    </x-admin.page-header>
    <x-ui.card class="p-6">
        <form method="POST" action="{{ route('admin.quote-requests.update', $quoteRequest) }}" class="space-y-6">
            @csrf
            @method('PUT')
            @include('admin.quote-requests._form', ['quoteRequest' => $quoteRequest])
            <x-admin.form-actions :cancel-url="route('admin.quote-requests.index')" />
        </form>
    </x-ui.card>
@endsection
