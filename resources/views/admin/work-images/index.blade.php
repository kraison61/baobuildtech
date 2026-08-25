@extends('admin.layouts.app')

@section('title', 'รูปหน้างาน')

@section('content')
    <x-admin.page-header title="รูปหน้างาน" :action="route('admin.work-images.create')" action-label="อัปโหลดรูป" />

    <x-ui.card class="mb-6 p-4">
        <form method="GET" action="{{ route('admin.work-images.index') }}" class="grid gap-4 sm:grid-cols-3">
            <div>
                <x-ui.label for="filter_portfolio_id">กรองหน้างาน</x-ui.label>
                <x-ui.select name="portfolio_id" id="filter_portfolio_id">
                    <option value="">ทั้งหมด</option>
                    @foreach ($portfolios as $portfolio)
                        <option value="{{ $portfolio->id }}" @selected(request('portfolio_id') == $portfolio->id)>
                            {{ $portfolio->title }}
                        </option>
                    @endforeach
                </x-ui.select>
            </div>
            <div>
                <x-ui.label for="filter_service_item_id">กรองรายการบริการ</x-ui.label>
                <x-ui.select name="service_item_id" id="filter_service_item_id">
                    <option value="">ทั้งหมด</option>
                    @foreach ($serviceItems as $item)
                        <option value="{{ $item->id }}" @selected(request('service_item_id') == $item->id)>
                            {{ $item->service?->name ? $item->service->name.' › ' : '' }}{{ $item->name }}
                        </option>
                    @endforeach
                </x-ui.select>
            </div>
            <div class="flex items-end gap-2">
                <x-ui.button type="submit">กรอง</x-ui.button>
                <x-ui.button variant="ghost" :href="route('admin.work-images.index')">ล้าง</x-ui.button>
            </div>
        </form>
    </x-ui.card>

    <x-ui.card class="overflow-hidden">
        @if ($images->isNotEmpty())
            <div class="grid gap-4 p-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($images as $image)
                    <div class="overflow-hidden rounded-lg border border-slate-700 bg-slate-800/50">
                        <div class="aspect-video bg-slate-900">
                            <img
                                src="{{ $image->url }}"
                                alt="{{ $image->alt_text ?? $image->original_name }}"
                                class="size-full object-cover"
                                loading="lazy"
                            />
                        </div>
                        <div class="space-y-2 p-3">
                            <p class="truncate text-sm font-medium text-white" title="{{ $image->original_name }}">
                                {{ $image->original_name ?? '—' }}
                            </p>
                            <p class="truncate text-xs text-slate-400">
                                หน้างาน: {{ $image->portfolio?->title ?? '—' }}
                            </p>
                            <p class="truncate text-xs text-slate-400">
                                บริการ: {{ $image->serviceItem?->name ?? '—' }}
                            </p>
                            <p class="truncate text-xs text-slate-500">
                                GPS: {{ $image->coordinates ?? '—' }}
                            </p>
                            <div class="flex items-center justify-between gap-2 pt-1">
                                <x-ui.badge :variant="$image->is_published ? 'success' : 'warning'">
                                    {{ $image->is_published ? 'เผยแพร่' : 'แบบร่าง' }}
                                </x-ui.badge>
                                <div class="flex gap-1">
                                    <x-ui.button variant="ghost" :href="route('admin.work-images.edit', $image)" class="!px-2 !py-1 text-xs">แก้ไข</x-ui.button>
                                    <x-admin.delete-form :action="route('admin.work-images.destroy', $image)" confirm="ลบรูปภาพนี้?" />
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($images->hasPages())
                <div class="border-t border-slate-700 px-4 py-3">{{ $images->links() }}</div>
            @endif
        @else
            <p class="px-4 py-10 text-center text-slate-500">ยังไม่มีรูปภาพ</p>
        @endif
    </x-ui.card>
@endsection
