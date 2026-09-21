<?php

namespace App\Support\Content;

use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\ServicePrice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

/**
 * งาน content cleanup phase 1 — เรียกจาก migration (idempotent + reversible)
 */
class BoaContentCleanupPhase1
{
    private const BRAND = 'BOA-Buildtech';

    private const BACKUP_PATH = 'boa_content_cleanup_phase1_backup.json';

    /** @var list<array{search: string, replace: string}> */
    private const BRAND_REPLACEMENTS = [
        ['search' => 'ธีรพงษ์การช่าง', 'replace' => self::BRAND],
        ['search' => 'บีเอโอ แลเพื่อน', 'replace' => self::BRAND],
        ['search' => 'บีโอเอ บิลเทค', 'replace' => self::BRAND],
        ['search' => 'BAO-Buildtech', 'replace' => self::BRAND],
        ['search' => 'BOA - BuildTech', 'replace' => self::BRAND],
        ['search' => 'BOA-BuildTech', 'replace' => self::BRAND],
    ];

    /** @var array<string, list<string>> */
    private const TEXT_FIELDS = [
        'services' => ['name', 'description', 'excerpt', 'meta_title', 'meta_description'],
        'service_items' => ['name', 'headline', 'excerpt', 'description', 'content', 'meta_title', 'meta_description'],
        'service_categories' => ['name', 'description'],
        'posts' => ['title', 'excerpt', 'body', 'meta_title', 'meta_description'],
        'portfolios' => ['title', 'description', 'meta_title', 'meta_description'],
        'locations' => ['name', 'description', 'meta_title', 'meta_description'],
        'faqs' => ['question', 'answer'],
    ];

    public function up(): array
    {
        $report = [
            'brand_replacements' => 0,
            'meta_titles' => 0,
            'unpublished' => 0,
            'prices_hidden' => 0,
            'site_clearing' => 0,
            'land_filling' => 0,
            'house_demolition' => 0,
            'wooden_house' => 0,
            'warnings' => [],
        ];

        $backup = [
            'rows' => [],
            'prices' => [],
            'site_clearing_price' => null,
        ];

        $report['brand_replacements'] = $this->replaceBrandVariants($backup, $report['warnings']);
        $report['meta_titles'] = $this->rewriteMetaTitles($backup, $report['warnings']);
        $report['unpublished'] = $this->unpublishThinContent($backup);
        $report['prices_hidden'] = $this->hideConflictingPrices($backup);
        $report['site_clearing'] = $this->fixSiteClearingPricing($backup, $report['warnings']);
        $report['land_filling'] = $this->fixLandFillingArea($backup, $report['warnings']);
        $report['house_demolition'] = $this->fixHouseDemolitionMeta($backup, $report['warnings']);
        $report['wooden_house'] = $this->fixWoodenHouseGeo($backup, $report['warnings']);

        $this->writeBackup($backup);

        return $report;
    }

    public function down(): void
    {
        $backup = $this->readBackup();

        if ($backup === null) {
            Log::warning('boa_content_cleanup_phase1: ไม่พบไฟล์ backup — ข้าม down()');

            return;
        }

        if (! empty($backup['site_clearing_price'])) {
            $snap = $backup['site_clearing_price'];
            DB::table('service_prices')->where('id', $snap['id'])->update([
                'price_type' => $snap['price_type'],
                'label' => $snap['label'],
                'price_min' => $snap['price_min'],
                'price_max' => $snap['price_max'],
                'price_unit' => $snap['price_unit'],
                'note' => $snap['note'],
                'is_visible' => $snap['is_visible'],
                'updated_at' => now(),
            ]);
        }

        foreach ($backup['prices'] ?? [] as $snap) {
            DB::table('service_prices')->where('id', $snap['id'])->update([
                'is_visible' => $snap['is_visible'],
                'updated_at' => now(),
            ]);
        }

        foreach (array_reverse($backup['rows'] ?? []) as $snap) {
            $payload = $snap['attributes'];
            if (Schema::hasColumn($snap['table'], 'updated_at')) {
                $payload['updated_at'] = now();
            }
            DB::table($snap['table'])->where('id', $snap['id'])->update($payload);
        }
    }

