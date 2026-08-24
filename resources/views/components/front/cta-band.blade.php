@props([
    'title' => 'ส่งรูปหน้างานมาประเมินก่อนตัดสินใจ',
    'body' => 'ตอบกลับภายใน [1] วันทำการ พร้อมข้อสังเกตทางวิศวกรรม — ไม่มีค่าใช้จ่าย และไม่โทรรบกวนหากไม่ได้ขอ',
    'variant' => 'paper',
])

@php
    $lineUrl = \App\Support\Company::lineUrl();
@endphp

<section
    @class([
        'py-14 lg:py-16',
        'border-y border-line bg-paper' => $variant === 'paper',
        'bg-white' => $variant === 'white',
        'bg-brand text-white' => $variant === 'brand',
    ])
>
    <x-front.container class="flex flex-col items-start justify-between gap-8 min-[800px]:flex-row min-[800px]:items-center">
        <div class="max-w-[640px]">
            <h2 @class([
                'text-[clamp(1.375rem,3vw,1.75rem)] font-semibold leading-[1.4]',
                'text-white' => $variant === 'brand',
                'text-brand' => $variant !== 'brand',
            ])>
                {{ $title }}
            </h2>
            <p @class([
                'mt-3 text-[17px] leading-[1.8]',
                'text-sand' => $variant === 'brand',
                'text-muted' => $variant !== 'brand',
            ])>
                {{ $body }}
            </p>
        </div>

        <a
            href="{{ $lineUrl ?? '#cta' }}"
            class="inline-flex shrink-0 items-center rounded-lg bg-accent px-[26px] py-4 text-[17px] font-semibold text-white hover:bg-accent-dark hover:text-white"
            @if ($lineUrl) target="_blank" rel="noopener noreferrer" @endif
        >ส่งรูปหน้างาน ประเมินฟรี</a>
    </x-front.container>
</section>
