@extends('admin.layouts.app')

@section('title', 'เพิ่มหมวดหมู่บริการ')

@section('content')
    <x-admin.page-header title="เพิ่มหมวดหมู่บริการ" />

    <x-ui.card class="p-6">
        <form method="POST" action="{{ route('admin.service-categories.store') }}" class="space-y-6">
            @csrf
            @include('admin.service-categories._form')
            <x-admin.form-actions :cancel-url="route('admin.service-categories.index')" submit-label="เพิ่มหมวดหมู่" />
        </form>
    </x-ui.card>
@endsection
