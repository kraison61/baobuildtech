@php
    $quotes = [
        '“ผู้รับเหมาเดิมบอกว่าไม่ต้องลงเข็ม ประหยัดกว่า ผ่านไปปีเดียวกำแพงเอนออกไปจากแนวเดิมประมาณหนึ่งฝ่ามือ”',
        '“ฝนตกหนักทีไรน้ำขังหลังกำแพงทุกครั้ง ไม่มีใครบอกว่าต้องมีท่อระบายและหินกรองด้านหลัง”',
        '“ราคาที่ตกลงกันไว้กับที่จ่ายจริงไม่ตรงกัน เพราะไม่มีใบแยกรายการว่าเงินไปอยู่ที่วัสดุหรือค่าแรงเท่าไร”',
    ];
@endphp

<section class="bg-white pt-16 pb-10 lg:pt-24 lg:pb-12">
    <x-front.container>
        <div class="mx-auto max-w-[620px]">
            <h2 class="text-center text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">
                สิ่งที่เจ้าของที่ดินลาดชันมักเจอ
            </h2>
            <div class="mt-10 grid gap-0 border-t border-line">
                @foreach ($quotes as $quote)
                    <p class="border-b border-line py-6 text-[17px] leading-[1.8] text-ink">{{ $quote }}</p>
                @endforeach
            </div>
        </div>
    </x-front.container>
</section>
