@php
    $facts = \App\Support\ContactContent::officeFacts();
    $lat = config('company.geo.lat');
    $lng = config('company.geo.lng');
    $mapsUrl = config('company.social.google_maps');
@endphp

<section id="office" class="scroll-mt-24 border-y border-line bg-paper py-20 lg:py-32">
    <x-front.container class="grid items-start gap-8 min-[900px]:grid-cols-2 min-[900px]:gap-16">
        <div>
            <div class="flex items-center gap-2 text-sm font-semibold tracking-wide text-brand-mid">
                <span class="h-px w-7 bg-brand-mid"></span>
                {{ \App\Support\ContactContent::officeEyebrow() }}
            </div>
            <h2 class="mt-6 text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">
                {{ \App\Support\ContactContent::officeTitle() }}
            </h2>
            <p class="mt-6 max-w-[520px] text-[17px] leading-[1.8] text-muted">
                {{ \App\Support\ContactContent::officeLead() }}
            </p>
            <dl class="mt-8 grid max-w-[520px] gap-3 border-t border-line pt-6 text-[15px] leading-[1.7]">
                @foreach ($facts as $fact)
                    <div class="flex justify-between gap-4">
                        <dt class="shrink-0 text-muted">{{ $fact['label'] }}</dt>
                        <dd class="m-0 text-end font-semibold text-ink">
                            @if ($fact['href'] ?? null)
                                <a href="{{ $fact['href'] }}" target="_blank" rel="noopener noreferrer" class="border-b border-brand-mid pb-px text-brand-mid hover:text-brand">{{ $fact['value'] }}</a>
                            @else
                                {{ $fact['value'] }}
                            @endif
                        </dd>
                    </div>
                @endforeach
            </dl>
        </div>

        @if (is_numeric($lat) && is_numeric($lng))
            <div class="overflow-hidden rounded-lg border border-line bg-white">
                <iframe
                    title="แผนที่ที่ตั้ง {{ config('company.brand_name') }}"
                    src="https://maps.google.com/maps?q={{ $lat }},{{ $lng }}&z=15&output=embed"
                    class="block min-h-[clamp(280px,34vw,380px)] w-full border-0"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    allowfullscreen
                ></iframe>
            </div>
        @elseif ($mapsUrl)
            <a
                href="{{ $mapsUrl }}"
                target="_blank"
                rel="noopener noreferrer"
                class="grid min-h-[clamp(280px,34vw,380px)] place-items-center rounded-lg border border-line bg-white p-8 text-center hover:border-brand-mid"
            >
                <div>
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" class="mx-auto text-brand-mid" aria-hidden="true">
                        <path d="M12 21s7-6.2 7-11a7 7 0 10-14 0c0 4.8 7 11 7 11z" />
                        <circle cx="12" cy="10" r="2.6" />
                    </svg>
                    <div class="mt-4 text-[17px] font-semibold text-brand">เปิดแผนที่ Google Maps</div>
                    <p class="mt-2 text-[15px] leading-[1.8] text-muted">ดูที่ตั้งสำนักงานบนแผนที่</p>
                </div>
            </a>
        @endif
    </x-front.container>
</section>
