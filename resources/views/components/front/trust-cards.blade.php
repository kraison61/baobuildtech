@php
    /**
     * ลำดับตาม trust ladder (งานมูลค่าสูง):
     * 1 Authority → 2 Evidence → 3 Risk reversal
     */
    $steps = [
        [
            'num' => '01',
            'outcome' => 'ได้แบบลงนามวิศวกร',
            'title' => 'คำนวณโดยหลักวิศวกรรม',
            'body' => 'แบบโครงสร้างระบุขนาดเหล็กเสริม ระยะเรียง และแรงดันดินด้านหลังกำแพง ลงนามโดยวิศวกรผู้ได้รับใบอนุญาต [เลขที่ใบ กว.]',
        ],
        [
            'num' => '02',
            'outcome' => 'ได้รายงานทดสอบเก็บไว้',
            'title' => 'มีรายงานทดสอบการบดอัด',
            'body' => 'ทดสอบความหนาแน่นชั้นดินถมทุกระยะ 30 ซม. ตามเกณฑ์ [Field Density Test ≥ 95% Modified Proctor] ส่งผลทดสอบให้เจ้าของงาน',
        ],
        [
            'num' => '03',
            'outcome' => 'ได้หนังสือรับประกันชัดเจน',
            'title' => 'รับประกันเป็นลายลักษณ์อักษร',
            'body' => 'หนังสือรับประกันโครงสร้าง [2 ปี] ระบุขอบเขตความเสียหายที่ครอบคลุมและระยะเวลาเข้าแก้ไข — ไม่ใช่คำรับปากทางโทรศัพท์',
        ],
    ];
@endphp

{{-- ต่อจาก hero บนพื้น paper เดียวกัน = หน่วย “ข้อเสนอ + หลักฐาน” ตาม ELM (central route) --}}
<section class="border-b border-line bg-paper" aria-labelledby="trust-heading">
    <x-front.container class="py-[clamp(3rem,6vw,4.5rem)]">
        <header class="max-w-[40rem]">
            <div class="flex items-center gap-2 text-[14px] font-semibold tracking-wide text-brand-mid">
                <span class="h-px w-7 bg-brand-mid" aria-hidden="true"></span>
                เช็คลิสต์ก่อนตัดสินใจจ้าง
            </div>
            <h2 id="trust-heading" class="mt-4 text-[clamp(1.5rem,3.6vw,2rem)] font-semibold leading-[1.35] text-brand">
                3 สิ่งที่คุณจะได้ก่อนจ้าง — ไม่ใช่แค่คำรับปาก
            </h2>
            <p class="mt-4 text-[17px] leading-[1.75] text-muted">
                งานโครงสร้างตัดสินจากเอกสารที่ตรวจสอบได้ ใช้เทียบกับผู้รับเหมาที่รับปากอย่างเดียว — ถ้าไม่มีทั้งสามอย่าง ความเสี่ยงอยู่ที่เจ้าของงาน
            </p>
        </header>

        <ol class="mt-10 grid list-none gap-0 border-t border-line p-0 md:mt-12 md:grid-cols-3">
            @foreach ($steps as $index => $step)
                <li @class([
                    'border-b border-line py-8 md:border-b-0 md:px-8 md:py-10',
                    'md:border-e md:border-line' => $index < count($steps) - 1,
                    'md:ps-0' => $index === 0,
                    'md:pe-0' => $index === count($steps) - 1,
                ])>
                    <div class="flex items-baseline justify-between gap-4">
                        <span class="text-[13px] font-semibold tabular-nums tracking-wide text-brand-mid" aria-hidden="true">{{ $step['num'] }}</span>
                        <span class="text-[13px] font-semibold text-accent">{{ $step['outcome'] }}</span>
                    </div>
                    <h3 class="mt-4 text-[20px] font-semibold leading-snug text-brand sm:text-[22px]">
                        {{ $step['title'] }}
                    </h3>
                    <p class="mt-3 text-[16px] leading-[1.75] text-muted sm:text-[17px] sm:leading-[1.8]">
                        {{ $step['body'] }}
                    </p>
                </li>
            @endforeach
        </ol>

        <p class="mt-8 max-w-[40rem] text-[15px] leading-[1.7] text-brand-mid md:mt-10">
            ส่งรูปหน้างานมาประเมินฟรี — เราจะบอกว่าหน้างานคุณต้องใช้ข้อไหนจากทั้งสามข้อนี้ และขาดอะไรอยู่
        </p>
    </x-front.container>
</section>
