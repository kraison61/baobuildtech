<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use App\Models\ServiceItem;
use Illuminate\Database\Seeder;

class AwningMockImagesSeeder extends Seeder
{
    /** slug ผลงานจำลองที่ลบออก — ห้าม seed กลับ */
    private const MOCK_PORTFOLIO_SLUGS = [
        'awning-louver-townhouse-thanyaburi',
        'awning-c-channel-carport-bangkok',
        'awning-wood-pattern-front-nonthaburi',
    ];

    public function run(): void
    {
        $item = ServiceItem::query()->where('slug', 'awning')->first();

        if (! $item) {
            $this->command?->error('ไม่พบ service_items slug=awning — รัน InsertAwningServiceItemSeeder ก่อน');

            return;
        }

        Portfolio::query()
            ->whereIn('slug', self::MOCK_PORTFOLIO_SLUGS)
            ->each(static fn (Portfolio $portfolio) => $portfolio->delete());

        // ไม่ใส่ Unsplash — ให้ front-end ใช้ mock SVG จาก x-ui.image-slot แทน
        if (filled($item->cover_image) && str_contains((string) $item->cover_image, 'unsplash.com')) {
            $item->update(['cover_image' => null]);
        }

        $this->command?->info("ลบผลงานจำลอง + ล้าง cover_image mock (awning id={$item->id})");
    }
}
