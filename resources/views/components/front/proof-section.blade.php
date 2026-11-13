@props([
    'portfolios' => collect(),
])

<section id="proof" class="scroll-mt-24 border-y border-line bg-paper py-20 lg:pt-28 lg:pb-20">
    <x-front.container>
        <div class="max-w-[680px]">
            <div class="flex items-center gap-2 text-sm font-semibold tracking-wide text-brand-mid">
                <span class="h-px w-7 bg-brand-mid"></span>
                {{ \App\Support\HomeContent::proofEyebrow() }}
            </div>
            <h2 class="mt-6 text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">
                {{ \App\Support\HomeContent::proofTitle() }}
            </h2>
            <p class="mt-4 text-[17px] leading-[1.8] text-muted">
                {{ \App\Support\HomeContent::proofLead() }}
            </p>
        </div>

        @if ($portfolios->isNotEmpty())
            <div class="mt-10 grid gap-6 [grid-template-columns:repeat(auto-fit,minmax(260px,1fr))]">
                @foreach ($portfolios as $portfolio)
                    @php $proofLabel = \App\Support\HomeContent::proofEyebrow().' — '.$portfolio->title; @endphp
                    <article class="overflow-hidden rounded-lg border border-line bg-white">
                        <a href="{{ $portfolio->url() }}" class="block hover:no-underline">
                            <x-ui.image-slot
                                :src="$portfolio->cover_image"
                                :label="$proofLabel"
                                spec="800×600"
                                ratio="4/3"
                                :alt="$portfolio->title"
                                class="w-full"
                                width="800"
                                height="600"
                                loading="lazy"
                            />
                            <div class="p-5">
                                <h3 class="text-[18px] font-semibold text-brand">{{ $portfolio->title }}</h3>
                                @if ($portfolio->location)
                                    <p class="mt-2 text-[15px] text-muted">
                                        {{ $portfolio->location->name }}
                                        @if ($portfolio->completed_at)
                                            · {{ \App\Support\HomeContent::proofDelivered() }} {{ $portfolio->completed_at->locale(app()->getLocale())->translatedFormat('M Y') }}
                                        @endif
                                    </p>
                                @endif
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        @else
            <p class="mt-10 max-w-[640px] text-[17px] leading-[1.8] text-muted">
                {{ \App\Support\HomeContent::proofEmpty() }}
            </p>
        @endif

        <div class="mt-10">
            <a href="{{ \App\Support\Locale::route('works') }}" class="inline-flex items-center border-b border-brand-mid pb-0.5 text-[17px] font-semibold text-brand-mid hover:text-brand">
                {{ \App\Support\HomeContent::proofCta() }}
            </a>
        </div>
    </x-front.container>
</section>
