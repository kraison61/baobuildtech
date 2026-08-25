@extends('front.layouts.app')

@php
    $pageTitle = \App\Support\AboutContent::metaTitle();
    $pageUrl = route('about');
    $breadcrumbs = [
        ['label' => 'หน้าแรก', 'url' => route('home')],
        ['label' => 'เกี่ยวกับเรา'],
    ];
    $siteUrl = rtrim((string) config('company.site_url'), '/');
    $schemaGraph = \App\Support\JsonLd::pageGraph(
        $pageTitle,
        $pageUrl,
        $breadcrumbs,
        \App\Support\Company::serviceAreas(),
        webPageExtra: ['about' => ['@id' => $siteUrl.'#organization']],
    );
@endphp

@section('title', $pageTitle)
@section('meta_description', \App\Support\AboutContent::metaDescription())

@section('breadcrumb')
    <x-front.breadcrumb :items="$breadcrumbs" />
@endsection

@push('head')
    <x-front.json-ld :graph="$schemaGraph" />
@endpush

@section('content')
    <main>
        <x-front.about-hero />
        <x-front.about-stats />
        <x-front.about-story />
        <x-front.about-principles />
        <x-front.about-team />
        <x-front.about-process />
        <x-front.about-company />
        <x-front.about-cta />
    </main>
@endsection
