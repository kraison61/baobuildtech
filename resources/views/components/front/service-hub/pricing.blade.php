@props(['hub'])

@php
    /** @var \App\Contracts\ServiceHubContent $hub */
    $prices = $hub->visiblePrices();
@endphp

<section id="pricing" class="scroll-mt-24 border-y border-line bg-paper py-16 lg:py-24">
    <x-front.container>
        <x-front.service-hub.section-header
            :eyebrow="$hub->pricingEyebrow()"
            :title="$hub->pricingTitle()"
            :intro="$hub->pricingIntro()"
        />

        <div class="mt-10 overflow-hidden rounded-lg border border-line bg-white p-4 lg:p-6">
            <x-front.service-price-table
                :prices="$prices"
                :caption="$hub->pricingTitle()"
            />
        </div>

        @if ($hub->priceFactors() !== [])
            <div class="mt-10 rounded-lg border border-line bg-white p-6 lg:p-8">
                <h3 class="text-[17px] font-semibold text-brand">ปัจจัยที่ทำให้ราคาขยับ</h3>
                <ul class="mt-4 grid list-none gap-3 p-0 min-[700px]:grid-cols-3">
                    @foreach ($hub->priceFactors() as $factor)
                        <li class="flex gap-3 text-[15px] leading-[1.7] text-muted">
                            <span class="mt-2 size-1.5 shrink-0 rounded-full bg-brand-mid" aria-hidden="true"></span>
                            {{ $factor }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </x-front.container>
</section>
