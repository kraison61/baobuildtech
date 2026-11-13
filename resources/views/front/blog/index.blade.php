@extends('front.layouts.app')

@php
    $pageTitle = __('ui.blog').' — '.config('company.brand_name');
    $pageUrl = \App\Support\Locale::route('blog.index');
    $metaDescription = \App\Support\Locale::pick(
        'บทความความรู้เรื่องงานก่อสร้าง ระบบไฟฟ้า โซล่าเซลล์ และเงื่อนไขโครงการจากทีมช่าง '.config('company.brand_name'),
        'Practical articles on construction, electrical systems, solar, and project requirements from the '.config('company.brand_name').' crew',
    );
    $breadcrumbs = [
        ['label' => __('ui.home'), 'url' => \App\Support\Locale::route('home')],
        ['label' => __('ui.blog')],
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
                    บทความ
                </h1>
                <p class="mt-6 max-w-[680px] text-[17px] leading-[1.8] text-muted">
                    ความรู้จากหน้างาน เงื่อนไขโครงการ และแนวทางตัดสินใจก่อนติดตั้งหรือก่อสร้าง
                </p>
            </x-front.container>
        </section>

        <section class="bg-white py-16 lg:py-24">
            <x-front.container>
                @if ($posts->isEmpty())
                    <p class="text-[17px] leading-[1.8] text-muted">ยังไม่มีบทความที่เผยแพร่</p>
                @else
                    <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($posts as $post)
                            <a href="{{ $post->url() }}" class="group block hover:no-underline">
                                <x-ui.image-slot
                                    :src="$post->imageUrl()"
                                    :alt="$post->title"
                                    :label="$post->title"
                                    ratio="16/9"
                                    spec="1200×675"
                                    :width="1200"
                                    :height="675"
                                    class="rounded-xl border border-line"
                                />
                                <h2 class="mt-5 text-[22px] font-semibold leading-[1.4] text-brand group-hover:text-brand-mid">
                                    {{ $post->title }}
                                </h2>
                                @if ($post->excerpt)
                                    <p class="mt-3 text-[16px] leading-[1.7] text-muted">
                                        {{ \Illuminate\Support\Str::limit($post->excerpt, 140) }}
                                    </p>
                                @endif
                                @if ($post->published_at)
                                    <p class="mt-3 text-[14px] text-muted">
                                        <time datetime="{{ $post->published_at->toIso8601String() }}">
                                            {{ $post->published_at->locale(app()->getLocale())->translatedFormat('j F Y') }}
                                        </time>
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
