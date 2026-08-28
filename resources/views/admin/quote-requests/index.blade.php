@extends('admin.layouts.app')

@section('title', 'คำขอใบเสนอราคา')

@section('content')
    <x-admin.page-header title="คำขอใบเสนอราคา" :action="route('admin.quote-requests.create')" action-label="เพิ่มคำขอ" />

    <x-ui.card class="mb-6 p-4">
        <form method="GET" action="{{ route('admin.quote-requests.index') }}" class="grid gap-4 sm:grid-cols-3">
            <div>
                <x-ui.label for="filter_status">กรองสถานะ</x-ui.label>
                <x-ui.select name="status" id="filter_status">
                    <option value="">ทั้งหมด</option>
                    @foreach (\App\Models\QuoteRequest::statusLabels() as $value => $label)
                        <option value="{{ $value }}" @selected($status === $value)>{{ $label }}</option>
                    @endforeach
                </x-ui.select>
            </div>
            <div class="flex items-end gap-2 sm:col-span-2">
                <x-ui.button type="submit">กรอง</x-ui.button>
                <x-ui.button variant="ghost" :href="route('admin.quote-requests.index')">ล้าง</x-ui.button>
            </div>
        </form>
    </x-ui.card>

    <x-ui.card class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="border-b border-slate-700 bg-slate-800/80 text-left text-slate-400">
                    <tr>
                        <th class="px-4 py-3 font-medium">ผู้ติดต่อ</th>
                        <th class="px-4 py-3 font-medium">เบอร์โทร</th>
                        <th class="px-4 py-3 font-medium">ประเภทงาน</th>
                        <th class="px-4 py-3 font-medium">พื้นที่</th>
                        <th class="px-4 py-3 font-medium">สถานะ</th>
                        <th class="px-4 py-3 font-medium">วันที่ส่ง</th>
                        <th class="px-4 py-3 font-medium"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse ($quoteRequests as $quoteRequest)
                        <tr class="hover:bg-slate-800/40">
                            <td class="px-4 py-3 font-medium text-white">{{ $quoteRequest->name }}</td>
                            <td class="px-4 py-3 tabular-nums text-slate-300">{{ $quoteRequest->phone }}</td>
                            <td class="px-4 py-3 text-slate-300">{{ $quoteRequest->jobTypeLabel() }}</td>
                            <td class="px-4 py-3 text-slate-300">{{ $quoteRequest->area }}</td>
                            <td class="px-4 py-3">
                                <x-ui.badge :variant="$quoteRequest->statusVariant()">
                                    {{ $quoteRequest->statusLabel() }}
                                </x-ui.badge>
                            </td>
                            <td class="px-4 py-3 tabular-nums text-slate-400">
                                {{ $quoteRequest->created_at?->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-4 py-3 text-end">
                                <div class="flex justify-end gap-2">
                                    <x-ui.button variant="ghost" :href="route('admin.quote-requests.edit', $quoteRequest)" class="!px-3 !py-1.5 text-xs">แก้ไข</x-ui.button>
                                    <x-admin.delete-form :action="route('admin.quote-requests.destroy', $quoteRequest)" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="px-4 py-8 text-center text-slate-500">ยังไม่มีคำขอใบเสนอราคา</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($quoteRequests->hasPages())
            <div class="border-t border-slate-700 px-4 py-3">{{ $quoteRequests->links() }}</div>
        @endif
    </x-ui.card>
@endsection
