@props([
    'title' => null,
    'body' => null,
    'variant' => 'brand',
    'withAnchor' => true,
])

@php
    $title = $title ?? \App\Support\HomeContent::ctaTitle();
    $body = $body ?? \App\Support\HomeContent::ctaBody();
    $phoneDisplay = \App\Support\Company::phoneDisplay();
    $phoneHref = \App\Support\Company::phoneHref();
    $lineId = \App\Support\Company::lineId();
    $lineUrl = \App\Support\Company::lineUrl();
    $email = config('company.email');
    $address = \App\Support\Company::addressDisplay();
    $hours = \App\Support\Company::hoursDisplay();
@endphp

<section
    @if ($withAnchor) id="cta" @endif
    @class([
        'scroll-mt-24 py-20 lg:py-32',
        'bg-brand text-white' => $variant === 'brand',
        'border-t border-line bg-paper' => $variant === 'paper',
    ])
>
    <x-front.container>
        <div class="mx-auto max-w-[680px] text-center">
            <h2 @class([
                'text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4]',
                'text-white' => $variant === 'brand',
                'text-brand' => $variant === 'paper',
            ])>
                {{ $title }}
            </h2>
            <p @class([
                'mt-6 text-[17px] leading-[1.8]',
                'text-sand' => $variant === 'brand',
                'text-muted' => $variant === 'paper',
            ])>
                {{ $body }}
            </p>
            <div class="mt-10 flex flex-wrap justify-center gap-4">
                <a
                    href="{{ $lineUrl ?? '#cta' }}"
                    class="inline-flex items-center rounded-lg bg-accent px-[26px] py-4 text-[17px] font-semibold text-white hover:bg-accent-dark hover:text-white"
                    @if ($lineUrl) target="_blank" rel="noopener noreferrer" data-cta="line" data-cta-source="cta-section" @endif
                >{{ \App\Support\HomeContent::ctaLine() }}</a>
                <a
                    href="{{ $phoneHref }}"
                    @class([
                        'inline-flex items-center border-b pb-0.5 text-[17px] font-semibold tabular-nums',
                        'border-sand/50 text-white hover:text-white' => $variant === 'brand',
                        'border-brand-mid text-brand-mid hover:text-brand' => $variant === 'paper',
                    ])
                    data-cta="phone"
                    data-cta-source="cta-section"
                >{{ \App\Support\HomeContent::ctaPhone() }} {{ $phoneDisplay }}</a>
            </div>

            <ul @class([
                'mt-10 grid list-none gap-2 p-0 text-[15px] leading-[1.7] sm:text-[16px]',
                'text-sand' => $variant === 'brand',
                'text-muted' => $variant === 'paper',
            ])>
                <li>
                    {{ \App\Support\HomeContent::ctaPhoneLabel() }} {{ $phoneDisplay }}
                    @if ($lineId)
                        · LINE {{ $lineId }}
                    @endif
                    @if ($email)
                        · {{ \App\Support\HomeContent::ctaEmailLabel() }} {{ $email }}
                    @endif
                </li>
                <li>{{ \App\Support\HomeContent::ctaHoursLabel() }} {{ $hours }}@if ($address !== '') · {{ \App\Support\HomeContent::ctaAddressLabel() }} {{ $address }}@endif</li>
            </ul>
        </div>
    </x-front.container>
</section>
