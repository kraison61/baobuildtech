@props([
    'categories',
])

@php
    use App\Models\ServiceCategory;

    $isComplementary = static function (ServiceCategory $category): bool {
        return $category->slug === 'it'
            || str_contains((string) $category->description, 'บริการเสริม');
    };

    /** สเปกวัสดุ/เกณฑ์ต่อบริการ — ค่า placeholder แก้ทีหลังได้ */
    $specsBySlug = [
        'structure' => [
            ['label' => 'คอนกรีต', 'value' => 'กำลังอัด 280 ksc'],
            ['label' => 'เหล็กเสริม', 'value' => 'SD40 DB12–DB16'],
            ['label' => 'ฐานราก', 'value' => 'เข็มเจาะ Ø35 ซม.'],
            ['label' => 'ระบายน้ำหลังกำแพง', 'value' => 'ท่อ PVC + หินกรอง'],
            ['label' => 'เอกสารส่งมอบ', 'value' => 'แบบลงนาม + ผลทดสอบลูกปูน'],
        ],
        'piles-foundation' => [
            ['label' => 'ชนิดเข็ม', 'value' => 'เจาะ / ตอก / ไมโครไพล์'],
            ['label' => 'ทดสอบกำลังรับน้ำหนัก', 'value' => '[Dynamic Load Test]'],
            ['label' => 'ความคลาดเคลื่อนตำแหน่ง', 'value' => 'ไม่เกิน 5 ซม.'],
            ['label' => 'งานเสริมฐานรากเดิม', 'value' => 'ไมโครไพล์ในที่แคบ'],
            ['label' => 'เอกสารส่งมอบ', 'value' => 'Pile record ทุกต้น'],
        ],
        'survey' => [
            ['label' => 'ขอบเขต', 'value' => 'วางผัง · ระดับ · แนวโครงสร้าง'],
            ['label' => 'ก่อนเริ่มงาน', 'value' => 'สำรวจสภาพดินและทางเข้า'],
            ['label' => 'ระหว่างก่อสร้าง', 'value' => 'ตรวจแนวก่อนเทคอนกรีต'],
            ['label' => 'เอกสารส่งมอบ', 'value' => 'บันทึกระดับและผังหน้างาน'],
        ],
        'construction-mgmt' => [
            ['label' => 'แผนงาน', 'value' => 'งวดงานและจุดตรวจรับ'],
            ['label' => 'ควบคุมคุณภาพ', 'value' => 'วัสดุและขั้นตอนก่อสร้าง'],
            ['label' => 'รายงาน', 'value' => 'ภาพหน้างานรายสัปดาห์'],
            ['label' => 'เอกสารส่งมอบ', 'value' => 'แฟ้มส่งมอบครบชุด'],
        ],
        'sanitation' => [
            ['label' => 'ถังบำบัด', 'value' => 'ติดตั้งตามขนาดใช้งาน'],
            ['label' => 'ท่อระบายน้ำ', 'value' => 'รอบโครงสร้างและฐานราก'],
            ['label' => 'เป้าหมาย', 'value' => 'ลดน้ำขังและความชื้น'],
            ['label' => 'เอกสารส่งมอบ', 'value' => 'ผังแนวท่อจริง'],
        ],
        'electrical' => [
            ['label' => 'สายไฟ', 'value' => 'มอก. ร้อยท่อ EMT/HDPE'],
            ['label' => 'เงื่อนไข', 'value' => 'ทำร่วมกับงานโครงสร้าง'],
            ['label' => 'เอกสารส่งมอบ', 'value' => 'ผังเดินสายจริง'],
        ],
        'network-cabling' => [
            ['label' => 'แลน', 'value' => 'CAT6 พร้อมผลทดสอบสาย'],
            ['label' => 'ไฟเบอร์', 'value' => 'Single-mode สไปซ์ในตู้'],
            ['label' => 'เงื่อนไข', 'value' => 'ทำร่วมกับงานโครงสร้าง'],
            ['label' => 'เอกสารส่งมอบ', 'value' => 'ผลทดสอบสาย'],
        ],
        'cctv' => [
            ['label' => 'ขอบเขต', 'value' => 'สำรวจจุด · เดินสาย · ตั้งค่า'],
            ['label' => 'รุ่นกล้อง', 'value' => '[ยี่ห้อ/รุ่นตามที่ตกลง]'],
            ['label' => 'เงื่อนไข', 'value' => 'ทำร่วมกับงานโครงสร้าง'],
            ['label' => 'เอกสารส่งมอบ', 'value' => 'ผังจุดติดตั้ง + คู่มือ'],
        ],
    ];

    $formatPrice = static function ($price): string {
        $min = $price->price_min !== null ? number_format((float) $price->price_min) : null;
        $max = $price->price_max !== null ? number_format((float) $price->price_max) : null;
        $unit = $price->price_unit ? ' '.$price->price_unit : '';

        if ($min && $max) {
            return $min.'–'.$max.$unit;
        }

        if ($min) {
            return 'เริ่ม '.$min.$unit;
        }

        return trim($unit) !== '' ? trim($unit) : 'สอบถาม';
    };

    $lineUrl = \App\Support\Company::lineUrl();
    $index = 0;
@endphp

