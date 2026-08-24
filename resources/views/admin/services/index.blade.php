@extends('admin.layouts.app')

@section('title', 'บริการ')

@section('content')
    <x-admin.page-header title="บริการ" :action="route('admin.services.create')" />

    <x-ui.card class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="border-b border-slate-700 bg-slate-800/80 text-left text-slate-400">
                    <tr>
                        <th class="px-4 py-3 font-medium">ชื่อ</th>
                        <th class="px-4 py-3 font-medium">หมวดหมู่</th>
                        <th class="px-4 py-3 font-medium">รายการ</th>
                        <th class="px-4 py-3 font-medium">สถานะ</th>
                        <th class="px-4 py-3 font-medium"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse ($services as $service)
                        <tr class="hover:bg-slate-800/40">
                            <td class="px-4 py-3">
                                <p class="font-medium text-white">{{ $service->name }}</p>
                                <p class="text-xs text-slate-500">{{ $service->slug }}</p>
                            </td>
                            <td class="px-4 py-3 text-slate-300">{{ $service->category?->name ?? '—' }}</td>
                            <td class="px-4 py-3">{{ $service->items_count }}</td>
                            <td class="px-4 py-3">
                                <x-ui.badge :variant="$service->is_published ? 'success' : 'warning'">
                                    {{ $service->is_published ? 'เผยแพร่' : 'แบบร่าง' }}
                                </x-ui.badge>
                            </td>
                            <td class="px-4 py-3 text-end">
                                <div class="flex justify-end gap-2">
                                    <x-ui.button variant="ghost" :href="route('admin.services.edit', $service)" class="!px-3 !py-1.5 text-xs">แก้ไข</x-ui.button>
                                    <x-admin.delete-form :action="route('admin.services.destroy', $service)" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-8 text-center text-slate-500">ยังไม่มีข้อมูล</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($services->hasPages())
            <div class="border-t border-slate-700 px-4 py-3">{{ $services->links() }}</div>
        @endif
    </x-ui.card>
@endsection
