@props(['hub'])

@php
    /** @var \App\Contracts\ServiceHubContent $hub */
    $sectionComponents = [
        'hero' => 'front.service-hub.hero',
        'price-summary' => 'front.service-hub.price-summary',
        'highlights' => 'front.service-hub.highlights',
        'jump' => 'front.service-hub.jump',
        'cards' => 'front.service-hub.cards',
        'pricing' => 'front.service-hub.pricing',
        'materials' => 'front.service-hub.materials',
        'process' => 'front.service-hub.process',
        'guide' => 'front.service-hub.guide',
        'portfolio' => 'front.service-hub.portfolio',
        'faq' => 'front.service-hub.faq',
        'cta' => 'front.service-hub.cta',
        'author' => 'front.service-hub.author',
    ];
@endphp

<main class="overflow-x-clip">
    @foreach ($hub->enabledSections() as $section)
        @if (isset($sectionComponents[$section]))
            <x-dynamic-component :component="$sectionComponents[$section]" :hub="$hub" />
        @endif
    @endforeach
</main>
