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
        $locale = Locale::current();

        return Cache::remember(self::CACHE_KEY.'.'.$locale, self::CACHE_TTL_SECONDS, function () use ($locale) {
            app()->setLocale($locale);

            $items = config('navigation', []);

            return array_map(static function (array $item): array {
                $item['label'] = __($item['label_key'] ?? 'ui.home');

                $route = $item['route'] ?? null;
                if (is_string($route) && $route !== '') {
                    $item['href'] = Locale::route($route, absolute: false);
                }

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
        foreach (Locale::supported() as $locale) {
            Cache::forget(self::CACHE_KEY.'.'.$locale);
        }
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
                            ->orderBy('sort_order')
                            ->with('service.category'),
                    ]),
            ])
            ->get();

        $servicesIndex = Locale::route('services', absolute: false);

        return $categories
            ->map(static function (ServiceCategory $category) use ($servicesIndex): array {
                return [
                    'label' => $category->name,
                    'href' => $servicesIndex.'#'.$category->slug,
                    'groups' => $category->services
                        ->map(static function ($service): array {
                            return [
                                'label' => $service->name,
                                'href' => $service->url(),
                                'children' => $service->items
                                    ->map(static fn ($item): array => [
                                        'label' => $item->name,
                                        'href' => $item->url(),
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
