@extends('admin.layouts.app')

@section('title', 'เพิ่มรายการบริการ')

@section('content')
    <x-admin.page-header title="เพิ่มรายการบริการ" />
    <x-ui.card class="p-6">
        <form method="POST" action="{{ route('admin.service-items.store') }}" class="space-y-6">
            @csrf
            @include('admin.service-items._form', ['services' => $services])
            <x-admin.form-actions :cancel-url="route('admin.service-items.index')" submit-label="เพิ่มรายการ" />
        </form>
    </x-ui.card>
@endsection
