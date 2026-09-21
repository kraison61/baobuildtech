@extends('front.layouts.app')

@php
    $service = $item->service;
    $headline = $item->headline ?: $item->name;
    $pageTitle = $item->meta_title ?: ($headline.' — '.config('company.brand_name'));
    $pageUrl = $item->url();
    $metaDescription = $item->meta_description ?: \Illuminate\Support\Str::limit(
        strip_tags((string) ($item->excerpt ?: $item->description)),
        160,
        ''
    );
    $publishedAt = $item->published_at ?? $item->created_at;
    $modifiedAt = $item->updated_at ?? $publishedAt;
    $breadcrumbs = [
        ['label' => 'หน้าแรก', 'url' => route('home')],
        ['label' => 'งานบริการ', 'url' => route('services')],
        ['label' => $service->category->name, 'url' => route('services').'#'.$service->category->slug],
        ['label' => $service->name, 'url' => $service->url()],
        ['label' => $item->name],
    ];

    $schemaGraph = \App\Support\JsonLd::pageGraph(
        $pageTitle,
        $pageUrl,
        $breadcrumbs,
        \App\Support\Company::serviceAreas(includeCountry: false),
        webPageExtra: [
            'datePublished' => $publishedAt?->toIso8601String(),
            'dateModified' => $modifiedAt?->toIso8601String(),
        ],
    );
    $schemaGraph[] = \App\Support\JsonLd::serviceItemEntity($item, $pageUrl, $item->prices);

    if ($item->faqs->isNotEmpty()) {
        $schemaGraph[2]['mainEntity'] = ['@id' => rtrim($pageUrl, '/').'#faq'];
        $schemaGraph[] = \App\Support\JsonLd::faqPage($pageUrl, $item->faqs);
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
        <x-front.service-item.hero :item="$item" />

        @if (filled($item->content))
            <x-front.service-item.content :item="$item" />
        @endif

        @if ($item->prices->isNotEmpty())
            <x-front.service.prices :service="$item" :prices="$item->prices" />
        @endif

        @if ($item->portfolios->isNotEmpty())
            <x-front.service.works :service="$item" :portfolios="$item->portfolios" />
        @endif

        @if ($item->faqs->isNotEmpty())
            <x-front.service.faqs :service="$item" :faqs="$item->faqs" />
        @endif

        @if ($relatedItems->isNotEmpty())
            <x-front.service-item.related :items="$relatedItems" :service="$service" />
        @endif

        <x-front.cta-section
            title="ส่งรูปหน้างานมาประเมินงาน{{ $item->name }}"
            :body="$item->slug === 'townhouse'
                ? 'ส่งรูปหน้าตึก ผนังที่ติดบ้านข้าง ปากซอย และตำแหน่งบน Google Maps มาทางไลน์ ทีมช่างจะตอบกลับภายใน 1 วันทำการ พร้อมข้อสังเกตและช่วงราคาคร่าว ๆ รับงานหลักในปทุมธานี นนทบุรี และกรุงเทพฯ ไม่มีค่าใช้จ่าย และไม่โทรรบกวนหากไม่ได้ขอ'
                : 'ส่งรูปพื้นที่และความต้องการมาทางไลน์ ทีมช่างจะตอบกลับภายใน 1 วันทำการ พร้อมข้อสังเกตและช่วงราคาคร่าว ๆ — ไม่มีค่าใช้จ่าย และไม่โทรรบกวนหากไม่ได้ขอ'"
            variant="paper"
        />
    </main>
@endsection
