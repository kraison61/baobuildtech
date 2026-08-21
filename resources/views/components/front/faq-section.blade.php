@php
    $faqs = [
        [
            'q' => 'ราคาประเมินยึดจากอะไร',
            'a' => 'ยึดจากปริมาณงานจริง — ความสูงและความยาวกำแพง ชนิดฐานราก และปริมาณดินที่ต้องบดอัด ใบเสนอราคาแยกรายการวัสดุ ค่าแรง และงานทดสอบให้เห็นทุกบรรทัด',
            'open' => true,
        ],
        [
            'q' => 'ใช้เวลาทำงานนานเท่าไร',
            'a' => 'กำแพงกันดินความยาว [60] เมตร ใช้เวลาประมาณ [28–35] วันทำการ รวมเวลาบ่มคอนกรีตตามข้อกำหนด เราไม่ลดเวลาบ่มเพื่อเร่งส่งมอบ',
        ],
        [
            'q' => 'เก็บมัดจำอย่างไร แบ่งงวดกี่งวด',
            'a' => 'มัดจำ [25]% เพื่อสั่งวัสดุและเข็ม งวดถัดไปจ่ายตามความคืบหน้าที่ตรวจรับแล้ว และงวดสุดท้าย [10]% หลังส่งมอบเอกสารครบ ทุกงวดมีใบเสร็จและเอกสารตรวจรับ',
        ],
        [
            'q' => 'รับงานพื้นที่ไหน',
            'a' => 'กรุงเทพฯ นนทบุรี ปทุมธานี สมุทรปราการ สมุทรสาคร และนครปฐม โครงการนอกพื้นที่พิจารณาเป็นรายกรณีตามขนาดงาน',
        ],
        [
            'q' => 'ถ้ากำแพงมีปัญหาหลังส่งมอบ',
            'a' => 'แจ้งได้ตลอดอายุรับประกัน [2] ปี เราเข้าตรวจหน้างานภายใน [3] วันทำการ และแจ้งสาเหตุพร้อมแนวทางแก้ไขเป็นเอกสาร งานที่อยู่ในขอบเขตรับประกันไม่มีค่าใช้จ่าย',
        ],
    ];
@endphp

<section id="faq" class="scroll-mt-24 border-t border-line bg-paper px-5 py-16 lg:py-24">
    <div class="mx-auto max-w-[680px]">
        <h2 class="text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">คำถามที่ลูกค้าถามก่อนตัดสินใจ</h2>

        <div class="mt-10 grid gap-4">
            @foreach ($faqs as $faq)
                <details class="group rounded-lg border border-line bg-white px-6 py-1" @if ($faq['open'] ?? false) open @endif>
                    <summary class="flex cursor-pointer list-none items-center justify-between gap-6 py-[18px] text-[17px] font-semibold text-brand [&::-webkit-details-marker]:hidden">
                        {{ $faq['q'] }}
                        <span class="text-[20px] leading-none text-brand-mid transition-transform duration-200 group-open:rotate-45" aria-hidden="true">+</span>
                    </summary>
                    <p class="m-0 pb-5 text-[17px] leading-[1.8] text-muted">{{ $faq['a'] }}</p>
                </details>
            @endforeach
        </div>
    </div>
</section>
