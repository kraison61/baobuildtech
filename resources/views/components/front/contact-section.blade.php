@php
    $phoneE164 = config('company.phone');
    $phoneDisplay = preg_replace('/^\+66/', '0', $phoneE164);
    $phoneDisplay = preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1-$2-$3', $phoneDisplay);
    $address = config('company.address');
    $lineHandle = config('company.social.line');
@endphp

<section id="contact" class="mx-auto max-w-[1280px] px-5 lg:px-14 py-14 lg:py-16 scroll-mt-24">
    <div class="grid gap-10 lg:gap-14 lg:grid-cols-2">
        <div>
            <h2 class="font-display text-2xl lg:text-4xl font-semibold">ขอใบเสนอราคา</h2>
            <p class="mt-3 text-base leading-relaxed text-neutral-700">แนบแบบหรือ BOQ มาได้เลย ทีมประเมินราคาจะติดต่อกลับภายใน 1 วันทำการ</p>
            <form class="mt-7 grid gap-4 sm:grid-cols-2" action="#" method="post">
                @csrf
                <label class="flex flex-col gap-2 text-sm font-semibold text-neutral-800">ชื่อผู้ติดต่อ
                    <input type="text" name="name" class="h-12 border border-neutral-300 bg-white px-3 text-base font-normal outline-none focus:border-brand text-ink">
                </label>
                <label class="flex flex-col gap-2 text-sm font-semibold text-neutral-800">หน่วยงาน / บริษัท
                    <input type="text" name="company" class="h-12 border border-neutral-300 bg-white px-3 text-base font-normal outline-none focus:border-brand text-ink">
                </label>
                <label class="flex flex-col gap-2 text-sm font-semibold text-neutral-800">เบอร์โทร
                    <input type="tel" name="phone" class="h-12 border border-neutral-300 bg-white px-3 text-base font-normal outline-none focus:border-brand text-ink">
                </label>
                <label class="flex flex-col gap-2 text-sm font-semibold text-neutral-800">ประเภทงาน
                    <select name="job_type" class="h-12 border border-neutral-300 bg-white px-3 text-base font-normal outline-none focus:border-brand text-ink">
                        <option>รั้ว / งานโยธา</option>
                        <option>Smart Building / IoT</option>
                        <option>ทั้งสองส่วน</option>
                    </select>
                </label>
                <label class="flex flex-col gap-2 text-sm font-semibold text-neutral-800 sm:col-span-2">รายละเอียดงาน
                    <textarea name="details" rows="4" class="border border-neutral-300 bg-white p-3 text-base font-normal outline-none focus:border-brand text-ink"></textarea>
                </label>
                <div class="sm:col-span-2 flex flex-col sm:flex-row sm:items-center gap-4">
                    <button type="button" class="bg-brand text-white text-base font-semibold px-8 py-4 hover:bg-brand-dark">ส่งคำขอ</button>
                    <span class="text-sm text-neutral-500">หรือแนบไฟล์ทาง LINE: @baogroup</span>
                </div>
            </form>
        </div>
        <div class="flex flex-col gap-5">
            <div class="aspect-4/3 lg:aspect-3/2 bg-neutral-200 border border-dashed border-neutral-400 grid place-items-center text-sm text-neutral-500">แผนที่สำนักงาน</div>
            <div class="grid sm:grid-cols-2 gap-5 text-[15px] leading-relaxed text-neutral-800">
                <div>
                    <p class="font-bold">สำนักงาน</p>
                    <p class="text-neutral-600">
                        {{ $address['street'] }}<br>
                        {{ $address['district'] }} {{ $address['province'] }} {{ $address['postal_code'] }}
                    </p>
                </div>
                <div>
                    <p class="font-bold">ติดต่อ</p>
                    <p class="text-neutral-600">
                        โทร {{ $phoneDisplay }}<br>
                        @if ($lineHandle)
                            LINE: <a href="{{ $lineHandle }}" class="text-brand hover:text-brand-dark" target="_blank" rel="noopener noreferrer">@baogroup</a><br>
                        @endif
                        <a href="mailto:{{ config('company.email') }}" class="text-brand hover:text-brand-dark">{{ config('company.email') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
