@props(['type' => 'success'])

@php
    $styles = [
        'success' => 'border-emerald-500/40 bg-emerald-500/10 text-emerald-200',
        'error' => 'border-red-500/40 bg-red-500/10 text-red-200',
        'info' => 'border-sky-500/40 bg-sky-500/10 text-sky-200',
    ];
@endphp

<div {{ $attributes->merge(['class' => 'rounded-lg border px-4 py-3 text-sm ' . ($styles[$type] ?? $styles['info'])]) }}>
    {{ $slot }}
</div>
