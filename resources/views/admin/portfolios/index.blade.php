@extends('admin.layouts.app')

@section('title', 'ผลงาน')

@section('content')
    <x-admin.page-header title="ผลงาน" :action="route('admin.portfolios.create')" />

    <x-ui.card class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="border-b border-slate-700 bg-slate-800/80 text-left text-slate-400">
                    <tr>
                        <th class="px-4 py-3 font-medium">ชื่อโครงการ</th>
                        <th class="px-4 py-3 font-medium">บริการ</th>
                        <th class="px-4 py-3 font-medium">รูป</th>
                        <th class="px-4 py-3 font-medium">สถานะ</th>
                        <th class="px-4 py-3 font-medium"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse ($portfolios as $portfolio)
                        <tr class="hover:bg-slate-800/40">
                            <td class="px-4 py-3">
                                <p class="font-medium text-white">{{ $portfolio->title }}</p>
                                <p class="text-xs text-slate-500">{{ $portfolio->client_name }}</p>
                            </td>
                            <td class="px-4 py-3 text-slate-300">{{ $portfolio->service?->name ?? '—' }}</td>
                            <td class="px-4 py-3">{{ $portfolio->images_count }}</td>
                            <td class="px-4 py-3">
                                <x-ui.badge :variant="$portfolio->is_published ? 'success' : 'warning'">
                                    {{ $portfolio->is_published ? 'เผยแพร่' : 'แบบร่าง' }}
                                </x-ui.badge>
                            </td>
                            <td class="px-4 py-3 text-end">
                                <div class="flex justify-end gap-2">
                                    <x-ui.button variant="ghost" :href="route('admin.portfolios.edit', $portfolio)" class="!px-3 !py-1.5 text-xs">แก้ไข</x-ui.button>
                                    <x-admin.delete-form :action="route('admin.portfolios.destroy', $portfolio)" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-8 text-center text-slate-500">ยังไม่มีข้อมูล</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($portfolios->hasPages())
            <div class="border-t border-slate-700 px-4 py-3">{{ $portfolios->links() }}</div>
        @endif
    </x-ui.card>
@endsection
