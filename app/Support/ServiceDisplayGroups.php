<?php

namespace App\Support;

use App\Models\Service;
use Illuminate\Support\Collection;

/**
 * Hydrate หมวดแสดงผลฝั่งลูกค้าจาก taxonomy จริง — คง URL / slug เดิม
 */
class ServiceDisplayGroups
{
    /**
     * หมวดสำหรับ mega menu / mobile nav
     *
     * @return list<array<string, mixed>>
     */
    public static function navSections(): array
    {
        $bySlug = self::publishedServicesBySlug();
        $servicesIndex = Locale::route('services', absolute: false);
        $sections = [];

        foreach (config('service-display-groups.groups', []) as $group) {
            $groups = [];

            foreach ($group['service_slugs'] as $slug) {
                /** @var Service|null $service */
                $service = $bySlug->get($slug);
                if ($service === null) {
                    continue;
                }

                $groups[] = [
                    'label' => self::displayLabel($slug, $service->name),
                    'href' => $service->url(),
                    'badge' => isset($group['badge']) ? self::pick($group['badge']) : null,
                    'children' => $service->items
                        ->map(static fn ($item): array => [
                            'label' => self::displayLabel($item->slug, $item->name),
                            'href' => $item->url(),
                        ])
                        ->values()
                        ->all(),
                ];
            }

            if ($groups === []) {
                continue;
            }

            $sections[] = [
                'key' => $group['key'],
                'number' => (int) $group['number'],
                'label' => self::pick($group['label']),
                'description' => self::pick($group['description'] ?? []),
                'badge' => isset($group['badge']) ? self::pick($group['badge']) : null,
                'href' => $servicesIndex.'#'.$group['key'],
                'groups' => $groups,
            ];
        }

        return $sections;
    }

    /**
     * หมวดสำหรับหน้ารวม /services (jump + catalog)
     *
     * @return list<array<string, mixed>>
     */
    public static function catalogSections(): array
    {
        $bySlug = self::publishedServicesBySlug();
        $sections = [];

        foreach (config('service-display-groups.groups', []) as $group) {
            $services = collect($group['service_slugs'])
                ->map(static fn (string $slug) => $bySlug->get($slug))
                ->filter()
                ->values();

            if ($services->isEmpty()) {
                continue;
            }

            $sections[] = [
                'key' => $group['key'],
                'number' => (int) $group['number'],
                'label' => self::pick($group['label']),
                'description' => self::pick($group['description'] ?? []),
                'badge' => isset($group['badge']) ? self::pick($group['badge']) : null,
                'services' => $services,
            ];
        }

        return $sections;
    }

    /**
     * ลิงก์ footer — เฉพาะที่ publish แล้ว ใช้ url() จริง
     *
     * @return list<array{label: string, href: string}>
     */
    public static function footerLinks(): array
    {
        $bySlug = self::publishedServicesBySlug();
        $preferred = [
            'house-demolition',
            'earthwork',
            'piles-foundation',
            'aluminum-works',
            'shop-design',
            'electrical',
        ];

        $links = [];
        foreach ($preferred as $slug) {
            $service = $bySlug->get($slug);
            if ($service === null) {
                continue;
            }

            $links[] = [
                'label' => self::displayLabel($slug, $service->name),
                'href' => $service->url(),
            ];
        }

        return $links;
    }

    /**
     * แถบล่าง mega menu
     *
     * @return array{text: string, cta: string, mgmt: ?array{label: string, href: string}}
     */
    public static function bottomBar(): array
    {
        $bar = config('service-display-groups.bottom_bar', []);
        $mgmt = null;
        $slug = $bar['mgmt_slug'] ?? null;

        if (is_string($slug) && $slug !== '') {
            $service = self::publishedServicesBySlug()->get($slug);
            if ($service !== null) {
                $mgmt = [
                    'label' => self::pick($bar['mgmt_label'] ?? []),
                    'href' => $service->url(),
                ];
            }
        }

        return [
            'text' => self::pick($bar['text'] ?? []),
            'cta' => self::pick($bar['cta'] ?? []),
            'mgmt' => $mgmt,
        ];
    }

    public static function menuIntro(): string
    {
        return self::pick(config('service-display-groups.menu_intro', []));
    }

    /**
     * @return Collection<string, Service>
     */
    public static function publishedServicesBySlug(): Collection
    {
        return Service::query()
            ->where('is_published', true)
            ->whereHas('category', static fn ($q) => $q->where('is_active', true))
            ->orderBy('sort_order')
            ->with([
                'category',
                'items' => static fn ($q) => $q
                    ->where('is_published', true)
                    ->orderBy('sort_order')
                    ->with([
                        'service.category',
                        'prices' => static fn ($pq) => $pq
                            ->forPublicDisplay()
                            ->orderBy('sort_order'),
                    ]),
                'prices' => static fn ($q) => $q
                    ->forPublicDisplay()
                    ->orderBy('sort_order'),
            ])
            ->get()
            ->keyBy('slug');
    }

    public static function displayLabel(string $slug, string $fallback): string
    {
        $override = config('service-display-groups.label_overrides.'.$slug);

        if (is_array($override)) {
            $picked = self::pick($override);
            if ($picked !== '') {
                return $picked;
            }
        }

        return $fallback;
    }

    /**
     * @param  array{th?: string, en?: string}|array<string, string>  $pair
     */
    private static function pick(array $pair): string
    {
        if ($pair === []) {
            return '';
        }

        return Locale::pick($pair['th'] ?? '', $pair['en'] ?? ($pair['th'] ?? ''));
    }
}
