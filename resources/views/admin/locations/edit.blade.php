@extends('admin.layouts.app')

@section('title', 'แก้ไขพื้นที่ให้บริการ')

@section('content')
    <x-admin.page-header title="แก้ไข: {{ $location->name }}" />
    <x-ui.card class="p-6">
        <form method="POST" action="{{ route('admin.locations.update', $location) }}" class="space-y-6">
            @csrf
            @method('PUT')
            @include('admin.locations._form', ['location' => $location])
            <x-admin.form-actions :cancel-url="route('admin.locations.index')" />
        </form>
    </x-ui.card>
@endsection
