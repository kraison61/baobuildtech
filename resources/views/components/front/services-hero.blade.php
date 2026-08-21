@php
    $brand = config('company.brand_name');
    $lineUrl = \App\Support\Company::lineUrl();
@endphp

<section id="top" class="border-b border-line bg-paper">
    <div class="grid items-stretch min-[900px]:grid-cols-[54fr_46fr]">
        <div class="max-w-full px-5 pt-[clamp(80px,10vw,128px)] pb-[clamp(104px,12vw,168px)] min-[900px]:ps-[max(1.25rem,calc((100vw-1160px)/2))] min-[900px]:pe-[clamp(24px,4vw,64px)]">
            <div class="max-w-[680px]">
                <p class="text-[clamp(1.75rem,4vw,2.25rem)] font-semibold leading-tight tracking-tight text-brand">
                    {{ $brand }}
                </p>

                <div class="mt-4 flex items-center gap-2 text-sm font-semibold tracking-wide text-brand-mid">
                    <span class="h-px w-7 bg-brand-mid"></span>
                    งานโครงสร้างเป็นหลัก · ระบบเป็นเสริมในโครงการเดียวกัน
                </div>

                <h1 class="mt-6 text-[clamp(1.625rem,4.4vw,2.35rem)] font-semibold leading-[1.35] text-brand">
                    งานทั้งหมดที่เรารับ พร้อมสเปกที่ใช้จริงหน้างาน
                </h1>

                <p class="mt-6 text-[17px] leading-[1.8] text-muted">
                    กลุ่มงานด้านล่างคือขอบเขตที่ทีมช่างของเราทำเองทั้งกระบวนการ ไม่ส่งต่อผู้รับเหมาช่วง แต่ละงานระบุวัสดุ เกณฑ์ทดสอบ และเอกสารที่ส่งมอบ เพื่อให้เทียบใบเสนอราคาจากหลายเจ้าได้ตรงรายการ
                </p>

                <div class="mt-10 flex flex-wrap items-center gap-6">
                    <a
                        href="{{ $lineUrl ?? '#cta' }}"
                        class="inline-flex items-center rounded-lg bg-accent px-[26px] py-4 text-[17px] font-semibold text-white hover:bg-accent-dark hover:text-white"
                        @if ($lineUrl) target="_blank" rel="noopener noreferrer" @endif
                    >ส่งรูปหน้างาน ประเมินฟรี</a>
                    <a href="#scope" class="border-b border-brand-mid pb-0.5 text-[17px] font-semibold text-brand-mid hover:text-brand">ดูงานที่รับ / ไม่รับ</a>
                </div>

                <p class="mt-4 text-[15px] leading-[1.7] text-muted">
                    ตอบกลับภายใน [1] วันทำการ · ไม่มีค่าใช้จ่าย · ไม่โทรรบกวนหากไม่ได้ขอ
                </p>
            </div>
        </div>

        <img
            src="https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=1600&q=80&auto=format&fit=crop"
            alt="ภาพรวมหน้างานโครงสร้างระหว่างก่อสร้าง"
            class="block size-full min-h-[300px] object-cover"
            width="1600"
            height="1200"
        >
    </div>
</section>
