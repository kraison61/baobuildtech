@extends('admin.layouts.app')

@section('title', 'รายการบริการ')

@section('content')
    <x-admin.page-header title="รายการบริการ" :action="route('admin.service-items.create')" />

    <x-ui.card class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="border-b border-slate-700 bg-slate-800/80 text-left text-slate-400">
                    <tr>
                        <th class="px-4 py-3 font-medium">ชื่อ</th>
                        <th class="px-4 py-3 font-medium">บริการ</th>
                        <th class="px-4 py-3 font-medium">สถานะ</th>
                        <th class="px-4 py-3 font-medium"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse ($items as $item)
                        <tr class="hover:bg-slate-800/40">
                            <td class="px-4 py-3">
                                <p class="font-medium text-white">{{ $item->name }}</p>
                                <p class="text-xs text-slate-500">{{ $item->slug }}</p>
                            </td>
                            <td class="px-4 py-3 text-slate-300">{{ $item->service?->name ?? '—' }}</td>
                            <td class="px-4 py-3">
                                <x-ui.badge :variant="$item->is_published ? 'success' : 'warning'">
                                    {{ $item->is_published ? 'เผยแพร่' : 'แบบร่าง' }}
                                </x-ui.badge>
                            </td>
                            <td class="px-4 py-3 text-end">
                                <div class="flex justify-end gap-2">
                                    <x-ui.button variant="ghost" :href="route('admin.service-items.edit', $item)" class="!px-3 !py-1.5 text-xs">แก้ไข</x-ui.button>
                                    <x-admin.delete-form :action="route('admin.service-items.destroy', $item)" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-4 py-8 text-center text-slate-500">ยังไม่มีข้อมูล</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($items->hasPages())
            <div class="border-t border-slate-700 px-4 py-3">{{ $items->links() }}</div>
        @endif
    </x-ui.card>
@endsection
