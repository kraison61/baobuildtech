@php
    $facts = \App\Support\AboutContent::companyFacts();
    $areas = \App\Support\Company::serviceAreas(includeCountry: false);
@endphp

<section id="area" class="bg-white py-20 lg:py-32">
    <x-front.container class="grid items-start gap-8 min-[900px]:grid-cols-2 min-[900px]:gap-16">
        <div>
            <div class="flex items-center gap-2 text-sm font-semibold tracking-wide text-brand-mid">
                <span class="h-px w-7 bg-brand-mid"></span>
                {{ \App\Support\AboutContent::companyEyebrow() }}
            </div>
            <h2 class="mt-6 text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">
                {{ \App\Support\AboutContent::companyTitle() }}
            </h2>
            <dl class="mt-8 grid max-w-[520px] gap-3 border-t border-line pt-6 text-[15px] leading-[1.7]">
                @foreach ($facts as $fact)
                    <div class="flex justify-between gap-4">
                        <dt class="shrink-0 text-muted">{{ $fact['label'] }}</dt>
                        <dd class="m-0 text-end font-semibold tabular-nums text-ink">{{ $fact['value'] }}</dd>
                    </div>
                @endforeach
            </dl>
        </div>
        <div class="rounded-lg border border-line bg-paper p-6 sm:p-8">
            <div class="text-[15px] font-semibold text-brand-mid">พื้นที่รับงาน</div>
            <ul class="mt-4 grid list-none gap-3 p-0 text-[17px] leading-[1.7] text-ink">
                @foreach ($areas as $area)
                    <li>{{ $area }}</li>
                @endforeach
            </ul>
            <p class="mt-6 border-t border-line pt-6 text-[15px] leading-[1.8] text-muted">
                โครงการนอกพื้นที่พิจารณาเป็นรายกรณีตามขนาดงาน ถ้างานอยู่ในต่างจังหวัดติดต่อมาคุยได้ — อาจมีค่าเดินทางสำรวจหน้างาน แต่หักลดกับราคางานได้หากตกลงจ้าง
            </p>
        </div>
    </x-front.container>
</section>
