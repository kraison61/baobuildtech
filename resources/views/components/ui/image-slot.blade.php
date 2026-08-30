@props([
    'src' => null,
    'alt' => '',
    'label' => 'รูปภาพ',
    'spec' => '1600×1200',
    'ratio' => '4/3',
    'ratioNote' => null,
    'width' => null,
    'height' => null,
    'loading' => 'lazy',
    'fetchpriority' => null,
    'imgClass' => 'absolute inset-0 size-full object-cover',
    'fixed' => false,
])

@php
    $ratioClass = match ($ratio) {
        '16/9' => 'aspect-video',
        '16/10' => 'aspect-16/10',
        '5/4' => 'aspect-[5/4]',
        '5/3' => 'aspect-[5/3]',
        '4/5' => 'aspect-4/5',
        '3/4' => 'aspect-3/4',
        'none' => '',
        default => 'aspect-4/3',
    };

    $ratioLabel = str_replace('/', ':', $ratio);
    $ratioDisplay = $ratioNote ?? ($ratio !== 'none' ? $ratioLabel : null);
    $specCaption = $spec.($ratioDisplay ? ' · '.$ratioDisplay : '').' px';
    $imgWidth = (int) ($width ?? 1600);
    $imgHeight = (int) ($height ?? 1200);
    $displaySrc = filled($src)
        ? $src
        : \App\Support\ImagePlaceholder::url($label, $spec, $ratioDisplay, $imgWidth, $imgHeight);
    $isMock = ! filled($src);
@endphp

<div {{ $attributes->class([
    'relative overflow-hidden',
    $ratioClass,
    $fixed ? '' : 'w-full',
]) }}>
    <img
        src="{{ $displaySrc }}"
        alt="{{ $isMock ? '' : $alt }}"
        @if ($imgWidth) width="{{ $imgWidth }}" @endif
        @if ($imgHeight) height="{{ $imgHeight }}" @endif
        loading="{{ $loading }}"
        @if ($fetchpriority) fetchpriority="{{ $fetchpriority }}" @endif
        @if ($isMock) role="img" aria-label="{{ $label }} — รอใส่รูป {{ $specCaption }}" @endif
        @class([
            $imgClass,
            'bg-paper' => $isMock,
        ])
    >
</div>
