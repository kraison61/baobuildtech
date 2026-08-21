@props([
    'title' => 'ส่งรูปหน้างานมาก่อน แล้วค่อยคุยเรื่องราคา',
    'body' => 'ส่งรูปพื้นที่ ความสูงดิน และแนวเขตที่ดินมาทางไลน์ ทีมช่างจะตอบกลับภายใน [1] วันทำการ พร้อมข้อสังเกตทางวิศวกรรมและช่วงราคาคร่าว ๆ ก่อนนัดเข้าสำรวจหน้างาน — ไม่มีค่าใช้จ่าย และไม่โทรรบกวนหากไม่ได้ขอ',
    'variant' => 'brand',
    'withAnchor' => true,
])

@php
    $phoneDisplay = \App\Support\Company::phoneDisplay();
    $phoneHref = \App\Support\Company::phoneHref();
    $lineId = \App\Support\Company::lineId();
    $lineUrl = \App\Support\Company::lineUrl();
@endphp

<section
    @if ($withAnchor) id="cta" @endif
    @class([
        'scroll-mt-24 px-5 py-20 lg:py-32',
        'bg-brand text-white' => $variant === 'brand',
        'border-t border-line bg-paper' => $variant === 'paper',
    ])
>
    <div class="mx-auto max-w-[680px] text-center">
        <h2 @class([
            'text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4]',
            'text-white' => $variant === 'brand',
            'text-brand' => $variant === 'paper',
        ])>
            {{ $title }}
        </h2>
        <p @class([
            'mt-6 text-[17px] leading-[1.8]',
            'text-sand' => $variant === 'brand',
            'text-muted' => $variant === 'paper',
        ])>
            {{ $body }}
        </p>
        <div class="mt-10 flex justify-center">
            <a
                href="{{ $lineUrl ?? '#cta' }}"
                class="inline-flex items-center rounded-lg bg-accent px-[26px] py-4 text-[17px] font-semibold text-white hover:bg-accent-dark hover:text-white"
                @if ($lineUrl) target="_blank" rel="noopener noreferrer" @endif
            >ส่งรูปหน้างาน ประเมินฟรี</a>
        </div>
        <p @class([
            'mt-4 text-[15px] leading-[1.7]',
            'text-sand/80' => $variant === 'brand',
            'text-muted' => $variant === 'paper',
        ])>
            ประเมินเบื้องต้นจากรูป · ไม่ผูกมัด · ไม่มีค่าใช้จ่าย
        </p>
        <div class="mt-6 flex flex-wrap justify-center gap-6 text-[17px]">
            <a
                href="{{ $phoneHref }}"
                @class([
                    'border-b pb-0.5 tabular-nums',
                    'border-sand/50 text-white hover:text-white' => $variant === 'brand',
                    'border-brand-mid text-brand-mid hover:text-brand' => $variant === 'paper',
                ])
            >โทร {{ $phoneDisplay }}</a>
            @if ($lineId)
                <span @class([
                    'text-sand' => $variant === 'brand',
                    'text-muted' => $variant === 'paper',
                ])>ไลน์ {{ $lineId }}</span>
            @endif
        </div>
    </div>
</section>
