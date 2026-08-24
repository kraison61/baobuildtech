@props([
    'service',
])

@php
    $brand = config('company.brand_name');
    $lineUrl = \App\Support\Company::lineUrl();
    $category = $service->category;
@endphp

<section id="top" class="border-b border-line bg-paper">
    <div class="grid items-stretch min-[900px]:grid-cols-[54fr_46fr]">
        <div class="max-w-full px-5 pt-[clamp(80px,10vw,128px)] pb-[clamp(104px,12vw,168px)] min-[900px]:ps-[max(1.25rem,calc((100vw-1160px)/2))] min-[900px]:pe-[clamp(24px,4vw,64px)]">
            <div class="max-w-[680px]">
                <p class="text-[clamp(1.75rem,4vw,2.25rem)] font-semibold leading-tight tracking-tight text-brand">
                    {{ $brand }}
                </p>

                <div class="mt-4 flex flex-wrap items-center gap-2 text-sm font-semibold tracking-wide text-muted">
                    <a href="{{ route('services') }}" class="text-brand-mid hover:text-brand">รวมงานบริการ</a>
                    <span aria-hidden="true">/</span>
                    @if ($category)
                        <a href="{{ route('services') }}#{{ $category->slug }}" class="text-brand-mid hover:text-brand">{{ $category->name }}</a>
                        <span aria-hidden="true">/</span>
                    @endif
                    <span>{{ $service->name }}</span>
                </div>

                <h1 class="mt-6 text-[clamp(1.625rem,4.4vw,2.35rem)] font-semibold leading-[1.35] text-brand">
                    {{ $service->name }}
                </h1>

                @if ($service->description)
                    <p class="mt-6 text-[17px] leading-[1.8] text-muted">
                        {{ $service->description }}
                    </p>
                @endif

                <div class="mt-10 flex flex-wrap items-center gap-6">
                    <a
                        href="{{ $lineUrl ?? '#cta' }}"
                        class="inline-flex items-center rounded-lg bg-accent px-[26px] py-4 text-[17px] font-semibold text-white hover:bg-accent-dark hover:text-white"
                        @if ($lineUrl) target="_blank" rel="noopener noreferrer" @endif
                    >ส่งรูปหน้างาน ประเมินฟรี</a>
                    @if ($service->items->isNotEmpty())
                        <a href="#items" class="border-b border-brand-mid pb-0.5 text-[17px] font-semibold text-brand-mid hover:text-brand">ดูรายการงาน</a>
                    @elseif ($service->prices->isNotEmpty())
                        <a href="#price" class="border-b border-brand-mid pb-0.5 text-[17px] font-semibold text-brand-mid hover:text-brand">ดูช่วงราคา</a>
                    @endif
                </div>

                <p class="mt-4 text-[15px] leading-[1.7] text-muted">
                    ตอบกลับภายใน [1] วันทำการ · ไม่มีค่าใช้จ่าย · ไม่โทรรบกวนหากไม่ได้ขอ
                </p>
            </div>
        </div>

        @if ($service->cover_image)
            <img
                src="{{ $service->cover_image }}"
                alt="{{ $service->name }}"
                class="block size-full min-h-[300px] object-cover"
                width="1600"
                height="1200"
            >
        @else
            <div class="min-h-[300px] bg-brand/10" aria-hidden="true"></div>
        @endif
    </div>
</section>
