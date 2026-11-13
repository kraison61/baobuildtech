@extends('front.layouts.app')

@php
    $pageTitle = $portfolio->meta_title ?: ($portfolio->title.' — '.config('company.brand_name'));
    $pageUrl = $portfolio->url();
    $metaDescription = $portfolio->meta_description ?: \Illuminate\Support\Str::limit(
        strip_tags((string) $portfolio->description),
        160,
        ''
    );
    $contentHtml = \App\Support\RichHtml::prepare((string) $portfolio->content);
    $breadcrumbs = [
        ['label' => __('ui.home'), 'url' => \App\Support\Locale::route('home')],
        ['label' => __('ui.works'), 'url' => \App\Support\Locale::route('works')],
        ['label' => $portfolio->title],
    ];
    $schemaGraph = \App\Support\JsonLd::pageGraph(
        $pageTitle,
        $pageUrl,
        $breadcrumbs,
        webPageExtra: [
            'datePublished' => $portfolio->completed_at?->toIso8601String() ?? $portfolio->created_at?->toIso8601String(),
            'dateModified' => $portfolio->updated_at?->toIso8601String(),
            'primaryImageOfPage' => $portfolio->cover_image,
            'description' => $metaDescription,
        ],
    );

    if ($portfolio->faqs->isNotEmpty()) {
        $schemaGraph[2]['mainEntity'] = ['@id' => rtrim($pageUrl, '/').'#faq'];
        $schemaGraph[] = \App\Support\JsonLd::faqPage($pageUrl, $portfolio->faqs);
    }
@endphp

@section('title', $pageTitle)
@section('meta_description', $metaDescription)
@section('canonical', $pageUrl)

@section('breadcrumb')
    <x-front.breadcrumb :items="$breadcrumbs" />
@endsection

@push('head')
    <x-front.json-ld :graph="$schemaGraph" />
@endpush

@section('content')
    <main class="overflow-x-clip">
        <section class="border-b border-line bg-paper py-16 lg:py-24">
            <x-front.container>
                <div class="max-w-[800px]">
                    @if ($portfolio->location || $portfolio->completed_at)
                        <p class="text-[14px] font-semibold text-brand-mid">
                            @if ($portfolio->location)
                                {{ $portfolio->location->name }}
                            @endif
                            @if ($portfolio->location && $portfolio->completed_at)
                                ·
                            @endif
                            @if ($portfolio->completed_at)
                                <time datetime="{{ $portfolio->completed_at->toDateString() }}">
                                    {{ $portfolio->completed_at->locale(app()->getLocale())->translatedFormat('j F Y') }}
                                </time>
                            @endif
                        </p>
                    @endif
                    <h1 class="mt-4 text-[clamp(1.75rem,4.8vw,2.75rem)] font-semibold leading-[1.3] text-brand">
                        {{ $portfolio->title }}
                    </h1>
                    @if ($portfolio->description)
                        <p class="mt-6 text-[17px] leading-[1.8] text-muted">
                            {{ $portfolio->description }}
                        </p>
                    @endif
                </div>
            </x-front.container>
        </section>

        @if (filled($contentHtml))
            <section id="content" class="scroll-mt-24 bg-white py-16 lg:py-24">
                <x-front.container>
                    <div class="mx-auto max-w-[960px] text-[17px] leading-[1.8] text-muted [&_h2]:mt-12 [&_h2]:text-[clamp(1.625rem,4vw,2rem)] [&_h2]:font-semibold [&_h2]:leading-[1.4] [&_h2]:text-brand [&_h2:first-child]:mt-0 [&_h3]:mt-8 [&_h3]:text-[22px] [&_h3]:font-semibold [&_h3]:text-brand [&_p]:mt-6 [&_p:first-child]:mt-0 [&_ul]:mt-6 [&_ul]:list-disc [&_ul]:ps-6 [&_ol]:mt-6 [&_ol]:list-decimal [&_ol]:ps-6 [&_li]:mt-2 [&_figure]:mt-8 [&_figure_img]:w-full [&_figure_img]:rounded-lg [&_figure_img]:border [&_figure_img]:border-line [&_figcaption]:mt-3 [&_figcaption]:text-[15px] [&_figcaption]:text-muted [&_div:has(>table)]:mt-8 [&_table]:w-full [&_table]:min-w-[560px] [&_table]:border-collapse [&_table]:border [&_table]:border-line [&_th]:border-b [&_th]:border-line [&_th]:bg-paper [&_th]:p-4 [&_th]:text-start [&_th]:font-semibold [&_th]:text-brand [&_td]:border-b [&_td]:border-line [&_td]:p-4 [&_td]:align-top [&_strong]:font-semibold [&_strong]:text-ink [&_a]:font-semibold [&_a]:text-brand-mid [&_a]:underline [&_a]:underline-offset-2 [&_em]:text-muted">
                        {!! $contentHtml !!}
                    </div>
                </x-front.container>
            </section>
        @endif

        @if ($portfolio->faqs->isNotEmpty())
            <section id="faq" class="scroll-mt-24 border-t border-line bg-paper py-16 lg:py-24">
                <x-front.container>
                    <div class="mx-auto max-w-[680px]">
                        <h2 class="text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">
                            {{ \App\Support\Locale::pick('คำถามที่พบบ่อย', 'Frequently asked questions') }}
                        </h2>
                        <div class="mt-10 grid gap-4">
                            @foreach ($portfolio->faqs as $faq)
                                <details name="works-faq" class="group rounded-lg border border-line bg-white px-6 py-1">
                                    <summary class="flex cursor-pointer list-none items-center justify-between gap-6 py-[18px] text-[17px] font-semibold text-brand [&::-webkit-details-marker]:hidden">
                                        {{ $faq->question }}
                                        <span class="text-[20px] leading-none text-brand-mid transition-transform duration-200 group-open:rotate-45" aria-hidden="true">+</span>
                                    </summary>
                                    <p class="m-0 pb-5 text-[17px] leading-[1.8] text-muted">{{ $faq->answer }}</p>
                                </details>
                            @endforeach
                        </div>
                    </div>
                </x-front.container>
            </section>
        @endif

        <x-front.cta-section
            :title="\App\Support\Locale::pick('ขอใบเสนอราคาเดินสายเมนเข้าบ้าน ประเมินหน้างานฟรี', 'Request a main-cable quote — free site estimate')"
            :body="\App\Support\Locale::pick('ส่งรูปมิเตอร์ รูปแนวสายจากเสาถึงบ้าน และระยะโดยประมาณมาทาง LINE เราตีราคาเบื้องต้นให้ก่อน แล้วนัดวัดระยะจริงที่หน้างาน', 'Send meter photos, the pole-to-house route, and an approximate distance via LINE for a preliminary figure, then we measure on site.')"
            variant="paper"
        />
    </main>
@endsection
