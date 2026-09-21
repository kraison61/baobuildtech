<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServicePrice;
use Illuminate\Database\Seeder;

/**
 * อัปเดต service slug=piles-foundation + ราคาเสาเข็มไอ/สี่เหลี่ยมตัน
 * แหล่งราคา: ใบราคาพาร์ตเนอร์ (ราคาเสาเสาเข็ม.pdf) + 10% ปัดขึ้นเป็นบาทเต็ม · ยังไม่รวม VAT
 * เนื้อหาหน้า hub อยู่ใน PilesFoundationHubContent
 */
class UpdatePilesFoundationHubSeeder extends Seeder
{
    public function run(): void
    {
        $service = Service::query()
            ->where('slug', 'piles-foundation')
            ->first();

        if (! $service) {
            $this->command?->error('ไม่พบ services slug=piles-foundation');

            return;
        }

        $brand = (string) config('company.brand_name');

        $service->update([
            'name' => 'เสาเข็มและฐานราก',
            'description' => 'รับเหมางานเสาเข็มเจาะ ไมโครไพล์ เสาเข็มเหล็ก เสาเข็มไอ และเสาเข็มหกเหลี่ยม สำหรับโรงงาน โครงการ และบ้านพักอาศัย ติดตั้งโดยพาร์ตเนอร์ ควบคุมโดยวิศวกรโยธาของ '.$brand,
            'excerpt' => 'เสาเข็มเจาะ · ไมโครไพล์ · เสาเข็มเหล็ก · เสาเข็มไอ · หกเหลี่ยม',
            'cover_image' => null,
            'service_type' => 'FoundationContractor',
            'meta_title' => "เสาเข็ม รับเหมาครบทุกระบบ สำหรับโรงงานและโครงการ | {$brand}",
            'meta_description' => 'รับเหมางานเสาเข็มเจาะ ไมโครไพล์ เสาเข็มเหล็ก และเสาเข็มไอ สำหรับโรงงาน โครงการ และบ้าน ปทุมธานี–นนทบุรี ควบคุมโดยวิศวกร ขอใบเสนอราคาฟรี',
            'is_published' => true,
            'published_at' => $service->published_at ?? now(),
        ]);

        ServicePrice::query()
            ->where('priceable_type', 'service')
            ->where('priceable_id', $service->id)
            ->delete();

        $note = 'ตอก 2 ท่อนต่อเชื่อม · ยังไม่รวม VAT · อัปเดต ก.ย. 2569';

        $prices = [
            [
                'price_type' => 'unit',
                'label' => 'เสาเข็มไอ — ค่าเสา มอก.',
                'price_min' => $this->markup(140),
                'price_max' => $this->markup(315),
                'price_unit' => 'บาท/ม.',
                'note' => $note.' · ขนาด I 0.18–0.30 ม.',
                'sort_order' => 1,
            ],
            [
                'price_type' => 'unit',
                'label' => 'เสาเข็มไอ — ค่าเสาอีกเกรด',
                'price_min' => $this->markup(130),
                'price_max' => $this->markup(295),
                'price_unit' => 'บาท/ม.',
                'note' => $note.' · ขนาด I 0.18–0.30 ม.',
                'sort_order' => 2,
            ],
            [
                'price_type' => 'package',
                'label' => 'เสาเข็มไอ — ค่าตอกเหมา 1–99 ต้น',
                'price_min' => $this->markup(24000),
                'price_max' => $this->markup(100000),
                'price_unit' => 'บาท',
                'note' => $note.' · ขั้นต่ำจำนวนต้นตามขนาดเสา',
                'sort_order' => 3,
            ],
            [
                'price_type' => 'unit',
                'label' => 'เสาเข็มไอ — ค่าตอกเกิน 100 ต้น',
                'price_min' => $this->markup(575),
                'price_max' => $this->markup(1000),
                'price_unit' => 'บาท/ต้น',
                'note' => $note,
                'sort_order' => 4,
            ],
            [
                'price_type' => 'unit',
                'label' => 'เสาเข็มสี่เหลี่ยมตัน — ค่าเสา',
                'price_min' => $this->markup(155),
                'price_max' => $this->markup(430),
                'price_unit' => 'บาท/ม.',
                'note' => $note.' · ขนาด 0.18–0.30 ม.',
                'sort_order' => 5,
            ],
            [
                'price_type' => 'package',
                'label' => 'เสาเข็มสี่เหลี่ยมตัน — ค่าตอกเหมา 1–99 ต้น',
                'price_min' => $this->markup(25000),
                'price_max' => $this->markup(115000),
                'price_unit' => 'บาท',
                'note' => $note.' · ขั้นต่ำจำนวนต้นตามขนาดเสา',
                'sort_order' => 6,
            ],
            [
                'price_type' => 'unit',
                'label' => 'เสาเข็มสี่เหลี่ยมตัน — ค่าตอกเกิน 100 ต้น',
                'price_min' => $this->markup(600),
                'price_max' => $this->markup(1150),
                'price_unit' => 'บาท/ต้น',
                'note' => $note,
                'sort_order' => 7,
            ],
        ];

        foreach ($prices as $row) {
            $service->prices()->create([
                ...$row,
                'currency' => 'THB',
                'is_visible' => true,
            ]);
        }

        $this->call(SyncServiceHubContentSeeder::class);

        $this->command?->info("อัปเดต piles-foundation id={$service->id} — meta + ServicePrice ".count($prices).' รายการ (+10% จากใบราคาพาร์ตเนอร์)');
    }

    /**
     * ใบราคาพาร์ตเนอร์ + 10% ปัดขึ้นเป็นบาทเต็ม
     * ใช้เลขจำนวนเต็มเพื่อเลี่ยงความคลาดเคลื่อนของ float (เช่น 24000*1.1)
     */
    private function markup(int $partnerPrice): int
    {
        return intdiv($partnerPrice * 11 + 9, 10);
    }
}
