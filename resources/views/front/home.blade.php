@extends('front.layouts.app')

@php
    $pageTitle = 'BAO — BUILD · ASSURE · OPERATE';
    $pageUrl = url('/');
    $breadcrumbs = [
        ['label' => 'หน้าแรก', 'url' => $pageUrl],
    ];
    $schemaGraph = \App\Support\JsonLd::pageGraph($pageTitle, $pageUrl, $breadcrumbs);
@endphp

@section('title', $pageTitle)
@section('meta_description', config('company.description'))

@push('head')
    <x-front.json-ld :graph="$schemaGraph" />
@endpush

@section('breadcrumb')
    <x-front.breadcrumb :items="$breadcrumbs" />
@endsection

@section('content')
    <main id="top" class="mx-auto max-w-[1280px] px-5 lg:px-14">
        <x-front.hero />

        <div class="aspect-16/9 sm:aspect-21/9 bg-neutral-200 border border-dashed border-neutral-400 grid place-items-center text-center text-neutral-500 px-6">
            <div>
                <p class="text-sm font-semibold">ภาพหน้าปก: งานกำแพงกันดิน/รั้วโครงการ ถ่ายมุมกว้าง</p>
                <p class="text-xs mt-1.5">แนวนอน 2400×900 px</p>
            </div>
        </div>

        <x-front.services-section />
        <x-front.portfolio-grid />
    </main>

    <x-front.why-us-section />
    <x-front.process-section />
    <x-front.standards-section />
    <x-front.clients-section />
    <x-front.team-section />
    <x-front.contact-section />
@endsection
