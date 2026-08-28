@props(['hub'])

<section id="portfolio" class="scroll-mt-24 border-y border-line bg-paper py-16 lg:py-24">
    <x-front.container>
        <div class="grid items-center gap-10 min-[900px]:grid-cols-2">
            @if ($image = $hub->portfolioImage())
                <img
                    src="{{ $image }}"
                    alt="{{ $hub->portfolioImageAlt() }}"
                    class="aspect-4/3 w-full rounded-lg object-cover"
                    width="1200"
                    height="900"
                    loading="lazy"
                >
            @endif

            <div class="max-w-[560px]">
                <x-front.service-hub.section-header
                    :eyebrow="$hub->portfolioEyebrow()"
                    :title="$hub->portfolioTitle()"
                    :intro="$hub->portfolioIntro()"
                />
                <p class="mt-4 text-[17px] leading-[1.8] text-muted">
                    {{ $hub->serviceAreaText() }}
                </p>
                <a
                    href="{{ $hub->portfolioWorksHref() }}"
                    class="mt-8 inline-flex items-center gap-2 rounded-lg bg-brand px-6 py-4 text-[17px] font-semibold text-white hover:bg-brand-mid"
                >
                    ดูผลงานทั้งหมด
                    <span aria-hidden="true">→</span>
                </a>
            </div>
        </div>
    </x-front.container>
</section>
