@props([
    'title' => 'เล่าให้เราฟังก่อนก็ได้ ยังไม่ต้องตัดสินใจอะไรทั้งนั้น',
    'body' => 'ส่งรูปที่ดิน แบบบ้าน หรือรูปช่องประตูหน้าต่างที่อยากเปลี่ยน มาทางไลน์ เราจะดูให้ว่าเป็นไปได้แค่ไหน ต้องเตรียมงบประมาณเท่าไหร่ และมีอะไรควรระวังตั้งแต่ตอนนี้ ถ้าต้องการตัวเลขจริง เราเข้าไปดูหน้างานและทำใบเสนอราคาพร้อม BOQ ให้ โดยไม่มีค่าใช้จ่ายและไม่ผูกมัด',
    'variant' => 'brand',
    'withAnchor' => true,
])

@php
    $phoneDisplay = \App\Support\Company::phoneDisplay();
    $phoneHref = \App\Support\Company::phoneHref();
    $lineId = \App\Support\Company::lineId();
    $lineUrl = \App\Support\Company::lineUrl();
    $email = config('company.email');
    $address = \App\Support\Company::addressDisplay();
    $hours = \App\Support\Company::hoursDisplay();
@endphp

<section
    @if ($withAnchor) id="cta" @endif
    @class([
        'scroll-mt-24 py-20 lg:py-32',
        'bg-brand text-white' => $variant === 'brand',
        'border-t border-line bg-paper' => $variant === 'paper',
    ])
>
    <x-front.container>
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
            <div class="mt-10 flex flex-wrap justify-center gap-4">
                <a
                    href="{{ $lineUrl ?? '#cta' }}"
                    class="inline-flex items-center rounded-lg bg-accent px-[26px] py-4 text-[17px] font-semibold text-white hover:bg-accent-dark hover:text-white"
                    @if ($lineUrl) target="_blank" rel="noopener noreferrer" @endif
                >ทักไลน์ ส่งรูปหน้างาน ประเมินฟรี</a>
                <a
                    href="{{ $phoneHref }}"
                    @class([
                        'inline-flex items-center border-b pb-0.5 text-[17px] font-semibold tabular-nums',
                        'border-sand/50 text-white hover:text-white' => $variant === 'brand',
                        'border-brand-mid text-brand-mid hover:text-brand' => $variant === 'paper',
                    ])
                >โทรคุยกับวิศวกร {{ $phoneDisplay }}</a>
            </div>

            <ul @class([
                'mt-10 grid list-none gap-2 p-0 text-[15px] leading-[1.7] sm:text-[16px]',
                'text-sand' => $variant === 'brand',
                'text-muted' => $variant === 'paper',
            ])>
                <li>
                    โทร {{ $phoneDisplay }}
                    @if ($lineId)
                        · LINE {{ $lineId }}
                    @endif
                    @if ($email)
                        · อีเมล {{ $email }}
                    @endif
                </li>
                <li>เวลาทำการ {{ $hours }}@if ($address !== '') · ที่อยู่ {{ $address }}@endif</li>
            </ul>
        </div>
    </x-front.container>
</section>
