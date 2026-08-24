@extends('admin.layouts.app')

@section('title', 'แก้ไขบทความ')

@section('content')
    <x-admin.page-header title="แก้ไข: {{ Str::limit($post->title, 50) }}" />
    <x-ui.card class="p-6">
        <form method="POST" action="{{ route('admin.posts.update', $post) }}" class="space-y-6">
            @csrf
            @method('PUT')
            @include('admin.posts._form', ['post' => $post, 'authors' => $authors])
            <x-admin.form-actions :cancel-url="route('admin.posts.index')" />
        </form>
    </x-ui.card>
@endsection
