<?php

namespace App\Support;

use Illuminate\Support\Facades\Cache;

class Navigation
{
    private const CACHE_KEY = 'front.navigation.items';

    private const CACHE_TTL_SECONDS = 300;

    /**
     * เมนูนำทางหน้าเว็บสาธารณะ (hydrate mega จากหมวดแสดงผล + taxonomy ใน DB)
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
                    $item['intro'] = ServiceDisplayGroups::menuIntro();
                    $item['sections'] = ServiceDisplayGroups::navSections();
                    $item['bottom_bar'] = ServiceDisplayGroups::bottomBar();
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
}
