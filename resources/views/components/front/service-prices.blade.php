@props([
    'service',
    'prices',
])

<section id="price" class="scroll-mt-24 bg-brand py-20 text-white lg:py-32">
    <x-front.container>
        <div class="max-w-[680px]">
            <div class="flex items-center gap-2 text-sm font-semibold tracking-wide text-sand">
                <span class="h-px w-7 bg-sand"></span>
                ช่วงราคา
            </div>
            <h2 class="mt-6 text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-white">
                ราคาประมาณการงาน{{ $service->name }}
            </h2>
            <p class="mt-6 text-[17px] leading-[1.8] text-sand">
                ตัวเลขในตารางเป็นช่วงประมาณการจากงานที่เคยทำจริง ราคาขั้นสุดท้ายขึ้นกับสภาพหน้างาน ปริมาณงาน และข้อจำกัดทางเข้า
            </p>
        </div>

        <div class="mt-10">
            <x-front.service-price-table
                :prices="$prices"
                :caption="'ตารางช่วงราคางาน'.$service->name"
                variant="dark"
            />
        </div>
    </x-front.container>
</section>
