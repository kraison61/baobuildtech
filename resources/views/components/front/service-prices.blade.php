@props([
    'service',
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
@endphp

<section id="price" class="scroll-mt-24 bg-brand py-20 text-white lg:py-32">
    <x-front.container>
        <div class="max-w-[680px]">
            <div class="flex items-center gap-2 text-sm font-semibold tracking-wide text-sand">
                <span class="h-px w-7 bg-sand"></span>
                ช่วงราคา
            </div>
            <h2 class="mt-6 text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-white">
                ราคาประมาณการงาน{{ $service->name }}
            </h2>
            <p class="mt-6 text-[17px] leading-[1.8] text-sand">
                ตัวเลขด้านล่างเป็นช่วงประมาณการจากงานที่เคยทำจริง ราคาขั้นสุดท้ายขึ้นกับสภาพหน้างาน ปริมาณงาน และข้อจำกัดทางเข้า
            </p>
        </div>

        <div class="mt-10 grid gap-6 [grid-template-columns:repeat(auto-fit,minmax(260px,1fr))]">
            @foreach ($prices as $price)
                <div class="rounded-lg border border-sand/30 p-6">
                    <h3 class="text-[22px] font-semibold text-white">{{ $price->label }}</h3>
                    <div class="mt-3 text-[clamp(1.375rem,2.5vw,1.75rem)] font-semibold tabular-nums text-white">
                        {{ $formatPrice($price) }}
                    </div>
                    @if ($price->note)
                        <p class="mt-3 text-[15px] leading-[1.7] text-sand">{{ $price->note }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    </x-front.container>
</section>
