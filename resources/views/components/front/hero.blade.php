@php
    $brand = config('company.brand_mark', 'BOA');
    $phoneHref = \App\Support\Company::phoneHref();
    $phoneDisplay = \App\Support\Company::phoneDisplay();
    $lineUrl = \App\Support\Company::lineUrl();
@endphp

<section id="top" class="bg-paper">
    <div class="grid items-stretch min-[900px]:grid-cols-[54fr_46fr]">
        <div class="max-w-full px-5 pt-[clamp(80px,10vw,128px)] pb-[clamp(64px,8vw,96px)] min-[900px]:ps-[max(1.25rem,calc((100vw-1160px)/2))] min-[900px]:pe-[clamp(24px,4vw,64px)]">
            <div class="max-w-[680px]">
                <p class="text-[clamp(1.75rem,4vw,2.25rem)] font-semibold leading-tight tracking-tight text-brand">
                    {{ $brand }}
                </p>

                <div class="mt-4 flex items-center gap-2 text-sm font-semibold tracking-wide text-brand-mid">
                    <span class="h-px w-7 bg-brand-mid"></span>
                    Build · Assure · Operate
                </div>

                <h1 class="mt-6 text-[clamp(1.625rem,4.4vw,2.35rem)] font-semibold leading-[1.35] text-brand">
                    รับเหมาก่อสร้างครบวงจร กรุงเทพฯ และปริมณฑล — วิศวกรลงหน้างานเอง จบครบในสัญญาเดียว
                </h1>

                <p class="mt-5 text-[18px] font-semibold leading-[1.55] text-ink sm:text-[19px]">
                    ตั้งแต่ที่ดินเปล่าจนถึงวันเข้าอยู่ โครงสร้าง อลูมิเนียม ไฟฟ้า ประปา และระบบไอที อยู่ในความรับผิดชอบทีมเดียว
                    <span class="mt-2 block text-brand-mid">งวดงานผูกกับเนื้องานที่ตรวจได้ และทุกสัญญากันงวดสุดท้ายไว้จนหลังตรวจรับ</span>
                </p>

                <div class="mt-8 flex flex-wrap items-center gap-6">
                    <a
                        href="{{ $lineUrl ?? '#cta' }}"
                        class="inline-flex items-center rounded-lg bg-accent px-[26px] py-4 text-[17px] font-semibold text-white hover:bg-accent-dark hover:text-white"
                        @if ($lineUrl) target="_blank" rel="noopener noreferrer" @endif
                    >ส่งรูปหน้างานทางไลน์ — ประเมินราคาเบื้องต้นฟรี</a>
                    <a href="{{ $phoneHref }}" class="border-b border-brand-mid pb-0.5 text-[17px] font-semibold tabular-nums text-brand-mid hover:text-brand">โทรคุยกับวิศวกร {{ $phoneDisplay }}</a>
                </div>

                <p class="mt-4 text-[14px] leading-[1.7] text-muted sm:text-[15px]">
                    ประเมินหน้างานฟรีในกรุงเทพฯ-ปริมณฑล · ไม่ผูกมัด · ขอดูสำเนาใบอนุญาตวิศวกรได้ก่อนตัดสินใจ
                </p>

                <p class="mt-8 text-[17px] leading-[1.8] text-muted">
                    BOA (Build Assure Operate) คือทีมรับเหมาก่อสร้างครบวงจรในกรุงเทพฯ ปริมณฑล และรับงานทั่วประเทศ ดูแลตั้งแต่ถมดิน ออกแบบ งานโครงสร้าง งานอลูมิเนียมและกระจก จนถึงระบบไฟฟ้า ประปา และ IT Infrastructure ในสัญญาเดียว
                </p>
                <p class="mt-4 text-[17px] leading-[1.8] text-muted">
                    ทีมของเรามาจากคนทำงานจริงสามสาย — วิศวกรโยธาที่คุมงานมากว่า 20 ปี ผู้บริหารโครงการระดับองค์กร และผู้เชี่ยวชาญระบบเครือข่าย คุณจึงไม่ต้องเป็นคนกลางคอยประสานช่างหลายเจ้า และไม่ต้องรับความเสี่ยงเองเวลางานต่อไม่ติด
                </p>
            </div>
        </div>

        <img
            src="https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=1600&q=80&auto=format&fit=crop"
            alt="ทีมวิศวกร BOA ตรวจงานโครงสร้างบ้านพักอาศัย กรุงเทพฯ"
            class="block size-full min-h-[300px] object-cover"
            width="1600"
            height="1200"
        >
    </div>
</section>
