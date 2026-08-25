@php
    $phases = \App\Support\HomeContent::timelinePhases();
@endphp

<section id="phases" class="scroll-mt-24 border-y border-line bg-paper py-16 lg:py-24">
    <x-front.container>
        <div class="max-w-[720px]">
            <h2 class="text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">
                จากที่ดินเปล่าถึงวันเข้าอยู่ — 8 ขั้นตอนที่เราดูแลให้
            </h2>
        </div>

        {{-- overflow อยู่ wrapper ไม่ใช่ที่ ol — กัน justify/center ตัดหัวท้ายตอนเลื่อน --}}
        <div class="mt-10 overflow-x-auto pb-2 [scrollbar-width:thin]">
            <ol
                class="mx-auto flex w-max list-none items-stretch gap-3 p-0"
                aria-label="8 ขั้นตอนจากที่ดินเปล่าถึงวันเข้าอยู่"
            >
                @foreach ($phases as $index => $phase)
                    <li class="flex shrink-0 items-center gap-3">
                        <div class="flex h-full min-w-[9.5rem] max-w-[11rem] flex-col items-center rounded-lg border border-line bg-white px-3 py-4 text-center sm:min-w-[10.5rem]">
                            <div class="flex items-center justify-center gap-2 text-brand-mid">
                                <span class="grid size-7 shrink-0 place-items-center" aria-hidden="true">
                                    @switch ($phase['icon'])
                                        @case('clearing')
                                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M3 20h18" />
                                                <path d="M5 20V14l4-3 3 2 4-4 3 3v8" />
                                                <path d="M14 6l2-2 3 3-2 2" />
                                            </svg>
                                            @break
                                        @case('survey')
                                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M8 3h6l4 4v14a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1z" />
                                                <path d="M14 3v4h4" />
                                                <path d="M9 13h6M9 17h4" />
                                            </svg>
                                            @break
                                        @case('foundation')
                                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M4 20h16" />
                                                <path d="M7 20V11h3v9M14 20V11h3v9" />
                                                <path d="M5 11h14" />
                                                <path d="M8 7V4h8v3" />
                                            </svg>
                                            @break
                                        @case('structure')
                                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M4 20h16" />
                                                <path d="M6 20V9l6-5 6 5v11" />
                                                <path d="M10 20v-5h4v5" />
                                                <path d="M9 12h6" />
                                            </svg>
                                            @break
                                        @case('aluminium')
                                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="4" y="4" width="16" height="16" rx="1" />
                                                <path d="M12 4v16M4 12h16" />
                                            </svg>
                                            @break
                                        @case('mep')
                                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M10 2 5 13h4l-1 9 7-12h-4l1-8z" />
                                                <path d="M17.5 13.5c0 2-1.5 3.5-2.5 3.5s-2.5-1.5-2.5-3.5 1.8-3.8 2.5-4.5c.7.7 2.5 2.5 2.5 4.5z" />
                                            </svg>
                                            @break
                                        @case('it')
                                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="2" />
                                                <path d="M12 4v4M12 16v4M4 12h4M16 12h4" />
                                                <path d="M6.5 6.5 9 9M15 15l2.5 2.5M17.5 6.5 15 9M9 15l-2.5 2.5" />
                                            </svg>
                                            @break
                                        @case('handover')
                                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M12 3 5 6v5c0 4.5 3 8 7 9 4-1 7-4.5 7-9V6l-7-3z" />
                                                <path d="M9 12l2 2 4-4" />
                                            </svg>
                                            @break
                                    @endswitch
                                </span>
                                <span class="text-[13px] font-semibold tabular-nums">{{ $index + 1 }}</span>
                            </div>
                            <div class="mt-2 text-[14px] font-semibold leading-snug text-brand sm:text-[15px]">
                                {{ $phase['label'] }}
                            </div>
                        </div>
                        @if ($index < count($phases) - 1)
                            <span class="shrink-0 text-brand-mid" aria-hidden="true">→</span>
                        @endif
                    </li>
                @endforeach
            </ol>
        </div>

        <p class="mt-8 text-[17px] leading-[1.8] text-muted">
            รับครบทั้ง 8 ขั้นในสัญญาเดียว หรือเลือกจ้างเฉพาะบางขั้นก็ได้
        </p>
        <a href="{{ route('services') }}" class="mt-4 inline-block border-b border-brand-mid pb-0.5 text-[17px] font-semibold text-brand-mid hover:text-brand">
            ดูรายละเอียดแต่ละขั้นตอน
        </a>
    </x-front.container>
</section>
