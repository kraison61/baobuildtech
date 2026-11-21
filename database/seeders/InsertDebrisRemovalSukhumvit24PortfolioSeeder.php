<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Location;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Database\Seeder;

/**
 * เพิ่มผลงานขนเศษปูน สุขุมวิท 24 + FAQ (TH/EN)
 *
 * Slug: debris-removal-sukhumvit-24
 * URL: /works/debris-removal-sukhumvit-24
 */
class InsertDebrisRemovalSukhumvit24PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $service = Service::query()
            ->where('slug', 'earthwork')
            ->where('is_published', true)
            ->first();

        if (! $service) {
            $this->command?->error('ไม่พบ services slug=earthwork');

            return;
        }

        $item = ServiceItem::query()
            ->where('service_id', $service->id)
            ->where('slug', 'construction-waste-hauling')
            ->first();

        if (! $item) {
            $this->command?->error('ไม่พบ service_items slug=construction-waste-hauling');

            return;
        }

        $location = Location::query()
            ->where('slug', 'bangkok')
            ->first();

        /** @var callable(string, string, string, string, string, string, string): array $load */
        $load = require __DIR__.'/data/debris_removal_sukhumvit_24_portfolio_contents.php';

        $brand = (string) config('company.brand_name');
        $phoneDisplay = (string) config('company.phone_format');
        $phoneTel = (string) config('company.phone');
        $lineId = (string) config('company.line_id');
        $lineUrl = (string) config('company.line_url');
        $imageBase = rtrim((string) config('company.images_cdn'), '/')
            .'/assets/portfolios/debris-removal-sukhumvit-24';
        $wastePath = '/services/civil/earthwork/construction-waste-hauling';
        $breakerPath = '/works/excavator-breaker-pc30-siam-square';

        $data = $load($brand, $phoneDisplay, $phoneTel, $lineId, $lineUrl, $imageBase, $wastePath, $breakerPath);
        $th = $data['th'];
        $en = $data['en'];

        $portfolio = Portfolio::query()->updateOrCreate(
            ['slug' => $data['slug']],
            [
                'service_id' => $service->id,
                'service_item_id' => $item->id,
                'location_id' => $location?->id,
                'lat' => $data['lat'],
                'lng' => $data['lng'],
                'title' => $th['title'],
                'title_en' => $en['title_en'],
                'description' => $th['description'],
                'description_en' => $en['description_en'],
                'content' => $th['content'],
                'content_en' => $en['content_en'],
                'cover_image' => $data['cover_image'],
                'client_name' => $data['client_name'],
                'client_name_en' => $data['client_name_en'],
                'completed_at' => $data['completed_at'],
                'meta_title' => $th['meta_title'],
                'meta_title_en' => $en['meta_title_en'],
                'meta_description' => $th['meta_description'],
                'meta_description_en' => $en['meta_description_en'],
                'is_published' => true,
            ],
        );

        $portfolio->images()->delete();
        foreach ($data['images'] as $image) {
            $portfolio->images()->create($image);
        }

        Faq::query()
            ->where('faqable_type', 'portfolio')
            ->where('faqable_id', $portfolio->id)
            ->delete();

        foreach ($data['faqs'] as $faq) {
            $portfolio->faqs()->create([
                'question' => $faq['question'],
                'answer' => $faq['answer'],
                'question_en' => $faq['question_en'],
                'answer_en' => $faq['answer_en'],
                'sort_order' => $faq['sort_order'],
                'is_active' => true,
            ]);
        }

        $this->command?->info(
            "บันทึก portfolio #{$portfolio->id} slug={$portfolio->slug} "
            .'(images='.count($data['images']).', faqs='.count($data['faqs']).')'
        );
        $this->command?->info('URL: '.$portfolio->url());
    }
}
