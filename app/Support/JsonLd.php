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
     * areaServed จากชื่อพื้นที่ที่แสดงบนหน้า — Place (City / Country)
     * อ้างอิง: https://schema.org/areaServed
     *
     * @param  array<int, string>  $areaNames
     * @return array<int, array<string, string>>
     */
    public static function areaServed(array $areaNames): array
    {
        return array_map(
            static function (string $name): array {
                $type = $name === 'ประเทศไทย' ? 'Country' : 'City';

                return [
                    '@type' => $type,
                    'name' => self::cleanText($name),
                ];
            },
            $areaNames,
        );
    }

    /**
     * Organization / GeneralContractor ตาม schema.org vocabulary
     * อ้างอิง: https://schema.org/GeneralContractor
     * ใส่เฉพาะ property ที่หน้าเว็บแสดงจริง (ดู docs/SCHEMA-SPEC.md)
     *
     * @param  array<string, mixed>  $extra  ฟิลด์เพิ่มเฉพาะหน้า (เช่น areaServed, hasOfferCatalog)
     * @return array<string, mixed>
     */
    public static function organization(array $extra = []): array
    {
        $siteUrl = rtrim((string) config('company.site_url'), '/');
        $type = (string) config('company.business_type', 'Organization');

        $entity = [
            '@type' => $type,
            '@id' => $siteUrl.'#organization',
            'name' => self::cleanText((string) config('company.brand_name')),
            'legalName' => self::cleanText((string) config('company.legal_name')),
            'url' => $siteUrl.'/',
            'logo' => Company::logoImageObject(),
            'description' => self::cleanText((string) config('company.description')),
            'telephone' => (string) config('company.phone'),
            'email' => (string) config('company.email'),
            'taxID' => (string) config('company.tax_id'),
            'address' => Company::postalAddress(),
            'openingHours' => Company::openingHours(),
            'openingHoursSpecification' => Company::openingHoursSpecification(),
            'sameAs' => Company::sameAs(),
        ];

        return array_merge($entity, $extra);
    }

    /**
     * WebSite entity
     *
     * @return array<string, mixed>
     */
    public static function webSite(): array
    {
        $siteUrl = rtrim((string) config('company.site_url'), '/');

        return [
            '@type' => 'WebSite',
            '@id' => $siteUrl.'#website',
            'url' => $siteUrl.'/',
            'name' => self::cleanText((string) config('company.brand_name')),
            'publisher' => ['@id' => $siteUrl.'#organization'],
            'inLanguage' => 'th-TH',
        ];
    }

    /**
     * สร้าง @graph สำหรับหน้าเว็บ (ใส่ BreadcrumbList เฉพาะเมื่อมี breadcrumbs จริงบนหน้า)
     *
     * @param  array<int, array{label: string, url?: string|null}>  $breadcrumbs
     * @param  array<int, string>  $areaNames  พื้นที่ให้บริการที่แสดงในหน้า
     * @return array<int, array<string, mixed>>
     */
    public static function pageGraph(
        string $pageTitle,
        string $pageUrl,
        array $breadcrumbs = [],
        array $areaNames = [],
        array $orgExtra = [],
        array $webPageExtra = [],
    ): array {
        $siteUrl = rtrim((string) config('company.site_url'), '/');
        $pageUrl = rtrim($pageUrl, '/').(parse_url($pageUrl, PHP_URL_PATH) === '/' ? '/' : '');

        if ($areaNames !== []) {
            $orgExtra['areaServed'] = self::areaServed($areaNames);
        }

        $webPage = array_merge([
            '@type' => 'WebPage',
            '@id' => $pageUrl.'#webpage',
            'url' => $pageUrl,
            'name' => self::cleanText($pageTitle),
            'isPartOf' => ['@id' => $siteUrl.'#website'],
        ], $webPageExtra);

        if ($breadcrumbs !== []) {
            $webPage['breadcrumb'] = ['@id' => $pageUrl.'#breadcrumb'];
        }

        $graph = [
            self::organization($orgExtra),
            self::webSite(),
            $webPage,
        ];

        if ($breadcrumbs !== []) {
            $graph[] = self::breadcrumbList($pageUrl, $breadcrumbs);
        }

        return $graph;
    }

    /**
     * @graph หน้าแรก — Organization เต็ม + FAQPage ตามเนื้อหาที่แสดงจริง
     *
     * @param  array<int, array{q: string, a: string}>  $faqs
     * @param  array<int, string>  $serviceNames  ชื่อบริการที่แสดงในหน้า
     * @param  array<int, string>  $areaNames  พื้นที่ให้บริการที่แสดงในหน้า
     * @return array<int, array<string, mixed>>
     */
    public static function homepageGraph(
        string $pageTitle,
        string $pageUrl,
        array $faqs = [],
        array $serviceNames = [],
        array $areaNames = [],
    ): array {
        $siteUrl = rtrim((string) config('company.site_url'), '/');
        $pageUrl = rtrim($pageUrl, '/').'/';

        $orgExtra = [];

        if ($areaNames !== []) {
            $orgExtra['areaServed'] = self::areaServed($areaNames);
        }

        if ($serviceNames !== []) {
            $orgExtra['hasOfferCatalog'] = [
                '@type' => 'OfferCatalog',
                'name' => 'บริการของ '.self::cleanText((string) config('company.brand_mark', 'BOA')),
                'itemListElement' => array_map(
                    static fn (string $name): array => [
                        '@type' => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name' => self::cleanText($name),
                        ],
                    ],
                    $serviceNames,
                ),
            ];
        }

        $graph = [
            self::organization($orgExtra),
            self::webSite(),
            [
                '@type' => 'WebPage',
                '@id' => $pageUrl.'#webpage',
                'url' => $pageUrl,
                'name' => self::cleanText($pageTitle),
                'isPartOf' => ['@id' => $siteUrl.'#website'],
                'about' => ['@id' => $siteUrl.'#organization'],
            ],
        ];

        if ($faqs !== []) {
            $graph[2]['mainEntity'] = ['@id' => $pageUrl.'#faq'];
            $graph[] = [
                '@type' => 'FAQPage',
                '@id' => $pageUrl.'#faq',
                'url' => $pageUrl,
                'isPartOf' => ['@id' => $siteUrl.'#website'],
                'about' => ['@id' => $siteUrl.'#organization'],
                'mainEntity' => array_map(
                    static fn (array $faq): array => [
                        '@type' => 'Question',
                        'name' => self::cleanText($faq['q']),
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => self::cleanText($faq['a']),
                        ],
                    ],
                    $faqs,
                ),
            ];
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
