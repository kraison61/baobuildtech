@props([
    'type' => 'button',
    'variant' => 'primary',
    'href' => null,
])

@php
    $variants = [
        'primary' => 'bg-emerald-600 text-white hover:bg-emerald-500',
        'secondary' => 'bg-slate-700 text-slate-100 hover:bg-slate-600',
        'danger' => 'bg-red-600 text-white hover:bg-red-500',
        'ghost' => 'bg-transparent text-slate-300 hover:bg-slate-700 hover:text-white',
    ];
    $classes = 'inline-flex items-center justify-center rounded-lg px-4 py-2 text-sm font-medium transition-colors disabled:opacity-50 '
        . ($variants[$variant] ?? $variants['primary']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
