@extends('front.layouts.app')

@php
    $heading = isset($headingKey) ? __($headingKey) : ($heading ?? $title ?? '');
    $titleText = isset($titleKey) ? __($titleKey) : ($title ?? $heading);
    $descriptionText = isset($descriptionKey) ? __($descriptionKey) : ($description ?? __('ui.placeholder_body'));
    $pageTitle = $heading.' — '.config('company.brand_name');
    $pageUrl = url()->current();
    $breadcrumbs = [
        ['label' => __('ui.home'), 'url' => \App\Support\Locale::route('home')],
        ['label' => $heading],
    ];
    $schemaGraph = \App\Support\JsonLd::pageGraph($pageTitle, $pageUrl, $breadcrumbs);
@endphp

@section('title', $pageTitle)
@section('meta_description', $descriptionText)

@section('breadcrumb')
    <x-front.breadcrumb :items="$breadcrumbs" />
@endsection

@push('head')
    <x-front.json-ld :graph="$schemaGraph" />
@endpush

@section('content')
    <main>
        <section id="top" class="border-b border-line bg-paper py-20 lg:py-32">
            <x-front.container>
                <div class="max-w-[680px]">
                    <h1 class="text-[clamp(1.875rem,5.2vw,2.75rem)] font-semibold leading-[1.35] text-brand">
                        {{ $heading }}
                    </h1>
                    <p class="mt-6 text-[17px] leading-[1.8] text-muted">
                        {{ $descriptionText }}
                    </p>
                    <div class="mt-10">
                        <a href="{{ \App\Support\Locale::route('home') }}#cta" class="inline-flex items-center rounded-lg bg-accent px-[26px] py-4 text-[17px] font-semibold text-white hover:bg-accent-dark hover:text-white">
                            {{ __('ui.cta_free_quote') }}
                        </a>
                    </div>
                </div>
            </x-front.container>
        </section>
    </main>
@endsection
