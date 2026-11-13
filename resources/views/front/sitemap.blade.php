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
        <loc>{{ route('services.show', [$service->category->slug, $service->slug]) }}</loc>
@if ($service->updated_at)
        <lastmod>{{ $service->updated_at->toAtomString() }}</lastmod>
@endif
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ route('en.services.show', [$service->category->slug, $service->slug]) }}</loc>
@if ($service->updated_at)
        <lastmod>{{ $service->updated_at->toAtomString() }}</lastmod>
@endif
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
@endforeach
@foreach ($items as $item)
    <url>
        <loc>{{ route('services.items.show', [$item->service->category->slug, $item->service->slug, $item->slug]) }}</loc>
@if ($item->updated_at)
        <lastmod>{{ $item->updated_at->toAtomString() }}</lastmod>
@endif
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ route('en.services.items.show', [$item->service->category->slug, $item->service->slug, $item->slug]) }}</loc>
@if ($item->updated_at)
        <lastmod>{{ $item->updated_at->toAtomString() }}</lastmod>
@endif
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
@endforeach
@foreach ($posts as $post)
    <url>
        <loc>{{ route('blog.show', $post->slug) }}</loc>
@if ($post->updated_at)
        <lastmod>{{ $post->updated_at->toAtomString() }}</lastmod>
@endif
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    <url>
        <loc>{{ route('en.blog.show', $post->slug) }}</loc>
@if ($post->updated_at)
        <lastmod>{{ $post->updated_at->toAtomString() }}</lastmod>
@endif
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
@endforeach
</urlset>
