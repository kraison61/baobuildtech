<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceItem;
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
                            ->orderBy('sort_order')
                            ->with([
                                'prices' => static fn ($q) => $q
                                    ->where('is_visible', true)
                                    ->orderBy('sort_order'),
                            ]),
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
     * หน้ารายละเอียดบริการ / Hub — /services/{categorySlug}/{serviceSlug}
     * รองรับ URL เก่า 2 segment (service/item) ด้วยการ redirect 301
     */
    public function show(string $first, string $second): View|RedirectResponse
    {
        if (! $this->isActiveCategorySlug($first)) {
            $item = $this->findLegacyItem($first, $second);

            if ($item !== null) {
                return redirect($item->url(), 301);
            }
        }

        return $this->showService($first, $second);
    }

    /**
     * Redirect 301 จาก URL เก่า 1 segment — /services/{slug}
     */
    public function showLegacy(string $slug): RedirectResponse
    {
        if ($hub = ServiceHubRegistry::resolve($slug)) {
            return redirect($hub->url(), 301);
        }

        $service = Service::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->whereHas('category', static fn ($q) => $q->where('is_active', true))
            ->with('category')
            ->firstOrFail();

        return redirect($service->url(), 301);
    }

    private function showService(string $categorySlug, string $serviceSlug): View|RedirectResponse
    {
        if ($hub = ServiceHubRegistry::resolve($serviceSlug)) {
            $canonicalCategory = $hub->categorySlug();

            if ($categorySlug !== $canonicalCategory || $serviceSlug !== $hub->slug()) {
                return redirect()->route('services.show', [$canonicalCategory, $hub->slug()], 301);
            }

            return view('front.service-hub', [
                'hub' => $hub,
            ]);
        }

        $service = Service::query()
            ->where('slug', $serviceSlug)
            ->where('is_published', true)
            ->whereHas('category', static fn ($q) => $q
                ->where('slug', $categorySlug)
                ->where('is_active', true))
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
            ->with('category')
            ->get(['id', 'category_id', 'name', 'slug', 'excerpt', 'description', 'cover_image']);

        return view('front.service', [
            'service' => $service,
            'relatedServices' => $relatedServices,
        ]);
    }

    private function isActiveCategorySlug(string $slug): bool
    {
        return ServiceCategory::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->exists();
    }

    private function findLegacyItem(string $serviceSlug, string $itemSlug): ?ServiceItem
    {
        return ServiceItem::query()
            ->where('slug', $itemSlug)
            ->where('is_published', true)
            ->whereHas(
                'service',
                static fn ($q) => $q
                    ->where('slug', $serviceSlug)
                    ->where('is_published', true)
            )
            ->with('service.category')
            ->first();
    }
}
