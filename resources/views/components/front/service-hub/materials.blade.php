@props(['hub'])

@php
    $tableClass = 'w-full min-w-[520px] border-collapse border border-line text-[15px] [&_th]:border-b [&_th]:border-line [&_th]:bg-paper [&_th]:p-3 [&_th]:text-start [&_th]:font-semibold [&_th]:text-brand [&_td]:border-b [&_td]:border-line [&_td]:p-3 [&_td]:align-top [&_td]:text-muted [&_td:first-child]:font-semibold [&_td:first-child]:text-brand';
@endphp

<section id="materials" class="scroll-mt-24 overflow-x-clip bg-white py-16 lg:py-24">
    <x-front.container>
        <div class="grid min-w-0 items-start gap-10 min-[900px]:grid-cols-[minmax(0,1fr)_380px]">
            <div class="min-w-0">
                <x-front.service-hub.section-header
                    :eyebrow="$hub->materialsEyebrow()"
                    :title="$hub->materialsTitle()"
                    :intro="$hub->materialsIntro()"
                />

                @foreach ($hub->materialTables() as $table)
                    <div class="mt-10 overflow-hidden rounded-lg border border-line bg-paper/40 p-4 lg:p-6">
                        <div class="flex flex-wrap items-baseline justify-between gap-2">
                            <h3 class="text-[17px] font-semibold text-brand">{{ $table['title'] }}</h3>
                            <p class="text-[13px] text-muted min-[640px]:hidden">เลื่อนดูตาราง →</p>
                        </div>
                        <div class="mt-4 max-w-full overflow-x-auto overscroll-x-contain pb-1 [-webkit-overflow-scrolling:touch] [scrollbar-width:thin]">
                            <table class="{{ $tableClass }}">
                            <thead>
                                <tr>
                                    @foreach ($table['columns'] as $column)
                                        <th>{{ $column }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($table['rows'] as $row)
                                    <tr>
                                        @foreach ($row as $cell)
                                            <td>{{ $cell }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="min-w-0 min-[900px]:sticky min-[900px]:top-28">
                <x-ui.image-slot
                    :src="$hub->materialsImage()"
                    :label="'วัสดุ — '.$hub->materialsTitle()"
                    spec="760×1013"
                    ratio="3/4"
                    :alt="$hub->materialsImageAlt()"
                    class="w-full rounded-lg"
                    width="760"
                    height="1013"
                    loading="lazy"
                />
            </div>
        </div>
    </x-front.container>
</section>
