@extends('front.layouts.app')

@php
    $pageTitle = config('company.brand_name').' — กำแพงกันดิน คสล. และงานฐานราก';
    $pageUrl = url('/');
    $schemaGraph = \App\Support\JsonLd::pageGraph($pageTitle, $pageUrl);
@endphp

@section('title', $pageTitle)
@section('meta_description', config('company.description'))

@push('head')
    <x-front.json-ld :graph="$schemaGraph" />
@endpush

@section('content')
    <main>
        <x-front.hero />
        <x-front.trust-cards />
        <x-front.pain-points />
        <x-front.cta-band
            title="เคยเจอแบบนี้มาก่อน? ส่งรูปหน้างานมาประเมินก่อน"
            body="ตอบกลับภายใน [1] วันทำการ พร้อมข้อสังเกตทางวิศวกรรม — ไม่มีค่าใช้จ่าย และไม่โทรรบกวนหากไม่ได้ขอ"
            variant="paper"
        />
        <x-front.services-section />
        <x-front.proof-section />
        <x-front.cta-band
            title="ดูหลักฐานแล้ว — ขั้นถัดไปคือส่งรูปหน้างานของคุณ"
            body="เราประเมินจากสภาพดินและความสูงจริง ไม่เดาจากราคาต่อเมตร — ไม่มีค่าใช้จ่าย และไม่ผูกมัด"
            variant="white"
        />
        <x-front.process-section />
        <x-front.cost-section />
        <x-front.faq-section />
        <x-front.cta-section />
    </main>
@endsection
