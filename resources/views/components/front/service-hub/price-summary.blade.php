@props(['hub'])

@php
    /** @var \App\Contracts\ServiceHubContent $hub */
    $prices = $hub->visiblePrices();
@endphp

@if ($prices->isNotEmpty())
    <section class="relative z-[1] -mt-10 bg-transparent pb-10 lg:pb-12" aria-label="ช่วงราคาโดยสรุป">
        <x-front.container>
            <x-front.service-price-table
                :prices="$prices"
                :caption="$hub->pricingTitle()"
                variant="default"
                :limit="4"
            />
        </x-front.container>
    </section>
@endif
