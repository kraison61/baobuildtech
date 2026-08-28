@extends('front.layouts.app')

@php
    /** @var \App\Contracts\ServiceHubContent $hub */
    $pageTitle = $hub->metaTitle();
    $pageUrl = route('services.show', $hub->slug());
    $breadcrumbs = [
        ['label' => 'หน้าแรก', 'url' => route('home')],
        ['label' => 'งานบริการ', 'url' => route('services')],
        ['label' => $hub->breadcrumbLabel()],
    ];
    $siteUrl = rtrim((string) config('company.site_url'), '/');

    $schemaGraph = \App\Support\JsonLd::pageGraph(
        $pageTitle,
        $pageUrl,
        $breadcrumbs,
        \App\Support\Company::serviceAreas(),
    );

    $schemaGraph[] = array_filter([
        '@type' => 'Service',
        '@id' => rtrim($pageUrl, '/').'#service',
        'name' => \App\Support\JsonLd::cleanText($hub->schemaServiceName()),
        'description' => \App\Support\JsonLd::cleanText($hub->schemaServiceDescription()),
        'url' => $pageUrl,
        'provider' => ['@id' => $siteUrl.'#organization'],
        'areaServed' => \App\Support\JsonLd::areaServed(\App\Support\Company::serviceAreas()),
        'image' => $hub->heroImage(),
    ]);

    $faqs = $hub->faqs();
    if ($faqs !== []) {
        $schemaGraph[] = [
            '@type' => 'FAQPage',
            '@id' => rtrim($pageUrl, '/').'#faq',
            'mainEntity' => array_map(
                static fn (array $faq): array => [
                    '@type' => 'Question',
                    'name' => \App\Support\JsonLd::cleanText($faq['q']),
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => \App\Support\JsonLd::cleanText($faq['a']),
                    ],
                ],
                $faqs,
            ),
        ];
    }
@endphp

@section('title', $pageTitle)
@section('meta_description', $hub->metaDescription())

@section('breadcrumb')
    <x-front.breadcrumb :items="$breadcrumbs" />
@endsection

@push('head')
    <x-front.json-ld :graph="$schemaGraph" />
@endpush

@section('content')
    <x-front.service-hub.layout :hub="$hub" />
@endsection
