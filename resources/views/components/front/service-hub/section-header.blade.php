@props([
    'eyebrow',
    'title',
    'intro' => null,
])

<div class="max-w-[680px]">
    <div class="flex items-center gap-2 text-sm font-semibold tracking-wide text-brand-mid">
        <span class="h-px w-7 bg-brand-mid"></span>
        {{ $eyebrow }}
    </div>
    <h2 class="mt-6 text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">
        {{ $title }}
    </h2>
    @if ($intro)
        <p class="mt-6 text-[17px] leading-[1.8] text-muted">{{ $intro }}</p>
    @endif
</div>
