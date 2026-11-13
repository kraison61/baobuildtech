@php
    $phoneDisplay = \App\Support\Company::phoneDisplay();
    $phoneHref = \App\Support\Company::phoneHref();
    $lineId = \App\Support\Company::lineId();
    $lineUrl = \App\Support\Company::lineUrl();
@endphp

<section id="cta" class="scroll-mt-24 border-t border-line bg-paper py-20 lg:py-32">
    <x-front.container>
        <div class="mx-auto max-w-[620px] text-center">
            <h2 class="text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">
                {{ \App\Support\AboutContent::ctaTitle() }}
            </h2>
            <p class="mt-6 text-[17px] leading-[1.8] text-muted">
                {{ \App\Support\AboutContent::ctaBody() }}
            </p>
            <div class="mt-10 flex justify-center">
                <a
                    href="{{ $lineUrl ?? route('contact') }}"
                    class="inline-flex items-center rounded-lg bg-accent px-[26px] py-4 text-[17px] font-semibold text-white hover:bg-accent-dark hover:text-white"
                    @if ($lineUrl) target="_blank" rel="noopener noreferrer" @endif
                >ส่งรูปหน้างาน ประเมินฟรี</a>
            </div>
            <div class="mt-6 flex flex-wrap justify-center gap-6 text-[17px]">
                <a href="{{ $phoneHref }}" class="border-b border-brand-mid pb-0.5 tabular-nums text-brand-mid hover:text-brand">โทร {{ $phoneDisplay }}</a>
                @if ($lineId)
                    <span class="text-muted">ไลน์ {{ $lineId }}</span>
                @endif
            </div>
        </div>
    </x-front.container>
</section>
