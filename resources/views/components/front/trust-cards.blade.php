@php
    $stats = \App\Support\HomeContent::stats();
@endphp

<section class="border-b border-line bg-brand" aria-label="ตัวเลขสำคัญ">
    <x-front.container class="grid gap-px py-0 [grid-template-columns:repeat(auto-fit,minmax(180px,1fr))] sm:grid-cols-3">
        @foreach ($stats as $stat)
            <div class="bg-brand px-2 py-8 text-center sm:py-10">
                <div class="text-[clamp(1.5rem,3vw,2rem)] font-semibold tabular-nums text-white">{{ $stat['value'] }}</div>
                <div class="mt-2 text-[14px] leading-[1.6] text-sand sm:text-[15px]">{{ $stat['label'] }}</div>
            </div>
        @endforeach
    </x-front.container>
</section>
