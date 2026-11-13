@props([
    'prices',
    'caption' => null,
    'variant' => 'default',
    'limit' => null,
])

@php
    $rows = $limit !== null ? $prices->take((int) $limit) : $prices;
    $hasNote = $rows->contains(static fn ($price) => filled($price->note));

    $tableClass = match ($variant) {
        'dark' => 'w-full min-w-[560px] border-collapse border border-sand/30 text-[15px] [&_caption]:text-start [&_th]:border-b [&_th]:border-sand/30 [&_th]:bg-brand/80 [&_th]:p-3 [&_th]:text-start [&_th]:font-semibold [&_th]:text-white [&_td]:border-b [&_td]:border-sand/30 [&_td]:p-3 [&_td]:align-top [&_td]:text-sand [&_tbody_th]:font-semibold [&_tbody_th]:text-white',
        'inline' => 'w-full min-w-[420px] border-collapse border border-line text-[14px] [&_th]:border-b [&_th]:border-line [&_th]:bg-paper [&_th]:px-3 [&_th]:py-2 [&_th]:text-start [&_th]:font-semibold [&_th]:text-brand [&_td]:border-b [&_td]:border-line [&_td]:px-3 [&_td]:py-2 [&_td]:align-top [&_td]:text-muted [&_tbody_th]:font-semibold [&_tbody_th]:text-brand',
        default => 'w-full min-w-[560px] border-collapse border border-line text-[15px] [&_caption]:text-start [&_th]:border-b [&_th]:border-line [&_th]:bg-paper [&_th]:p-3 [&_th]:text-start [&_th]:font-semibold [&_th]:text-brand [&_td]:border-b [&_td]:border-line [&_td]:p-3 [&_td]:align-top [&_td]:text-muted [&_tbody_th]:font-semibold [&_tbody_th]:text-brand',
    };
@endphp

@if ($rows->isNotEmpty())
    <div class="max-w-full overflow-x-auto overscroll-x-contain pb-1 [-webkit-overflow-scrolling:touch] [scrollbar-width:thin]">
        <table class="{{ $tableClass }}">
            @if ($caption)
                <caption @class([
                    'mb-3 text-[15px] leading-[1.7]',
                    'text-sand' => $variant === 'dark',
                    'text-muted' => $variant !== 'dark',
                ])>{{ $caption }}</caption>
            @endif
            <thead>
                <tr>
                    <th scope="col">รายการ</th>
                    <th scope="col">ราคาต่ำสุด (บาท)</th>
                    <th scope="col">ราคาสูงสุด (บาท)</th>
                    <th scope="col">หน่วย</th>
                    @if ($hasNote)
                        <th scope="col">หมายเหตุ</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $price)
                    <tr>
                        <th scope="row">{{ $price->label }}</th>
                        <td class="tabular-nums">{{ $price->formattedMin() ?? '—' }}</td>
                        <td class="tabular-nums">{{ $price->formattedMax() ?? '—' }}</td>
                        <td>{{ $price->price_unit ?: '—' }}</td>
                        @if ($hasNote)
                            <td>{{ $price->note ?: '—' }}</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
