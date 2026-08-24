@extends('admin.layouts.app')

@section('title', 'เพิ่ม FAQ')

@section('content')
    <x-admin.page-header title="เพิ่ม FAQ" />
    <x-ui.card class="p-6">
        <form method="POST" action="{{ route('admin.faqs.store') }}" class="space-y-6">
            @csrf
            @include('admin.faqs._form', compact('faqableTypes', 'recordsByType'))
            <x-admin.form-actions :cancel-url="route('admin.faqs.index')" submit-label="เพิ่ม FAQ" />
        </form>
    </x-ui.card>
@endsection
