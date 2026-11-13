@extends('front.layouts.app')

@php
    $pageTitle = \App\Support\ContactContent::metaTitle();
    $pageUrl = \App\Support\Locale::route('contact');
    $breadcrumbs = [
        ['label' => __('ui.home'), 'url' => \App\Support\Locale::route('home')],
        ['label' => __('ui.contact')],
    ];
    $orgExtra = [];

    if ($geo = \App\Support\Company::geoCoordinates()) {
        $orgExtra['geo'] = $geo;
    }

    $schemaGraph = \App\Support\JsonLd::pageGraph(
        $pageTitle,
        $pageUrl,
        $breadcrumbs,
        \App\Support\Company::serviceAreas(includeCountry: false),
        $orgExtra,
    );

    $faqs = \App\Support\ContactContent::faqs();
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
@section('meta_description', \App\Support\ContactContent::metaDescription())

@section('breadcrumb')
    <x-front.breadcrumb :items="$breadcrumbs" />
@endsection

@push('head')
    <x-front.json-ld :graph="$schemaGraph" />
@endpush

@section('content')
    <main>
        <x-front.contact.hero />
        <x-front.contact.channels />
        <x-front.contact.form />
        <x-front.contact.office />
        <x-front.contact.faq />
    </main>
@endsection
