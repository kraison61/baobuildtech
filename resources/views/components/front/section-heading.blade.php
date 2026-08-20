@props([
    'title',
    'subtitle' => null,
])

<div {{ $attributes->merge(['class' => 'flex flex-wrap items-baseline justify-between gap-2 border-b-2 border-ink pb-3.5']) }}>
    <h2 class="font-display text-2xl lg:text-4xl font-semibold">{{ $title }}</h2>
    @if ($subtitle)
        <p class="text-sm text-neutral-500">{{ $subtitle }}</p>
    @elseif ($slot->isNotEmpty())
        {{ $slot }}
    @endif
</div>
