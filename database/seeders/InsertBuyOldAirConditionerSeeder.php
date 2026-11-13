<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Support\Navigation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

/**
 * เพิ่มบริการรับซื้อแอร์เก่า + FAQ (TH/EN)
 * แหล่ง: SEO package ร้านรับซื้อแอร์เก่าใกล้ฉัน
 *
 * Canonical: /services/mechanical-and-electrical-work/buy-old-air-conditioner
 * Legacy 1-segment: /services/buy-old-air-conditioner → 301
 */
class InsertBuyOldAirConditionerSeeder extends Seeder
{
    public function run(): void
    {
        $category = ServiceCategory::query()
            ->where('slug', 'mechanical-and-electrical-work')
            ->where('is_active', true)
            ->first();

        if (! $category) {
            $this->command?->error('ไม่พบ service_categories slug=mechanical-and-electrical-work');

            return;
        }

        /** @var callable(string, string, string, string, string, string, string): array $load */
        $load = require __DIR__.'/data/buy_old_air_conditioner_contents.php';

        $brand = (string) config('company.brand_name');
        $phoneDisplay = (string) config('company.phone_format');
        $phoneTel = (string) config('company.phone');
        $lineId = (string) config('company.line_id');
        $lineUrl = (string) config('company.line_url');
        $mapsUrl = (string) (config('company.social.google_maps') ?: '#');
        $imageBase = rtrim((string) config('company.images_cdn'), '/').'/assets/service-items/buy-old-air-condition';

        $data = $load($brand, $phoneDisplay, $phoneTel, $lineId, $lineUrl, $mapsUrl, $imageBase);
        $th = $data['th'];
        $en = $data['en'];

        $service = Service::query()->updateOrCreate(
            ['slug' => 'buy-old-air-conditioner'],
            [
                'category_id' => $category->id,
                'name' => $th['name'],
                'name_en' => $en['name_en'],
                'headline' => $th['headline'],
                'headline_en' => $en['headline_en'],
                'description' => $th['description'],
                'description_en' => $en['description_en'],
                'excerpt' => $th['excerpt'],
                'excerpt_en' => $en['excerpt_en'],
                'content' => $th['content'],
                'content_en' => $en['content_en'],
                'service_type' => $th['service_type'],
                'service_type_en' => $en['service_type_en'],
                'meta_title' => $th['meta_title'],
                'meta_title_en' => $en['meta_title_en'],
                'meta_description' => $th['meta_description'],
                'meta_description_en' => $en['meta_description_en'],
                'cover_image' => $data['cover_image'],
                'sort_order' => 4,
                'is_published' => true,
                'published_at' => now(),
            ],
        );

        Faq::query()
            ->where('faqable_type', 'service')
            ->where('faqable_id', $service->id)
            ->delete();

        $faqIds = [];

        foreach ($data['faqs'] as $faq) {
            $row = Faq::query()->create([
                'faqable_type' => 'service',
                'faqable_id' => $service->id,
                'question' => $faq['question'],
                'question_en' => $faq['question_en'],
                'answer' => $faq['answer'],
                'answer_en' => $faq['answer_en'],
                'sort_order' => $faq['sort_order'],
                'is_active' => true,
            ]);
            $faqIds[] = $row->id;
        }

        $this->syncEnTranslationsJson($service->id, $en, $faqIds, $data['faqs']);

        Navigation::forgetCache();

        $this->command?->info("services id={$service->id} slug=buy-old-air-conditioner + FAQ ".count($faqIds).' ข้อ (TH+EN)');
        $this->command?->info('URL: '.$service->url());
        $this->command?->info('Legacy: '.url('/services/buy-old-air-conditioner'));
    }

    /**
     * @param  array<string, string>  $en
     * @param  list<int>  $faqIds
     * @param  list<array{question_en: string, answer_en: string}>  $faqs
     */
    private function syncEnTranslationsJson(int $serviceId, array $en, array $faqIds, array $faqs): void
    {
        $path = database_path('data/en_translations.json');

        if (! is_file($path)) {
            $this->command?->warn('ไม่พบ en_translations.json — ข้าม sync');

            return;
        }

        /** @var array<string, mixed> $json */
        $json = json_decode((string) File::get($path), true);

        if (! is_array($json)) {
            $this->command?->warn('en_translations.json parse ไม่ได้ — ข้าม sync');

            return;
        }

        $json['services'] ??= [];
        $json['services'][(string) $serviceId] = [
            'name_en' => $en['name_en'],
            'headline_en' => $en['headline_en'],
            'description_en' => $en['description_en'],
            'excerpt_en' => $en['excerpt_en'],
            'service_type_en' => $en['service_type_en'],
            'meta_title_en' => $en['meta_title_en'],
            'meta_description_en' => $en['meta_description_en'],
            'content_en' => $en['content_en'],
        ];

        $json['faqs'] ??= [];

        foreach ($faqIds as $i => $faqId) {
            $json['faqs'][(string) $faqId] = [
                'question_en' => $faqs[$i]['question_en'],
                'answer_en' => $faqs[$i]['answer_en'],
            ];
        }

        File::put(
            $path,
            json_encode($json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)."\n",
        );

        $this->command?->info('อัปเดต database/data/en_translations.json แล้ว');
    }
}
