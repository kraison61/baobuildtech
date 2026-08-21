@extends('front.layouts.app')

@php
    $pageTitle = 'งานบริการ — '.config('company.brand_name');
    $pageUrl = route('services');
    $metaDescription = 'รวมงานบริการกำแพงกันดิน คสล. ฐานราก งานโยธา และงานระบบ พร้อมสเปกวัสดุและเกณฑ์ทดสอบที่ใช้จริงหน้างาน';
    $breadcrumbs = [
        ['label' => 'หน้าแรก', 'url' => route('home')],
        ['label' => 'งานบริการ'],
    ];
    $schemaGraph = \App\Support\JsonLd::pageGraph($pageTitle, $pageUrl, $breadcrumbs);
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
        <x-front.services-hero />
        <x-front.services-jump />
        <x-front.services-scope />
        <x-front.cta-band
            title="ขอบเขตชัดแล้ว — ส่งรูปหน้างานมาให้จัดกลุ่มงาน"
            body="ตอบกลับภายใน [1] วันทำการ ว่างานของคุณเข้ากลุ่มใด และต้องใช้ฐานรากแบบไหน — ไม่มีค่าใช้จ่าย ไม่โทรรบกวนหากไม่ได้ขอ"
            variant="white"
        />
        <x-front.services-catalog />
        <x-front.cta-section
            title="ไม่แน่ใจว่างานของคุณอยู่ในกลุ่มไหน"
            body="ส่งรูปพื้นที่ ความสูงดิน และแนวเขตที่ดินมาทางไลน์ ทีมช่างจะตอบกลับภายใน [1] วันทำการ บอกว่างานของคุณเข้ากลุ่มใด ต้องใช้ฐานรากแบบไหน และช่วงราคาคร่าว ๆ — ไม่มีค่าใช้จ่าย และไม่โทรรบกวนหากไม่ได้ขอ"
            variant="paper"
        />
    </main>
@endsection
