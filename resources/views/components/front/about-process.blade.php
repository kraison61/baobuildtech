@php
    $steps = \App\Support\AboutContent::processSteps();
@endphp

<section id="process" class="border-y border-line bg-paper py-20 lg:py-32">
    <x-front.container>
        <div class="max-w-[680px]">
            <div class="flex items-center gap-2 text-sm font-semibold tracking-wide text-brand-mid">
                <span class="h-px w-7 bg-brand-mid"></span>
                {{ \App\Support\AboutContent::processEyebrow() }}
            </div>
            <h2 class="mt-6 text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">
                {{ \App\Support\AboutContent::processTitle() }}
            </h2>
        </div>

        <div class="mt-10 grid gap-6 [grid-template-columns:repeat(auto-fit,minmax(200px,1fr))]">
            @foreach ($steps as $step)
                <div class="rounded-lg border border-line bg-white p-6">
                    <div class="text-sm font-semibold tabular-nums text-muted">{{ $step['no'] }}</div>
                    <div class="mt-2 text-[19px] font-semibold text-brand">{{ $step['title'] }}</div>
                    <p class="mt-3 text-[15px] leading-[1.8] text-muted">{{ $step['body'] }}</p>
                </div>
            @endforeach
        </div>
    </x-front.container>
</section>
