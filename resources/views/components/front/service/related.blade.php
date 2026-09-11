@props([
    'services',
])

<section id="related" class="scroll-mt-24 bg-white py-16 lg:py-24">
    <x-front.container>
        <div class="max-w-[680px]">
            <h2 class="text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">
                บริการอื่นในหมวดเดียวกัน
            </h2>
        </div>

        <div class="mt-10 grid gap-6 [grid-template-columns:repeat(auto-fit,minmax(240px,1fr))]">
            @foreach ($services as $related)
                <a
                    href="{{ $related->url() }}"
                    class="block rounded-lg border border-line bg-white p-6 hover:border-brand-mid"
                >
                    <div class="text-[22px] font-semibold text-brand">{{ $related->name }}</div>
                    <p class="mt-2 text-[15px] leading-[1.7] text-muted">
                        {{ $related->excerpt ?: \Illuminate\Support\Str::limit((string) $related->description, 90) }}
                    </p>
                    <span class="mt-4 inline-flex border-b border-brand-mid pb-0.5 text-[15px] font-semibold text-brand-mid">ดูรายละเอียด</span>
                </a>
            @endforeach
        </div>
    </x-front.container>
</section>
