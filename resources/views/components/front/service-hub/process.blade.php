@props(['hub'])

<section id="process" class="scroll-mt-24 border-y border-line bg-paper py-16 lg:py-24">
    <x-front.container>
        <div class="grid items-start gap-10 min-[900px]:grid-cols-2">
            <div>
                <x-front.service-hub.section-header
                    :eyebrow="$hub->processEyebrow()"
                    :title="$hub->processTitle()"
                    :intro="$hub->processIntro()"
                />

                @if ($image = $hub->processImage())
                    <img
                        src="{{ $image }}"
                        alt="{{ $hub->processImageAlt() }}"
                        class="mt-8 aspect-16/10 w-full rounded-lg object-cover min-[900px]:hidden"
                        width="1200"
                        height="750"
                        loading="lazy"
                    >
                @endif

                <ol class="mt-10 grid list-none gap-4 p-0">
                    @foreach ($hub->processSteps() as $step)
                        <li class="flex gap-4 rounded-lg border border-line bg-white p-5">
                            <div class="flex size-10 shrink-0 items-center justify-center rounded-full bg-brand text-[15px] font-semibold tabular-nums text-white">
                                {{ $step['no'] }}
                            </div>
                            <div class="min-w-0">
                                <div class="flex flex-wrap items-baseline gap-x-3 gap-y-1">
                                    <h3 class="text-[17px] font-semibold text-brand">{{ $step['title'] }}</h3>
                                    <span class="text-[13px] font-semibold text-brand-mid">{{ $step['days'] }}</span>
                                </div>
                                <p class="mt-2 text-[15px] leading-[1.7] text-muted">{{ $step['body'] }}</p>
                            </div>
                        </li>
                    @endforeach
                </ol>
            </div>

            @if ($image = $hub->processImage())
                <img
                    src="{{ $image }}"
                    alt="{{ $hub->processImageAlt() }}"
                    class="hidden aspect-4/5 w-full rounded-lg object-cover min-[900px]:block"
                    width="1200"
                    height="1500"
                    loading="lazy"
                >
            @endif
        </div>
    </x-front.container>
</section>
