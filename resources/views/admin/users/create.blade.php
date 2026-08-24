@extends('admin.layouts.app')

@section('title', 'เพิ่มผู้ใช้')

@section('content')
    <x-admin.page-header title="เพิ่มผู้ใช้" />
    <x-ui.card class="p-6">
        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
            @csrf
            @include('admin.users._form')
            <x-admin.form-actions :cancel-url="route('admin.users.index')" submit-label="เพิ่มผู้ใช้" />
        </form>
    </x-ui.card>
@endsection
