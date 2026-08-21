@php
    $services = [
        [
            'title' => 'กำแพงกันดิน คสล.',
            'body' => 'แบบ Cantilever และ Counterfort ตามความสูงดินและระยะร่นที่ดิน คำนวณแรงดันดินด้านหลังกำแพงก่อนกำหนดขนาดเหล็ก',
            'image' => 'https://images.unsplash.com/photo-1531834685032-c34bf0d84c77?w=1200&q=80&auto=format&fit=crop',
            'alt' => 'โครงเหล็กเสริมกำแพงและเสาระหว่างก่อสร้าง',
            'image_left' => true,
            'specs' => [
                ['label' => 'คอนกรีต', 'value' => 'กำลังอัด 280 ksc'],
                ['label' => 'เหล็กเสริม', 'value' => 'SD40 DB12–DB16'],
                ['label' => 'ฐานราก', 'value' => 'เข็มเจาะ Ø35 ซม.'],
                ['label' => 'ระบายน้ำหลังกำแพง', 'value' => 'ท่อ PVC + หินกรอง'],
            ],
        ],
        [
            'title' => 'งานฐานรากและเข็ม',
            'body' => 'ฐานรากอาคาร โรงงาน และงานเสริมฐานรากเดิมที่ทรุดตัว เลือกชนิดเข็มจากสภาพชั้นดินและข้อจำกัดทางเข้าหน้างาน',
            'image' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1200&q=80&auto=format&fit=crop',
            'alt' => 'งานเหล็กเสริมและไม้แบบฐานรากที่หน้างาน',
            'image_left' => false,
            'specs' => [
                ['label' => 'ชนิดเข็ม', 'value' => 'เจาะ / ตอก / ไมโครไพล์'],
                ['label' => 'ทดสอบกำลังรับน้ำหนัก', 'value' => '[Dynamic Load Test]'],
                ['label' => 'ความคลาดเคลื่อนตำแหน่ง', 'value' => 'ไม่เกิน 5 ซม.'],
                ['label' => 'รายงาน', 'value' => 'Pile record ทุกต้น'],
            ],
        ],
        [
            'title' => 'งานโยธาและปรับพื้นที่',
            'body' => 'ถมดิน บดอัด ลานคอนกรีต ถนน และระบบระบายน้ำรอบโครงการ ทดสอบความหนาแน่นทุกชั้นก่อนขึ้นชั้นถัดไป',
            'image' => 'https://images.unsplash.com/photo-1517089596392-fb9a9033e05b?w=1200&q=80&auto=format&fit=crop',
            'alt' => 'งานปรับพื้นที่และบดอัดดินด้วยเครื่องจักร',
            'image_left' => true,
            'specs' => [
                ['label' => 'ชั้นบดอัด', 'value' => '30 ซม./ชั้น'],
                ['label' => 'ความหนาแน่น', 'value' => '[≥ 95% Mod. Proctor]'],
                ['label' => 'ลานคอนกรีต', 'value' => 'หนา 15 ซม. + ตะแกรง'],
                ['label' => 'รอยต่อควบคุมรอยร้าว', 'value' => 'ทุก 3.0 ม.'],
            ],
        ],
    ];
@endphp

<section id="services" class="scroll-mt-24 border-y border-line bg-paper px-5 py-16 lg:py-24">
    <x-front.container>
        <div class="max-w-[680px]">
            <h2 class="text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">งานโครงสร้างที่เรารับ — พร้อมสเปกกำกับทุกรายการ</h2>
            <p class="mt-4 text-[17px] leading-[1.8] text-muted">โฟกัสงานกำแพงกันดิน ฐานราก และโยธา ที่ทีมช่างของเราทำเองทั้งกระบวนการ ไม่ส่งต่อผู้รับเหมาช่วง</p>
            <a href="{{ route('services') }}" class="mt-4 inline-block border-b border-brand-mid pb-0.5 text-[17px] font-semibold text-brand-mid hover:text-brand">ดูงานบริการทั้งหมด</a>
        </div>

        <div class="mt-10 grid gap-6">
            @foreach ($services as $service)
                <article class="grid min-h-[420px] overflow-hidden rounded-lg border border-line bg-white min-[900px]:grid-cols-2">
                    <div @class([
                        'relative min-h-[280px] overflow-hidden order-1',
                        'min-[900px]:order-1' => $service['image_left'],
                        'min-[900px]:order-2' => ! $service['image_left'],
                    ])>
                        <img
                            src="{{ $service['image'] }}"
                            alt="{{ $service['alt'] }}"
                            class="absolute inset-0 block size-full object-cover"
                            width="1200"
                            height="900"
                            loading="lazy"
                        >
                    </div>

                    <div @class([
                        'flex flex-col justify-center p-7 order-2 min-[900px]:p-[clamp(28px,4vw,52px)]',
                        'min-[900px]:order-2' => $service['image_left'],
                        'min-[900px]:order-1' => ! $service['image_left'],
                    ])>
                        <h3 class="text-[22px] font-semibold text-brand">{{ $service['title'] }}</h3>
                        <p class="mt-3 max-w-[460px] text-[17px] leading-[1.8] text-muted">{{ $service['body'] }}</p>
                        <dl class="mt-6 grid max-w-[460px] gap-4 border-t border-line pt-6 text-[15px] leading-[1.7]">
                            @foreach ($service['specs'] as $spec)
                                <div class="flex justify-between gap-4">
                                    <dt class="text-muted">{{ $spec['label'] }}</dt>
                                    <dd class="m-0 text-right font-semibold text-ink">{{ $spec['value'] }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>
                </article>
            @endforeach
        </div>

        <p class="mt-10 max-w-[680px] text-[15px] leading-[1.8] text-muted">
            บริการเสริมในโครงการเดียวกัน: ระบบไฟฟ้า ไฟเบอร์ LAN และ CCTV — เดินร้อยท่อไปพร้อมงานโครงสร้าง ไม่ต้องรื้อผิวคอนกรีตซ้ำ
            <a href="{{ route('services') }}" class="ms-1 border-b border-brand-mid pb-0.5 font-semibold text-brand-mid hover:text-brand">ดูรายละเอียดบริการเสริม</a>
        </p>
    </x-front.container>
</section>
