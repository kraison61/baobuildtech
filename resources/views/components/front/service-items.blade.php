@props([
    'service',
    'items',
])

@if ($items->isNotEmpty())
    <section id="items" class="scroll-mt-24 bg-white py-16 lg:py-24">
        <x-front.container>
            <div class="max-w-[680px]">
                <h2 class="text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">
                    รายการงานภายใต้{{ $service->name }}
                </h2>
                <p class="mt-6 text-[17px] leading-[1.8] text-muted">
                    เลือกรูปแบบจากสภาพหน้างานและความต้องการใช้งาน ไม่ใช่จากราคาที่ถูกที่สุด
                </p>
            </div>

            <div class="mt-10 grid gap-6 [grid-template-columns:repeat(auto-fit,minmax(260px,1fr))]">
                @foreach ($items as $item)
                    <article class="scroll-mt-24 rounded-lg border border-line bg-white p-6">
                        @if ($item->cover_image)
                            <img
                                src="{{ $item->cover_image }}"
                                alt="{{ $item->name }}"
                                class="mb-5 aspect-4/3 w-full rounded-lg object-cover"
                                width="800"
                                height="600"
                                loading="lazy"
                            >
                        @endif
                        <h3 class="text-[22px] font-semibold text-brand">
                            <a href="{{ route('services.items.show', [$service->slug, $item->slug]) }}" class="hover:text-brand-mid">
                                {{ $item->name }}
                            </a>
                        </h3>
                        @if ($item->description)
                            <p class="mt-2 text-[17px] leading-[1.8] text-muted">{{ $item->description }}</p>
                        @endif

                        @if ($item->prices->isNotEmpty())
                            <dl class="mt-6 grid gap-3 border-t border-line pt-6 text-[15px] leading-[1.7]">
                                @foreach ($item->prices as $price)
                                    @php
                                        $min = $price->price_min !== null ? number_format((float) $price->price_min) : null;
                                        $max = $price->price_max !== null ? number_format((float) $price->price_max) : null;
                                        $unit = $price->price_unit ? ' '.$price->price_unit : '';
                                        if ($min && $max) {
                                            $display = $min.'–'.$max.$unit;
                                        } elseif ($min) {
                                            $display = 'เริ่ม '.$min.$unit;
                                        } else {
                                            $display = trim($unit) !== '' ? trim($unit) : 'สอบถาม';
                                        }
                                    @endphp
                                    <div class="flex justify-between gap-4">
                                        <dt class="text-muted">{{ $price->label }}</dt>
                                        <dd class="m-0 text-right font-semibold tabular-nums text-ink">{{ $display }}</dd>
                                    </div>
                                @endforeach
                            </dl>
                        @endif

                        <a
                            href="{{ route('services.items.show', [$service->slug, $item->slug]) }}"
                            class="mt-6 inline-flex border-b border-brand-mid pb-0.5 text-[15px] font-semibold text-brand-mid hover:text-brand"
                        >ดูรายละเอียด{{ $item->name }}</a>
                    </article>
                @endforeach
            </div>
        </x-front.container>
    </section>
@endif
