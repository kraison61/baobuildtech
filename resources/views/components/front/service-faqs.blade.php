@props([
    'service',
    'faqs',
])

<section id="faq" class="scroll-mt-24 bg-white py-16 lg:py-24">
    <x-front.container>
        <div class="mx-auto max-w-[680px]">
            <h2 class="text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">
                คำถามเฉพาะงาน{{ $service->name }}
            </h2>

            <div class="mt-10 grid gap-4">
                @foreach ($faqs as $faq)
                    <details name="service-faq" class="group rounded-lg border border-line bg-white px-6 py-1">
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-6 py-[18px] text-[17px] font-semibold text-brand [&::-webkit-details-marker]:hidden">
                            {{ $faq->question }}
                            <span class="text-[20px] leading-none text-brand-mid transition-transform duration-200 group-open:rotate-45" aria-hidden="true">+</span>
                        </summary>
                        <p class="m-0 pb-5 text-[17px] leading-[1.8] text-muted">{{ $faq->answer }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </x-front.container>
</section>
