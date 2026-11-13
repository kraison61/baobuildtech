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
                        <x-ui.image-slot
                            :src="$item->cover_image"
                            :label="'รายการ — '.$item->name"
                            spec="800×600"
                            ratio="4/3"
                            :alt="$item->name"
                            class="mb-5 w-full rounded-lg"
                            width="800"
                            height="600"
                            loading="lazy"
                        />
                        <h3 class="text-[22px] font-semibold text-brand">
                            <a href="{{ $item->url() }}" class="hover:text-brand-mid">
                                {{ $item->name }}
                            </a>
                        </h3>
                        @if ($item->description)
                            <p class="mt-2 text-[17px] leading-[1.8] text-muted">{{ $item->description }}</p>
                        @endif

                        @if ($item->prices->isNotEmpty())
                            <div class="mt-6 border-t border-line pt-6">
                                <x-front.service-price-table
                                    :prices="$item->prices"
                                    :caption="'ช่วงราคา'.$item->name"
                                    variant="inline"
                                />
                            </div>
                        @endif

                        <a
                            href="{{ $item->url() }}"
                            class="mt-6 inline-flex border-b border-brand-mid pb-0.5 text-[15px] font-semibold text-brand-mid hover:text-brand"
                        >ดูรายละเอียด{{ $item->name }}</a>
                    </article>
                @endforeach
            </div>
        </x-front.container>
    </section>
@endif
