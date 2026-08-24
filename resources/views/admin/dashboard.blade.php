@extends('admin.layouts.app')

@section('title', 'ภาพรวม')

@section('content')
    <x-admin.page-header title="ภาพรวม">จัดการข้อมูลภายในเว็บไซต์</x-admin.page-header>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">
        @foreach ([
            ['label' => 'หมวดหมู่บริการ', 'count' => $stats['categories'], 'route' => 'admin.service-categories.index'],
            ['label' => 'บริการ', 'count' => $stats['services'], 'route' => 'admin.services.index'],
            ['label' => 'รายการบริการ', 'count' => $stats['service_items'], 'route' => 'admin.service-items.index'],
            ['label' => 'ราคาบริการ', 'count' => $stats['prices'], 'route' => 'admin.service-prices.index'],
            ['label' => 'ผลงาน', 'count' => $stats['portfolios'], 'route' => 'admin.portfolios.index'],
            ['label' => 'พื้นที่ให้บริการ', 'count' => $stats['locations'], 'route' => 'admin.locations.index'],
            ['label' => 'ผู้เขียน', 'count' => $stats['authors'], 'route' => 'admin.authors.index'],
            ['label' => 'บทความ', 'count' => $stats['posts'], 'route' => 'admin.posts.index'],
            ['label' => 'FAQ', 'count' => $stats['faqs'], 'route' => 'admin.faqs.index'],
            ['label' => 'ผู้ใช้', 'count' => $stats['users'], 'route' => 'admin.users.index'],
        ] as $card)
            <a href="{{ route($card['route']) }}" class="rounded-xl border border-slate-700 bg-slate-800/60 p-4 transition-colors hover:border-emerald-500/40 hover:bg-slate-800">
                <p class="text-3xl font-semibold text-white">{{ number_format($card['count']) }}</p>
                <p class="mt-1 text-sm text-slate-400">{{ $card['label'] }}</p>
            </a>
        @endforeach
    </div>
@endsection
