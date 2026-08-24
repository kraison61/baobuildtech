@extends('admin.layouts.app')

@section('title', 'แก้ไขราคาบริการ')

@section('content')
    <x-admin.page-header title="แก้ไขราคา: {{ $price->label }}" />
    <x-ui.card class="p-6">
        <form method="POST" action="{{ route('admin.service-prices.update', $price) }}" class="space-y-6">
            @csrf
            @method('PUT')
            @include('admin.service-prices._form', [
                'price' => $price,
                'priceableTypes' => $priceableTypes,
                'priceTypes' => $priceTypes,
                'recordsByType' => $recordsByType,
            ])
            <x-admin.form-actions :cancel-url="route('admin.service-prices.index')" />
        </form>
    </x-ui.card>
@endsection
