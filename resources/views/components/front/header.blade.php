@php
    $phoneDisplay = \App\Support\Company::phoneDisplay();
    $phoneHref = \App\Support\Company::phoneHref();
    $lineId = \App\Support\Company::lineId();
    $brand = config('company.brand_name');
    $mark = config('company.brand_mark');
    $navItems = config('navigation');
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
    <div class="mx-auto flex max-w-[1160px] items-center justify-between gap-3 px-5 py-3">
        <a href="{{ $homeHref }}" class="flex min-w-0 items-center gap-2 text-white hover:text-white" data-mobile-nav-link>
            <span class="grid size-[34px] shrink-0 place-items-center rounded-lg border border-sand/45 text-[13px] font-semibold tracking-wide">{{ $mark }}</span>
            <span class="truncate text-[17px] font-semibold">{{ $brand }}</span>
        </a>

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

        <div class="hidden items-center gap-3 min-[1100px]:flex">
            <a href="{{ $phoneHref }}" class="whitespace-nowrap text-[14px] text-white tabular-nums hover:text-white xl:text-[15px]">โทร {{ $phoneDisplay }}</a>
            <a href="{{ $ctaHref }}" class="inline-flex items-center rounded-lg bg-accent px-4 py-[11px] text-[14px] font-semibold whitespace-nowrap text-white hover:bg-accent-dark hover:text-white xl:px-[18px] xl:text-[15px]">ส่งรูปหน้างาน ประเมินฟรี</a>
        </div>

        <div class="flex items-center gap-2 min-[1100px]:hidden">
            <a href="{{ $phoneHref }}" class="inline-flex min-h-[46px] items-center rounded-lg border border-sand/45 px-3.5 text-[15px] text-white tabular-nums hover:text-white">{{ $phoneDisplay }}</a>
            <button
                type="button"
                class="grid size-[46px] shrink-0 place-items-center rounded-lg border border-sand/45 text-white"
                aria-label="เปิดเมนู"
                aria-expanded="false"
                aria-controls="mobile-menu"
                data-mobile-nav-toggle
            >
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" aria-hidden="true">
                    <path d="M4 7h16M4 12h16M4 17h16" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Mega menu เต็มความกว้าง (คล้าย theeraphong.com) --}}
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

    <nav
        id="mobile-menu"
        class="hidden max-h-[min(80vh,720px)] overflow-y-auto border-t border-sand/20 px-5 pt-2 pb-5 min-[1100px]:hidden"
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
            โทร {{ $phoneDisplay }}@if ($lineId) · ไลน์ {{ $lineId }}@endif
        </a>
        <a href="{{ $ctaHref }}" class="mt-1.5 flex items-center justify-center rounded-lg bg-accent px-5 py-4 text-[17px] font-semibold text-white hover:bg-accent-dark hover:text-white" data-mobile-nav-link>
            ส่งรูปหน้างาน ประเมินฟรี
        </a>
    </nav>
</header>
