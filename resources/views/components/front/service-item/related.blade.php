@props([
    'items',
    'service',
])

<section id="related" class="scroll-mt-24 bg-white py-16 lg:py-24">
    <x-front.container>
        <div class="max-w-[680px]">
            <h2 class="text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">
                งานอื่นใกล้เคียงภายใต้{{ $service->name }}
            </h2>
        </div>

        <div class="mt-10 grid gap-6 [grid-template-columns:repeat(auto-fit,minmax(240px,1fr))]">
            @foreach ($items as $related)
                <article class="overflow-hidden rounded-lg border border-line bg-white hover:border-brand-mid">
                    <a href="{{ $related->url() }}" class="block">
                        <x-ui.image-slot
                            :src="$related->cover_image"
                            :label="'Related — '.$related->name"
                            spec="800×600"
                            ratio="4/3"
                            :alt="$related->name"
                            class="w-full"
                            width="800"
                            height="600"
                            loading="lazy"
                        />
                    </a>
                    <div class="p-6">
                        <h3 class="text-[22px] font-semibold text-brand">
                            <a href="{{ $related->url() }}" class="hover:text-brand-mid">{{ $related->name }}</a>
                        </h3>
                        <p class="mt-2 text-[15px] leading-[1.7] text-muted">
                            {{ $related->excerpt ?: \Illuminate\Support\Str::limit((string) $related->description, 90) }}
                        </p>
                        <a
                            href="{{ $related->url() }}"
                            class="mt-4 inline-flex border-b border-brand-mid pb-0.5 text-[15px] font-semibold text-brand-mid hover:text-brand"
                        >ดูรายละเอียด</a>
                    </div>
                </article>
            @endforeach
        </div>
    </x-front.container>
</section>
