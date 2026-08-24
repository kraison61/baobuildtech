@extends('admin.layouts.app')

@section('title', 'แก้ไขผู้ใช้')

@section('content')
    <x-admin.page-header title="แก้ไข: {{ $user->name }}" />
    <x-ui.card class="p-6">
        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
            @csrf
            @method('PUT')
            @include('admin.users._form', ['user' => $user])
            <x-admin.form-actions :cancel-url="route('admin.users.index')" />
        </form>
    </x-ui.card>
@endsection
