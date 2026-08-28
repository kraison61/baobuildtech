@props(['hub'])

@php
    $phoneHref = \App\Support\Company::phoneHref();
    $phoneDisplay = \App\Support\Company::phoneDisplay();
    $lineUrl = \App\Support\Company::lineUrl();
    $lineId = \App\Support\Company::lineId();
@endphp

<section id="quote" class="scroll-mt-24 border-t border-line bg-brand py-20 text-white lg:py-32">
    <x-front.container>
        <div class="max-w-[760px]">
            <h2 class="text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-white">
                {{ $hub->ctaTitle() }}
            </h2>
            <p class="mt-6 text-[17px] leading-[1.8] text-sand">
                {{ $hub->ctaBody() }}
            </p>

            @if ($items = $hub->ctaPrepareItems())
                <ul class="mt-6 list-disc ps-6 text-[17px] leading-[1.8] text-sand">
                    @foreach ($items as $item)
                        <li class="mt-2">{{ $item }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="mt-10 flex flex-col gap-3 min-[520px]:flex-row min-[520px]:flex-wrap min-[520px]:gap-4">
                <a
                    href="{{ $phoneHref }}"
                    class="inline-flex w-full items-center justify-center rounded-lg bg-white px-6 py-4 text-[17px] font-semibold text-brand hover:bg-paper min-[520px]:w-auto"
                >
                    โทร {{ $phoneDisplay }}
                </a>
                @if ($lineUrl && $lineId)
                    <a
                        href="{{ $lineUrl }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex w-full items-center justify-center rounded-lg border border-sand/40 px-6 py-4 text-[17px] font-semibold text-white hover:bg-white/10 min-[520px]:w-auto"
                    >
                        LINE {{ $lineId }}
                    </a>
                @endif
                <a
                    href="{{ route('contact') }}"
                    class="inline-flex w-full items-center justify-center rounded-lg border border-sand/40 px-6 py-4 text-[17px] font-semibold text-white hover:bg-white/10 min-[520px]:w-auto"
                >
                    กรอกฟอร์มขอใบเสนอราคา
                </a>
            </div>
        </div>
    </x-front.container>
</section>
