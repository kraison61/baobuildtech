<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $static = [
            ['loc' => route('home'), 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['loc' => route('services'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => route('works'), 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['loc' => route('articles'), 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['loc' => route('gallery'), 'priority' => '0.6', 'changefreq' => 'weekly'],
            ['loc' => route('about'), 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['loc' => route('contact'), 'priority' => '0.8', 'changefreq' => 'monthly'],
        ];

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

        return response()
            ->view('front.sitemap', compact('static', 'services', 'items'))
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
