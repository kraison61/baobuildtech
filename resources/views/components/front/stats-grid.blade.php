@props([
    'items' => [
        ['label' => 'โครงการที่ส่งมอบแล้ว', 'value' => '240+'],
        ['label' => 'งานประมูลภาครัฐ', 'value' => '68 สัญญา'],
        ['label' => 'ส่งมอบตรงกำหนด', 'value' => '97%'],
        ['label' => 'ทีมช่างประจำ', 'value' => '45 คน'],
    ],
])

<dl class="grid grid-cols-2 lg:grid-cols-1 border-t-2 border-ink">
    @foreach ($items as $index => $item)
        <div @class([
            'flex flex-col lg:flex-row lg:justify-between gap-1 py-4 border-b border-line pr-4 lg:pr-0',
            'lg:border-b-0' => $index === count($items) - 1,
        ])>
            <dt class="text-sm lg:text-[15px] text-neutral-600">{{ $item['label'] }}</dt>
            <dd class="font-display text-2xl font-semibold">{{ $item['value'] }}</dd>
        </div>
    @endforeach
</dl>
