@extends('admin.layouts.app')

@section('title', 'แก้ไขผลงาน')

@section('content')
    <x-admin.page-header title="แก้ไข: {{ $portfolio->title }}" />

    <x-ui.card class="mb-6 p-6">
        <form method="POST" action="{{ route('admin.portfolios.update', $portfolio) }}" class="space-y-6">
            @csrf
            @method('PUT')
            @include('admin.portfolios._form', [
                'portfolio' => $portfolio,
                'services' => $services,
                'serviceItems' => $serviceItems,
                'locations' => $locations,
            ])
            <x-admin.form-actions :cancel-url="route('admin.portfolios.index')" />
        </form>
    </x-ui.card>

    <x-ui.card class="p-6">
        <h2 class="mb-4 text-lg font-semibold text-white">รูปภาพในอัลบั้ม ({{ $portfolio->images->count() }})</h2>

        @if ($portfolio->images->isNotEmpty())
            <div class="mb-6 space-y-3">
                @foreach ($portfolio->images as $image)
                    <div class="flex flex-wrap items-center justify-between gap-3 rounded-lg border border-slate-700 bg-slate-800/50 p-3">
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm text-white">{{ $image->image_url }}</p>
                            <p class="text-xs text-slate-500">{{ $image->alt_text ?? '—' }} · {{ $image->width }}×{{ $image->height }} · ลำดับ {{ $image->sort_order }}</p>
                        </div>
                        <x-admin.delete-form :action="route('admin.portfolio-images.destroy', $image)" confirm="ลบรูปภาพนี้?" />
                    </div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.portfolios.images.store', $portfolio) }}" class="grid gap-4 sm:grid-cols-2">
            @csrf
            <div class="sm:col-span-2">
                <x-ui.label for="image_url">URL รูปภาพ *</x-ui.label>
                <x-ui.input type="url" name="image_url" id="image_url" required />
            </div>
            <div class="sm:col-span-2">
                <x-ui.label for="alt_text">Alt Text</x-ui.label>
                <x-ui.input type="text" name="alt_text" id="alt_text" />
            </div>
            <div>
                <x-ui.label for="width">ความกว้าง (px)</x-ui.label>
                <x-ui.input type="number" name="width" id="width" min="1" />
            </div>
            <div>
                <x-ui.label for="height">ความสูง (px)</x-ui.label>
                <x-ui.input type="number" name="height" id="height" min="1" />
            </div>
            <div>
                <x-ui.label for="img_sort_order">ลำดับ</x-ui.label>
                <x-ui.input type="number" name="sort_order" id="img_sort_order" value="0" min="0" />
            </div>
            <div class="flex items-end sm:col-span-2">
                <x-ui.button type="submit">เพิ่มรูปภาพ</x-ui.button>
            </div>
        </form>
    </x-ui.card>
@endsection
