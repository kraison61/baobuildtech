@php
    $jobTypes = \App\Support\ContactContent::jobTypes();
    $prepareItems = \App\Support\ContactContent::prepareItems();
    $areas = \App\Support\Company::serviceAreas(includeCountry: false);
    $lineId = \App\Support\Company::lineId();
    $lineUrl = \App\Support\Company::lineUrl();
    $phoneDisplay = \App\Support\Company::phoneDisplay();
    $sent = session('contact_sent', false);
    $lat = config('company.geo.lat');
    $lng = config('company.geo.lng');
    $mapsUrl = config('company.social.google_maps');
    $brand = config('company.brand_name');
@endphp

<section id="form" class="scroll-mt-24 bg-white pb-20 lg:pb-32">
    <x-front.container class="grid items-start gap-8 min-[900px]:grid-cols-[62fr_38fr] min-[900px]:gap-16">
        <div class="rounded-lg border border-line bg-white p-[clamp(28px,4vw,48px)]">
            <div class="flex items-center gap-2 text-sm font-semibold tracking-wide text-brand-mid">
                <span class="h-px w-7 bg-brand-mid"></span>
                ขอใบเสนอราคา
            </div>
            <h2 class="mt-6 text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">
                กรอกห้าช่อง เราจะโทรกลับพร้อมช่วงราคา
            </h2>
            <p class="mt-4 text-[17px] leading-[1.8] text-muted">
                ยิ่งบอกความสูงดินและขนาดพื้นที่ชัด เรายิ่งประเมินราคาได้ใกล้ความจริง
            </p>

            @if ($sent)
                <div class="mt-8 rounded-lg border border-brand-mid bg-paper p-6">
                    <div class="text-[19px] font-semibold text-brand">ได้รับข้อมูลแล้ว</div>
                    <p class="mt-3 text-[15px] leading-[1.8] text-muted">
                        ทีมช่างจะติดต่อกลับที่เบอร์ที่ให้ไว้ภายใน 1 วันทำการ ถ้าเร่งด่วน โทรมาที่ {{ $phoneDisplay }} ได้เลย
                    </p>
                </div>
            @else
                <form
                    method="post"
                    action="{{ route('contact.store') }}"
                    class="mt-8 grid gap-5"
                >
                    @csrf

                    <label class="grid gap-2 text-[15px] font-semibold text-ink">
                        ชื่อผู้ติดต่อ
                        <input
                            type="text"
                            name="name"
                            required
                            value="{{ old('name') }}"
                            placeholder="ชื่อ–นามสกุล"
                            class="min-h-12 w-full rounded-lg border border-line bg-white px-3.5 py-3 text-[17px] font-normal text-ink outline-none placeholder:text-[#9A958A] focus:border-brand-mid"
                        >
                        @error('name')
                            <span class="text-sm font-normal text-accent">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="grid gap-2 text-[15px] font-semibold text-ink">
                        เบอร์โทรที่ติดต่อได้
                        <input
                            type="tel"
                            name="phone"
                            required
                            inputmode="tel"
                            value="{{ old('phone') }}"
                            placeholder="08x-xxx-xxxx"
                            class="min-h-12 w-full rounded-lg border border-line bg-white px-3.5 py-3 text-[17px] font-normal tabular-nums text-ink outline-none placeholder:text-[#9A958A] focus:border-brand-mid"
                        >
                        @error('phone')
                            <span class="text-sm font-normal text-accent">{{ $message }}</span>
                        @enderror
                    </label>

                    <div class="grid gap-5 min-[900px]:grid-cols-2">
                        <label class="grid gap-2 text-[15px] font-semibold text-ink">
                            ประเภทงาน
                            <select
                                name="job"
                                required
                                class="min-h-12 w-full rounded-lg border border-line bg-white px-3.5 py-3 text-[17px] font-normal text-ink outline-none focus:border-brand-mid"
                            >
                                @foreach ($jobTypes as $type)
                                    <option value="{{ $type['value'] }}" @selected(old('job') === $type['value'])>{{ $type['label'] }}</option>
                                @endforeach
                            </select>
                            @error('job')
                                <span class="text-sm font-normal text-accent">{{ $message }}</span>
                            @enderror
                        </label>

                        <label class="grid gap-2 text-[15px] font-semibold text-ink">
                            ที่ตั้งหน้างาน
                            <input
                                type="text"
                                name="area"
                                required
                                value="{{ old('area') }}"
                                placeholder="อำเภอ/เขต จังหวัด"
                                class="min-h-12 w-full rounded-lg border border-line bg-white px-3.5 py-3 text-[17px] font-normal text-ink outline-none placeholder:text-[#9A958A] focus:border-brand-mid"
                            >
                            @error('area')
                                <span class="text-sm font-normal text-accent">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>

                    <label class="grid gap-2 text-[15px] font-semibold text-ink">
                        รายละเอียดหน้างาน
                        <textarea
                            name="detail"
                            rows="5"
                            placeholder="เช่น กำแพงกันดินยาว 40 ม. ดินสูงต่างระดับ 2.5 ม. ติดแนวเขตเพื่อนบ้าน มีทางเข้ารถบรรทุกหกล้อ"
                            class="w-full resize-y rounded-lg border border-line bg-white px-3.5 py-3 text-[17px] font-normal leading-[1.7] text-ink outline-none placeholder:text-[#9A958A] focus:border-brand-mid"
                        >{{ old('detail') }}</textarea>
                        @error('detail')
                            <span class="text-sm font-normal text-accent">{{ $message }}</span>
                        @enderror
                    </label>

                    <div class="mt-1 flex flex-wrap items-center gap-4">
                        <button
                            type="submit"
                            class="inline-flex min-h-[52px] items-center justify-center rounded-lg bg-accent px-[26px] text-[17px] font-semibold text-white hover:bg-accent-dark hover:text-white"
                        >ส่งข้อมูลขอประเมิน</button>
                        @if ($lineId)
                            <span class="text-[15px] leading-[1.7] text-muted">
                                หรือส่งรูปทางไลน์
                                @if ($lineUrl)
                                    <a href="{{ $lineUrl }}" target="_blank" rel="noopener noreferrer" class="font-semibold text-brand-mid hover:text-brand">{{ $lineId }}</a>
                                @else
                                    {{ $lineId }}
                                @endif
                                ได้เลย
                            </span>
                        @endif
                    </div>
                    <p class="m-0 text-sm leading-[1.7] text-muted">
                        ข้อมูลที่กรอกใช้สำหรับติดต่อกลับเรื่องงานนี้เท่านั้น เราไม่ส่งต่อให้บุคคลอื่น
                    </p>
                </form>
            @endif
        </div>

        <div class="grid gap-6">
            @if (is_numeric($lat) && is_numeric($lng))
                <div class="relative min-h-[clamp(280px,34vw,420px)] overflow-hidden rounded-lg border border-line bg-line">
                    <iframe
                        title="แผนที่ที่ตั้ง {{ $brand }}"
                        src="https://maps.google.com/maps?q={{ $lat }},{{ $lng }}&z=15&output=embed"
                        class="absolute inset-0 size-full border-0"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allowfullscreen
                    ></iframe>
                </div>
                @if ($mapsUrl)
                    <a
                        href="{{ $mapsUrl }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-block border-b border-brand-mid pb-0.5 text-[15px] font-semibold text-brand-mid hover:text-brand"
                    >เปิดใน Google Maps</a>
                @endif
            @elseif ($mapsUrl)
                <a
                    href="{{ $mapsUrl }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="grid min-h-[clamp(280px,34vw,380px)] place-items-center rounded-lg border border-line bg-paper p-8 text-center hover:border-brand-mid"
                >
                    <div>
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" class="mx-auto text-brand-mid" aria-hidden="true">
                            <path d="M12 21s7-6.2 7-11a7 7 0 10-14 0c0 4.8 7 11 7 11z" />
                            <circle cx="12" cy="10" r="2.6" />
                        </svg>
                        <div class="mt-4 text-[17px] font-semibold text-brand">เปิดแผนที่ Google Maps</div>
                        <p class="mt-2 text-[15px] leading-[1.8] text-muted">ดูที่ตั้งสำนักงานบนแผนที่</p>
                    </div>
                </a>
            @endif

            <div class="rounded-lg bg-brand p-6 text-white sm:p-8">
                <div class="text-[15px] font-semibold text-sand">เตรียมไว้ก่อนติดต่อ</div>
                <ul class="mt-4 grid list-none gap-3 p-0 text-[17px] leading-[1.7]">
                    @foreach ($prepareItems as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="rounded-lg border border-line bg-paper p-6 sm:p-8">
                <div class="text-[15px] font-semibold text-brand-mid">พื้นที่รับงาน</div>
                <p class="mt-4 text-[17px] leading-[1.8] text-ink">
                    {{ implode(' ', $areas) }}
                </p>
                <p class="mt-4 text-[15px] leading-[1.8] text-muted">
                    โครงการนอกพื้นที่พิจารณาเป็นรายกรณีตามขนาดงาน
                </p>
                <a href="{{ route('services') }}" class="mt-6 inline-block border-b border-brand-mid pb-0.5 text-[17px] font-semibold text-brand-mid hover:text-brand">
                    ดูขอบเขตงานที่เรารับ
                </a>
            </div>
        </div>
    </x-front.container>
</section>
