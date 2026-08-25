@extends('front.layouts.app')

@php
    $pageTitle = \App\Support\HomeContent::metaTitle();
    $pageUrl = url('/');
    $schemaFaqs = \App\Support\HomeContent::schemaFaqs();
    $portfolios = \App\Models\Portfolio::query()
        ->where('is_published', true)
        ->with('location')
        ->latest('completed_at')
        ->limit(3)
        ->get();

    $schemaGraph = \App\Support\JsonLd::homepageGraph(
        $pageTitle,
        $pageUrl,
        $schemaFaqs,
        \App\Support\HomeContent::schemaServiceNames(),
        \App\Support\HomeContent::serviceAreas(),
    );
@endphp

@section('title', $pageTitle)
@section('meta_description', \App\Support\HomeContent::metaDescription())

@push('head')
    <x-front.json-ld :graph="$schemaGraph" />
@endpush

@section('content')
    <main>
        {{-- v2: 11 บล็อก — ทางแยก ไม่ใช่ปลายทาง --}}
        <x-front.hero />
        <x-front.trust-cards />
        <x-front.pain-points />
        <x-front.proof-section :portfolios="$portfolios" />
        <x-front.why-section />
        <x-front.phases-section />
        <x-front.services-section />
        <x-front.about-section />
        <x-front.process-section />
        <x-front.faq-section />
        <x-front.cta-section />
    </main>
@endsection
