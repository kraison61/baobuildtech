@props([
    'prices',
])

@php
    $formatPrice = static function ($price): string {
        $min = $price->price_min !== null ? number_format((float) $price->price_min) : null;
        $max = $price->price_max !== null ? number_format((float) $price->price_max) : null;
        $unit = $price->price_unit ? ' '.$price->price_unit : '';

        if ($min && $max) {
            return $min.'–'.$max.$unit;
        }

        if ($min) {
            return 'เริ่ม '.$min.$unit;
        }

        return trim($unit) !== '' ? trim($unit) : 'สอบถาม';
    };

    $cards = $prices->take(4);
@endphp

@if ($cards->isNotEmpty())
    <section class="relative z-[1] -mt-10 bg-transparent pb-10 lg:pb-12" aria-label="ช่วงราคาโดยสรุป">
        <x-front.container>
            <div class="grid gap-6 [grid-template-columns:repeat(auto-fit,minmax(240px,1fr))]">
                @foreach ($cards as $price)
                    <div class="rounded-lg border border-line bg-white p-6">
                        <div class="text-[clamp(1.5rem,3vw,2.125rem)] font-semibold tabular-nums text-brand">
                            {{ $formatPrice($price) }}
                        </div>
                        <div class="mt-2 text-[15px] leading-[1.7] text-muted">{{ $price->label }}</div>
                    </div>
                @endforeach
            </div>
        </x-front.container>
    </section>
@endif
