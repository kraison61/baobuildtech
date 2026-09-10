@props([
    'size' => 'size-9',
])

<svg
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 64 64"
    {{ $attributes->class([$size, 'shrink-0']) }}
    role="img"
    aria-label="{{ config('company.brand_name') }}"
>
    <rect width="64" height="64" rx="14" fill="#14294A"/>
    <rect x="21" y="13" width="7" height="32" fill="#FFFFFF"/>
    <path d="M28 13h7a8 8 0 0 1 0 15h-7z" fill="#FFFFFF"/>
    <path d="M28 28h8a8.5 8.5 0 0 1 0 17h-8z" fill="#FFFFFF"/>
    <path d="M10 53c12 6 30 5 43-4" fill="none" stroke="#1B7FE8" stroke-width="5" stroke-linecap="round"/>
</svg>
