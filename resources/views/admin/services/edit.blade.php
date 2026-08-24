@extends('admin.layouts.app')

@section('title', 'แก้ไขบริการ')

@section('content')
    <x-admin.page-header title="แก้ไข: {{ $service->name }}" />
    <x-ui.card class="p-6">
        <form method="POST" action="{{ route('admin.services.update', $service) }}" class="space-y-6">
            @csrf
            @method('PUT')
            @include('admin.services._form', ['service' => $service, 'categories' => $categories])
            <x-admin.form-actions :cancel-url="route('admin.services.index')" />
        </form>
    </x-ui.card>
@endsection
