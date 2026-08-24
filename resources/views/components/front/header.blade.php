@php
    $phoneDisplay = \App\Support\Company::phoneDisplay();
    $phoneHref = \App\Support\Company::phoneHref();
    $lineId = \App\Support\Company::lineId();
    $lineUrl = \App\Support\Company::lineUrl();
    $brand = config('company.brand_name');
    $mark = config('company.brand_mark');
    $navItems = \App\Support\Navigation::items();
    $homeHref = route('home');
    $ctaHref = request()->routeIs(['home', 'services']) ? '#cta' : route('home').'#cta';

    $resolveHref = static function (string $href): string {
        if (str_starts_with($href, 'http') || str_starts_with($href, '#')) {
            return $href;
        }

        return url($href);
    };

    $isActive = static function (?string $routeName): bool {
        return $routeName !== null && request()->routeIs($routeName);
    };
@endphp

<header class="sticky top-0 z-50 border-b border-sand/18 bg-brand" data-mobile-nav>
    {{-- backdrop: เฉพาะมือถือ --}}
    <div
        class="fixed inset-0 z-40 hidden bg-ink/40 min-[1100px]:hidden"
        data-mobile-nav-backdrop
        hidden
        aria-hidden="true"
    ></div>

    <div class="relative z-[60] mx-auto flex max-w-[1160px] items-center justify-between gap-3 bg-brand px-5 py-3" data-mobile-nav-bar>
        <a href="{{ $homeHref }}" class="flex min-w-0 items-center gap-2 text-white hover:text-white" data-mobile-nav-link>
            <span class="grid size-[34px] shrink-0 place-items-center rounded-lg border border-sand/45 text-[13px] font-semibold tracking-wide">{{ $mark }}</span>
            <span class="truncate text-[17px] font-semibold">{{ $brand }}</span>
        </a>

        {{-- Desktop: เมนูแนวนอน --}}
        <nav class="hidden items-center gap-1 text-[14px] min-[1100px]:flex xl:gap-2 xl:text-[15px]" aria-label="เมนูหลัก">
            @foreach ($navItems as $item)
                @if (! empty($item['mega']) && ! empty($item['sections']))
                    <div class="relative" data-nav-mega>
                        <button
                            type="button"
                            class="inline-flex items-center gap-1 whitespace-nowrap rounded-lg px-2.5 py-2 text-sand hover:text-white {{ $isActive($item['route'] ?? null) ? 'text-white' : '' }}"
                            aria-expanded="false"
                            aria-haspopup="true"
                            data-nav-mega-toggle
                        >
                            {{ $item['label'] }}
                            <svg class="size-3.5 opacity-70 transition" data-nav-mega-chevron viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                                <path d="M2.5 4.5 6 8l3.5-3.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                @elseif (! empty($item['children']))
                    <div class="group relative" data-nav-dropdown>
                        <button
                            type="button"
                            class="inline-flex items-center gap-1 whitespace-nowrap rounded-lg px-2.5 py-2 text-sand hover:text-white {{ $isActive($item['route'] ?? null) ? 'text-white' : '' }}"
                            aria-expanded="false"
                            aria-haspopup="true"
                        >
                            {{ $item['label'] }}
                            <svg class="size-3.5 opacity-70 transition group-hover:rotate-180 group-focus-within:rotate-180" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                                <path d="M2.5 4.5 6 8l3.5-3.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                        <div class="invisible absolute start-0 top-full z-50 pt-2 opacity-0 transition group-hover:visible group-hover:opacity-100 group-focus-within:visible group-focus-within:opacity-100">
                            <div class="min-w-[240px] rounded-lg border border-line bg-white p-3 shadow-lg">
                                <ul class="grid list-none gap-1 p-0">
                                    @foreach ($item['children'] as $child)
                                        <li>
                                            <a href="{{ $resolveHref($child['href']) }}" class="block rounded-md px-3 py-2 text-[14px] text-muted hover:bg-paper hover:text-brand">
                                                {{ $child['label'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @else
                    <a
                        href="{{ $resolveHref($item['href']) }}"
                        @class([
                            'whitespace-nowrap rounded-lg px-2.5 py-2 text-sand hover:text-white',
                            'text-white' => $isActive($item['route'] ?? null),
                        ])
                    >{{ $item['label'] }}</a>
                @endif
            @endforeach
        </nav>

        {{-- Desktop: โทร + CTA --}}
        <div class="hidden items-center gap-3 min-[1100px]:flex">
            <a href="{{ $phoneHref }}" class="whitespace-nowrap text-[14px] text-white tabular-nums hover:text-white xl:text-[15px]">โทร {{ $phoneDisplay }}</a>
            <a href="{{ $ctaHref }}" class="inline-flex items-center rounded-lg bg-accent px-4 py-[11px] text-[14px] font-semibold whitespace-nowrap text-white hover:bg-accent-dark hover:text-white xl:px-[18px] xl:text-[15px]">ส่งรูปหน้างาน ประเมินฟรี</a>
        </div>

        {{-- Mobile: ไอคอนโทร / ไลน์ / hamburger --}}
        <div class="flex shrink-0 items-center gap-1.5 min-[1100px]:hidden sm:gap-2">
            <a
                href="{{ $phoneHref }}"
                class="grid size-[42px] shrink-0 place-items-center rounded-lg border border-sand/45 text-white hover:text-white sm:size-[46px]"
                aria-label="โทร {{ $phoneDisplay }}"
            >
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M5 4h4l2 5-2.5 1.5a11 11 0 005 5L15 13l5 2v4a1 1 0 01-1 1A16 16 0 014 5a1 1 0 011-1z" />
                </svg>
            </a>

            @if ($lineUrl || $lineId)
                <a
                    href="{{ $lineUrl ?? '#' }}"
                    class="grid size-[42px] shrink-0 place-items-center rounded-lg border border-sand/45 text-white hover:text-white sm:size-[46px]"
                    aria-label="ไลน์ {{ $lineId ?? '' }}"
                    @if ($lineUrl) target="_blank" rel="noopener noreferrer" @endif
                >
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63h2.386c.349 0 .63.285.63.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.286.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63.349 0 .631.285.631.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.348 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.281.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.121.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314" />
                    </svg>
                </a>
            @endif

            <button
                type="button"
                class="grid size-[42px] shrink-0 place-items-center rounded-lg border border-sand/45 text-white sm:size-[46px]"
                aria-label="เปิดเมนู"
                aria-expanded="false"
                aria-controls="site-menu"
                data-mobile-nav-toggle
            >
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" aria-hidden="true">
                    <path d="M4 7h16M4 12h16M4 17h16" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Desktop mega menu --}}
    @foreach ($navItems as $item)
        @if (! empty($item['mega']) && ! empty($item['sections']))
            <div
                class="hidden border-t border-line bg-white shadow-lg"
                data-nav-mega-panel
                hidden
            >
                <div class="mx-auto max-w-[1160px] px-5 py-8">
                    <div class="grid gap-10 lg:grid-cols-2">
                        @foreach ($item['sections'] as $section)
                            <section>
                                <div class="mb-5 flex items-end justify-between gap-4 border-b border-line pb-3">
                                    <div>
                                        <div class="text-sm font-semibold tracking-wide text-muted">หมวดหมู่งาน</div>
                                        <a href="{{ $resolveHref($section['href']) }}" class="text-[20px] font-semibold text-brand hover:text-brand-dark">
                                            {{ $section['label'] }}
                                        </a>
                                    </div>
                                </div>
                                <div class="grid gap-6 sm:grid-cols-2">
                                    @foreach ($section['groups'] as $group)
                                        <div>
                                            <a href="{{ $resolveHref($group['href']) }}" class="text-[15px] font-semibold text-brand hover:text-brand-dark">
                                                {{ $group['label'] }}
                                            </a>
                                            @if (! empty($group['children']))
                                                <ul class="mt-3 grid list-none gap-2 p-0">
                                                    @foreach ($group['children'] as $child)
                                                        <li>
                                                            <a href="{{ $resolveHref($child['href']) }}" class="block text-[14px] leading-[1.6] text-muted hover:text-brand">
                                                                {{ $child['label'] }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </section>
                        @endforeach
                    </div>
                    <div class="mt-8 flex flex-wrap items-center justify-between gap-4 border-t border-line pt-5">
                        <p class="text-[14px] text-muted">รวมงานโยธาและงานไอทีในโครงการเดียวกัน — ทีมช่างทำเองทั้งกระบวนการ</p>
                        <a href="{{ $resolveHref($item['href']) }}" class="inline-flex items-center gap-1 text-[15px] font-semibold text-brand-mid hover:text-brand">
                            ดูงานบริการทั้งหมด
                            <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    {{-- Mobile accordion menu --}}
    <nav
        id="site-menu"
        class="relative z-[60] hidden max-h-[calc(100dvh-4.5rem)] touch-pan-y overflow-y-auto overscroll-contain border-t border-sand/20 bg-brand px-5 pt-2 pb-[max(1.25rem,env(safe-area-inset-bottom))] min-[1100px]:hidden"
        data-mobile-nav-panel
        hidden
        aria-label="เมนูมือถือ"
    >
        <div class="grid gap-0.5">
            @foreach ($navItems as $item)
                @if (! empty($item['mega']) && ! empty($item['sections']))
                    <div class="border-b border-sand/18" data-nav-accordion>
                        <button
                            type="button"
                            class="flex w-full items-center justify-between gap-3 py-3.5 text-start text-[17px] text-white"
                            aria-expanded="false"
                            data-nav-accordion-toggle
                        >
                            <span>{{ $item['label'] }}</span>
                            <svg class="size-4 shrink-0 transition" data-nav-accordion-icon viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                                <path d="M2.5 4.5 6 8l3.5-3.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                        <div class="hidden pb-3 ps-1" data-nav-accordion-panel hidden>
                            <a href="{{ $resolveHref($item['href']) }}" class="block py-2.5 text-[15px] text-sand hover:text-white" data-mobile-nav-link>
                                ดูงานบริการทั้งหมด
                            </a>
                            @foreach ($item['sections'] as $section)
                                <div class="mt-2 border-t border-sand/12 pt-2" data-nav-accordion>
                                    <button
                                        type="button"
                                        class="flex w-full items-center justify-between gap-3 py-2.5 text-start text-[16px] font-semibold text-white"
                                        aria-expanded="false"
                                        data-nav-accordion-toggle
                                    >
                                        <span>{{ $section['label'] }}</span>
                                        <svg class="size-3.5 shrink-0 transition" data-nav-accordion-icon viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                                            <path d="M2.5 4.5 6 8l3.5-3.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                    <div class="hidden pb-2 ps-3" data-nav-accordion-panel hidden>
                                        <a href="{{ $resolveHref($section['href']) }}" class="block py-2 text-[15px] text-sand hover:text-white" data-mobile-nav-link>
                                            ดูทั้งหมด — {{ $section['label'] }}
                                        </a>
                                        @foreach ($section['groups'] as $group)
                                            <div class="border-t border-sand/10" data-nav-accordion>
                                                <button
                                                    type="button"
                                                    class="flex w-full items-center justify-between gap-3 py-2 text-start text-[15px] text-white"
                                                    aria-expanded="false"
                                                    data-nav-accordion-toggle
                                                >
                                                    <span>{{ $group['label'] }}</span>
                                                    <svg class="size-3 shrink-0 transition" data-nav-accordion-icon viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                                                        <path d="M2.5 4.5 6 8l3.5-3.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </button>
                                                <div class="hidden pb-2 ps-3" data-nav-accordion-panel hidden>
                                                    @foreach ($group['children'] ?? [] as $child)
                                                        <a href="{{ $resolveHref($child['href']) }}" class="block py-1.5 text-[14px] text-sand hover:text-white" data-mobile-nav-link>
                                                            {{ $child['label'] }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @elseif (! empty($item['children']))
                    <div class="border-b border-sand/18" data-nav-accordion>
                        <button
                            type="button"
                            class="flex w-full items-center justify-between gap-3 py-3.5 text-start text-[17px] text-white"
                            aria-expanded="false"
                            data-nav-accordion-toggle
                        >
                            <span>{{ $item['label'] }}</span>
                            <svg class="size-4 shrink-0 transition" data-nav-accordion-icon viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                                <path d="M2.5 4.5 6 8l3.5-3.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                        <div class="hidden pb-3 ps-3" data-nav-accordion-panel hidden>
                            @foreach ($item['children'] as $child)
                                <a href="{{ $resolveHref($child['href']) }}" class="block py-2 text-[15px] text-sand hover:text-white" data-mobile-nav-link>
                                    {{ $child['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a
                        href="{{ $resolveHref($item['href']) }}"
                        class="border-b border-sand/18 py-3.5 text-[17px] text-white hover:text-white"
                        data-mobile-nav-link
                    >{{ $item['label'] }}</a>
                @endif
            @endforeach
        </div>

        <a href="{{ $phoneHref }}" class="mt-2 block py-3.5 text-[17px] text-sand tabular-nums hover:text-white" data-mobile-nav-link>
            โทร {{ $phoneDisplay }}
        </a>
        @if ($lineUrl || $lineId)
            <a
                href="{{ $lineUrl ?? '#' }}"
                class="block py-3.5 text-[17px] text-sand hover:text-white"
                data-mobile-nav-link
                @if ($lineUrl) target="_blank" rel="noopener noreferrer" @endif
            >ไลน์ {{ $lineId ?? '' }}</a>
        @endif
        <a href="{{ $ctaHref }}" class="mt-1.5 flex items-center justify-center rounded-lg bg-accent px-5 py-4 text-[17px] font-semibold text-white hover:bg-accent-dark hover:text-white" data-mobile-nav-link>
            ส่งรูปหน้างาน ประเมินฟรี
        </a>
    </nav>
</header>
