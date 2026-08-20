@php
    $phoneE164 = config('company.phone');
    $phoneDisplay = preg_replace('/^\+66/', '0', $phoneE164);
    $phoneDisplay = preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1-$2-$3', $phoneDisplay);
    $phoneHref = 'tel:' . preg_replace('/\D/', '', $phoneDisplay);

    $navLinks = [
        ['label' => 'บริการ', 'href' => url('/') . '#services'],
        ['label' => 'ผลงาน', 'href' => url('/') . '#work'],
        ['label' => 'มาตรฐาน', 'href' => url('/') . '#standards'],
        ['label' => 'ขั้นตอนงาน', 'href' => url('/') . '#process'],
        ['label' => 'ทีมงาน', 'href' => url('/') . '#team'],
    ];
@endphp

<header class="sticky top-0 z-30 bg-paper/95 backdrop-blur border-b border-line" data-mobile-nav>
    <div class="mx-auto max-w-[1280px] px-5 lg:px-14 h-16 lg:h-20 flex items-center justify-between gap-4">
        <a href="{{ url('/') }}#top" class="flex items-center gap-3 shrink-0 text-ink hover:text-ink">
            <span class="grid size-9 place-items-center bg-brand text-white font-bold">B</span>
            <span class="flex flex-col leading-tight">
                <span class="text-base lg:text-lg font-bold tracking-wide">BAO</span>
                <span class="hidden sm:block text-[10px] tracking-[0.14em] text-neutral-500">BUILD · ASSURE · OPERATE</span>
            </span>
        </a>

        <nav class="hidden lg:flex gap-7 text-sm font-medium text-neutral-700" aria-label="เมนูหลัก">
            @foreach ($navLinks as $link)
                <a href="{{ $link['href'] }}" class="text-neutral-700 hover:text-brand-dark">{{ $link['label'] }}</a>
            @endforeach
        </nav>

        <div class="flex items-center gap-2 sm:gap-3">
            <a href="{{ $phoneHref }}" class="hidden md:block text-sm font-semibold text-brand hover:text-brand-dark">{{ $phoneDisplay }}</a>
            <a href="{{ url('/') }}#contact" class="hidden sm:block bg-brand text-white text-sm font-semibold px-4 py-2.5 lg:px-5 lg:py-3 hover:bg-brand-dark hover:text-white">ขอใบเสนอราคา</a>

            <button
                type="button"
                class="lg:hidden grid size-10 place-items-center border border-line text-ink hover:border-brand hover:text-brand"
                aria-label="เปิดเมนู"
                aria-expanded="false"
                aria-controls="mobile-menu"
                data-mobile-nav-toggle
            >
                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16" />
                </svg>
            </button>
        </div>
    </div>

    <div
        id="mobile-menu"
        class="lg:hidden hidden border-t border-line bg-paper"
        data-mobile-nav-panel
        hidden
    >
        <nav class="mx-auto max-w-[1280px] px-5 py-4 flex flex-col gap-1" aria-label="เมนูมือถือ">
            @foreach ($navLinks as $link)
                <a
                    href="{{ $link['href'] }}"
                    class="py-3 text-base font-medium text-neutral-800 border-b border-line last:border-b-0 hover:text-brand"
                    data-mobile-nav-link
                >{{ $link['label'] }}</a>
            @endforeach

            <div class="pt-4 mt-2 grid gap-3">
                <a href="{{ $phoneHref }}" class="text-center text-sm font-semibold text-brand border border-brand/30 py-3 hover:text-brand-dark">{{ $phoneDisplay }}</a>
                <a href="{{ url('/') }}#contact" class="text-center bg-brand text-white text-sm font-semibold py-3 hover:bg-brand-dark hover:text-white" data-mobile-nav-link>ขอใบเสนอราคา</a>
            </div>
        </nav>
    </div>
</header>

@once
    @push('scripts')
        <script>
            (() => {
                const root = document.querySelector('[data-mobile-nav]');
                if (!root) return;

                const toggle = root.querySelector('[data-mobile-nav-toggle]');
                const panel = root.querySelector('[data-mobile-nav-panel]');
                const links = root.querySelectorAll('[data-mobile-nav-link]');

                const setOpen = (open) => {
                    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
                    toggle.setAttribute('aria-label', open ? 'ปิดเมนู' : 'เปิดเมนู');
                    panel.hidden = !open;
                    panel.classList.toggle('hidden', !open);
                    document.documentElement.classList.toggle('overflow-hidden', open);
                };

                toggle.addEventListener('click', () => {
                    setOpen(toggle.getAttribute('aria-expanded') !== 'true');
                });

                links.forEach((link) => link.addEventListener('click', () => setOpen(false)));

                document.addEventListener('keydown', (event) => {
                    if (event.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
                        setOpen(false);
                        toggle.focus();
                    }
                });

                window.matchMedia('(min-width: 1024px)').addEventListener('change', (event) => {
                    if (event.matches) setOpen(false);
                });
            })();
        </script>
    @endpush
@endonce
