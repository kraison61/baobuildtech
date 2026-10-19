@extends('admin.layouts.app')

@section('title', 'คลิกไลน์ / โทร')

@section('content')
    <x-admin.page-header title="คลิกไลน์ / โทร" />

    <div class="mb-6 grid gap-4 sm:grid-cols-2">
        <x-ui.card class="p-4">
            <div class="text-xs font-medium uppercase tracking-wide text-slate-500">ไลน์</div>
            <div class="mt-1 text-2xl font-semibold tabular-nums text-white">{{ number_format($totals['line']) }}</div>
        </x-ui.card>
        <x-ui.card class="p-4">
            <div class="text-xs font-medium uppercase tracking-wide text-slate-500">โทร</div>
            <div class="mt-1 text-2xl font-semibold tabular-nums text-white">{{ number_format($totals['phone']) }}</div>
        </x-ui.card>
    </div>

    <x-ui.card class="mb-6 p-4">
        <form method="GET" action="{{ route('admin.cta-clicks.index') }}" class="grid gap-4 sm:grid-cols-3">
            <div>
                <x-ui.label for="filter_channel">กรองช่องทาง</x-ui.label>
                <x-ui.select name="channel" id="filter_channel">
                    <option value="">ทั้งหมด</option>
                    @foreach (\App\Models\CtaClick::channelLabels() as $value => $label)
                        <option value="{{ $value }}" @selected($channel === $value)>{{ $label }}</option>
                    @endforeach
                </x-ui.select>
            </div>
            <div class="flex items-end gap-2 sm:col-span-2">
                <x-ui.button type="submit">กรอง</x-ui.button>
                <x-ui.button variant="ghost" :href="route('admin.cta-clicks.index')">ล้าง</x-ui.button>
            </div>
        </form>
    </x-ui.card>

    <x-ui.card class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="border-b border-slate-700 bg-slate-800/80 text-left text-slate-400">
                    <tr>
                        <th class="px-4 py-3 font-medium">ช่องทาง</th>
                        <th class="px-4 py-3 font-medium">จุดกด</th>
                        <th class="px-4 py-3 font-medium">หน้า</th>
                        <th class="px-4 py-3 font-medium">เวลา</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse ($ctaClicks as $click)
                        <tr class="hover:bg-slate-800/40">
                            <td class="px-4 py-3">
                                <x-ui.badge :variant="$click->channel === 'line' ? 'success' : 'default'">
                                    {{ $click->channelLabel() }}
                                </x-ui.badge>
                            </td>
                            <td class="px-4 py-3 font-mono text-xs text-slate-300">{{ $click->source }}</td>
                            <td class="max-w-[280px] truncate px-4 py-3 text-slate-400" title="{{ $click->page_url }}">
                                {{ $click->page_url ?: '—' }}
                            </td>
                            <td class="px-4 py-3 tabular-nums text-slate-400">
                                {{ $click->created_at?->format('d/m/Y H:i:s') }}
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-4 py-8 text-center text-slate-500">ยังไม่มีการกดไลน์หรือโทร</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($ctaClicks->hasPages())
            <div class="border-t border-slate-700 px-4 py-3">{{ $ctaClicks->links() }}</div>
        @endif
    </x-ui.card>
@endsection
