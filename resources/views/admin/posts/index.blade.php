@extends('admin.layouts.app')

@section('title', 'บทความ')

@section('content')
    <x-admin.page-header title="บทความ" :action="route('admin.posts.create')" />

    <x-ui.card class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="border-b border-slate-700 bg-slate-800/80 text-left text-slate-400">
                    <tr>
                        <th class="px-4 py-3 font-medium">หัวข้อ</th>
                        <th class="px-4 py-3 font-medium">ผู้เขียน</th>
                        <th class="px-4 py-3 font-medium">คำ</th>
                        <th class="px-4 py-3 font-medium">สถานะ</th>
                        <th class="px-4 py-3 font-medium"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse ($posts as $post)
                        <tr class="hover:bg-slate-800/40">
                            <td class="px-4 py-3">
                                <p class="font-medium text-white">{{ Str::limit($post->title, 60) }}</p>
                                <p class="text-xs text-slate-500">{{ $post->slug }}</p>
                            </td>
                            <td class="px-4 py-3 text-slate-300">{{ $post->author?->name ?? '—' }}</td>
                            <td class="px-4 py-3">{{ number_format($post->word_count ?? 0) }}</td>
                            <td class="px-4 py-3">
                                <x-ui.badge :variant="$post->is_published ? 'success' : 'warning'">
                                    {{ $post->is_published ? 'เผยแพร่' : 'แบบร่าง' }}
                                </x-ui.badge>
                            </td>
                            <td class="px-4 py-3 text-end">
                                <div class="flex justify-end gap-2">
                                    <x-ui.button variant="ghost" :href="route('admin.posts.edit', $post)" class="!px-3 !py-1.5 text-xs">แก้ไข</x-ui.button>
                                    <x-admin.delete-form :action="route('admin.posts.destroy', $post)" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-8 text-center text-slate-500">ยังไม่มีข้อมูล</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($posts->hasPages())
            <div class="border-t border-slate-700 px-4 py-3">{{ $posts->links() }}</div>
        @endif
    </x-ui.card>
@endsection
