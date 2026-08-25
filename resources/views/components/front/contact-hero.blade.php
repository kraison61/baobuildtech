<section id="top" class="border-b border-line bg-paper">
    <div class="grid items-stretch min-[900px]:grid-cols-[54fr_46fr]">
        <div class="max-w-full px-5 pt-[clamp(80px,10vw,128px)] pb-[clamp(104px,12vw,168px)] min-[900px]:ps-[max(1.25rem,calc((100vw-1160px)/2))] min-[900px]:pe-[clamp(24px,4vw,64px)]">
            <div class="max-w-[680px]">
                <div class="flex items-center gap-2 text-sm font-semibold tracking-wide text-brand-mid">
                    <span class="h-px w-7 bg-brand-mid"></span>
                    {{ \App\Support\ContactContent::heroEyebrow() }}
                </div>
                <h1 class="mt-6 text-[clamp(1.875rem,5.2vw,2.75rem)] font-semibold leading-[1.35] text-brand">
                    {{ \App\Support\ContactContent::heroTitle() }}
                </h1>
                <p class="mt-6 text-[17px] leading-[1.8] text-muted">
                    {{ \App\Support\ContactContent::heroLead() }}
                </p>
            </div>
        </div>
        <img
            src="{{ \App\Support\ContactContent::heroImage() }}"
            alt="{{ \App\Support\ContactContent::heroImageAlt() }}"
            class="block size-full min-h-[300px] object-cover"
            width="1600"
            height="1200"
        >
    </div>
</section>
