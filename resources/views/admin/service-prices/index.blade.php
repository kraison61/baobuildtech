@extends('admin.layouts.app')

@section('title', 'ราคาบริการ')

@section('content')
    <x-admin.page-header title="ราคาบริการ" :action="route('admin.service-prices.create')" />

    <x-ui.card class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="border-b border-slate-700 bg-slate-800/80 text-left text-slate-400">
                    <tr>
                        <th class="px-4 py-3 font-medium">Label</th>
                        <th class="px-4 py-3 font-medium">ผูกกับ</th>
                        <th class="px-4 py-3 font-medium">ราคา</th>
                        <th class="px-4 py-3 font-medium">สถานะ</th>
                        <th class="px-4 py-3 font-medium"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse ($prices as $price)
                        <tr class="hover:bg-slate-800/40">
                            <td class="px-4 py-3 font-medium text-white">{{ $price->label }}</td>
                            <td class="px-4 py-3 text-slate-400">{{ $price->priceable_type }} #{{ $price->priceable_id }}</td>
                            <td class="px-4 py-3">
                                @if ($price->price_min)
                                    {{ number_format($price->price_min, 0) }}
                                    @if ($price->price_max) – {{ number_format($price->price_max, 0) }} @endif
                                    {{ $price->price_unit }}
                                @else
                                    —
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <x-ui.badge :variant="$price->is_visible ? 'success' : 'warning'">
                                    {{ $price->is_visible ? 'แสดง' : 'ซ่อน' }}
                                </x-ui.badge>
                            </td>
                            <td class="px-4 py-3 text-end">
                                <div class="flex justify-end gap-2">
                                    <x-ui.button variant="ghost" :href="route('admin.service-prices.edit', $price)" class="!px-3 !py-1.5 text-xs">แก้ไข</x-ui.button>
                                    <x-admin.delete-form :action="route('admin.service-prices.destroy', $price)" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-8 text-center text-slate-500">ยังไม่มีข้อมูล</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($prices->hasPages())
            <div class="border-t border-slate-700 px-4 py-3">{{ $prices->links() }}</div>
        @endif
    </x-ui.card>
@endsection
