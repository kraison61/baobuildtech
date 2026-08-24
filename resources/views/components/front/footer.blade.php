@php
    $phoneDisplay = \App\Support\Company::phoneDisplay();
    $lineId = \App\Support\Company::lineId();
    $address = config('company.address');
    $brand = config('company.brand_name');
    $legal = config('company.legal_name');
    $taxId = config('company.tax_id');
    $email = config('company.email');

    $services = [
        ['label' => 'สำรวจ', 'href' => route('services').'#survey'],
        ['label' => 'เสาเข็มและฐานราก', 'href' => route('services').'#piles-foundation'],
        ['label' => 'โครงสร้าง', 'href' => route('services').'#structure'],
        ['label' => 'ระบบไฟฟ้า', 'href' => route('services').'#electrical'],
        ['label' => 'สายสัญญาณ', 'href' => route('services').'#network-cabling'],
        ['label' => 'กล้องวงจรปิด', 'href' => route('services').'#cctv'],
    ];
@endphp

<footer class="border-t border-sand/20 bg-brand pt-16 pb-10 text-sand lg:pt-24">
    <x-front.container class="grid gap-10 [grid-template-columns:repeat(auto-fit,minmax(220px,1fr))]">
        <div class="max-w-[320px]">
            <div class="text-[17px] font-semibold text-white">{{ $brand }}</div>
            <p class="mt-3 text-[15px] leading-[1.8]">
                ช่างเฉพาะทางงานกำแพงกันดิน คสล. งานฐานราก และงานโยธา พร้อมงานระบบไฟฟ้า ไฟเบอร์ LAN และ CCTV เป็นบริการเสริมของโครงการ
            </p>
        </div>

        <div>
            <div class="text-[15px] font-semibold text-white">เมนู</div>
            <ul class="mt-3 grid list-none gap-2 p-0 text-[15px]">
                <li><a href="{{ route('home') }}" class="text-sand hover:text-white">หน้าแรก</a></li>
                <li><a href="{{ route('services') }}" class="text-sand hover:text-white">งานบริการ</a></li>
                <li><a href="{{ route('works') }}" class="text-sand hover:text-white">ผลงาน</a></li>
                <li><a href="{{ route('articles') }}" class="text-sand hover:text-white">บทความ</a></li>
                <li><a href="{{ route('gallery') }}" class="text-sand hover:text-white">คลังภาพผลงาน</a></li>
                <li><a href="{{ route('about') }}" class="text-sand hover:text-white">เกี่ยวกับเรา</a></li>
            </ul>
        </div>

        <div>
            <div class="text-[15px] font-semibold text-white">งานที่รับ</div>
            <ul class="mt-3 grid list-none gap-2 p-0 text-[15px]">
                @foreach ($services as $item)
                    <li>
                        <a href="{{ $item['href'] }}" class="text-sand hover:text-white">{{ $item['label'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div>
            <div class="text-[15px] font-semibold text-white">ติดต่อ</div>
            <ul class="mt-3 grid list-none gap-2 p-0 text-[15px]">
                <li>โทร {{ $phoneDisplay }}</li>
                @if ($lineId)
                    <li>ไลน์ {{ $lineId }}</li>
                @endif
                <li>{{ $email }}</li>
                <li>{{ $address['street'] }} {{ $address['district'] }} {{ $address['province'] }} {{ $address['postal_code'] }}</li>
            </ul>
        </div>

        <div>
            <div class="text-[15px] font-semibold text-white">เวลาทำการ</div>
            <ul class="mt-3 grid list-none gap-2 p-0 text-[15px]">
                <li>จันทร์–เสาร์ 8:00–18:00 น.</li>
                <li>รับงาน กทม. และปริมณฑล</li>
            </ul>
        </div>
    </x-front.container>

    <x-front.container class="mt-16 border-t border-sand/20 pt-6 text-sm">
        © {{ date('Y') }} {{ $legal }} · เลขผู้เสียภาษี {{ $taxId }}
    </x-front.container>
</footer>
