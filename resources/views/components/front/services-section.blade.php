@php
    $groups = \App\Support\HomeContent::serviceGroups();
@endphp

<section id="services" class="scroll-mt-24 border-b border-line bg-white py-16 lg:py-24">
    <x-front.container>
        <div class="max-w-[680px]">
            <h2 class="text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">บริการของเรา</h2>
        </div>

        <div class="mt-12 grid gap-10 min-[900px]:grid-cols-2 xl:grid-cols-4">
            @foreach ($groups as $group)
                <div>
                    <h3 class="border-b border-line pb-4 text-[18px] font-semibold text-brand">{{ $group['title'] }}</h3>
                    <ul class="mt-4 grid list-none gap-3 p-0">
                        @foreach ($group['items'] as $item)
                            <li>
                                <a href="{{ $item['href'] }}" class="text-[16px] leading-[1.6] text-brand-mid hover:text-brand sm:text-[17px]">
                                    {{ $item['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <p class="mt-10 max-w-[720px] text-[17px] leading-[1.8] text-muted">
            <strong class="font-semibold text-ink">รับเป็นงานเดี่ยวได้ทุกรายการ</strong>
            ไม่จำเป็นต้องจ้างครบวงจร ลูกค้าจำนวนมากเริ่มจากงานเล็กอย่างเปลี่ยนประตูหน้าต่างอลูมิเนียมหรือถมดินก่อน แล้วค่อยกลับมาคุยเรื่องงานใหญ่ทีหลัง
        </p>
    </x-front.container>
</section>
