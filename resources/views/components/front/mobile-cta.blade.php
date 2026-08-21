@php
    $phoneHref = \App\Support\Company::phoneHref();
    $lineUrl = \App\Support\Company::lineUrl() ?? '#cta';
@endphp

<div class="h-[88px] min-[1100px]:hidden" aria-hidden="true"></div>

<div
    id="mobile-cta"
    class="fixed inset-x-0 bottom-0 z-[60] hidden items-stretch gap-4 border-t border-line bg-white px-4 py-3 min-[1100px]:hidden"
    data-mobile-cta
    hidden
>
    <a
        href="{{ $phoneHref }}"
        class="flex w-[34%] shrink-0 items-center justify-center gap-2 rounded-lg border border-brand-mid bg-paper text-[17px] font-semibold text-brand-mid hover:text-brand"
    >
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" aria-hidden="true">
            <path d="M5 4h4l2 5-2.5 1.5a11 11 0 005 5L15 13l5 2v4a1 1 0 01-1 1A16 16 0 014 5a1 1 0 011-1z" />
        </svg>
        โทร
    </a>
    <a
        href="{{ $lineUrl }}"
        class="flex flex-1 items-center justify-center rounded-lg bg-accent text-center text-[17px] font-semibold text-white hover:bg-accent-dark hover:text-white"
        @if (\App\Support\Company::lineUrl()) target="_blank" rel="noopener noreferrer" @endif
    >ส่งรูปหน้างาน</a>
</div>
