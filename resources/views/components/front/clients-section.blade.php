<section class="mx-auto max-w-[1280px] px-5 lg:px-14 pb-14 lg:pb-16">
    <h2 class="font-display text-2xl lg:text-4xl font-semibold">ลูกค้าอ้างอิง</h2>
    <div class="grid grid-cols-3 sm:grid-cols-6 gap-4 mt-6">
        @foreach (range(1, 6) as $i)
            <div class="h-16 bg-neutral-200 grid place-items-center text-xs text-neutral-500">โลโก้</div>
        @endforeach
    </div>
    <div class="grid gap-6 md:grid-cols-2 mt-8">
        <blockquote class="bg-neutral-100 p-7">
            <p class="text-[17px] lg:text-lg leading-relaxed">“ทีมเข้าหน้างานตรงตามแผน ส่งรายงานทุกสัปดาห์ ทำให้เราปิดงวดงานกับผู้ว่าจ้างได้ไม่ติดขัด”</p>
            <footer class="text-sm text-neutral-500 mt-4">ผู้ควบคุมงาน · โครงการปรับปรุงริมคลอง</footer>
        </blockquote>
        <blockquote class="bg-neutral-100 p-7">
            <p class="text-[17px] lg:text-lg leading-relaxed">“วางท่อร้อยสายเผื่อไว้ตอนทำรั้ว ปีต่อมาเราเพิ่มกล้องอีก 20 ตัวโดยไม่ต้องรื้อพื้นเลย”</p>
            <footer class="text-sm text-neutral-500 mt-4">ฝ่ายวิศวกรรมโรงงาน · นิคมอุตสาหกรรม</footer>
        </blockquote>
    </div>
</section>
