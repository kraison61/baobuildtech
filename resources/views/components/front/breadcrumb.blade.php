@props([
    'items' => [],
])

@if (count($items))
    <nav aria-label="Breadcrumb" {{ $attributes->merge(['class' => 'border-b border-line bg-paper']) }}>
        <ol class="mx-auto max-w-[1280px] px-5 lg:px-14 py-3 flex flex-wrap items-center gap-x-2 gap-y-1 text-sm text-neutral-600">
            @foreach ($items as $item)
                <li class="flex items-center gap-2 min-w-0">
                    @if (! $loop->first)
                        <span aria-hidden="true" class="text-neutral-400">/</span>
                    @endif

                    @if (! $loop->last && ! empty($item['url']))
                        <a href="{{ $item['url'] }}" class="truncate text-brand hover:text-brand-dark">{{ $item['label'] }}</a>
                    @else
                        <span class="truncate text-neutral-800 font-medium" @if ($loop->last) aria-current="page" @endif>{{ $item['label'] }}</span>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endif
