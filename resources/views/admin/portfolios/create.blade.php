@extends('admin.layouts.app')

@section('title', 'เพิ่มผลงาน')

@section('content')
    <x-admin.page-header title="เพิ่มผลงาน" />
    <x-ui.card class="p-6">
        <form method="POST" action="{{ route('admin.portfolios.store') }}" class="space-y-6">
            @csrf
            @include('admin.portfolios._form', compact('services', 'serviceItems', 'locations'))
            <x-admin.form-actions :cancel-url="route('admin.portfolios.index')" submit-label="เพิ่มผลงาน" />
        </form>
    </x-ui.card>
@endsection
