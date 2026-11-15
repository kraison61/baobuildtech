@props([
    'sections',
])

@if ($sections !== [])
    <section class="relative z-[1] -mt-10 bg-transparent pb-10 lg:pb-12" aria-label="{{ \App\Support\Locale::pick('ขั้นตอนงานบริการ', 'Service stages') }}">
        <x-front.container>
            <p class="mb-5 text-[15px] font-semibold text-brand">
                {{ \App\Support\Locale::pick('เรียงตามลำดับที่โปรเจกต์เกิดจริง — คลิกเพื่อไปยังหมวด', 'Ordered by how a project unfolds — click to jump') }}
            </p>
            <div class="grid gap-4 [grid-template-columns:repeat(auto-fit,minmax(200px,1fr))]">
                @foreach ($sections as $section)
                    <a
                        href="#{{ $section['key'] }}"
                        class="block rounded-lg border border-line bg-white p-5 hover:border-brand-mid"
                    >
                        <div class="text-sm font-semibold text-muted tabular-nums">
                            {{ str_pad((string) $section['number'], 2, '0', STR_PAD_LEFT) }}
                        </div>
                        <div class="mt-2 text-[18px] font-semibold leading-snug text-brand">{{ $section['label'] }}</div>
                        @if (! empty($section['description']))
                            <div class="mt-2 text-[14px] leading-[1.65] text-muted">{{ $section['description'] }}</div>
                        @endif
                        @if (! empty($section['badge']))
                            <div class="mt-3 text-[12px] font-semibold text-brand-mid">{{ $section['badge'] }}</div>
                        @endif
                    </a>
                @endforeach
            </div>

            <p class="mt-8 text-[15px] leading-[1.7] text-muted">
                {{ \App\Support\Locale::pick('ยังไม่แน่ใจว่างานของคุณอยู่ในกลุ่มไหน?', 'Not sure which group fits your job?') }}
                <a href="#scope" class="ms-1 border-b border-brand-mid pb-0.5 font-semibold text-brand-mid hover:text-brand">
                    {{ \App\Support\Locale::pick('ดูขอบเขตงานที่รับและไม่รับ', 'See what we accept and decline') }}
                </a>
            </p>
        </x-front.container>
    </section>
@endif
