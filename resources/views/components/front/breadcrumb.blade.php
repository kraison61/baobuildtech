@props([
    'items' => [],
])

@if (count($items))
    <nav aria-label="Breadcrumb" {{ $attributes->merge(['class' => 'border-b border-line bg-paper']) }}>
        <x-front.container as="ol" class="flex flex-wrap items-center gap-x-2 gap-y-1 py-3 text-sm text-neutral-600">
            @foreach ($items as $item)
                <li class="flex min-w-0 items-center gap-2">
                    @if (! $loop->first)
                        <span aria-hidden="true" class="text-neutral-400">/</span>
                    @endif

                    @if (! $loop->last && ! empty($item['url']))
                        <a href="{{ $item['url'] }}" class="truncate text-brand hover:text-brand-dark">{{ $item['label'] }}</a>
                    @else
                        <span class="truncate font-medium text-neutral-800" @if ($loop->last) aria-current="page" @endif>{{ $item['label'] }}</span>
                    @endif
                </li>
            @endforeach
        </x-front.container>
    </nav>
@endif
