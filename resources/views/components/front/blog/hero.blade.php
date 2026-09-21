@props([
    'post',
])

@php
    $brand = config('company.brand_name');
    $lineUrl = \App\Support\Company::lineUrl();
    $cover = $post->image_16x9 ?: $post->image_4x3 ?: $post->image_1x1;
    $publishedAt = $post->published_at ?? $post->created_at;
    $modifiedAt = $post->updated_at ?? $publishedAt;
@endphp

<section id="top" class="border-b border-line bg-paper">
    <div class="grid items-start min-[900px]:grid-cols-[54fr_46fr]">
        <div class="max-w-full px-5 pt-[clamp(80px,10vw,128px)] pb-[clamp(104px,12vw,168px)] min-[900px]:ps-[max(1.25rem,calc((100vw-1160px)/2))] min-[900px]:pe-[clamp(24px,4vw,64px)]">
            <div class="max-w-[680px]">
                <p class="text-[clamp(1.75rem,4vw,2.25rem)] font-semibold leading-tight tracking-tight text-brand">
                    {{ $brand }}
                </p>

                <div class="mt-4 flex flex-wrap items-center gap-2 text-sm font-semibold tracking-wide text-muted">
                    <a href="{{ route('blog.index') }}" class="text-brand-mid hover:text-brand">บทความ</a>
                </div>

                <h1 class="mt-6 text-[clamp(1.625rem,4.4vw,2.35rem)] font-semibold leading-[1.35] text-brand">
                    {{ $post->title }}
                </h1>

                @if ($publishedAt)
                    <p class="mt-4 text-[15px] leading-[1.7] text-muted">
                        @if ($post->author)
                            โดย {{ $post->author->name }} ·
                        @endif
                        <time datetime="{{ $publishedAt->toIso8601String() }}">เผยแพร่ {{ $publishedAt->locale('th')->translatedFormat('j F Y') }}</time>
                        @if ($modifiedAt && (! $publishedAt || ! $modifiedAt->equalTo($publishedAt)))
                            · <time datetime="{{ $modifiedAt->toIso8601String() }}">อัปเดต {{ $modifiedAt->locale('th')->translatedFormat('j F Y') }}</time>
                        @endif
                    </p>
                @endif

                @if ($post->excerpt)
                    <p class="mt-6 text-[17px] leading-[1.8] text-muted">
                        {{ $post->excerpt }}
                    </p>
                @endif

                <div class="mt-10 flex flex-wrap items-center gap-6">
                    <a
                        href="{{ $lineUrl ?? '#cta' }}"
                        class="inline-flex items-center rounded-lg bg-accent px-[26px] py-4 text-[17px] font-semibold text-white hover:bg-accent-dark hover:text-white"
                        @if ($lineUrl) target="_blank" rel="noopener noreferrer" @endif
                    >ปรึกษาทีมช่างทางไลน์</a>
                    <a href="#content" class="border-b border-brand-mid pb-0.5 text-[17px] font-semibold text-brand-mid hover:text-brand">อ่านรายละเอียด</a>
                </div>
            </div>
        </div>

        <x-ui.image-slot
            :src="$cover"
            :alt="'ทีมช่าง '.$brand.' ติดตั้งแผงโซล่าเซลล์บนหลังคาบ้านในโครงการโซล่าเซลล์ภาคประชาชน จ.ปทุมธานี'"
            :label="'Hero — '.$post->title"
            ratio="4/3"
            spec="1200×900"
            :width="1200"
            :height="900"
            loading="eager"
            fetchpriority="high"
            class="min-h-full border-t border-line min-[900px]:border-t-0 min-[900px]:border-s"
        />
    </div>
</section>