<section class="bg-white py-16 lg:py-24">
    <x-front.container class="grid gap-14">
        @forelse ($categories as $category)
            @php
                $complementary = $isComplementary($category);
            @endphp
            <div id="{{ $category->slug }}" class="scroll-mt-24">
                <div class="mb-8 max-w-[680px]">
                    @if ($complementary)
                        <div class="text-sm font-semibold tracking-wide text-brand-mid">บริการเสริม · {{ $category->name }}</div>
                        <h2 class="mt-2 text-[clamp(1.625rem,4vw,2rem)] font-semibold text-brand">
                            งานระบบในโครงการเดียวกัน
                        </h2>
                        <p class="mt-3 text-[17px] leading-[1.8] text-muted">
                            รับเฉพาะเมื่อทำร่วมกับงานโครงสร้าง ไม่รับงานระบบเดี่ยวแยกสัญญา
                        </p>
                    @else
                        <div class="text-sm font-semibold tracking-wide text-muted">{{ $category->name }}</div>
                        <h2 class="mt-2 text-[clamp(1.625rem,4vw,2rem)] font-semibold text-brand">
                            งานภายใต้{{ $category->name }}
                        </h2>
                        @if ($category->description)
                            <p class="mt-3 text-[17px] leading-[1.8] text-muted">{{ $category->description }}</p>
                        @endif
                    @endif
                </div>

                <div class="grid gap-10">
                    @foreach ($category->services as $service)
                        @php
                            $index++;
                            $specs = $specsBySlug[$service->slug] ?? [];
                            $visiblePrices = $service->prices;
                        @endphp
                        <article
                            id="{{ $service->slug }}"
                            class="scroll-mt-24 overflow-hidden rounded-lg border border-line bg-white"
                        >
                            <div class="grid min-h-[320px] min-[900px]:grid-cols-2">
                                <div @class([
                                    'relative min-h-[240px] overflow-hidden order-1',
                                    'min-[900px]:order-1' => $index % 2 === 1,
                                    'min-[900px]:order-2' => $index % 2 === 0,
                                ])>
                                    @if ($service->cover_image)
                                        <img
                                            src="{{ $service->cover_image }}"
                                            alt="{{ $service->name }}"
                                            class="absolute inset-0 block size-full object-cover"
                                            width="1200"
                                            height="900"
                                            loading="lazy"
                                        >
                                    @else
                                        <div class="absolute inset-0 bg-paper"></div>
                                    @endif
                                </div>

                                <div @class([
                                    'flex flex-col justify-center p-7 order-2 min-[900px]:p-[clamp(28px,4vw,52px)]',
                                    'min-[900px]:order-2' => $index % 2 === 1,
                                    'min-[900px]:order-1' => $index % 2 === 0,
                                ])>
                                    <div class="text-sm font-semibold text-muted tabular-nums">{{ str_pad((string) $index, 2, '0', STR_PAD_LEFT) }}</div>
                                    <h3 class="mt-2 text-[clamp(1.5rem,3.5vw,1.875rem)] font-semibold leading-[1.4] text-brand">
                                        <a href="{{ route('services.show', $service->slug) }}" class="hover:text-brand-mid">
                                            {{ $service->name }}
                                        </a>
                                    </h3>
                                    <p class="mt-4 max-w-[460px] text-[17px] leading-[1.8] text-muted">
                                        {{ $service->description }}
                                    </p>

                                    @if ($specs !== [])
                                        <dl class="mt-6 grid max-w-[460px] gap-3 border-t border-line pt-6 text-[15px] leading-[1.7]">
                                            @foreach ($specs as $spec)
                                                <div class="flex justify-between gap-4">
                                                    <dt class="text-muted">{{ $spec['label'] }}</dt>
                                                    <dd class="m-0 text-right font-semibold text-ink">{{ $spec['value'] }}</dd>
                                                </div>
                                            @endforeach
                                        </dl>
                                    @elseif ($visiblePrices->isNotEmpty())
                                        <dl class="mt-6 grid max-w-[460px] gap-3 border-t border-line pt-6 text-[15px] leading-[1.7]">
                                            @foreach ($visiblePrices as $price)
                                                <div class="flex justify-between gap-4">
                                                    <dt class="text-muted">{{ $price->label }}</dt>
                                                    <dd class="m-0 text-right font-semibold text-ink tabular-nums">{{ $formatPrice($price) }}</dd>
                                                </div>
                                            @endforeach
                                        </dl>
                                    @endif

                                    <div class="mt-6 flex flex-wrap items-center gap-x-6 gap-y-3">
                                        <a
                                            href="{{ route('services.show', $service->slug) }}"
                                            class="inline-flex self-start border-b border-brand-mid pb-0.5 text-[17px] font-semibold text-brand-mid hover:text-brand"
                                        >ดูรายละเอียด{{ $service->name }}</a>
                                        <a
                                            href="{{ $lineUrl ?? '#cta' }}"
                                            class="inline-flex self-start border-b border-line pb-0.5 text-[17px] font-semibold text-muted hover:text-brand"
                                            @if ($lineUrl) target="_blank" rel="noopener noreferrer" @endif
                                        >ส่งรูปประเมิน</a>
                                    </div>
                                </div>
                            </div>

                            @if ($service->items->isNotEmpty())
                                <div class="border-t border-line bg-paper/60 px-5 py-6 min-[900px]:px-8">
                                    <div class="text-[15px] font-semibold text-brand">รายการงานภายใต้{{ $service->name }}</div>
                                    <ul class="mt-4 grid list-none gap-3 p-0 min-[700px]:grid-cols-2">
                                        @foreach ($service->items as $item)
                                            <li class="rounded-lg border border-line bg-white p-4">
                                                <a href="{{ route('services.items.show', [$service->slug, $item->slug]) }}" class="block hover:text-brand-mid">
                                                    <div class="text-[16px] font-semibold text-brand">{{ $item->name }}</div>
                                                    @if ($item->description)
                                                        <p class="mt-2 text-[14px] leading-[1.7] text-muted">{{ $item->description }}</p>
                                                    @endif
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </article>
                    @endforeach
                </div>
            </div>
        @empty
            <p class="text-[17px] text-muted">ยังไม่มีข้อมูลบริการที่เผยแพร่</p>
        @endforelse
    </x-front.container>
</section>
