<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Service;
use App\Support\ServiceHub\HubHtmlExporter;
use App\Support\ServiceHub\ServiceHubRegistry;
use Illuminate\Database\Seeder;

/**
 * ย้ายเนื้อหาหน้า Service Hub จาก PHP → services.content (HTML) + faqs
 */
class SyncServiceHubContentSeeder extends Seeder
{
    public function run(): void
    {
        foreach (ServiceHubRegistry::phpHubs() as $hub) {
            $service = Service::query()
                ->where('slug', $hub->slug())
                ->first();

            if (! $service) {
                $this->command?->error("ไม่พบ services slug={$hub->slug()}");

                continue;
            }

            $html = HubHtmlExporter::export($hub);

            $service->update([
                'content' => $html,
                'meta_title' => $service->meta_title ?: $hub->metaTitle(),
                'meta_description' => $service->meta_description ?: $hub->metaDescription(),
            ]);

            $this->syncFaqs($service, $hub->faqs());

            $this->command?->info("อัปเดต services.content (HTML) + FAQ slug={$service->slug}");
        }
    }

    /**
     * @param  array<int, array{q: string, a: string, open?: bool}>  $faqs
     */
    private function syncFaqs(Service $service, array $faqs): void
    {
        Faq::query()
            ->where('faqable_type', $service->getMorphClass())
            ->where('faqable_id', $service->id)
            ->delete();

        foreach (array_values($faqs) as $index => $faq) {
            $service->faqs()->create([
                'question' => (string) ($faq['q'] ?? ''),
                'answer' => (string) ($faq['a'] ?? ''),
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);
        }
    }
}
