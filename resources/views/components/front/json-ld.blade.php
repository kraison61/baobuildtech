@props([
    'graph' => [],
])

@if (count($graph))
    <script type="application/ld+json">{!! \App\Support\JsonLd::encode($graph) !!}</script>
@endif
