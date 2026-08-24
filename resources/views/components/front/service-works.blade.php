@props([
    'service',
    'portfolios',
])

<section id="works" class="scroll-mt-24 border-t border-line bg-paper py-16 lg:py-24">
    <x-front.container>
        <div class="flex flex-wrap items-end justify-between gap-6">
            <div class="max-w-[680px]">
                <h2 class="text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">
                    ผลงานที่เกี่ยวข้องกับ{{ $service->name }}
                </h2>
                <p class="mt-4 text-[17px] leading-[1.8] text-muted">
                    ตัวอย่างงานที่ส่งมอบแล้วในขอบเขตบริการนี้
                </p>
            </div>

            @if ($portfolios->count() > 1)
                <div class="flex shrink-0 items-center gap-2" data-carousel-nav>
                    <button
                        type="button"
                        data-carousel-prev
                        class="grid size-10 place-items-center rounded-lg border border-line bg-white text-brand-mid transition hover:border-brand-mid hover:text-brand disabled:pointer-events-none disabled:opacity-40"
                        aria-label="เลื่อนผลงานก่อนหน้า"
                    >
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true">
                            <path d="M15 6l-6 6 6 6" />
                        </svg>
                    </button>
                    <button
                        type="button"
                        data-carousel-next
                        class="grid size-10 place-items-center rounded-lg border border-line bg-white text-brand-mid transition hover:border-brand-mid hover:text-brand disabled:pointer-events-none disabled:opacity-40"
                        aria-label="เลื่อนผลงานถัดไป"
                    >
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true">
                            <path d="M9 6l6 6-6 6" />
                        </svg>
                    </button>
                </div>
            @endif
        </div>

        <div class="relative mt-8" data-carousel>
            <div
                data-carousel-track
                class="flex snap-x snap-mandatory gap-4 overflow-x-auto scroll-smooth pb-2 [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden"
            >
                @foreach ($portfolios as $portfolio)
                    <article
                        data-carousel-slide
                        class="group flex w-[min(100%,280px)] shrink-0 snap-start flex-col overflow-hidden rounded-lg border border-line bg-white transition-colors hover:border-brand-mid min-[480px]:w-[300px] min-[768px]:w-[320px] min-[1024px]:w-[340px]"
                    >
                        <a href="{{ route('works') }}" class="block shrink-0 overflow-hidden">
                            @if ($portfolio->cover_image)
                                <img
                                    src="{{ $portfolio->cover_image }}"
                                    alt="{{ $portfolio->title }}"
                                    class="aspect-[5/3] w-full object-cover transition-transform duration-300 group-hover:scale-[1.02]"
                                    width="680"
                                    height="408"
                                    loading="lazy"
                                >
                            @else
                                <div class="aspect-[5/3] bg-paper" aria-hidden="true"></div>
                            @endif
                        </a>

                        <div class="flex flex-1 flex-col p-5">
                            @if ($portfolio->location || $portfolio->completed_at)
                                <div class="flex flex-wrap items-center gap-1.5 text-[12px] font-semibold">
                                    @if ($portfolio->location)
                                        <span class="rounded-md bg-paper px-2 py-0.5 text-brand-mid">{{ $portfolio->location->name }}</span>
                                    @endif
                                    @if ($portfolio->completed_at)
                                        <span class="rounded-md bg-paper px-2 py-0.5 tabular-nums text-muted">{{ $portfolio->completed_at->format('Y') }}</span>
                                    @endif
                                </div>
                            @endif

                            <h3 class="mt-3 text-[17px] font-semibold leading-snug text-brand">
                                <a href="{{ route('works') }}" class="line-clamp-2 hover:text-brand-mid">{{ $portfolio->title }}</a>
                            </h3>

                            @if ($portfolio->description)
                                <p class="mt-2 line-clamp-2 flex-1 text-[14px] leading-[1.65] text-muted">
                                    {{ $portfolio->description }}
                                </p>
                            @endif

                            @if ($portfolio->client_name)
                                <p class="mt-3 truncate text-[13px] text-muted">ลูกค้า · {{ $portfolio->client_name }}</p>
                            @endif

                            <a
                                href="{{ route('works') }}"
                                class="mt-4 inline-flex self-start border-b border-brand-mid pb-0.5 text-[14px] font-semibold text-brand-mid group-hover:text-brand"
                            >ดูรายละเอียด</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>

        <p class="mt-6 text-[15px] leading-[1.7] text-muted">
            <a href="{{ route('works') }}" class="border-b border-brand-mid pb-0.5 font-semibold text-brand-mid hover:text-brand">ดูผลงานทั้งหมด</a>
        </p>
    </x-front.container>
</section>
