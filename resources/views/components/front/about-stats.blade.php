@php
    $stats = \App\Support\AboutContent::stats();
@endphp

<section class="relative z-1 -mt-10 bg-transparent pb-16 lg:pb-24">
    <x-front.container class="grid gap-6 [grid-template-columns:repeat(auto-fit,minmax(240px,1fr))]">
        @foreach ($stats as $stat)
            <div class="rounded-lg border border-line bg-white p-6">
                <div class="text-[clamp(1.75rem,4vw,2.125rem)] font-semibold tabular-nums text-brand">{{ $stat['value'] }}</div>
                <div class="mt-2 text-[15px] leading-[1.7] text-muted">{{ $stat['label'] }}</div>
            </div>
        @endforeach
    </x-front.container>
</section>
