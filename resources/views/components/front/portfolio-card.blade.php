@props([
    'image' => null,
    'category' => '',
    'title' => '',
    'description' => '',
    'span' => false,
])

<article @class(['flex flex-col gap-3', 'sm:col-span-2 lg:col-span-1' => $span])>
    <div class="aspect-3/2 bg-neutral-200 border border-dashed border-neutral-400 grid place-items-center text-xs text-neutral-500 overflow-hidden">
        @if ($image)
            <img src="{{ $image }}" alt="{{ $title }}" class="size-full object-cover">
        @else
            ภาพผลงาน 1200×800
        @endif
    </div>
    @if ($category)
        <p class="text-xs font-semibold tracking-[0.1em] text-brand">{{ $category }}</p>
    @endif
    <h3 class="font-display text-lg lg:text-xl font-semibold">{{ $title }}</h3>
    @if ($description)
        <p class="text-[15px] leading-relaxed text-neutral-600">{{ $description }}</p>
    @endif
</article>
