@extends('admin.layouts.app')

@section('title', 'อัปโหลดรูปหน้างาน')

@section('content')
    <x-admin.page-header title="อัปโหลดรูปหน้างาน" />

    <x-ui.card class="p-6">
        <form
            method="POST"
            action="{{ route('admin.work-images.store') }}"
            enctype="multipart/form-data"
            class="space-y-6"
        >
            @csrf
            @include('admin.work-images._form', [
                'portfolios' => $portfolios,
                'serviceItems' => $serviceItems,
                'bulk' => true,
            ])
            <x-admin.form-actions
                :cancel-url="route('admin.work-images.index')"
                submit-label="อัปโหลด"
            />
        </form>
    </x-ui.card>
@endsection
