@php
    $facts = \App\Support\AboutContent::teamFacts();
    $images = \App\Support\AboutContent::teamImages();
@endphp

<section id="team" class="bg-white py-20 lg:py-32">
    <x-front.container class="grid items-start gap-8 min-[900px]:grid-cols-2 min-[900px]:gap-16">
        <div>
            <div class="flex items-center gap-2 text-sm font-semibold tracking-wide text-brand-mid">
                <span class="h-px w-7 bg-brand-mid"></span>
                {{ \App\Support\AboutContent::teamEyebrow() }}
            </div>
            <h2 class="mt-6 text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">
                {{ \App\Support\AboutContent::teamTitle() }}
            </h2>
            <p class="mt-6 max-w-[520px] text-[17px] leading-[1.8] text-muted">
                {{ \App\Support\AboutContent::teamLead() }}
            </p>
            <dl class="mt-8 grid max-w-[520px] gap-3 border-t border-line pt-6 text-[15px] leading-[1.7]">
                @foreach ($facts as $fact)
                    <div class="flex justify-between gap-4">
                        <dt class="text-muted">{{ $fact['label'] }}</dt>
                        <dd class="m-0 text-end font-semibold text-ink">{{ $fact['value'] }}</dd>
                    </div>
                @endforeach
            </dl>
        </div>
        <div class="grid gap-6">
            @foreach ($images as $image)
                <x-ui.image-slot
                    :src="$image['src']"
                    :label="$image['label']"
                    :spec="$image['spec']"
                    ratio="none"
                    :alt="$image['alt']"
                    :class="$image['class'].' block w-full rounded-lg'"
                    width="1200"
                    height="800"
                    loading="lazy"
                />
            @endforeach
        </div>
    </x-front.container>
</section>