    /**
     * @param  array{rows: list<array>, prices: list<array>, site_clearing_price: ?array}  $backup
     * @param  list<string>  $warnings
     */
    private function replaceBrandVariants(array &$backup, array &$warnings): int
    {
        $changed = 0;

        foreach (self::TEXT_FIELDS as $table => $fields) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            $existingFields = array_values(array_filter(
                $fields,
                static fn (string $f): bool => Schema::hasColumn($table, $f),
            ));

            if ($existingFields === []) {
                continue;
            }

            $select = array_merge(['id'], $existingFields);
            $rows = DB::table($table)->get($select);

            foreach ($rows as $row) {
                $updates = [];

                foreach ($existingFields as $field) {
                    $value = $row->{$field};
                    if (! is_string($value) || $value === '') {
                        continue;
                    }

                    $newValue = $value;
                    foreach (self::BRAND_REPLACEMENTS as $pair) {
                        if (! str_contains($newValue, $pair['search'])) {
                            continue;
                        }
                        $newValue = str_replace($pair['search'], $pair['replace'], $newValue);
                    }

                    if ($newValue !== $value) {
                        $updates[$field] = $newValue;
                    }
                }

                if ($updates === []) {
                    continue;
                }

                $this->snapshotRow($backup, $table, (int) $row->id, array_intersect_key(
                    (array) $row,
                    array_flip(array_keys($updates)),
                ));

                if (Schema::hasColumn($table, 'updated_at')) {
                    $updates['updated_at'] = now();
                }

                DB::table($table)->where('id', $row->id)->update($updates);
                $changed += count(array_filter(
                    $updates,
                    static fn ($v, $k) => $k !== 'updated_at',
                    ARRAY_FILTER_USE_BOTH,
                ));
            }
        }

