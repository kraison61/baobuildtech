{!! '<'.'?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach ($static as $page)
    <url>
        <loc>{{ $page['loc'] }}</loc>
        <changefreq>{{ $page['changefreq'] }}</changefreq>
        <priority>{{ $page['priority'] }}</priority>
    </url>
@endforeach
@foreach ($services as $service)
    <url>
        <loc>{{ $service->url() }}</loc>
@if ($service->updated_at)
        <lastmod>{{ $service->updated_at->toAtomString() }}</lastmod>
@endif
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
@endforeach
@foreach ($items as $item)
    <url>
        <loc>{{ $item->url() }}</loc>
@if ($item->updated_at)
        <lastmod>{{ $item->updated_at->toAtomString() }}</lastmod>
@endif
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
@endforeach
</urlset>
