@extends('admin.layouts.app')

@section('title', 'เพิ่มราคาบริการ')

@section('content')
    <x-admin.page-header title="เพิ่มราคาบริการ" />
    <x-ui.card class="p-6">
        <form method="POST" action="{{ route('admin.service-prices.store') }}" class="space-y-6">
            @csrf
            @include('admin.service-prices._form', compact('priceableTypes', 'priceTypes', 'recordsByType'))
            <x-admin.form-actions :cancel-url="route('admin.service-prices.index')" submit-label="เพิ่มราคา" />
        </form>
    </x-ui.card>
@endsection