        return $changed;
    }

    /**
     * @param  array{rows: list<array>, prices: list<array>, site_clearing_price: ?array}  $backup
     * @param  list<string>  $warnings
     */
    private function rewriteMetaTitles(array &$backup, array &$warnings): int
    {
        $map = [
            ['table' => 'services', 'slug' => 'aluminum-works', 'meta_title' => 'รับติดตั้งงานอลูมิเนียม ประตู หน้าต่าง กันสาด | BOA-Buildtech'],
            ['table' => 'service_items', 'slug' => 'solar-cell-installation', 'meta_title' => 'ร้านติดตั้งโซล่าเซลล์ ราคาพร้อม VAT ปทุมธานี | BOA-Buildtech'],
            ['table' => 'services', 'slug' => 'electrical', 'meta_title' => 'ระบบไฟฟ้า เดินสายไฟ โซล่าเซลล์ | BOA-Buildtech'],
        ];

        $count = 0;

        foreach ($map as $item) {
            $row = DB::table($item['table'])->where('slug', $item['slug'])->first(['id', 'meta_title']);
            if (! $row) {
                $warnings[] = "ไม่พบ {$item['table']} slug={$item['slug']} สำหรับ rewrite meta_title";

                continue;
            }

            if ((string) $row->meta_title === $item['meta_title']) {
                continue;
            }

            $this->snapshotRow($backup, $item['table'], (int) $row->id, ['meta_title' => $row->meta_title]);
            DB::table($item['table'])->where('id', $row->id)->update([
                'meta_title' => $item['meta_title'],
                'updated_at' => now(),
            ]);
            $count++;
        }

        return $count;
    }

    /**
     * @param  array{rows: list<array>, prices: list<array>, site_clearing_price: ?array}  $backup
     */
    private function unpublishThinContent(array &$backup): int
    {
        $count = 0;

        $itemSlugs = ['driven-pile'];
        foreach ($itemSlugs as $slug) {
            $row = DB::table('service_items')->where('slug', $slug)->first(['id', 'is_published', 'published_at']);
            if (! $row || ! (bool) $row->is_published) {
                continue;
            }
            $this->snapshotRow($backup, 'service_items', (int) $row->id, [
                'is_published' => $row->is_published,
                'published_at' => $row->published_at,
            ]);
            DB::table('service_items')->where('id', $row->id)->update([
                'is_published' => false,
                'updated_at' => now(),
            ]);
            $count++;
        }

        foreach (['3-causes-retaining-wall-failure', 'bored-pile-vs-micropile'] as $slug) {
            $row = DB::table('posts')->where('slug', $slug)->first(['id', 'is_published', 'published_at']);
            if (! $row || ! (bool) $row->is_published) {
                continue;
            }
            $this->snapshotRow($backup, 'posts', (int) $row->id, [
                'is_published' => $row->is_published,
                'published_at' => $row->published_at,
            ]);
            DB::table('posts')->where('id', $row->id)->update([
                'is_published' => false,
                'updated_at' => now(),
            ]);
            $count++;
        }

        foreach (['retaining-wall-bang-yai', 'micropile-bang-khun-thian', 'concrete-yard-khlong-luang'] as $slug) {
            $row = DB::table('portfolios')->where('slug', $slug)->first(['id', 'is_published']);
            if (! $row || ! (bool) $row->is_published) {
                continue;
            }
            $this->snapshotRow($backup, 'portfolios', (int) $row->id, [
                'is_published' => $row->is_published,
            ]);
            DB::table('portfolios')->where('id', $row->id)->update([
                'is_published' => false,
                'updated_at' => now(),
            ]);
            $count++;
        }

        return $count;
    }

    /**
     * @param  array{rows: list<array>, prices: list<array>, site_clearing_price: ?array}  $backup
     */
    private function hideConflictingPrices(array &$backup): int
    {
        $count = 0;

        $serviceSlugs = ['structure', 'piles-foundation'];
        foreach ($serviceSlugs as $slug) {
            $service = Service::query()->where('slug', $slug)->first();
            if (! $service) {
                continue;
            }
            $count += $this->hidePricesFor($backup, 'service', (int) $service->id);
        }

        $itemSlugs = ['retaining-wall', 'steel-plaster-fence', 'concrete-pour', 'septic-tank', 'driven-pile'];
        foreach ($itemSlugs as $slug) {
            $item = ServiceItem::query()->where('slug', $slug)->first();
            if (! $item) {
                continue;
            }
            $count += $this->hidePricesFor($backup, 'service_item', (int) $item->id);
        }

        $draft = Service::query()->where('slug', 'draft-service')->first();
        if ($draft) {
            $prices = ServicePrice::query()
                ->where('priceable_type', 'service')
                ->where('priceable_id', $draft->id)
                ->where('label', 'ราคาซ่อน')
                ->where('is_visible', true)
                ->get();

            foreach ($prices as $price) {
                $backup['prices'][] = [
                    'id' => $price->id,
                    'is_visible' => $price->is_visible,
                ];
                $price->update(['is_visible' => false]);
                $count++;
            }
        }

        return $count;
    }

    /**
     * @param  array{rows: list<array>, prices: list<array>, site_clearing_price: ?array}  $backup
     */
    private function hidePricesFor(array &$backup, string $type, int $id): int
    {
        $count = 0;
        $prices = ServicePrice::query()
            ->where('priceable_type', $type)
            ->where('priceable_id', $id)
            ->where('is_visible', true)
            ->get();

        foreach ($prices as $price) {
            $backup['prices'][] = [
                'id' => $price->id,
                'is_visible' => $price->is_visible,
            ];
            $price->update(['is_visible' => false]);
            $count++;
        }

        return $count;
    }

    /**
     * @param  array{rows: list<array>, prices: list<array>, site_clearing_price: ?array}  $backup
     * @param  list<string>  $warnings
     */
    private function fixSiteClearingPricing(array &$backup, array &$warnings): int
    {
        $item = ServiceItem::query()->where('slug', 'site-clearing')->first();
        if (! $item) {
            $warnings[] = 'ไม่พบ service_items slug=site-clearing';

            return 0;
        }

        $changed = 0;
        $price = $item->prices()->orderBy('sort_order')->first();

        if ($price) {
            $alreadyFixed = $price->price_unit === 'บาท/ตร.ม.'
                && $price->label === 'เคลียร์พื้นที่หลังรื้อถอน (คิดตามพื้นที่)';

            if (! $alreadyFixed) {
                $backup['site_clearing_price'] = [
                    'id' => $price->id,
                    'price_type' => $price->price_type,
                    'label' => $price->label,
                    'price_min' => $price->price_min,
                    'price_max' => $price->price_max,
                    'price_unit' => $price->price_unit,
                    'note' => $price->note,
                    'is_visible' => $price->is_visible,
                ];

                $price->update([
                    'price_type' => 'unit',
                    'label' => 'เคลียร์พื้นที่หลังรื้อถอน (คิดตามพื้นที่)',
                    'price_min' => null,
                    'price_max' => null,
                    'price_unit' => 'บาท/ตร.ม.',
                    'note' => 'TODO: ยืนยันช่วงราคา',
                ]);
                $changed++;
            }
        } else {
            $warnings[] = 'site-clearing ไม่มี service_prices';
        }

        $content = (string) $item->content;
        $originalContent = $content;

        $replacements = [
            [
                'old' => 'คิดเป็น <strong>เที่ยวรถ</strong> ไม่ใช่ต่อตารางเมตรอย่างเดียว ช่วงประมาณ <strong>2,500–4,500 บาทต่อเที่ยว</strong> สำหรับรถ 6–10 ล้อ ขึ้นกับระยะทางและค่าธรรมเนียมบ่อทิ้ง บ้านเดี่ยวชั้นเดียวมักใช้หลายเที่ยวถึงสิบกว่าเที่ยว ตึกแถวสองชั้นมากกว่านั้น',
                'new' => 'คิดตาม <strong>พื้นที่ (บาท/ตร.ม.)</strong> ตามปริมาณเศษวัสดุและระยะทางไปบ่อทิ้ง ไม่คิดเหมาเป็นเที่ยวรถแบบเดียวกับงานขนส่งทั่วไป บ้านเดี่ยวชั้นเดียวกับตึกแถวสองชั้นปริมาณเศษต่างกันชัด — สำรวจหน้างานแล้วใส่รายการในใบเสนอราคา <em>TODO: ยืนยันช่วงราคา</em>',
            ],
            [
                'old' => 'คิดเป็น เที่ยวรถ ไม่ใช่ต่อตารางเมตรอย่างเดียว ช่วงประมาณ 2,500–4,500 บาทต่อเที่ยว สำหรับรถ 6–10 ล้อ ขึ้นกับระยะทางและค่าธรรมเนียมบ่อทิ้ง บ้านเดี่ยวชั้นเดียวมักใช้หลายเที่ยวถึงสิบกว่าเที่ยว ตึกแถวสองชั้นมากกว่านั้น',
                'new' => 'คิดตามพื้นที่ (บาท/ตร.ม.) ตามปริมาณเศษวัสดุและระยะทางไปบ่อทิ้ง ไม่คิดเหมาเป็นเที่ยวรถแบบเดียวกับงานขนส่งทั่วไป บ้านเดี่ยวชั้นเดียวกับตึกแถวสองชั้นปริมาณเศษต่างกันชัด — สำรวจหน้างานแล้วใส่รายการในใบเสนอราคา <em>TODO: ยืนยันช่วงราคา</em>',
            ],
        ];

        $snippetReplaced = false;
        foreach ($replacements as $pair) {
            if (str_contains($content, $pair['old'])) {
                $content = str_replace($pair['old'], $pair['new'], $content);
                $snippetReplaced = true;
                break;
            }
        }

        if (! $snippetReplaced && ! str_contains($content, 'คิดตาม') && str_contains($content, '2,500')) {
            $warnings[] = 'site-clearing content ไม่พบ pattern ราคาต่อเที่ยวที่คาดไว้';
            Log::warning('boa_content_cleanup_phase1: site-clearing content pattern ไม่เจอ');
        }

        $h2Old = 'ขนเศษวัสดุคิดราคายังไง กี่เที่ยว';
        $h2New = 'ขนเศษวัสดุคิดราคายังไง (ตามพื้นที่)';
        if (str_contains($content, $h2Old)) {
            $content = str_replace($h2Old, $h2New, $content);
        }

        if ($content !== $originalContent) {
            $this->snapshotRow($backup, 'service_items', (int) $item->id, [
                'content' => $originalContent,
            ]);
            $item->update(['content' => $content]);
            $changed++;
        }

        return $changed;
    }

    /**
     * @param  array{rows: list<array>, prices: list<array>, site_clearing_price: ?array}  $backup
     * @param  list<string>  $warnings
     */
    private function fixLandFillingArea(array &$backup, array &$warnings): int
    {
        $item = ServiceItem::query()->where('slug', 'land-filling')->first();
        if (! $item) {
            $warnings[] = 'ไม่พบ service_items slug=land-filling';

            return 0;
        }

        $old = 'ปทุมธานี กรุงเทพมหานคร นนทบุรี สมุทรปราการ สมุทรสาคร และนครปฐม';
        $new = 'ปทุมธานี กรุงเทพมหานคร สมุทรปราการ สมุทรสาคร และนครปฐม';

        $content = (string) $item->content;
        if (! str_contains($content, $old)) {
            if (str_contains($content, $new)) {
                return 0;
            }
            $warnings[] = 'land-filling content ไม่พบรายการพื้นที่ที่มีคำว่า นนทบุรี ตามที่คาดไว้';
            Log::warning('boa_content_cleanup_phase1: land-filling area pattern ไม่เจอ');

            return 0;
        }

        $this->snapshotRow($backup, 'service_items', (int) $item->id, ['content' => $item->content]);
        $item->update(['content' => str_replace($old, $new, $content)]);

        return 1;
    }

    /**
     * @param  array{rows: list<array>, prices: list<array>, site_clearing_price: ?array}  $backup
     * @param  list<string>  $warnings
     */
    private function fixHouseDemolitionMeta(array &$backup, array &$warnings): int
    {
        $service = Service::query()->where('slug', 'house-demolition')->first();
        if (! $service) {
            $warnings[] = 'ไม่พบ services slug=house-demolition';

            return 0;
        }

        $newMd = 'รับรื้อถอนบ้าน ทุบตึกแถว ทาวน์เฮาส์ รื้อถอนภายใน ปทุมธานี รังสิต ธัญบุรี ลำลูกกา และกรุงเทพฯ ใบเสนอราคาแยกรายการ ประเมินหน้างานฟรี โทร 061-743-9900';

        if ((string) $service->meta_description === $newMd) {
            return 0;
        }

        if (! str_contains((string) $service->meta_description, 'นนทบุรี') && (string) $service->meta_description !== $newMd) {
            // ยังอนุญาตเขียนทับถ้ายังไม่ตรงเป้า
        }

        $this->snapshotRow($backup, 'services', (int) $service->id, [
            'meta_description' => $service->meta_description,
        ]);
        $service->update(['meta_description' => $newMd]);

        return 1;
    }

    /**
     * @param  array{rows: list<array>, prices: list<array>, site_clearing_price: ?array}  $backup
     * @param  list<string>  $warnings
     */
    private function fixWoodenHouseGeo(array &$backup, array &$warnings): int
    {
        $item = ServiceItem::query()->where('slug', 'wooden-house')->first();
        if (! $item) {
            $warnings[] = 'ไม่พบ service_items slug=wooden-house';

            return 0;
        }

        $newMeta = 'รับรื้อบ้านไม้เก่า ปทุมธานี หักราคาเศษไม้ | BOA-Buildtech';
        $updates = [];
        $snap = [];

        if ((string) $item->meta_title !== $newMeta) {
            $snap['meta_title'] = $item->meta_title;
            $updates['meta_title'] = $newMeta;
        }

        $content = (string) $item->content;
        $geo = 'ปทุมธานี รังสิต ธัญบุรี ลำลูกกา';

        // ย่อหน้าเปิด — แทรกพื้นที่โดยไม่ยืดเนื้อหาทั้งหน้า
        $openOld = 'หน้านี้ตอบงานรื้อบ้านไม้โดยเฉพาะ';
        $openNew = "หน้านี้ตอบงานรื้อบ้านไม้ในโซน{$geo} โดยเฉพาะ";

        if (str_contains($content, $openOld) && ! str_contains($content, $openNew)) {
            $content = str_replace($openOld, $openNew, $content);
        } elseif (! str_contains($content, $geo) && ! str_contains($content, 'ปทุมธานี')) {
            $warnings[] = 'wooden-house content ไม่พบจุดแทรกพื้นที่ในย่อหน้าเปิด';
            Log::warning('boa_content_cleanup_phase1: wooden-house open paragraph pattern ไม่เจอ');
        }

        $h2Old = '<h2>รับรื้อบ้านไม้ราคาเท่าไหร่ ใช้เวลากี่วัน</h2>';
        $h2New = '<h2>รับรื้อบ้านไม้ ปทุมธานี–รังสิต ราคาเท่าไหร่ ใช้เวลากี่วัน</h2>';

        if (str_contains($content, $h2Old)) {
            $content = str_replace($h2Old, $h2New, $content);
        } elseif (! str_contains($content, 'ปทุมธานี–รังสิต')) {
            $warnings[] = 'wooden-house content ไม่พบ H2 ที่จะใส่พื้นที่';
            Log::warning('boa_content_cleanup_phase1: wooden-house H2 pattern ไม่เจอ');
        }

        if ($content !== (string) $item->content) {
            $snap['content'] = $item->content;
            $updates['content'] = $content;
        }

        // excerpt — เติมพื้นที่ถ้ายังไม่มี (สั้น ๆ)
        $excerpt = (string) $item->excerpt;
        if ($excerpt !== '' && ! str_contains($excerpt, 'ปทุมธานี') && str_contains($excerpt, 'รับรื้อบ้านไม้เก่า')) {
            $excerptNew = str_replace(
                'รับรื้อบ้านไม้เก่า',
                'รับรื้อบ้านไม้เก่าในปทุมธานี รังสิต ธัญบุรี ลำลูกกา',
                $excerpt,
            );
            if ($excerptNew !== $excerpt) {
                $snap['excerpt'] = $item->excerpt;
                $updates['excerpt'] = $excerptNew;
            }
        }

        if ($updates === []) {
            return 0;
        }

        $this->snapshotRow($backup, 'service_items', (int) $item->id, $snap);
        $item->update($updates);

        return count($updates);
    }

    /**
     * @param  array{rows: list<array>, prices: list<array>, site_clearing_price: ?array}  $backup
     * @param  array<string, mixed>  $attributes
     */
    private function snapshotRow(array &$backup, string $table, int $id, array $attributes): void
    {
        foreach ($backup['rows'] as &$existing) {
            if ($existing['table'] === $table && (int) $existing['id'] === $id) {
                $existing['attributes'] = array_merge($attributes, $existing['attributes']);

                return;
            }
        }
        unset($existing);

        $backup['rows'][] = [
            'table' => $table,
            'id' => $id,
            'attributes' => $attributes,
        ];
    }

    /**
     * @param  array{rows: list<array>, prices: list<array>, site_clearing_price: ?array}  $backup
     */
    private function writeBackup(array $backup): void
    {
        $path = storage_path('app/'.self::BACKUP_PATH);
        file_put_contents($path, json_encode($backup, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }

    /**
     * @return array{rows: list<array>, prices: list<array>, site_clearing_price: ?array}|null
     */
    private function readBackup(): ?array
    {
        $path = storage_path('app/'.self::BACKUP_PATH);
        if (! is_file($path)) {
            return null;
        }

        $data = json_decode((string) file_get_contents($path), true);

        return is_array($data) ? $data : null;
    }
}
