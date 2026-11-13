<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Post;
use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $staticNames = [
            ['name' => 'home', 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['name' => 'services', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['name' => 'works', 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['name' => 'blog.index', 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['name' => 'gallery', 'priority' => '0.6', 'changefreq' => 'weekly'],
            ['name' => 'about', 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['name' => 'contact', 'priority' => '0.8', 'changefreq' => 'monthly'],
        ];

        $static = [];
        foreach ($staticNames as $page) {
            $static[] = [
                'loc' => route($page['name']),
                'priority' => $page['priority'],
                'changefreq' => $page['changefreq'],
            ];
            $static[] = [
                'loc' => route('en.'.$page['name']),
                'priority' => $page['priority'],
                'changefreq' => $page['changefreq'],
            ];
        }

        $services = Service::query()
            ->where('is_published', true)
            ->whereHas('category', static fn ($q) => $q->where('is_active', true))
            ->with('category')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $items = ServiceItem::query()
            ->where('is_published', true)
            ->whereHas(
                'service',
                static fn ($q) => $q
                    ->where('is_published', true)
                    ->whereHas('category', static fn ($q2) => $q2->where('is_active', true))
            )
            ->with('service.category')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $posts = Post::query()
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->get();

        $portfolios = Portfolio::query()
            ->where('is_published', true)
            ->orderByDesc('completed_at')
            ->orderByDesc('id')
            ->get();

        return response()
            ->view('front.sitemap', compact('static', 'services', 'items', 'posts', 'portfolios'))
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function robots(): Response
    {
        $content = implode("\n", [
            'User-agent: *',
            'Disallow:',
            '',
            'Sitemap: '.route('sitemap'),
            '',
        ]);

        return response($content, 200)
            ->header('Content-Type', 'text/plain; charset=UTF-8');
    }
}
