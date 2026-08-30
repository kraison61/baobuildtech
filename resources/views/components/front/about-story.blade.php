@php
    $paragraphs = \App\Support\AboutContent::storyParagraphs();
@endphp

<section id="story" class="bg-white pb-16 lg:pb-24">
    <x-front.container>
        <div class="grid min-h-[420px] overflow-hidden rounded-lg border border-line bg-white min-[900px]:grid-cols-2">
            <div class="relative order-1 min-h-[280px] overflow-hidden min-[900px]:order-0">
                <x-ui.image-slot
                    :src="\App\Support\AboutContent::storyImage()"
                    label="เรื่องราว BOA"
                    spec="1200×900"
                    ratio="none"
                    :alt="\App\Support\AboutContent::storyImageAlt()"
                    class="absolute inset-0 size-full min-h-[280px]"
                    width="1200"
                    height="900"
                    loading="lazy"
                />
            </div>
            <div class="order-2 flex flex-col justify-center p-[clamp(28px,4vw,52px)]">
                <div class="flex items-center gap-2 text-sm font-semibold tracking-wide text-brand-mid">
                    <span class="h-px w-7 bg-brand-mid"></span>
                    {{ \App\Support\AboutContent::storyEyebrow() }}
                </div>
                <h2 class="mt-6 text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">
                    {{ \App\Support\AboutContent::storyTitle() }}
                </h2>
                @foreach ($paragraphs as $paragraph)
                    <p class="mt-4 max-w-[460px] text-[17px] leading-[1.8] text-muted">{{ $paragraph }}</p>
                @endforeach
                <a href="{{ route('services') }}" class="mt-6 self-start border-b border-brand-mid pb-0.5 text-[17px] font-semibold text-brand-mid hover:text-brand">
                    ดูขอบเขตงานที่เรารับ
                </a>
            </div>
        </div>
    </x-front.container>
</section>
