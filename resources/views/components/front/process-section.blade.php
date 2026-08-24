@php
    $steps = [
        [
            'no' => '01',
            'title' => 'ส่งรูปหน้างาน ประเมินเบื้องต้น',
            'body' => 'ส่งรูปพื้นที่ ความสูงดิน และแนวเขตทางไลน์ ทีมช่างตอบกลับพร้อมข้อสังเกตภายใน [1] วันทำการ — ไม่มีค่าใช้จ่าย ไม่โทรรบกวนหากไม่ได้ขอ',
            'emphasis' => false,
        ],
        [
            'no' => '02',
            'title' => 'สำรวจหน้างานและสภาพดิน',
            'body' => 'วัดระดับ ตรวจการระบายน้ำ และประเมินชั้นดินเพื่อเลือกชนิดฐานราก ไม่มีค่าใช้จ่าย',
            'emphasis' => false,
        ],
        [
            'no' => '03',
            'title' => 'ตรวจสอบก่อนเทคอนกรีต',
            'body' => 'วิศวกรตรวจเหล็กเสริม ระยะหุ้ม ไม้แบบ และค้ำยัน พร้อมถ่ายภาพเป็นหลักฐาน เจ้าของงานเซ็นรับก่อนเทเสมอ — ถ้าไม่ผ่าน เราไม่เท',
            'emphasis' => true,
        ],
        [
            'no' => '04',
            'title' => 'ก่อสร้างและรายงานความคืบหน้า',
            'body' => 'รายงานภาพหน้างานรายสัปดาห์ พร้อมผลทดสอบวัสดุที่เกี่ยวข้องในแต่ละงวด',
            'emphasis' => false,
        ],
        [
            'no' => '05',
            'title' => 'ส่งมอบพร้อมเอกสารครบชุด',
            'body' => 'แบบก่อสร้างจริง ผลทดสอบ และหนังสือรับประกัน ส่งมอบเป็นแฟ้มเดียวให้เจ้าของงาน',
            'emphasis' => false,
        ],
    ];
@endphp

<section id="process" class="scroll-mt-24 border-b border-line bg-paper py-16 lg:py-24">
    <x-front.container>
        <div class="max-w-[680px]">
            <h2 class="text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">ขั้นตอนการทำงาน 5 ขั้น</h2>
            <p class="mt-4 text-[17px] leading-[1.8] text-muted">ขั้นที่ 3 คือขั้นที่แยกงานโครงสร้างที่ดีออกจากงานที่สวยแต่ผิว</p>
        </div>

        <ol class="mt-10 grid list-none gap-4 p-0">
            @foreach ($steps as $step)
                <li @class([
                    'grid grid-cols-[56px_minmax(0,680px)] items-start gap-6 rounded-lg border p-6',
                    'border-brand bg-brand' => $step['emphasis'],
                    'border-line bg-white' => ! $step['emphasis'],
                ])>
                    <span @class([
                        'grid size-10 place-items-center rounded-lg border font-semibold tabular-nums',
                        'border-sand/45 text-white' => $step['emphasis'],
                        'border-line text-brand-mid' => ! $step['emphasis'],
                    ])>{{ $step['no'] }}</span>
                    <div>
                        <h3 @class([
                            'text-[22px] font-semibold',
                            'text-white' => $step['emphasis'],
                            'text-brand' => ! $step['emphasis'],
                        ])>{{ $step['title'] }}</h3>
                        <p @class([
                            'mt-2 text-[17px] leading-[1.8]',
                            'text-sand' => $step['emphasis'],
                            'text-muted' => ! $step['emphasis'],
                        ])>{{ $step['body'] }}</p>
                    </div>
                </li>
            @endforeach
        </ol>
    </x-front.container>
</section>
