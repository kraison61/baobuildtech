@php
    $accept = [
        'กำแพงกันดินสูงไม่เกิน [4.0] เมตร',
        'ฐานรากอาคารและโรงงานขนาดกลาง',
        'งานเสริมฐานรากเดิมที่ทรุดตัว',
        'ถมและบดอัดที่ดินตั้งแต่ [1] ไร่ขึ้นไป',
        'งานระบบเมื่อทำร่วมกับงานโครงสร้างในโครงการเดียวกัน',
    ];

    $decline = [
        'งานที่เจ้าของงานไม่ต้องการให้ลงเข็มตามที่แบบกำหนด',
        'งานที่ขอลดเวลาบ่มคอนกรีตเพื่อเร่งส่งมอบ',
        'งานตกแต่งภายในและงานสถาปัตย์ทั่วไป',
        'งานระบบเดี่ยวที่ไม่มีงานโครงสร้างในโครงการ',
        'งานที่ไม่อนุญาตให้เก็บภาพก่อนเทคอนกรีตเป็นหลักฐาน',
    ];
@endphp

<section id="scope" class="scroll-mt-24 bg-brand px-5 py-16 text-white lg:py-24">
    <x-front.container>
        <div class="max-w-[680px]">
            <div class="flex items-center gap-2 text-sm font-semibold tracking-wide text-sand">
                <span class="h-px w-7 bg-sand"></span>
                ขอบเขตงาน — อ่านก่อนเลื่อนดูรายการ
            </div>
            <h2 class="mt-6 text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-white">
                งานที่เรารับ และงานที่เราบอกตรง ๆ ว่าไม่รับ
            </h2>
            <p class="mt-6 text-[17px] leading-[1.8] text-sand">
                การปฏิเสธงานที่ไม่ถนัดตั้งแต่ต้น ทำให้งานที่รับไว้เสร็จตามกำหนดและตรวจสอบได้จริง — รู้ขอบเขตก่อน แล้วค่อยดูสเปกรายบริการด้านล่าง
            </p>
        </div>

        <div class="mt-10 grid gap-6 min-[900px]:grid-cols-2">
            <div class="rounded-lg border border-sand/30 p-6">
                <div class="text-[15px] font-semibold text-sand">รับงาน</div>
                <ul class="mt-4 grid list-none gap-3 p-0 text-[17px] leading-[1.7]">
                    @foreach ($accept as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="rounded-lg border border-sand/30 p-6">
                <div class="text-[15px] font-semibold text-sand">ไม่รับงาน</div>
                <ul class="mt-4 grid list-none gap-3 p-0 text-[17px] leading-[1.7]">
                    @foreach ($decline as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <p class="mt-10 max-w-[680px] text-[15px] leading-[1.8] text-sand">
            พื้นที่รับงาน กรุงเทพฯ นนทบุรี ปทุมธานี สมุทรปราการ สมุทรสาคร และนครปฐม โครงการนอกพื้นที่พิจารณาเป็นรายกรณีตามขนาดงาน
        </p>
    </x-front.container>
</section>
