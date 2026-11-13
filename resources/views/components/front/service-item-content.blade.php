@props([
    'item',
])

@php
    $content = \App\Support\RichHtml::prepare((string) $item->content);
@endphp

<section id="content" class="scroll-mt-24 bg-white py-16 lg:py-24">
    <x-front.container>
        <div class="mx-auto max-w-[960px] text-[17px] leading-[1.8] text-muted [&_h2]:mt-12 [&_h2]:text-[clamp(1.625rem,4vw,2rem)] [&_h2]:font-semibold [&_h2]:leading-[1.4] [&_h2]:text-brand [&_h2:first-child]:mt-0 [&_h3]:mt-8 [&_h3]:text-[22px] [&_h3]:font-semibold [&_h3]:text-brand [&_p]:mt-6 [&_p:first-child]:mt-0 [&_ul]:mt-6 [&_ul]:list-disc [&_ul]:ps-6 [&_ol]:mt-6 [&_ol]:list-decimal [&_ol]:ps-6 [&_li]:mt-2 [&_div:has(>table)]:mt-8 [&_table]:w-full [&_table]:min-w-[560px] [&_table]:border-collapse [&_table]:border [&_table]:border-line [&_th]:border-b [&_th]:border-line [&_th]:bg-paper [&_th]:p-4 [&_th]:text-start [&_th]:font-semibold [&_th]:text-brand [&_td]:border-b [&_td]:border-line [&_td]:p-4 [&_td]:align-top [&_strong]:font-semibold [&_strong]:text-ink [&_.content-gallery]:mt-6 [&_.content-gallery]:grid [&_.content-gallery]:grid-cols-1 [&_.content-gallery]:gap-4 [&_.content-gallery--2]:sm:grid-cols-2 [&_.content-gallery--3]:sm:grid-cols-2 [&_.content-gallery--3]:lg:grid-cols-3 [&_figure]:m-0 [&_figure]:overflow-hidden [&_figure]:rounded-xl [&_figure]:border [&_figure]:border-line [&_figure]:bg-paper [&_img]:block [&_img]:aspect-4/3 [&_img]:h-auto [&_img]:w-full [&_img]:object-cover">
            {!! $content !!}
        </div>
    </x-front.container>
</section>
