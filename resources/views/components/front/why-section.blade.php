@php
    $reasons = \App\Support\HomeContent::reasons();
@endphp

<section id="why-boa" class="scroll-mt-24 bg-white py-16 lg:py-24">
    <x-front.container>
        <div class="max-w-[680px]">
            <h2 class="text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">
                ทำไมเจ้าของงานถึงเลือก BOA
            </h2>
        </div>

        <ol class="mt-10 grid max-w-[800px] list-none gap-0 border-t border-line p-0">
            @foreach ($reasons as $index => $reason)
                <li class="border-b border-line py-8">
                    <h3 class="text-[18px] font-semibold leading-snug text-brand sm:text-[19px]">
                        <span class="me-2 tabular-nums text-brand-mid">{{ $index + 1 }}.</span>{{ $reason['title'] }}
                    </h3>
                    <p class="mt-3 text-[17px] leading-[1.8] text-muted">{{ $reason['body'] }}</p>
                </li>
            @endforeach
        </ol>
    </x-front.container>
</section>
