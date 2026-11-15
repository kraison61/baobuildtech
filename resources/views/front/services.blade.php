@extends('front.layouts.app')

@php
    $pageTitle = __('ui.services').' — '.config('company.brand_name');
    $pageUrl = \App\Support\Locale::route('services');
    $metaDescription = \App\Support\Locale::pick(
        'เริ่มตรงไหนก็ได้ จบครบในสัญญาเดียว — รื้อถอน เตรียมที่ดิน เสาเข็ม อลูมิเนียม และงานระบบ พร้อมสเปกที่ใช้จริงหน้างาน',
        'Start anywhere, finish under one contract — demolition, site prep, piles, aluminium, and systems with real on-site specs',
    );
    $breadcrumbs = [
        ['label' => __('ui.home'), 'url' => \App\Support\Locale::route('home')],
        ['label' => __('ui.services')],
    ];
    $schemaGraph = \App\Support\JsonLd::pageGraph(
        $pageTitle,
        $pageUrl,
        $breadcrumbs,
        \App\Support\Company::serviceAreas(includeCountry: false),
    );
@endphp

@section('title', $pageTitle)
@section('meta_description', $metaDescription)

@section('breadcrumb')
    <x-front.breadcrumb :items="$breadcrumbs" />
@endsection

@push('head')
    <x-front.json-ld :graph="$schemaGraph" />
@endpush

@section('content')
    <main>
        <x-front.services.hero />
        <x-front.services.jump :sections="$sections" />
        <x-front.services.scope />
        <x-front.cta-band
            title="ขอบเขตชัดแล้ว — ส่งรูปหน้างานมาให้จัดกลุ่มงาน"
            body="ตอบกลับภายใน 1 วันทำการ ว่างานของคุณเข้ากลุ่มใด และต้องเริ่มจากขั้นไหน — ไม่มีค่าใช้จ่าย ไม่โทรรบกวนหากไม่ได้ขอ"
            variant="white"
        />
        <x-front.services.catalog :sections="$sections" />
        <x-front.cta-section
            title="ไม่แน่ใจว่างานของคุณอยู่ในกลุ่มไหน"
            body="ส่งรูปพื้นที่ ความสูงดิน และแนวเขตที่ดินมาทางไลน์ ทีมช่างจะตอบกลับภายใน 1 วันทำการ บอกว่างานของคุณเข้ากลุ่มใด ต้องเริ่มจากขั้นไหน และช่วงราคาคร่าว ๆ — ไม่มีค่าใช้จ่าย และไม่โทรรบกวนหากไม่ได้ขอ"
            variant="paper"
        />
    </main>
@endsection
