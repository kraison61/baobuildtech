@props([
    'as' => 'div',
])

<{{ $as }} {{ $attributes->class('mx-auto max-w-[1160px] px-5') }}>
    {{ $slot }}
</{{ $as }}>
