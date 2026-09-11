@php
    $facts = \App\Support\ContactContent::officeFacts();
@endphp

<section id="office" class="scroll-mt-24 border-y border-line bg-paper py-20 lg:py-32">
    <x-front.container class="max-w-[640px]">
        <div class="flex items-center gap-2 text-sm font-semibold tracking-wide text-brand-mid">
            <span class="h-px w-7 bg-brand-mid"></span>
            {{ \App\Support\ContactContent::officeEyebrow() }}
        </div>
        <h2 class="mt-6 text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">
            {{ \App\Support\ContactContent::officeTitle() }}
        </h2>
        <p class="mt-6 text-[17px] leading-[1.8] text-muted">
            {{ \App\Support\ContactContent::officeLead() }}
        </p>
        <dl class="mt-8 grid gap-3 border-t border-line pt-6 text-[15px] leading-[1.7]">
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
    </x-front.container>
</section>
