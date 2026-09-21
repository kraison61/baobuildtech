<?php

namespace App\Console\Commands;

use App\Models\Portfolio;
use App\Models\Post;
use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Console\Command;

/**
 * ตรวจสุขภาพเนื้อหาที่เผยแพร่ — รายงานอย่างเดียว ไม่แก้ข้อมูล
 */
class BoaContentHealthCommand extends Command
{
    protected $signature = 'boa:content-health';

    protected $description = 'รายงาน orphan items, เนื้อหาสั้น, และ meta ที่ผิดความยาว';

    public function handle(): int
    {
        $this->info('=== BOA content health ===');
        $this->newLine();

        $this->reportOrphanItems();
        $this->reportShortBodies();
        $this->reportMetaTitles();
        $this->reportMetaDescriptions();

        return self::SUCCESS;
    }

    private function reportOrphanItems(): void
    {
        $this->comment('1) service_items ที่เผยแพร่ แต่แม่ยังไม่เผยแพร่/ไม่ active');

        $orphans = ServiceItem::query()
            ->where('is_published', true)
            ->with(['service.category'])
            ->orderBy('slug')
            ->get()
            ->filter(function (ServiceItem $item): bool {
                $service = $item->service;
                if (! $service || ! $service->is_published) {
                    return true;
                }
                $category = $service->category;
                if (! $category || ! $category->is_active) {
                    return true;
                }

                return false;
            });

        if ($orphans->isEmpty()) {
            $this->line('  ✓ ไม่พบ');
        } else {
            foreach ($orphans as $item) {
                $svc = $item->service;
                $cat = $svc?->category;
                $this->warn(sprintf(
                    '  - %s (service=%s pub=%s, category=%s active=%s)',
                    $item->slug,
                    $svc?->slug ?? 'null',
                    $svc ? ($svc->is_published ? '1' : '0') : 'n/a',
                    $cat?->slug ?? 'null',
                    $cat ? ($cat->is_active ? '1' : '0') : 'n/a',
                ));
            }
        }

        $this->newLine();
    }

    private function reportShortBodies(): void
    {
        $this->comment('2) เนื้อหาที่เผยแพร่แต่สั้นกว่า 1,500 ตัวอักษร (content/body)');

        $found = false;

        ServiceItem::query()
            ->where('is_published', true)
            ->orderBy('slug')
            ->each(function (ServiceItem $item) use (&$found): void {
                $len = $this->plainLength((string) $item->content);
                if ($len < 1500) {
                    $found = true;
                    $this->warn("  - service_items/{$item->slug} content={$len}");
                }
            });

        Service::query()
            ->where('is_published', true)
            ->orderBy('slug')
            ->each(function (Service $service) use (&$found): void {
                // services ใช้ description เป็นเนื้อหาหลักเมื่อไม่มี content column
                $text = (string) ($service->description ?? '');
                $len = $this->plainLength($text);
                if ($len < 1500) {
                    $found = true;
                    $this->warn("  - services/{$service->slug} description={$len}");
                }
            });

        Post::query()
            ->where('is_published', true)
            ->orderBy('slug')
            ->each(function (Post $post) use (&$found): void {
                $len = $this->plainLength((string) $post->body);
                if ($len < 1500) {
                    $found = true;
                    $this->warn("  - posts/{$post->slug} body={$len}");
                }
            });

        if (! $found) {
            $this->line('  ✓ ไม่พบ');
        }

        $this->newLine();
    }

    private function reportMetaTitles(): void
    {
        $this->comment('3) meta_title ว่าง หรือยาวเกิน 65 ตัวอักษร (ที่เผยแพร่)');

        $found = false;

        $check = function (string $type, string $slug, ?string $meta) use (&$found): void {
            $meta = (string) $meta;
            $len = mb_strlen($meta);
            if ($meta === '' || $len > 65) {
                $found = true;
                $label = $meta === '' ? 'ว่าง' : "len={$len}";
                $this->warn("  - {$type}/{$slug} meta_title {$label}");
            }
        };

        Service::query()->where('is_published', true)->orderBy('slug')
            ->each(fn (Service $s) => $check('services', $s->slug, $s->meta_title));

        ServiceItem::query()->where('is_published', true)->orderBy('slug')
            ->each(fn (ServiceItem $i) => $check('service_items', $i->slug, $i->meta_title));

        Post::query()->where('is_published', true)->orderBy('slug')
            ->each(fn (Post $p) => $check('posts', $p->slug, $p->meta_title));

        Portfolio::query()->where('is_published', true)->orderBy('slug')
            ->each(fn (Portfolio $p) => $check('portfolios', $p->slug, $p->meta_title));

        if (! $found) {
            $this->line('  ✓ ไม่พบ');
        }

        $this->newLine();
    }

    private function reportMetaDescriptions(): void
    {
        $this->comment('4) meta_description ยาวเกิน 155 ตัวอักษร (ที่เผยแพร่)');

        $found = false;

        $check = function (string $type, string $slug, ?string $meta) use (&$found): void {
            $meta = (string) $meta;
            $len = mb_strlen($meta);
            if ($len > 155) {
                $found = true;
                $this->warn("  - {$type}/{$slug} meta_description len={$len}");
            }
        };

        Service::query()->where('is_published', true)->orderBy('slug')
            ->each(fn (Service $s) => $check('services', $s->slug, $s->meta_description));

        ServiceItem::query()->where('is_published', true)->orderBy('slug')
            ->each(fn (ServiceItem $i) => $check('service_items', $i->slug, $i->meta_description));

        Post::query()->where('is_published', true)->orderBy('slug')
            ->each(fn (Post $p) => $check('posts', $p->slug, $p->meta_description));

        Portfolio::query()->where('is_published', true)->orderBy('slug')
            ->each(fn (Portfolio $p) => $check('portfolios', $p->slug, $p->meta_description));

        if (! $found) {
            $this->line('  ✓ ไม่พบ');
        }

        $this->newLine();
    }

    private function plainLength(string $html): int
    {
        return mb_strlen(trim(html_entity_decode(strip_tags($html))));
    }
}
