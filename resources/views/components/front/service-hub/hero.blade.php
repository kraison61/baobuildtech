@props([
    'hub',
])

@php
    /** @var \App\Contracts\ServiceHubContent $hub */
    $lineUrl = \App\Support\Company::lineUrl();
@endphp

<section id="top" class="border-b border-line bg-paper">
    <div class="grid items-stretch min-[900px]:grid-cols-[54fr_46fr]">
        <div class="max-w-full px-5 pt-10 pb-12 sm:pt-14 sm:pb-16 min-[900px]:pt-[clamp(80px,10vw,128px)] min-[900px]:pb-[clamp(80px,10vw,120px)] min-[900px]:ps-[max(1.25rem,calc((100vw-1160px)/2+1.25rem))] min-[900px]:pe-[clamp(24px,4vw,64px)]">
            <div class="max-w-[680px]">
                <div class="flex items-center gap-2 text-sm font-semibold tracking-wide text-brand-mid">
                    <span class="h-px w-7 bg-brand-mid"></span>
                    {{ $hub->heroEyebrow() }}
                </div>
                <h1 class="mt-6 text-[clamp(1.875rem,5.2vw,2.75rem)] font-semibold leading-[1.35] text-brand">
                    {{ $hub->heroTitle() }}
                </h1>
                <p class="mt-6 text-[17px] leading-[1.8] text-muted">
                    {{ $hub->heroLead() }}
                </p>

                <div class="mt-8 flex flex-col gap-4 min-[480px]:mt-10 min-[480px]:flex-row min-[480px]:flex-wrap min-[480px]:items-center min-[480px]:gap-6">
                    <a
                        href="{{ $lineUrl ?? '#quote' }}"
                        class="inline-flex w-full items-center justify-center rounded-lg bg-accent px-[26px] py-4 text-[17px] font-semibold text-white hover:bg-accent-dark hover:text-white min-[480px]:w-auto"
                        @if ($lineUrl) target="_blank" rel="noopener noreferrer" @endif
                    >ส่งรูปหน้างาน ประเมินฟรี</a>
                    <a href="{{ $hub->heroSecondaryCtaHref() }}" class="inline-flex w-full items-center justify-center border-b border-brand-mid pb-0.5 text-[17px] font-semibold text-brand-mid hover:text-brand min-[480px]:w-auto min-[480px]:justify-start">
                        {{ $hub->heroSecondaryCtaLabel() }}
                    </a>
                    @if ($hub->visiblePrices()->isNotEmpty())
                        <a href="#pricing" class="inline-flex w-full items-center justify-center border-b border-brand-mid pb-0.5 text-[17px] font-semibold text-brand-mid hover:text-brand min-[480px]:w-auto min-[480px]:justify-start">
                            ดูช่วงราคา
                        </a>
                    @endif
                </div>

                <p class="mt-4 text-[15px] leading-[1.7] text-muted">
                    ตอบกลับภายใน 1 วันทำการ · ไม่มีค่าใช้จ่าย
                </p>
            </div>
        </div>

        <x-ui.image-slot
            :src="$hub->heroImage()"
            :label="'Hero — '.$hub->breadcrumbLabel()"
            spec="1600×1200"
            ratio="none"
            :alt="$hub->heroImageAlt()"
            class="size-full min-h-[300px]"
            width="1600"
            height="1200"
            loading="eager"
            fetchpriority="high"
        />
    </div>
</section>
