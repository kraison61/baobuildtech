@extends('admin.layouts.app')

@section('title', 'ผู้เขียน')

@section('content')
    <x-admin.page-header title="ผู้เขียน" :action="route('admin.authors.create')" />

    <x-ui.card class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="border-b border-slate-700 bg-slate-800/80 text-left text-slate-400">
                    <tr>
                        <th class="px-4 py-3 font-medium">ชื่อ</th>
                        <th class="px-4 py-3 font-medium">ตำแหน่ง</th>
                        <th class="px-4 py-3 font-medium">บทความ</th>
                        <th class="px-4 py-3 font-medium">สถานะ</th>
                        <th class="px-4 py-3 font-medium"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse ($authors as $author)
                        <tr class="hover:bg-slate-800/40">
                            <td class="px-4 py-3 font-medium text-white">{{ $author->name }}</td>
                            <td class="px-4 py-3 text-slate-300">{{ $author->job_title ?? '—' }}</td>
                            <td class="px-4 py-3">{{ $author->posts_count }}</td>
                            <td class="px-4 py-3">
                                <x-ui.badge :variant="$author->is_active ? 'success' : 'warning'">
                                    {{ $author->is_active ? 'เปิด' : 'ปิด' }}
                                </x-ui.badge>
                            </td>
                            <td class="px-4 py-3 text-end">
                                <div class="flex justify-end gap-2">
                                    <x-ui.button variant="ghost" :href="route('admin.authors.edit', $author)" class="!px-3 !py-1.5 text-xs">แก้ไข</x-ui.button>
                                    <x-admin.delete-form :action="route('admin.authors.destroy', $author)" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-8 text-center text-slate-500">ยังไม่มีข้อมูล</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($authors->hasPages())
            <div class="border-t border-slate-700 px-4 py-3">{{ $authors->links() }}</div>
        @endif
    </x-ui.card>
@endsection
