@props(['hub'])

<section class="border-b border-line bg-brand" aria-label="จุดเด่นบริการ">
    <div class="mx-auto grid max-w-[1160px] gap-px [grid-template-columns:repeat(auto-fit,minmax(min(100%,9.5rem),1fr))]">
        @foreach ($hub->highlights() as $item)
            <div class="bg-brand px-3 py-6 text-center sm:px-4 sm:py-10">
                <div class="text-[clamp(1.25rem,3vw,2rem)] font-semibold tabular-nums text-white">{{ $item['value'] }}</div>
                <div class="mt-1.5 text-[13px] leading-[1.5] text-sand sm:mt-2 sm:text-[15px] sm:leading-[1.6]">{{ $item['label'] }}</div>
            </div>
        @endforeach
    </div>
</section>
