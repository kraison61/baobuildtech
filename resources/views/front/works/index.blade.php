@extends('front.layouts.app')

@php
    $pageTitle = __('ui.works').' — '.config('company.brand_name');
    $pageUrl = \App\Support\Locale::route('works');
    $metaDescription = __('ui.works_description');
    $breadcrumbs = [
        ['label' => __('ui.home'), 'url' => \App\Support\Locale::route('home')],
        ['label' => __('ui.works')],
    ];
    $schemaGraph = \App\Support\JsonLd::pageGraph($pageTitle, $pageUrl, $breadcrumbs);
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
                <p class="text-[clamp(1.75rem,4vw,2.25rem)] font-semibold leading-tight tracking-tight text-brand">
                    {{ config('company.brand_name') }}
                </p>
                <h1 class="mt-6 text-[clamp(1.625rem,4.4vw,2.35rem)] font-semibold leading-[1.35] text-brand">
                    {{ __('ui.works_heading') }}
                </h1>
                <p class="mt-6 max-w-[680px] text-[17px] leading-[1.8] text-muted">
                    {{ __('ui.works_description') }}
                </p>
            </x-front.container>
        </section>

        <section class="bg-white py-16 lg:py-24">
            <x-front.container>
                @if ($portfolios->isEmpty())
                    <p class="text-[17px] leading-[1.8] text-muted">
                        {{ \App\Support\Locale::pick('ยังไม่มีผลงานที่เผยแพร่', 'No published projects yet') }}
                    </p>
                @else
                    <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($portfolios as $portfolio)
                            <a href="{{ $portfolio->url() }}" class="group block hover:no-underline">
                                <x-ui.image-slot
                                    :src="$portfolio->cover_image"
                                    :alt="$portfolio->title"
                                    :label="$portfolio->title"
                                    ratio="4/3"
                                    spec="800×600"
                                    :width="800"
                                    :height="600"
                                    class="rounded-xl border border-line"
                                />
                                <h2 class="mt-5 text-[22px] font-semibold leading-[1.4] text-brand group-hover:text-brand-mid">
                                    {{ $portfolio->title }}
                                </h2>
                                @if ($portfolio->description)
                                    <p class="mt-3 text-[16px] leading-[1.7] text-muted">
                                        {{ \Illuminate\Support\Str::limit($portfolio->description, 140) }}
                                    </p>
                                @endif
                                @if ($portfolio->location || $portfolio->completed_at)
                                    <p class="mt-3 text-[14px] text-muted">
                                        @if ($portfolio->location)
                                            {{ $portfolio->location->name }}
                                        @endif
                                        @if ($portfolio->location && $portfolio->completed_at)
                                            ·
                                        @endif
                                        @if ($portfolio->completed_at)
                                            <time datetime="{{ $portfolio->completed_at->toDateString() }}">
                                                {{ $portfolio->completed_at->locale(app()->getLocale())->translatedFormat('M Y') }}
                                            </time>
                                        @endif
                                    </p>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @endif
            </x-front.container>
        </section>
    </main>
@endsection
