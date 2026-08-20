@props([
    'type' => 'button',
    'variant' => 'primary',
])

@php
    $variants = [
        'primary' => 'bg-slate-800 text-white hover:bg-slate-700',
        'secondary' => 'bg-gray-200 text-slate-800 hover:bg-gray-300',
        'danger' => 'bg-red-600 text-white hover:bg-red-500',
    ];
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->merge(['class' => 'inline-flex items-center justify-center rounded-lg px-4 py-2 text-sm font-medium transition-colors disabled:opacity-50 ' . ($variants[$variant] ?? $variants['primary'])]) }}
>
    {{ $slot }}
</button>
