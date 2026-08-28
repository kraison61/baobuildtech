@props(['hub'])

<section class="bg-white pb-2 pt-6" aria-label="ลิงก์ไปยังหัวข้อในหน้า">
    <x-front.container>
        <div class="flex gap-2 overflow-x-auto pb-1 [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
            @foreach ($hub->jumpLinks() as $link)
                <a
                    href="{{ $link['href'] }}"
                    class="shrink-0 whitespace-nowrap rounded-full border border-line bg-white px-4 py-2 text-[14px] font-semibold text-brand hover:border-brand-mid"
                >{{ $link['label'] }}</a>
            @endforeach
        </div>
    </x-front.container>
</section>
