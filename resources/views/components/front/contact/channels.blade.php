@php
    $channels = \App\Support\ContactContent::channels();
@endphp

<section id="channels" class="relative z-1 -mt-10 bg-transparent pb-16 lg:pb-24">
    <x-front.container class="grid gap-6 [grid-template-columns:repeat(auto-fit,minmax(240px,1fr))]">
        @foreach ($channels as $channel)
            @if ($channel['href'] ?? null)
                <a
                    href="{{ $channel['href'] }}"
                    class="block rounded-lg border border-line bg-white p-6 hover:border-brand-mid"
                    @if ($channel['external'] ?? false) target="_blank" rel="noopener noreferrer" @endif
                >
                    <div class="text-sm font-semibold text-muted">{{ $channel['label'] }}</div>
                    <div @class([
                        'mt-2 font-semibold text-brand',
                        'text-[22px] tabular-nums' => $channel['label'] === 'โทรหาทีมช่าง' || $channel['label'] === 'ไลน์ (ส่งรูปได้)',
                        'text-[19px] break-all' => $channel['label'] === 'อีเมล',
                        'text-[22px]' => $channel['label'] === 'เวลาตอบกลับ',
                    ])>{{ $channel['value'] }}</div>
                    <div class="mt-2 text-[15px] leading-[1.7] text-muted">{{ $channel['hint'] }}</div>
                </a>
            @else
                <div class="rounded-lg border border-line bg-white p-6">
                    <div class="text-sm font-semibold text-muted">{{ $channel['label'] }}</div>
                    <div class="mt-2 text-[22px] font-semibold text-brand">{{ $channel['value'] }}</div>
                    <div class="mt-2 text-[15px] leading-[1.7] text-muted">{{ $channel['hint'] }}</div>
                </div>
            @endif
        @endforeach
    </x-front.container>
</section>
