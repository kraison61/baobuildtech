@php
    $principles = \App\Support\AboutContent::principles();
@endphp

<section id="principles" class="bg-brand py-20 text-white lg:py-32">
    <x-front.container>
        <div class="max-w-[680px]">
            <div class="flex items-center gap-2 text-sm font-semibold tracking-wide text-sand">
                <span class="h-px w-7 bg-sand"></span>
                {{ \App\Support\AboutContent::principlesEyebrow() }}
            </div>
            <h2 class="mt-6 text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-white">
                {{ \App\Support\AboutContent::principlesTitle() }}
            </h2>
            <p class="mt-6 text-[17px] leading-[1.8] text-sand">
                {{ \App\Support\AboutContent::principlesLead() }}
            </p>
        </div>

        <div class="mt-10 grid gap-6 [grid-template-columns:repeat(auto-fit,minmax(240px,1fr))]">
            @foreach ($principles as $item)
                <div class="rounded-lg border border-sand/30 p-6">
                    <div class="text-sm font-semibold tabular-nums text-sand">{{ $item['no'] }}</div>
                    <div class="mt-2 text-[22px] font-semibold text-white">{{ $item['title'] }}</div>
                    <p class="mt-3 text-[15px] leading-[1.8] text-sand">{{ $item['body'] }}</p>
                </div>
            @endforeach
        </div>
    </x-front.container>
</section>
