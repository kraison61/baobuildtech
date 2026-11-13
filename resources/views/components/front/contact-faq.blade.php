@php
    $faqs = \App\Support\ContactContent::faqs();
@endphp

<section id="faq" class="scroll-mt-24 bg-white py-20 lg:py-32">
    <x-front.container>
        <div class="max-w-[680px]">
            <div class="flex items-center gap-2 text-sm font-semibold tracking-wide text-brand-mid">
                <span class="h-px w-7 bg-brand-mid"></span>
                {{ \App\Support\ContactContent::faqEyebrow() }}
            </div>
            <h2 class="mt-6 text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">
                {{ \App\Support\ContactContent::faqTitle() }}
            </h2>
        </div>

        <div class="mt-10 grid gap-6 min-[900px]:grid-cols-2">
            @foreach ($faqs as $faq)
                <div class="border-t border-line pt-6">
                    <div class="text-[19px] font-semibold text-brand">{{ $faq['q'] }}</div>
                    <p class="mt-3 text-[17px] leading-[1.8] text-muted">{{ $faq['a'] }}</p>
                </div>
            @endforeach
        </div>
    </x-front.container>
</section>
