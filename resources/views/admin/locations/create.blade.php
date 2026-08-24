@extends('admin.layouts.app')

@section('title', 'เพิ่มพื้นที่ให้บริการ')

@section('content')
    <x-admin.page-header title="เพิ่มพื้นที่ให้บริการ" />
    <x-ui.card class="p-6">
        <form method="POST" action="{{ route('admin.locations.store') }}" class="space-y-6">
            @csrf
            @include('admin.locations._form')
            <x-admin.form-actions :cancel-url="route('admin.locations.index')" submit-label="เพิ่มพื้นที่" />
        </form>
    </x-ui.card>
@endsection
