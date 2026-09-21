@props([
    'service',
    'prices',
])

<section id="price" class="scroll-mt-24 bg-brand py-20 text-white lg:py-32">
    <x-front.container>
        <div class="max-w-[680px]">
            @if ($service->slug === 'townhouse')
                {{-- H2 ราคาอยู่ใน content แล้ว — ส่วนนี้แสดงแค่ตารางตัวเลข --}}
                <p class="text-sm font-semibold tracking-wide text-sand">สรุปช่วงราคาต่อตารางเมตร</p>
                <p class="mt-4 text-[17px] leading-[1.8] text-sand">
                    ตัวเลขด้านล่างเป็นช่วงประมาณการ 350–800 บาท/ตร.ม. จากงานที่ทำจริง ราคาสุดท้ายยืนยันหลังสำรวจหน้างาน
                </p>
            @else
                <div class="flex items-center gap-2 text-sm font-semibold tracking-wide text-sand">
                    <span class="h-px w-7 bg-sand"></span>
                    ช่วงราคา
                </div>
                <h2 class="mt-6 text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-white">
                    @if ($service->slug === 'house-demolition')
                        รื้อถอนบ้านราคาเท่าไหร่?
                    @else
                        ราคาประมาณการงาน{{ $service->name }}
                    @endif
                </h2>
                <p class="mt-6 text-[17px] leading-[1.8] text-sand">
                    @if ($service->slug === 'house-demolition')
                        ค่ารื้อถอนบ้านเดี่ยวชั้นเดียวโดยประมาณ 40,000–120,000 บาท/หลัง บ้านเดี่ยว 2 ชั้น 80,000–220,000 บาท/หลัง และทุบตึกแถว/ทาวน์เฮาส์ 350–800 บาท/ตร.ม. ตัวเลขเหล่านี้เป็นช่วงประมาณการจากงานที่ทำจริง ราคาสุดท้ายขึ้นกับสภาพหน้างานหลังสำรวจ
                    @else
                        ตัวเลขในตารางเป็นช่วงประมาณการจากงานที่เคยทำจริง ราคาขั้นสุดท้ายขึ้นกับสภาพหน้างาน ปริมาณงาน และข้อจำกัดทางเข้า
                    @endif
                </p>
            @endif
        </div>

        <div class="mt-10">
            <x-front.service.price-table
                :prices="$prices"
                :caption="'ตารางช่วงราคางาน'.$service->name"
                variant="dark"
            />
        </div>
    </x-front.container>
</section>
