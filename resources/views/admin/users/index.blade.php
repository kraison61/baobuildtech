@extends('admin.layouts.app')

@section('title', 'ผู้ใช้')

@section('content')
    <x-admin.page-header title="ผู้ใช้" :action="route('admin.users.create')" />

    <x-ui.card class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="border-b border-slate-700 bg-slate-800/80 text-left text-slate-400">
                    <tr>
                        <th class="px-4 py-3 font-medium">ชื่อ</th>
                        <th class="px-4 py-3 font-medium">อีเมล</th>
                        <th class="px-4 py-3 font-medium"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse ($users as $user)
                        <tr class="hover:bg-slate-800/40">
                            <td class="px-4 py-3 font-medium text-white">{{ $user->name }}</td>
                            <td class="px-4 py-3 text-slate-300">{{ $user->email }}</td>
                            <td class="px-4 py-3 text-end">
                                <div class="flex justify-end gap-2">
                                    <x-ui.button variant="ghost" :href="route('admin.users.edit', $user)" class="!px-3 !py-1.5 text-xs">แก้ไข</x-ui.button>
                                    @if ($user->id !== auth()->id())
                                        <x-admin.delete-form :action="route('admin.users.destroy', $user)" />
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="px-4 py-8 text-center text-slate-500">ยังไม่มีข้อมูล</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($users->hasPages())
            <div class="border-t border-slate-700 px-4 py-3">{{ $users->links() }}</div>
        @endif
    </x-ui.card>
@endsection
