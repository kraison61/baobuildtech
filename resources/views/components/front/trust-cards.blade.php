@php
    $cards = [
        [
            'title' => 'คำนวณโดยหลักวิศวกรรม',
            'body' => 'แบบโครงสร้างระบุขนาดเหล็กเสริม ระยะเรียง และแรงดันดินด้านหลังกำแพง ลงนามโดยวิศวกรผู้ได้รับใบอนุญาต [เลขที่ใบ กว.]',
            'paths' => ['M3 20h18M6 20V9l6-4 6 4v11M10 20v-5h4v5'],
        ],
        [
            'title' => 'มีรายงานทดสอบการบดอัด',
            'body' => 'ทดสอบความหนาแน่นชั้นดินถมทุกระยะ 30 ซม. ตามเกณฑ์ [Field Density Test ≥ 95% Modified Proctor] ส่งผลทดสอบให้เจ้าของงานเก็บไว้',
            'paths' => ['M7 3h10v4H7zM5 7h14v14H5zM9 12h6M9 16h6'],
        ],
        [
            'title' => 'รับประกันเป็นลายลักษณ์อักษร',
            'body' => 'หนังสือรับประกันโครงสร้าง [2 ปี] ระบุขอบเขตความเสียหายที่ครอบคลุมและระยะเวลาเข้าแก้ไข ไม่ใช่คำรับปากทางโทรศัพท์',
            'paths' => ['M12 3l7 3v6c0 4-3 7-7 9-4-2-7-5-7-9V6z', 'M9 12l2 2 4-4'],
        ],
    ];
@endphp

<section class="relative z-[1] -mt-10 px-5 pb-12 lg:pb-16">
    <div class="mx-auto max-w-[1160px]">
        <p class="mb-6 text-center text-[15px] font-semibold tracking-wide text-brand-mid">
            สิ่งที่คุณจะได้ก่อนตัดสินใจจ้าง — ไม่ใช่แค่คำรับปาก
        </p>
        <div class="grid gap-6 [grid-template-columns:repeat(auto-fit,minmax(280px,1fr))]">
            @foreach ($cards as $card)
                <div class="rounded-lg border border-line bg-white p-6">
                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" class="text-brand-mid" aria-hidden="true">
                        @foreach ($card['paths'] as $path)
                            <path d="{{ $path }}" />
                        @endforeach
                    </svg>
                    <h3 class="mt-4 text-[22px] font-semibold text-brand">{{ $card['title'] }}</h3>
                    <p class="mt-2 text-[17px] leading-[1.8] text-muted">{{ $card['body'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
