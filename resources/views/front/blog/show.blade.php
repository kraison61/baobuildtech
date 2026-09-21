@extends('front.layouts.app')

@php
    $pageTitle = $post->meta_title ?: ($post->title.' — '.config('company.brand_name'));
    $pageUrl = $post->url();
    $metaDescription = $post->meta_description ?: \Illuminate\Support\Str::limit(
        strip_tags((string) $post->excerpt),
        160,
        ''
    );
    $publishedAt = $post->published_at ?? $post->created_at;
    $modifiedAt = $post->updated_at ?? $publishedAt;
    $breadcrumbs = [
        ['label' => 'หน้าแรก', 'url' => route('home')],
        ['label' => 'บทความ', 'url' => route('blog.index')],
        ['label' => $post->title],
    ];

    $schemaGraph = \App\Support\JsonLd::pageGraph(
        $pageTitle,
        $pageUrl,
        $breadcrumbs,
        webPageExtra: [
            'datePublished' => $publishedAt?->toIso8601String(),
            'dateModified' => $modifiedAt?->toIso8601String(),
            'primaryImageOfPage' => filled($post->image_16x9) ? $post->image_16x9 : null,
            'mainEntity' => ['@id' => rtrim($pageUrl, '/').'#article'],
        ],
    );

    if ($post->author) {
        $schemaGraph[] = \App\Support\JsonLd::personEntity($post->author);
    }

    $schemaGraph[] = \App\Support\JsonLd::articleEntity($post, $pageUrl);

    if ($post->faqs->isNotEmpty()) {
        $schemaGraph[2]['mainEntity'] = [
            ['@id' => rtrim($pageUrl, '/').'#article'],
            ['@id' => rtrim($pageUrl, '/').'#faq'],
        ];
        $schemaGraph[] = \App\Support\JsonLd::faqPage($pageUrl, $post->faqs);
    }
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
        <x-front.blog.hero :post="$post" />

        <x-front.blog.content :post="$post" />

        @if ($post->faqs->isNotEmpty())
            <x-front.blog.faqs :faqs="$post->faqs" />
        @endif

        <x-front.cta-section
            title="ต้องการประเมินหลังคาและขนาดระบบโซล่าเซลล์?"
            body="ส่งรูปหลังคาและบิลค่าไฟมาทางไลน์ ทีมช่างจะช่วยตรวจโครงสร้าง ประเมินขนาดระบบ และแนะนำขั้นตอนสมัครโครงการโซล่าเซลล์ภาคประชาชน — ไม่มีค่าใช้จ่าย และไม่โทรรบกวนหากไม่ได้ขอ"
            variant="paper"
        />
    </main>
@endsection
