@extends('front.layouts.app')

@php
    $pageTitle = $service->meta_title ?: ($service->name.' — '.config('company.brand_name'));
    $pageUrl = route('services.show', $service->slug);
    $metaDescription = $service->meta_description ?: \Illuminate\Support\Str::limit(
        strip_tags((string) $service->description),
        160,
        ''
    );
    $breadcrumbs = [
        ['label' => 'หน้าแรก', 'url' => route('home')],
        ['label' => 'งานบริการ', 'url' => route('services')],
        ['label' => $service->name],
    ];

    $visiblePrices = $service->prices->values();
    foreach ($service->items as $item) {
        $visiblePrices = $visiblePrices->concat($item->prices);
    }
    $visiblePrices = $visiblePrices->unique('id')->values();

    $schemaGraph = \App\Support\JsonLd::pageGraph(
        $pageTitle,
        $pageUrl,
        $breadcrumbs,
        \App\Support\Company::serviceAreas(includeCountry: false),
    );
    $schemaGraph[] = \App\Support\JsonLd::serviceEntity($service, $pageUrl, $visiblePrices);

    if ($service->faqs->isNotEmpty()) {
        $schemaGraph[2]['mainEntity'] = ['@id' => rtrim($pageUrl, '/').'#faq'];
        $schemaGraph[] = \App\Support\JsonLd::faqPage($pageUrl, $service->faqs);
    }
@endphp

@section('title', $pageTitle)
@section('meta_description', $metaDescription)

@section('breadcrumb')
    <x-front.breadcrumb :items="$breadcrumbs" />
@endsection

@push('head')
    <x-front.json-ld :graph="$schemaGraph" />
@endpush

@section('content')
    <main>
        <x-front.service-hero :service="$service" />

        @if ($visiblePrices->isNotEmpty())
            <x-front.service-highlights :prices="$visiblePrices" />
        @endif

        <x-front.service-items :service="$service" :items="$service->items" />

        @if ($visiblePrices->isNotEmpty())
            <x-front.service-prices :service="$service" :prices="$visiblePrices" />
        @endif

        @if ($service->portfolios->isNotEmpty())
            <x-front.service-works :service="$service" :portfolios="$service->portfolios" />
        @endif

        @if ($service->faqs->isNotEmpty())
            <x-front.service-faqs :service="$service" :faqs="$service->faqs" />
        @endif

        @if ($relatedServices->isNotEmpty())
            <x-front.service-related :services="$relatedServices" />
        @endif

        <x-front.cta-section
            title="ส่งรูปหน้างานมาประเมินงาน{{ $service->name }}"
            body="ส่งรูปพื้นที่และความต้องการมาทางไลน์ ทีมช่างจะตอบกลับภายใน [1] วันทำการ พร้อมข้อสังเกตและช่วงราคาคร่าว ๆ — ไม่มีค่าใช้จ่าย และไม่โทรรบกวนหากไม่ได้ขอ"
            variant="paper"
        />
    </main>
@endsection
