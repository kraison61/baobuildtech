@php
    $team = \App\Support\HomeContent::team();
@endphp

<section id="about" class="scroll-mt-24 border-b border-line bg-paper py-16 lg:py-24">
    <x-front.container>
        <div class="max-w-[720px]">
            <h2 class="text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">
                {{ \App\Support\HomeContent::aboutTitle() }}
            </h2>
            <p class="mt-6 text-[17px] leading-[1.8] text-muted">
                {!! \App\Support\HomeContent::aboutP1Html() !!}
            </p>
            <p class="mt-4 text-[17px] leading-[1.8] text-muted">
                {{ \App\Support\HomeContent::aboutP2() }}
            </p>
        </div>

        <div class="mt-12 max-w-[720px]">
            <div class="grid gap-0 border-t border-line">
                @foreach ($team as $member)
                    <article class="border-b border-line py-8">
                        <h3 class="text-[18px] font-semibold leading-snug text-brand sm:text-[19px]">{{ $member['title'] }}</h3>
                        <p class="mt-3 text-[17px] leading-[1.8] text-muted">{{ $member['body'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </x-front.container>
</section>
