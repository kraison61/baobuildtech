@extends('admin.layouts.app')

@section('title', 'เพิ่มคำขอใบเสนอราคา')

@section('content')
    <x-admin.page-header title="เพิ่มคำขอใบเสนอราคา" />
    <x-ui.card class="p-6">
        <form method="POST" action="{{ route('admin.quote-requests.store') }}" class="space-y-6">
            @csrf
            @include('admin.quote-requests._form')
            <x-admin.form-actions :cancel-url="route('admin.quote-requests.index')" submit-label="เพิ่มคำขอ" />
        </form>
    </x-ui.card>
@endsection
