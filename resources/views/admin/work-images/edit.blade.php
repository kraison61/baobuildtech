@extends('admin.layouts.app')

@section('title', 'แก้ไขรูปหน้างาน')

@section('content')
    <x-admin.page-header title="แก้ไขรูปหน้างาน" />

    <x-ui.card class="mb-6 overflow-hidden">
        <div class="aspect-video max-h-80 bg-slate-900 sm:aspect-auto">
            <img
                src="{{ $workImage->url }}"
                alt="{{ $workImage->alt_text ?? $workImage->original_name }}"
                class="mx-auto max-h-80 object-contain"
            />
        </div>
    </x-ui.card>

    <x-ui.card class="p-6">
        <form
            method="POST"
            action="{{ route('admin.work-images.update', $workImage) }}"
            enctype="multipart/form-data"
            class="space-y-6"
        >
            @csrf
            @method('PUT')
            @include('admin.work-images._form', [
                'workImage' => $workImage,
                'portfolios' => $portfolios,
                'serviceItems' => $serviceItems,
                'bulk' => false,
            ])
            <x-admin.form-actions :cancel-url="route('admin.work-images.index')" />
        </form>
    </x-ui.card>
@endsection
