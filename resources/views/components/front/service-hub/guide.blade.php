@props(['hub'])

<section id="guide" class="scroll-mt-24 bg-white py-16 lg:py-24">
    <x-front.container>
        <x-front.service-hub.section-header
            :eyebrow="$hub->guideEyebrow()"
            :title="$hub->guideTitle()"
            :intro="$hub->guideIntro()"
        />

        <div class="mt-10 grid gap-4 min-[700px]:grid-cols-2">
            @foreach ($hub->guideTips() as $tip)
                <div class="rounded-lg border border-line bg-paper/50 p-6">
                    <h3 class="text-[17px] font-semibold text-brand">{{ $tip['title'] }}</h3>
                    <p class="mt-3 text-[15px] leading-[1.7] text-muted">{{ $tip['body'] }}</p>
                </div>
            @endforeach
        </div>

        @if ($closing = $hub->guideClosing())
            <p class="mt-8 max-w-[760px] rounded-lg border border-brand/15 bg-paper px-6 py-5 text-[17px] leading-[1.8] text-muted">
                {{ $closing }}
            </p>
        @endif
    </x-front.container>
</section>
