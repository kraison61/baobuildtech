@php
    $photos = [
        ['src' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=900&q=80&auto=format&fit=crop', 'alt' => 'ช่างทำงานบนแผงเหล็กเสริมหน้างาน'],
        ['src' => 'https://images.unsplash.com/photo-1517581177682-a085bb7ffb15?w=900&q=80&auto=format&fit=crop', 'alt' => 'ไม้แบบและค้ำยันโครงสร้างคอนกรีต'],
        ['src' => 'https://images.unsplash.com/photo-1541976590-713941681591?w=900&q=80&auto=format&fit=crop', 'alt' => 'ผิวคอนกรีตหลังถอดแบบ'],
        ['src' => 'https://images.unsplash.com/photo-1508450859948-4e04fabaa4ea?w=900&q=80&auto=format&fit=crop', 'alt' => 'โครงสร้างคอนกรีตเสริมเหล็กระหว่างก่อสร้าง'],
    ];

    $stats = [
        ['value' => '280 ksc', 'label' => 'กำลังอัดคอนกรีตที่ 28 วัน พร้อมผลทดสอบลูกปูน'],
        ['value' => '[95]%', 'label' => 'ความหนาแน่นชั้นบดอัดขั้นต่ำที่ยอมรับหน้างาน'],
        ['value' => '[2] ปี', 'label' => 'รับประกันโครงสร้างเป็นลายลักษณ์อักษร'],
        ['value' => '[420]', 'label' => 'โครงการที่ส่งมอบในกรุงเทพฯ และปริมณฑล'],
    ];

    $testimonials = [
        [
            'quote' => '“กำแพงกันดินสูง 2.5 เมตร วิศวกรเข้าตรวจหน้างานทุกสัปดาห์ ส่งรูปเหล็กก่อนเทให้ดูทุกครั้ง เสร็จก่อนกำหนด 3 วัน”',
            'by' => 'คุณสมชาย ภักดี · กำแพงกันดิน บางใหญ่',
        ],
        [
            'quote' => '“ถมและบดอัดที่ดิน 4 ไร่ มีผลทดสอบความหนาแน่นให้ทุกชั้น ผ่านมา 3 ปี พื้นยังไม่ทรุดเป็นแอ่ง”',
            'by' => 'คุณมานพ ใจดี · งานถมดินและบดอัด บางบัวทอง',
        ],
    ];
@endphp

<section id="proof" class="scroll-mt-24 bg-brand px-5 py-20 text-white lg:pt-32 lg:pb-20">

    <x-front.container>
        <div class="max-w-[680px]">
            <div class="flex items-center gap-2 text-sm font-semibold tracking-wide text-sand">
                <span class="h-px w-7 bg-sand"></span>
                หลักฐานงาน
            </div>
            <h2 class="mt-6 text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-white">
                ดูที่เหล็กเสริม ไม้แบบ และผิวคอนกรีต ก่อนดูที่ราคา
            </h2>
            <p class="mt-4 text-[17px] leading-[1.8] text-sand">
                งานโครงสร้างตัดสินกันตอนก่อนเทคอนกรีต ภาพชุดนี้คือระยะเรียงเหล็ก ระยะหุ้มคอนกรีต และการค้ำยันไม้แบบจากหน้างานจริงของเรา
            </p>
        </div>

        <div class="mt-10 grid gap-4 [grid-template-columns:repeat(auto-fit,minmax(240px,1fr))]">
            @foreach ($photos as $photo)
                <img
                    src="{{ $photo['src'] }}"
                    alt="{{ $photo['alt'] }}"
                    class="block aspect-3/4 w-full rounded-lg object-cover"
                    width="900"
                    height="1200"
                    loading="lazy"
                >
            @endforeach
        </div>

        <div class="mt-10 grid overflow-hidden rounded-lg bg-sand/25 [grid-template-columns:repeat(auto-fit,minmax(200px,1fr))] gap-px">
            @foreach ($stats as $stat)
                <div class="bg-brand p-6">
                    <div class="text-[34px] font-semibold tabular-nums">{{ $stat['value'] }}</div>
                    <div class="mt-1.5 text-[15px] leading-[1.7] text-sand">{{ $stat['label'] }}</div>
                </div>
            @endforeach
        </div>

        <div class="mt-5 grid gap-6 [grid-template-columns:repeat(auto-fit,minmax(300px,1fr))]">
            @foreach ($testimonials as $item)
                <figure class="m-0 rounded-lg border border-sand/30 p-6">
                    <blockquote class="m-0 text-[17px] leading-[1.8] text-white">{{ $item['quote'] }}</blockquote>
                    <figcaption class="mt-4 text-[15px] text-sand">{{ $item['by'] }}</figcaption>
                </figure>
            @endforeach
        </div>
    </x-front.container>
</section>
