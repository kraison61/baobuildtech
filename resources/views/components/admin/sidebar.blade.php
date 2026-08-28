@php
    $nav = [
        ['label' => 'ภาพรวม', 'route' => 'admin.dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
        ['group' => 'งานบริการ'],
        ['label' => 'หมวดหมู่บริการ', 'route' => 'admin.service-categories.index'],
        ['label' => 'บริการ', 'route' => 'admin.services.index'],
        ['label' => 'รายการบริการ', 'route' => 'admin.service-items.index'],
        ['label' => 'ราคาบริการ', 'route' => 'admin.service-prices.index'],
        ['group' => 'เนื้อหา'],
        ['label' => 'ผลงาน', 'route' => 'admin.portfolios.index'],
        ['label' => 'รูปหน้างาน', 'route' => 'admin.work-images.index'],
        ['label' => 'พื้นที่ให้บริการ', 'route' => 'admin.locations.index'],
        ['label' => 'ผู้เขียน', 'route' => 'admin.authors.index'],
        ['label' => 'บทความ', 'route' => 'admin.posts.index'],
        ['label' => 'FAQ', 'route' => 'admin.faqs.index'],
        ['group' => 'ระบบ'],
        ['label' => 'คำขอใบเสนอราคา', 'route' => 'admin.quote-requests.index'],
        ['label' => 'ผู้ใช้', 'route' => 'admin.users.index'],
    ];
@endphp

<aside class="hidden w-64 shrink-0 flex-col border-e border-slate-700 bg-slate-800 md:flex">
    <div class="border-b border-slate-700 px-4 py-4">
        <a href="{{ route('admin.dashboard') }}" class="block font-semibold text-white">{{ config('app.name') }}</a>
        <span class="text-xs text-slate-400">Admin Panel</span>
    </div>
    <nav class="flex-1 space-y-1 overflow-y-auto p-3">
        @foreach ($nav as $item)
            @if (isset($item['group']))
                <div class="px-3 pt-4 pb-1 text-xs font-semibold uppercase tracking-wide text-slate-500">{{ $item['group'] }}</div>
            @else
                @php $active = request()->routeIs($item['route'].'*'); @endphp
                <a
                    href="{{ route($item['route']) }}"
                    @class([
                        'flex items-center gap-2 rounded-lg px-3 py-2 text-sm transition-colors',
                        'bg-emerald-600/20 text-emerald-300' => $active,
                        'text-slate-300 hover:bg-slate-700 hover:text-white' => ! $active,
                    ])
                >
                    {{ $item['label'] }}
                </a>
            @endif
        @endforeach
    </nav>
    <div class="border-t border-slate-700 p-3">
        <a href="{{ route('home') }}" target="_blank" class="mb-2 block rounded-lg px-3 py-2 text-sm text-slate-400 hover:bg-slate-700 hover:text-white">
            ดูหน้าเว็บ ↗
        </a>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="w-full rounded-lg px-3 py-2 text-start text-sm text-slate-400 hover:bg-slate-700 hover:text-white">
                ออกจากระบบ
            </button>
        </form>
    </div>
</aside>
