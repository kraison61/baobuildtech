@extends('admin.layouts.app')

@section('title', 'เพิ่มบริการ')

@section('content')
    <x-admin.page-header title="เพิ่มบริการ" />
    <x-ui.card class="p-6">
        <form method="POST" action="{{ route('admin.services.store') }}" class="space-y-6">
            @csrf
            @include('admin.services._form', ['categories' => $categories])
            <x-admin.form-actions :cancel-url="route('admin.services.index')" submit-label="เพิ่มบริการ" />
        </form>
    </x-ui.card>
@endsection
