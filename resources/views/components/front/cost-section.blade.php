@php
    $rows = [
        [
            'item' => 'คอนกรีตและเหล็กเสริม',
            'share' => '[34–40]%',
            'detail' => 'คอนกรีตผสมเสร็จ 280 ksc, เหล็ก SD40, ลวดผูก, ระยะหุ้มคอนกรีต',
        ],
        [
            'item' => 'ฐานรากและงานเข็ม',
            'share' => '[18–24]%',
            'detail' => 'เข็มเจาะหรือไมโครไพล์ ตัดหัวเข็ม เทลีน และ pile record',
        ],
        [
            'item' => 'ค่าแรงช่างและควบคุมงาน',
            'share' => '[20–26]%',
            'detail' => 'ทีมช่างประจำ โฟร์แมนหน้างาน และวิศวกรเข้าตรวจตามงวด',
        ],
        [
            'item' => 'ไม้แบบ ค้ำยัน และเครื่องจักร',
            'share' => '[8–12]%',
            'detail' => 'แบบเหล็ก/ไม้อัดเคลือบ นั่งร้าน รถแบคโฮ รถบด และค่าขนย้าย',
        ],
        [
            'item' => 'ทดสอบและเอกสาร',
            'share' => '[3–5]%',
            'detail' => 'ทดสอบลูกปูน ทดสอบการบดอัด แบบก่อสร้างจริง และหนังสือรับประกัน',
        ],
    ];
@endphp

<section id="cost" class="scroll-mt-24 bg-white py-16 lg:py-24">
    <x-front.container>
        <div class="max-w-[680px]">
            <h2 class="text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">โครงสร้างต้นทุน — เงินของคุณไปอยู่ที่อะไร</h2>
            <p class="mt-4 text-[17px] leading-[1.8] text-muted">สัดส่วนโดยประมาณจากงานกำแพงกันดินที่ผ่านมา ใบเสนอราคาจริงแยกทุกรายการตามปริมาณงานหน้างาน</p>
        </div>

        <div class="mt-10 overflow-x-auto">
            <table class="w-full min-w-[560px] border-collapse text-[17px]">
                <thead>
                    <tr>
                        <th class="border-b border-line py-3.5 pr-4 text-left font-semibold text-brand">รายการต้นทุน</th>
                        <th class="border-b border-line px-4 py-3.5 text-right font-semibold whitespace-nowrap text-brand">สัดส่วน</th>
                        <th class="border-b border-line py-3.5 pl-4 text-left font-semibold text-brand">สิ่งที่รวมอยู่ในรายการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows as $row)
                        <tr>
                            <td class="border-b border-line py-[18px] pr-4 text-ink">{{ $row['item'] }}</td>
                            <td class="border-b border-line px-4 py-[18px] text-right font-semibold whitespace-nowrap tabular-nums">{{ $row['share'] }}</td>
                            <td class="border-b border-line py-[18px] pl-4 leading-[1.7] text-muted">{{ $row['detail'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <p class="mt-6 max-w-[680px] text-[15px] leading-[1.8] text-muted">
            สัดส่วนเปลี่ยนตามความสูงกำแพง สภาพดิน และทางเข้าหน้างาน เราชี้แจงทุกบรรทัดก่อนเซ็นสัญญา และไม่คิดค่าใช้จ่ายเพิ่มโดยไม่มีเอกสารอนุมัติจากเจ้าของงาน
        </p>
    </x-front.container>
</section>
