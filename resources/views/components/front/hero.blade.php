@php
    $brand = config('company.brand_name');
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
                    ช่างเฉพาะทางงานโครงสร้าง · นนทบุรี &amp; ปริมณฑล
                </div>

                <h1 class="mt-6 text-[clamp(1.625rem,4.4vw,2.35rem)] font-semibold leading-[1.35] text-brand">
                    กำแพงกันดิน คสล. และงานฐานราก<br>
                    ที่คำนวณด้วยหลักวิศวกรรม ตรวจสอบได้ทุกชั้นงาน
                </h1>

                <p class="mt-6 text-[17px] leading-[1.8] text-muted">
                    ดินสไลด์ กำแพงเอน ร้าวตามแนวเสา — ปัญหาเหล่านี้เกิดจากฐานรากและการบดอัดที่ไม่ได้มาตรฐาน ไม่ใช่จากคอนกรีตที่ผิวสวย เราออกแบบเหล็กเสริมและระบบระบายน้ำหลังกำแพงตามสภาพดินจริงของหน้างานคุณ พร้อมรายงานทดสอบให้ตรวจสอบ
                </p>

                <p class="mt-4 text-[15px] leading-[1.7] text-brand-mid">
                    ก่อนฤดูฝน — ตรวจสภาพดินและแนวกำแพงให้ทัน ลดความเสี่ยงดินขยับซ้ำ
                </p>

                <div class="mt-10 flex flex-wrap items-center gap-6">
                    <a
                        href="{{ $lineUrl ?? '#cta' }}"
                        class="inline-flex items-center rounded-lg bg-accent px-[26px] py-4 text-[17px] font-semibold text-white hover:bg-accent-dark hover:text-white"
                        @if ($lineUrl) target="_blank" rel="noopener noreferrer" @endif
                    >ส่งรูปหน้างาน ประเมินฟรี</a>
                    <a href="{{ route('services') }}" class="border-b border-brand-mid pb-0.5 text-[17px] font-semibold text-brand-mid hover:text-brand">ดูสเปกงานของเรา</a>
                </div>

                <p class="mt-4 text-[15px] leading-[1.7] text-muted">
                    ตอบกลับภายใน [1] วันทำการ · ไม่มีค่าใช้จ่าย · ไม่โทรรบกวนหากไม่ได้ขอ
                </p>
            </div>
        </div>

        <img
            src="https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=1600&q=80&auto=format&fit=crop"
            alt="งานผูกเหล็กเสริมพื้นก่อนเทคอนกรีตที่หน้างาน"
            class="block size-full min-h-[300px] object-cover"
            width="1600"
            height="1200"
        >
    </div>
</section>
