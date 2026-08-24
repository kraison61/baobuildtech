@props(['variant' => 'default'])

@php
    $variants = [
        'default' => 'bg-slate-700 text-slate-200',
        'success' => 'bg-emerald-500/20 text-emerald-300',
        'warning' => 'bg-amber-500/20 text-amber-300',
        'danger' => 'bg-red-500/20 text-red-300',
    ];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ' . ($variants[$variant] ?? $variants['default'])]) }}>
    {{ $slot }}
</span>
