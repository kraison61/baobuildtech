@extends('front.layouts.app')

@php
    $pageTitle = ($heading ?? $title).' — '.config('company.brand_name');
    $pageUrl = url()->current();
    $breadcrumbs = [
        ['label' => 'หน้าแรก', 'url' => route('home')],
        ['label' => $heading ?? $title],
    ];
    $schemaGraph = \App\Support\JsonLd::pageGraph($pageTitle, $pageUrl, $breadcrumbs);
@endphp

@section('title', $pageTitle)
@section('meta_description', $description ?? config('company.description'))

@section('breadcrumb')
    <x-front.breadcrumb :items="$breadcrumbs" />
@endsection

@push('head')
    <x-front.json-ld :graph="$schemaGraph" />
@endpush

@section('content')
    <main>
        <section id="top" class="border-b border-line bg-paper px-5 py-20 lg:py-32">
            <x-front.container>
                <div class="max-w-[680px]">
                    <h1 class="text-[clamp(1.875rem,5.2vw,2.75rem)] font-semibold leading-[1.35] text-brand">
                        {{ $heading ?? $title }}
                    </h1>
                    <p class="mt-6 text-[17px] leading-[1.8] text-muted">
                        {{ $description ?? 'กำลังจัดทำเนื้อหาของหน้านี้ จะอัปเดตเร็ว ๆ นี้' }}
                    </p>
                    <div class="mt-10">
                        <a href="{{ route('home') }}#cta" class="inline-flex items-center rounded-lg bg-accent px-[26px] py-4 text-[17px] font-semibold text-white hover:bg-accent-dark hover:text-white">
                            ส่งรูปหน้างาน ประเมินฟรี
                        </a>
                    </div>
                </div>
            </x-front.container>
        </section>
    </main>
@endsection
