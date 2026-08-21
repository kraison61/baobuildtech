@php
    use App\Models\ServiceCategory;

    $categories = ServiceCategory::query()
        ->with(['services' => fn ($q) => $q->where('is_published', true)->orderBy('sort_order')])
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    $isComplementary = static function (ServiceCategory $category): bool {
        return $category->slug === 'it'
            || str_contains((string) $category->description, 'บริการเสริม');
    };

    $primary = $categories->reject($isComplementary)->values();
    $secondary = $categories->filter($isComplementary)->values();
@endphp

@if ($categories->isNotEmpty())
    <section class="relative z-[1] -mt-10 bg-transparent px-5 pb-10 lg:pb-12" aria-label="หมวดหมู่งาน">
        <x-front.container>
            @if ($primary->isNotEmpty())
                <div class="grid gap-6 [grid-template-columns:repeat(auto-fit,minmax(240px,1fr))]">
                    @foreach ($primary as $category)
                        @php
                            $excerpt = $category->services
                                ->take(3)
                                ->pluck('name')
                                ->implode(' · ');
                        @endphp
                        <a
                            href="#{{ $category->slug }}"
                            class="block rounded-lg border border-line bg-white p-6 hover:border-brand-mid"
                        >
                            <div class="text-sm font-semibold text-muted tabular-nums">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                            <div class="mt-2 text-[22px] font-semibold text-brand">{{ $category->name }}</div>
                            @if ($excerpt !== '')
                                <div class="mt-2 text-[15px] leading-[1.7] text-muted">{{ $excerpt }}</div>
                            @elseif ($category->description)
                                <div class="mt-2 text-[15px] leading-[1.7] text-muted">{{ $category->description }}</div>
                            @endif
                        </a>
                    @endforeach
                </div>
            @endif

            @if ($secondary->isNotEmpty())
                <div class="mt-8">
                    <p class="text-[15px] font-semibold text-brand-mid">บริการเสริมในโครงการเดียวกัน</p>
                    <div class="mt-4 grid gap-6 [grid-template-columns:repeat(auto-fit,minmax(240px,1fr))]">
                        @foreach ($secondary as $category)
                            @php
                                $excerpt = $category->services
                                    ->take(3)
                                    ->pluck('name')
                                    ->implode(' · ');
                            @endphp
                            <a
                                href="#{{ $category->slug }}"
                                class="block rounded-lg border border-dashed border-line bg-paper/80 p-6 hover:border-brand-mid"
                            >
                                <div class="text-sm font-semibold text-muted">บริการเสริม</div>
                                <div class="mt-2 text-[22px] font-semibold text-brand">{{ $category->name }}</div>
                                @if ($excerpt !== '')
                                    <div class="mt-2 text-[15px] leading-[1.7] text-muted">{{ $excerpt }}</div>
                                @elseif ($category->description)
                                    <div class="mt-2 text-[15px] leading-[1.7] text-muted">{{ $category->description }}</div>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <p class="mt-8 text-[15px] leading-[1.7] text-muted">
                ยังไม่แน่ใจว่างานของคุณอยู่ในกลุ่มไหน?
                <a href="#scope" class="ms-1 border-b border-brand-mid pb-0.5 font-semibold text-brand-mid hover:text-brand">ดูขอบเขตงานที่รับและไม่รับ</a>
            </p>
        </x-front.container>
    </section>
@endif
