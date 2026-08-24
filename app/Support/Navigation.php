<?php

namespace App\Support;

use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Cache;

class Navigation
{
    private const CACHE_KEY = 'front.navigation.items';

    private const CACHE_TTL_SECONDS = 300;

    /**
     * เมนูนำทางหน้าเว็บสาธารณะ (hydrate mega จาก taxonomy ใน DB)
     *
     * @return list<array<string, mixed>>
     */
    public static function items(): array
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL_SECONDS, function () {
            $items = config('navigation', []);

            return array_map(static function (array $item): array {
                if (($item['source'] ?? null) === 'services') {
                    $item['sections'] = self::serviceSections();
                }

                return $item;
            }, $items);
        });
    }

    /**
     * ล้าง cache เมื่อ taxonomy เปลี่ยน (เรียกจาก admin ภายหลังได้)
     */
    public static function forgetCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    /**
     * Category → Service → ServiceItem (เฉพาะที่เผยแพร่)
     *
     * @return list<array<string, mixed>>
     */
    private static function serviceSections(): array
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
                    ]),
            ])
            ->get();

        return $categories
            ->map(static function (ServiceCategory $category): array {
                return [
                    'label' => $category->name,
                    'href' => '/services#'.$category->slug,
                    'groups' => $category->services
                        ->map(static function ($service): array {
                            return [
                                'label' => $service->name,
                                'href' => '/services/'.$service->slug,
                                'children' => $service->items
                                    ->map(static fn ($item): array => [
                                        'label' => $item->name,
                                        'href' => '/services/'.$service->slug.'/'.$item->slug,
                                    ])
                                    ->values()
                                    ->all(),
                            ];
                        })
                        ->values()
                        ->all(),
                ];
            })
            ->values()
            ->all();
    }
}
