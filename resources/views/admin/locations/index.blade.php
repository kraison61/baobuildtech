@extends('admin.layouts.app')

@section('title', 'พื้นที่ให้บริการ')

@section('content')
    <x-admin.page-header title="พื้นที่ให้บริการ" :action="route('admin.locations.create')" />

    <x-ui.card class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="border-b border-slate-700 bg-slate-800/80 text-left text-slate-400">
                    <tr>
                        <th class="px-4 py-3 font-medium">ชื่อ</th>
                        <th class="px-4 py-3 font-medium">จังหวัด</th>
                        <th class="px-4 py-3 font-medium">ผลงาน</th>
                        <th class="px-4 py-3 font-medium">สถานะ</th>
                        <th class="px-4 py-3 font-medium"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse ($locations as $location)
                        <tr class="hover:bg-slate-800/40">
                            <td class="px-4 py-3 font-medium text-white">{{ $location->name }}</td>
                            <td class="px-4 py-3 text-slate-300">{{ $location->province ?? '—' }}</td>
                            <td class="px-4 py-3">{{ $location->portfolios_count }}</td>
                            <td class="px-4 py-3">
                                <x-ui.badge :variant="$location->is_published ? 'success' : 'warning'">
                                    {{ $location->is_published ? 'เผยแพร่' : 'แบบร่าง' }}
                                </x-ui.badge>
                            </td>
                            <td class="px-4 py-3 text-end">
                                <div class="flex justify-end gap-2">
                                    <x-ui.button variant="ghost" :href="route('admin.locations.edit', $location)" class="!px-3 !py-1.5 text-xs">แก้ไข</x-ui.button>
                                    <x-admin.delete-form :action="route('admin.locations.destroy', $location)" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-8 text-center text-slate-500">ยังไม่มีข้อมูล</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($locations->hasPages())
            <div class="border-t border-slate-700 px-4 py-3">{{ $locations->links() }}</div>
        @endif
    </x-ui.card>
@endsection
