@php
    $brand = config('company.brand_mark', 'BOA');
    $phoneHref = \App\Support\Company::phoneHref();
    $phoneDisplay = \App\Support\Company::phoneDisplay();
    $lineUrl = \App\Support\Company::lineUrl();
    $heroImageLabel = \App\Support\HomeContent::heroImageLabel();
    $heroImageAlt = \App\Support\HomeContent::heroImageAlt();
@endphp

<section id="top" class="bg-paper">
    <div class="grid items-stretch min-[900px]:grid-cols-[54fr_46fr]">
        <div class="max-w-full px-5 pt-[clamp(80px,10vw,128px)] pb-[clamp(64px,8vw,96px)] min-[900px]:ps-[max(1.25rem,calc((100vw-1160px)/2))] min-[900px]:pe-[clamp(24px,4vw,64px)]">
            <div class="max-w-[680px]">
                <p class="text-[clamp(1.75rem,4vw,2.25rem)] font-semibold leading-tight tracking-tight text-brand">
                    {{ $brand }}
                </p>

                <div class="mt-4 flex items-center gap-2 text-sm font-semibold tracking-wide text-brand-mid">
                    <span class="h-px w-7 bg-brand-mid"></span>
                    Build · Operate · Assure
                </div>

                <h1 class="mt-6 text-[clamp(1.625rem,4.4vw,2.35rem)] font-semibold leading-[1.35] text-brand">
                    {{ \App\Support\HomeContent::heroHeadline() }}
                </h1>

                <p class="mt-5 text-[18px] font-semibold leading-[1.55] text-ink sm:text-[19px]">
                    {{ \App\Support\HomeContent::heroLead() }}
                    <span class="mt-2 block text-brand-mid">{{ \App\Support\HomeContent::heroLeadAccent() }}</span>
                </p>

                <div class="mt-8 flex flex-wrap items-center gap-6">
                    <a
                        href="{{ $lineUrl ?? '#cta' }}"
                        class="inline-flex items-center rounded-lg bg-accent px-[26px] py-4 text-[17px] font-semibold text-white hover:bg-accent-dark hover:text-white"
                        @if ($lineUrl) target="_blank" rel="noopener noreferrer" data-cta="line" data-cta-source="home-hero" @endif
                    >{{ \App\Support\HomeContent::heroCtaPrimary() }}</a>
                    <a href="{{ $phoneHref }}" class="border-b border-brand-mid pb-0.5 text-[17px] font-semibold tabular-nums text-brand-mid hover:text-brand" data-cta="phone" data-cta-source="home-hero">{{ \App\Support\HomeContent::heroCtaPhone() }} {{ $phoneDisplay }}</a>
                </div>

                <p class="mt-4 text-[14px] leading-[1.7] text-muted sm:text-[15px]">
                    {{ \App\Support\HomeContent::heroNote() }}
                </p>

                <p class="mt-8 text-[17px] leading-[1.8] text-muted">
                    {{ \App\Support\HomeContent::heroBody1() }}
                </p>
                <p class="mt-4 text-[17px] leading-[1.8] text-muted">
                    {{ \App\Support\HomeContent::heroBody2() }}
                </p>
            </div>
        </div>

        <x-ui.image-slot
            src="{{ config('company.images_cdn') }}/assets/home-hero.webp"
            :label="$heroImageLabel"
            spec="1600×1200"
            ratio="none"
            :alt="$heroImageAlt"
            class="size-full min-h-[300px]"
            width="1600"
            height="1200"
            loading="eager"
            fetchpriority="high"
        />
    </div>
</section>
