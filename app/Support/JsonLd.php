<?php

namespace App\Support;

use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Support\Collection;

class JsonLd
{
    /**
     * ตัดค่าว่างออกจาก array แบบ recursive ก่อน encode schema
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public static function filterEmpty(array $data): array
    {
        $filtered = [];

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $value = self::filterEmpty($value);

                if ($value === []) {
                    continue;
                }
            } elseif ($value === null || $value === '' || $value === []) {
                continue;
            }

            $filtered[$key] = $value;
        }

        return $filtered;
    }

    /**
     * ทำความสะอาดข้อความก่อนใส่ schema
     */
    public static function cleanText(string $text): string
    {
        return html_entity_decode(strip_tags($text), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    /**
     * Encode @graph เป็น JSON-LD string สำหรับ render ใน <script>
     *
     * @param  array<int, array<string, mixed>>  $graph
     */
    public static function encode(array $graph): string
    {
        $payload = self::filterEmpty([
            '@context' => 'https://schema.org',
            '@graph' => $graph,
        ]);

        $json = json_encode(
            $payload,
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR,
        );

        return str_replace('</', '<\/', $json);
    }

    /**
     * สร้าง @graph สำหรับหน้าเว็บ (ใส่ BreadcrumbList เฉพาะเมื่อมี breadcrumbs จริงบนหน้า)
     *
     * @param  array<int, array{label: string, url?: string|null}>  $breadcrumbs
     * @return array<int, array<string, mixed>>
     */
    public static function pageGraph(string $pageTitle, string $pageUrl, array $breadcrumbs = []): array
    {
        $siteUrl = rtrim((string) config('company.site_url'), '/');
        $pageUrl = rtrim($pageUrl, '/').(parse_url($pageUrl, PHP_URL_PATH) === '/' ? '/' : '');

        $webPage = [
            '@type' => 'WebPage',
            '@id' => $pageUrl.'#webpage',
            'url' => $pageUrl,
            'name' => self::cleanText($pageTitle),
            'isPartOf' => ['@id' => $siteUrl.'#website'],
        ];

        if ($breadcrumbs !== []) {
            $webPage['breadcrumb'] = ['@id' => $pageUrl.'#breadcrumb'];
        }

        $graph = [
            [
                '@type' => 'Organization',
                '@id' => $siteUrl.'#organization',
                'name' => self::cleanText((string) config('company.legal_name')),
                'url' => $siteUrl.'/',
            ],
            [
                '@type' => 'WebSite',
                '@id' => $siteUrl.'#website',
                'url' => $siteUrl.'/',
                'name' => self::cleanText((string) config('company.legal_name')),
                'publisher' => ['@id' => $siteUrl.'#organization'],
            ],
            $webPage,
        ];

        if ($breadcrumbs !== []) {
            $graph[] = self::breadcrumbList($pageUrl, $breadcrumbs);
        }

        return $graph;
    }

    /**
     * สร้าง BreadcrumbList entity
     *
     * @param  array<int, array{label: string, url?: string|null}>  $breadcrumbs
     * @return array<string, mixed>
     */
    public static function breadcrumbList(string $pageUrl, array $breadcrumbs): array
    {
        $pageUrl = rtrim($pageUrl, '/').(parse_url($pageUrl, PHP_URL_PATH) === '/' ? '/' : '');

        $itemListElement = [];

        foreach ($breadcrumbs as $index => $breadcrumb) {
            $item = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => self::cleanText($breadcrumb['label']),
            ];

            if (! empty($breadcrumb['url'])) {
                $item['item'] = $breadcrumb['url'];
            }

            $itemListElement[] = $item;
        }

        return [
            '@type' => 'BreadcrumbList',
            '@id' => $pageUrl.'#breadcrumb',
            'itemListElement' => $itemListElement,
        ];
    }

    /**
     * Service entity จากข้อมูลที่แสดงบนหน้าจริง
     *
     * @param  Collection<int, \App\Models\ServicePrice>  $prices
     * @return array<string, mixed>
     */
    public static function serviceEntity(Service $service, string $pageUrl, Collection $prices): array
    {
        $siteUrl = rtrim((string) config('company.site_url'), '/');
        $pageUrl = rtrim($pageUrl, '/');

        $entity = [
            '@type' => 'Service',
            '@id' => $pageUrl.'#service',
            'name' => self::cleanText($service->name),
            'description' => self::cleanText((string) $service->description),
            'url' => $pageUrl,
            'provider' => ['@id' => $siteUrl.'#organization'],
        ];

        if (filled($service->cover_image)) {
            $entity['image'] = $service->cover_image;
        }

        $offers = $prices
            ->filter(static fn ($price) => $price->price_min !== null)
            ->map(static function ($price): array {
                return [
                    '@type' => 'Offer',
                    'name' => self::cleanText((string) $price->label),
                    'price' => (float) $price->price_min,
                    'priceCurrency' => $price->currency ?: 'THB',
                ];
            })
            ->values()
            ->all();

        if ($offers !== []) {
            $entity['offers'] = count($offers) === 1 ? $offers[0] : $offers;
        }

        return $entity;
    }

    /**
     * Service entity สำหรับหน้า service_items
     *
     * @param  Collection<int, \App\Models\ServicePrice>  $prices
     * @return array<string, mixed>
     */
    public static function serviceItemEntity(ServiceItem $item, string $pageUrl, Collection $prices): array
    {
        $siteUrl = rtrim((string) config('company.site_url'), '/');
        $pageUrl = rtrim($pageUrl, '/');

        $entity = [
            '@type' => 'Service',
            '@id' => $pageUrl.'#service',
            'name' => self::cleanText($item->name),
            'description' => self::cleanText((string) ($item->excerpt ?: $item->description)),
            'url' => $pageUrl,
            'provider' => ['@id' => $siteUrl.'#organization'],
        ];

        if (filled($item->cover_image)) {
            $entity['image'] = $item->cover_image;
        }

        if ($item->service?->service_type) {
            $entity['serviceType'] = self::cleanText((string) $item->service->service_type);
        }

        $offers = $prices
            ->filter(static fn ($price) => $price->price_min !== null)
            ->map(static function ($price): array {
                return [
                    '@type' => 'Offer',
                    'name' => self::cleanText((string) $price->label),
                    'price' => (float) $price->price_min,
                    'priceCurrency' => $price->currency ?: 'THB',
                ];
            })
            ->values()
            ->all();

        if ($offers !== []) {
            $entity['offers'] = count($offers) === 1 ? $offers[0] : $offers;
        }

        return $entity;
    }

    /**
     * FAQPage จาก FAQ ที่แสดงบนหน้าจริง
     *
     * @param  Collection<int, \App\Models\Faq>  $faqs
     * @return array<string, mixed>
     */
    public static function faqPage(string $pageUrl, Collection $faqs): array
    {
        $pageUrl = rtrim($pageUrl, '/');

        return [
            '@type' => 'FAQPage',
            '@id' => $pageUrl.'#faq',
            'mainEntity' => $faqs
                ->map(static fn ($faq): array => [
                    '@type' => 'Question',
                    'name' => self::cleanText($faq->question),
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => self::cleanText($faq->answer),
                    ],
                ])
                ->values()
                ->all(),
        ];
    }
}
