@php
    $steps = \App\Support\HomeContent::processSteps();
    $areaText = \App\Support\HomeContent::serviceAreaText();
@endphp

<section id="process" class="scroll-mt-24 border-b border-line bg-white py-16 lg:py-24">
    <x-front.container>
        <div class="max-w-[680px]">
            <h2 class="text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">เริ่มงานกับเรายังไง</h2>
        </div>

        <ol class="mt-10 grid list-none gap-4 p-0">
            @foreach ($steps as $step)
                <li class="grid grid-cols-[56px_minmax(0,680px)] items-start gap-6 rounded-lg border border-line bg-white p-6">
                    <span class="grid size-10 place-items-center rounded-lg border border-line font-semibold tabular-nums text-brand-mid">{{ $step['no'] }}</span>
                    <div>
                        <h3 class="text-[20px] font-semibold text-brand sm:text-[22px]">{{ $step['title'] }}</h3>
                        <p class="mt-2 text-[17px] leading-[1.8] text-muted">{{ $step['body'] }}</p>
                    </div>
                </li>
            @endforeach
        </ol>

        <p class="mt-10 max-w-[720px] text-[17px] leading-[1.8] text-muted">
            {{ $areaText }}
        </p>
    </x-front.container>
</section>
