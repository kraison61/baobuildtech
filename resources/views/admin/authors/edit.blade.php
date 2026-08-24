@extends('admin.layouts.app')

@section('title', 'แก้ไขผู้เขียน')

@section('content')
    <x-admin.page-header title="แก้ไข: {{ $author->name }}" />
    <x-ui.card class="p-6">
        <form method="POST" action="{{ route('admin.authors.update', $author) }}" class="space-y-6">
            @csrf
            @method('PUT')
            @include('admin.authors._form', ['author' => $author])
            <x-admin.form-actions :cancel-url="route('admin.authors.index')" />
        </form>
    </x-ui.card>
@endsection
