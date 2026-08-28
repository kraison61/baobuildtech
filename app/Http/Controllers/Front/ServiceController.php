<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Support\ServiceHub\ServiceHubRegistry;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * หน้ารวมงานบริการ — แสดงเฉพาะหมวดที่ active และบริการที่เผยแพร่
     */
    public function index(): View
    {
        $categories = ServiceCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->with([
                'services' => static fn ($q) => $q
                    ->where('is_published', true)
                    ->orderBy('sort_order')
                    ->with([
                        'items' => static fn ($q) => $q
                            ->where('is_published', true)
                            ->orderBy('sort_order'),
                        'prices' => static fn ($q) => $q
                            ->where('is_visible', true)
                            ->orderBy('sort_order'),
                    ]),
            ])
            ->get();

        return view('front.services', [
            'categories' => $categories,
        ]);
    }

    /**
     * หน้ารายละเอียดบริการ หรือหน้า Hub (ถ้ามีลงทะเบียนใน ServiceHubRegistry)
     */
    public function show(string $slug): View|RedirectResponse
    {
        if ($hub = ServiceHubRegistry::resolve($slug)) {
            if ($slug !== $hub->slug()) {
                return redirect()->route('services.show', $hub->slug(), 301);
            }

            return view('front.service-hub', [
                'hub' => $hub,
            ]);
        }

        $service = Service::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->whereHas('category', static fn ($q) => $q->where('is_active', true))
            ->with([
                'category',
                'items' => static fn ($q) => $q
                    ->where('is_published', true)
                    ->orderBy('sort_order')
                    ->with([
                        'prices' => static fn ($q) => $q
                            ->where('is_visible', true)
                            ->orderBy('sort_order'),
                    ]),
                'prices' => static fn ($q) => $q
                    ->where('is_visible', true)
                    ->orderBy('sort_order'),
                'faqs' => static fn ($q) => $q
                    ->where('is_active', true)
                    ->orderBy('sort_order'),
                'portfolios' => static fn ($q) => $q
                    ->where('is_published', true)
                    ->orderByDesc('completed_at')
                    ->limit(6)
                    ->with('location'),
            ])
            ->firstOrFail();

        $relatedServices = Service::query()
            ->where('category_id', $service->category_id)
            ->whereKeyNot($service->id)
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->limit(4)
            ->get(['id', 'name', 'slug', 'excerpt', 'description', 'cover_image']);

        return view('front.service', [
            'service' => $service,
            'relatedServices' => $relatedServices,
        ]);
    }
}
