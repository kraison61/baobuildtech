@php
    $phoneDisplay = \App\Support\Company::phoneDisplay();
    $lineId = \App\Support\Company::lineId();
    $addressDisplay = \App\Support\Company::addressDisplay();
    $hoursDisplay = \App\Support\Company::hoursDisplay();
    $brand = config('company.brand_name');
    $legal = config('company.legal_name');
    $taxId = config('company.tax_id');
    $email = config('company.email');
    $servicesIndex = \App\Support\Locale::route('services');

    $services = \App\Support\Locale::pickAny(
        [
            ['label' => 'สำรวจ', 'href' => $servicesIndex.'#survey'],
            ['label' => 'เสาเข็มและฐานราก', 'href' => \App\Support\Locale::route('services.show', ['civil', 'piles-foundation'])],
            ['label' => 'โครงสร้าง', 'href' => $servicesIndex.'#structure'],
            ['label' => 'ระบบไฟฟ้า', 'href' => $servicesIndex.'#electrical'],
            ['label' => 'สายสัญญาณ', 'href' => $servicesIndex.'#network-cabling'],
            ['label' => 'กล้องวงจรปิด', 'href' => $servicesIndex.'#cctv'],
        ],
        [
            ['label' => 'Survey', 'href' => $servicesIndex.'#survey'],
            ['label' => 'Piles & foundation', 'href' => \App\Support\Locale::route('services.show', ['civil', 'piles-foundation'])],
            ['label' => 'Structure', 'href' => $servicesIndex.'#structure'],
            ['label' => 'Electrical', 'href' => $servicesIndex.'#electrical'],
            ['label' => 'Network cabling', 'href' => $servicesIndex.'#network-cabling'],
            ['label' => 'CCTV', 'href' => $servicesIndex.'#cctv'],
        ],
    );
@endphp

<footer class="border-t border-sand/20 bg-brand pt-16 pb-10 text-sand lg:pt-24">
    <x-front.container class="grid gap-10 [grid-template-columns:repeat(auto-fit,minmax(220px,1fr))]">
        <div class="max-w-[320px]">
            <a href="{{ \App\Support\Locale::route('home') }}" class="inline-flex items-center gap-3 text-white hover:text-white">
                <x-ui.logo-mark size="size-11" />
                <span class="text-[17px] font-semibold">{{ $brand }}</span>
            </a>
            <p class="mt-3 text-[15px] leading-[1.8]">
                {{ \App\Support\Company::description() }}
            </p>
        </div>

        <div>
            <div class="text-[15px] font-semibold text-white">{{ \App\Support\Locale::pick('เมนู', 'Menu') }}</div>
            <ul class="mt-3 grid list-none gap-2 p-0 text-[15px]">
                <li><a href="{{ \App\Support\Locale::route('home') }}" class="text-sand hover:text-white">{{ __('ui.home') }}</a></li>
                <li><a href="{{ \App\Support\Locale::route('services') }}" class="text-sand hover:text-white">{{ __('ui.services') }}</a></li>
                <li><a href="{{ \App\Support\Locale::route('works') }}" class="text-sand hover:text-white">{{ __('ui.works') }}</a></li>
                <li><a href="{{ \App\Support\Locale::route('blog.index') }}" class="text-sand hover:text-white">{{ __('ui.blog') }}</a></li>
                <li><a href="{{ \App\Support\Locale::route('gallery') }}" class="text-sand hover:text-white">{{ __('ui.gallery') }}</a></li>
                <li><a href="{{ \App\Support\Locale::route('about') }}" class="text-sand hover:text-white">{{ __('ui.about') }}</a></li>
                <li><a href="{{ \App\Support\Locale::route('contact') }}" class="text-sand hover:text-white">{{ __('ui.contact') }}</a></li>
            </ul>
        </div>

        <div>
            <div class="text-[15px] font-semibold text-white">{{ \App\Support\Locale::pick('งานที่รับ', 'What we do') }}</div>
            <ul class="mt-3 grid list-none gap-2 p-0 text-[15px]">
                @foreach ($services as $item)
                    <li>
                        <a href="{{ $item['href'] }}" class="text-sand hover:text-white">{{ $item['label'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div>
            <div class="text-[15px] font-semibold text-white">{{ __('ui.contact') }}</div>
            <ul class="mt-3 grid list-none gap-2 p-0 text-[15px]">
                <li>{{ \App\Support\Locale::pick('โทร', 'Call') }} {{ $phoneDisplay }}</li>
                @if ($lineId)
                    <li>LINE {{ $lineId }}</li>
                @endif
                @if ($email)
                    <li>{{ $email }}</li>
                @endif
                <li>{{ $hoursDisplay }}</li>
                <li>{{ $addressDisplay }}</li>
            </ul>
            <p class="mt-4 text-[13px] leading-[1.7] text-sand/70">
                {{ $legal }}
                @if ($taxId)
                    · {{ \App\Support\Locale::pick('เลขผู้เสียภาษี', 'Tax ID') }} {{ $taxId }}
                @endif
            </p>
        </div>
    </x-front.container>
</footer>
