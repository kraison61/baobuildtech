@extends('admin.layouts.app')

@section('title', 'เพิ่มบทความ')

@section('content')
    <x-admin.page-header title="เพิ่มบทความ" />
    <x-ui.card class="p-6">
        <form method="POST" action="{{ route('admin.posts.store') }}" class="space-y-6">
            @csrf
            @include('admin.posts._form', compact('authors'))
            <x-admin.form-actions :cancel-url="route('admin.posts.index')" submit-label="เพิ่มบทความ" />
        </form>
    </x-ui.card>
@endsection
