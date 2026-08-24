@extends('admin.layouts.app')

@section('title', 'แก้ไข FAQ')

@section('content')
    <x-admin.page-header title="แก้ไข FAQ" />
    <x-ui.card class="p-6">
        <form method="POST" action="{{ route('admin.faqs.update', $faq) }}" class="space-y-6">
            @csrf
            @method('PUT')
            @include('admin.faqs._form', [
                'faq' => $faq,
                'faqableTypes' => $faqableTypes,
                'recordsByType' => $recordsByType,
            ])
            <x-admin.form-actions :cancel-url="route('admin.faqs.index')" />
        </form>
    </x-ui.card>
@endsection
