<?php

namespace App\Support;

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
     * สร้าง @graph สำหรับหน้าเว็บ พร้อม BreadcrumbList
     *
     * @param  array<int, array{label: string, url?: string|null}>  $breadcrumbs
     * @return array<int, array<string, mixed>>
     */
    public static function pageGraph(string $pageTitle, string $pageUrl, array $breadcrumbs): array
    {
        $siteUrl = rtrim((string) config('company.site_url'), '/');
        $pageUrl = rtrim($pageUrl, '/').(parse_url($pageUrl, PHP_URL_PATH) === '/' ? '/' : '');

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
            [
                '@type' => 'WebPage',
                '@id' => $pageUrl.'#webpage',
                'url' => $pageUrl,
                'name' => self::cleanText($pageTitle),
                'isPartOf' => ['@id' => $siteUrl.'#website'],
                'breadcrumb' => ['@id' => $pageUrl.'#breadcrumb'],
            ],
            self::breadcrumbList($pageUrl, $breadcrumbs),
        ];

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
}
