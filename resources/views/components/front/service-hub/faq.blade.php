@props(['hub'])

<section id="faq" class="scroll-mt-24 bg-white py-16 lg:py-24">
    <x-front.container>
        <div class="max-w-[760px]">
            <x-front.service-hub.section-header
                eyebrow="FAQ"
                title="คำถามที่พบบ่อย"
            />

            <div class="mt-10 grid gap-4">
                @foreach ($hub->faqs() as $faq)
                    <details class="group rounded-lg border border-line bg-paper px-6 py-1" @if ($faq['open'] ?? false) open @endif>
                        <summary class="flex cursor-pointer list-none items-start justify-between gap-4 py-[18px] text-[17px] font-semibold text-brand [&::-webkit-details-marker]:hidden">
                            <span class="min-w-0 flex-1 leading-[1.5]">{{ $faq['q'] }}</span>
                            <span class="mt-0.5 shrink-0 text-[20px] leading-none text-brand-mid transition-transform duration-200 group-open:rotate-45" aria-hidden="true">+</span>
                        </summary>
                        <p class="m-0 pb-5 text-[17px] leading-[1.8] text-muted">{{ $faq['a'] }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </x-front.container>
</section>
