<section id="work" class="pb-16 scroll-mt-24">
    <x-front.section-heading title="ผลงาน">
        <div class="flex gap-4 text-sm font-medium text-neutral-700">
            <span class="font-bold text-brand">ทั้งหมด</span>
            <span>ภาครัฐ</span>
            <span>โรงงาน</span>
            <span>อสังหาฯ</span>
        </div>
    </x-front.section-heading>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 mt-7">
        <x-front.portfolio-card
            category="ภาครัฐ · 2025"
            title="กำแพงกันดิน คสล. ริมคลอง 480 ม."
            description="เทศบาลนคร — งานเสาเข็มเจาะ ผนังกันดิน และราวกันตก ส่งมอบก่อนกำหนด 3 สัปดาห์"
        />
        <x-front.portfolio-card
            category="โรงงาน · 2026"
            title="รั้วรอบโรงงาน + AI CCTV 64 จุด"
            description="นิคมอุตสาหกรรม — รั้วตะแกรงเหล็กสูง 2.8 ม. พร้อมระบบตรวจจับการบุกรุกและอ่านป้ายทะเบียน"
        />
        <x-front.portfolio-card
            category="อสังหาฯ · 2026"
            title="ระบบอาคารส่วนกลาง โครงการ 320 ยูนิต"
            description="ผู้พัฒนาอสังหาริมทรัพย์ — BMS มิเตอร์พลังงานแยกอาคาร และระบบเข้าออกด้วยแอป"
            :span="true"
        />
    </div>
</section>
