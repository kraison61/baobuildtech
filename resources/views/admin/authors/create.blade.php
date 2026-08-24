@extends('admin.layouts.app')

@section('title', 'เพิ่มผู้เขียน')

@section('content')
    <x-admin.page-header title="เพิ่มผู้เขียน" />
    <x-ui.card class="p-6">
        <form method="POST" action="{{ route('admin.authors.store') }}" class="space-y-6">
            @csrf
            @include('admin.authors._form')
            <x-admin.form-actions :cancel-url="route('admin.authors.index')" submit-label="เพิ่มผู้เขียน" />
        </form>
    </x-ui.card>
@endsection
