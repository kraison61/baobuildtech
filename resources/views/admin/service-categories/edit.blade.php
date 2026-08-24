@extends('admin.layouts.app')

@section('title', 'แก้ไขหมวดหมู่บริการ')

@section('content')
    <x-admin.page-header title="แก้ไข: {{ $category->name }}" />

    <x-ui.card class="p-6">
        <form method="POST" action="{{ route('admin.service-categories.update', $category) }}" class="space-y-6">
            @csrf
            @method('PUT')
            @include('admin.service-categories._form', ['category' => $category])
            <x-admin.form-actions :cancel-url="route('admin.service-categories.index')" />
        </form>
    </x-ui.card>
@endsection
