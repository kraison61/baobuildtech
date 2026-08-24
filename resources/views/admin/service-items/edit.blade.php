@extends('admin.layouts.app')

@section('title', 'แก้ไขรายการบริการ')

@section('content')
    <x-admin.page-header title="แก้ไข: {{ $item->name }}" />
    <x-ui.card class="p-6">
        <form method="POST" action="{{ route('admin.service-items.update', $item) }}" class="space-y-6">
            @csrf
            @method('PUT')
            @include('admin.service-items._form', ['item' => $item, 'services' => $services])
            <x-admin.form-actions :cancel-url="route('admin.service-items.index')" />
        </form>
    </x-ui.card>
@endsection
