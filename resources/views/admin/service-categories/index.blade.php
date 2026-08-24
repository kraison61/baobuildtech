@extends('admin.layouts.app')

@section('title', 'หมวดหมู่บริการ')

@section('content')
    <x-admin.page-header title="หมวดหมู่บริการ" :action="route('admin.service-categories.create')" />

    <x-ui.card class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="border-b border-slate-700 bg-slate-800/80 text-left text-slate-400">
                    <tr>
                        <th class="px-4 py-3 font-medium">ชื่อ</th>
                        <th class="px-4 py-3 font-medium">Slug</th>
                        <th class="px-4 py-3 font-medium">บริการ</th>
                        <th class="px-4 py-3 font-medium">ลำดับ</th>
                        <th class="px-4 py-3 font-medium">สถานะ</th>
                        <th class="px-4 py-3 font-medium"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse ($categories as $category)
                        <tr class="hover:bg-slate-800/40">
                            <td class="px-4 py-3 font-medium text-white">{{ $category->name }}</td>
                            <td class="px-4 py-3 text-slate-400">{{ $category->slug }}</td>
                            <td class="px-4 py-3">{{ $category->services_count }}</td>
                            <td class="px-4 py-3">{{ $category->sort_order }}</td>
                            <td class="px-4 py-3">
                                <x-ui.badge :variant="$category->is_active ? 'success' : 'warning'">
                                    {{ $category->is_active ? 'เปิดใช้' : 'ปิด' }}
                                </x-ui.badge>
                            </td>
                            <td class="px-4 py-3 text-end">
                                <div class="flex justify-end gap-2">
                                    <x-ui.button variant="ghost" :href="route('admin.service-categories.edit', $category)" class="!px-3 !py-1.5 text-xs">แก้ไข</x-ui.button>
                                    <x-admin.delete-form :action="route('admin.service-categories.destroy', $category)" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-4 py-8 text-center text-slate-500">ยังไม่มีข้อมูล</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($categories->hasPages())
            <div class="border-t border-slate-700 px-4 py-3">{{ $categories->links() }}</div>
        @endif
    </x-ui.card>
@endsection
