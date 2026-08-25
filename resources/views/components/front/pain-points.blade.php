@php
    $concerns = \App\Support\HomeContent::concerns();
    $fixes = \App\Support\HomeContent::concernFixes();
    $lineUrl = \App\Support\Company::lineUrl();
@endphp

<section id="concerns" class="scroll-mt-24 bg-white py-16 lg:py-24">
    <x-front.container>
        <div class="max-w-[720px]">
            <h2 class="text-[clamp(1.625rem,4vw,2rem)] font-semibold leading-[1.4] text-brand">
                ก่อนเซ็นสัญญากับผู้รับเหมา คุณกำลังกังวลเรื่องพวกนี้อยู่ใช่ไหม
            </h2>

            <ul class="mt-8 grid list-none gap-0 border-t border-line p-0">
                @foreach ($concerns as $concern)
                    <li class="border-b border-line py-5 text-[17px] leading-[1.8] text-muted">{{ $concern }}</li>
                @endforeach
            </ul>

            <p class="mt-8 text-[17px] leading-[1.8] text-muted">
                ทั้งหมดนี้คือเหตุผลที่ BOA ถูกตั้งขึ้นมา และเราออกแบบวิธีทำงานเพื่อปิดช่องทีละข้อ
            </p>
        </div>

        <div class="mt-10 overflow-x-auto">
            <table class="w-full min-w-[560px] border-collapse text-[17px]">
                <thead>
                    <tr>
                        <th class="border-b border-line py-3.5 pr-4 text-left font-semibold text-muted">สิ่งที่คุณกลัว</th>
                        <th class="border-b border-line py-3.5 pl-4 text-left font-semibold text-brand">วิธีที่ BOA ปิดช่อง</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fixes as $row)
                        <tr>
                            <td class="border-b border-line py-[18px] pr-4 align-top leading-[1.7] text-muted">{{ $row['fear'] }}</td>
                            <td class="border-b border-line py-[18px] pl-4 align-top font-semibold leading-[1.7] text-ink">{{ $row['fix'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-10">
            <a
                href="{{ $lineUrl ?? '#cta' }}"
                class="inline-flex items-center rounded-lg bg-accent px-[26px] py-4 text-[17px] font-semibold text-white hover:bg-accent-dark hover:text-white"
                @if ($lineUrl) target="_blank" rel="noopener noreferrer" @endif
            >ปรึกษาฟรี ไม่ผูกมัด</a>
        </div>
    </x-front.container>
</section>
