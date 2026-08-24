<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ServiceItem;
use Illuminate\View\View;

class ServiceItemController extends Controller
{
    /**
     * หน้า SEO รายละเอียดงานย่อย (service_items)
     */
    public function show(string $serviceSlug, string $itemSlug): View
    {
        $item = ServiceItem::query()
            ->where('slug', $itemSlug)
            ->where('is_published', true)
            ->whereHas(
                'service',
                static fn ($q) => $q
                    ->where('slug', $serviceSlug)
                    ->where('is_published', true)
                    ->whereHas('category', static fn ($q) => $q->where('is_active', true))
            )
            ->with([
                'service.category',
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

        $relatedItems = ServiceItem::query()
            ->where('service_id', $item->service_id)
            ->whereKeyNot($item->id)
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->limit(4)
            ->get(['id', 'service_id', 'name', 'slug', 'excerpt', 'description', 'cover_image']);

        return view('front.service-item', [
            'item' => $item,
            'relatedItems' => $relatedItems,
        ]);
    }
}
