@props(['hub'])

@php
    /** @var \App\Contracts\ServiceHubContent $hub */
    $itemsByUrl = $hub->publishedItems()->keyBy(static fn ($item) => $item->url());
@endphp

<section id="services" class="scroll-mt-24 bg-white py-16 lg:py-24">
    <x-front.container>
        <x-front.service-hub.section-header
            :eyebrow="$hub->cardsEyebrow()"
            :title="$hub->cardsTitle()"
            :intro="$hub->cardsIntro()"
        />

        <div class="mt-10 grid gap-6 min-[700px]:grid-cols-2 lg:grid-cols-3">
            @foreach ($hub->cards() as $card)
                @php
                    $cardHref = url($card['href']);
                    $item = $itemsByUrl->get($cardHref);
                @endphp
                <article class="group flex flex-col overflow-hidden rounded-lg border border-line bg-white">
                    <a href="{{ $cardHref }}" class="relative block aspect-4/3 overflow-hidden">
                        <img
                            src="{{ $card['image'] }}"
                            alt="{{ $card['image_alt'] }}"
                            class="size-full object-cover transition duration-300 group-hover:scale-[1.03]"
                            width="800"
                            height="600"
                            loading="lazy"
                        >
                        <span class="absolute start-4 top-4 rounded-md bg-brand/90 px-2.5 py-1 text-[13px] font-semibold tabular-nums text-white">
                            {{ $card['no'] }}
                        </span>
                    </a>
                    <div class="flex flex-1 flex-col p-6">
                        <h3 class="text-[19px] font-semibold leading-[1.4] text-brand">
                            <a href="{{ $cardHref }}" class="hover:text-brand-mid">
                                {{ $card['title'] }}
                            </a>
                        </h3>
                        <p class="mt-3 flex-1 text-[15px] leading-[1.7] text-muted">{{ $card['body'] }}</p>

                        @if ($item?->prices->isNotEmpty())
                            <div class="mt-5 border-t border-line pt-5">
                                <x-front.service-price-table
                                    :prices="$item->prices"
                                    :caption="'ช่วงราคา'.$item->name"
                                    variant="inline"
                                />
                            </div>
                        @endif

                        <a
                            href="{{ $cardHref }}"
                            class="mt-5 inline-flex items-center gap-2 text-[15px] font-semibold text-brand-mid hover:text-brand"
                        >
                            ดูรายละเอียด
                            <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </x-front.container>
</section>
