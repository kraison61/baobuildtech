@extends('admin.layouts.app')

@section('title', 'FAQ')

@section('content')
    <x-admin.page-header title="FAQ" :action="route('admin.faqs.create')" />

    <x-ui.card class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="border-b border-slate-700 bg-slate-800/80 text-left text-slate-400">
                    <tr>
                        <th class="px-4 py-3 font-medium">คำถาม</th>
                        <th class="px-4 py-3 font-medium">ผูกกับ</th>
                        <th class="px-4 py-3 font-medium">สถานะ</th>
                        <th class="px-4 py-3 font-medium"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse ($faqs as $faq)
                        <tr class="hover:bg-slate-800/40">
                            <td class="max-w-md px-4 py-3">
                                <p class="font-medium text-white">{{ Str::limit($faq->question, 80) }}</p>
                            </td>
                            <td class="px-4 py-3 text-slate-400">{{ $faq->faqable_type }} #{{ $faq->faqable_id }}</td>
                            <td class="px-4 py-3">
                                <x-ui.badge :variant="$faq->is_active ? 'success' : 'warning'">
                                    {{ $faq->is_active ? 'เปิด' : 'ปิด' }}
                                </x-ui.badge>
                            </td>
                            <td class="px-4 py-3 text-end">
                                <div class="flex justify-end gap-2">
                                    <x-ui.button variant="ghost" :href="route('admin.faqs.edit', $faq)" class="!px-3 !py-1.5 text-xs">แก้ไข</x-ui.button>
                                    <x-admin.delete-form :action="route('admin.faqs.destroy', $faq)" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-4 py-8 text-center text-slate-500">ยังไม่มีข้อมูล</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($faqs->hasPages())
            <div class="border-t border-slate-700 px-4 py-3">{{ $faqs->links() }}</div>
        @endif
    </x-ui.card>
@endsection
