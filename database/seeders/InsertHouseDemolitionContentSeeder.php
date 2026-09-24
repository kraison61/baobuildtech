<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceItem;
use Illuminate\Database\Seeder;

/**
 * สร้าง Hub รับรื้อถอนบ้าน + 4 หน้าย่อย
 * แบรนด์และ Contact อ้างอิง config/company.php เท่านั้น
 */
class InsertHouseDemolitionContentSeeder extends Seeder
{
    public function run(): void
    {
        $category = ServiceCategory::query()->where('slug', 'civil')->first();

        if ($category && ! $category->is_active) {
            $category->update(['is_active' => true]);
        }

        if (! $category) {
            $category = ServiceCategory::query()->create([
                'name' => 'งานโยธา',
                'slug' => 'civil',
                'description' => 'งานโยธาครบวงจร — รื้อถอนบ้าน ถมดิน สำรวจ เสาเข็ม โครงสร้าง และสุขาภิบาล',
                'cover_image' => null,
                'sort_order' => 1,
                'is_active' => true,
            ]);
            $this->command?->info('สร้างหมวด service_categories slug=civil');
        }

        $brand = (string) config('company.brand_name');
        $legal = (string) config('company.legal_name');
        $phone = (string) config('company.phone_format');
        $lineId = (string) config('company.line_id');
        $areas = implode(' ', array_slice(config('company.area_served', []), 0, 6));
        $publishedAt = now();
        $imageBase = rtrim((string) config('company.images_cdn'), '/').'/assets/service-items/demolish-building/';
        $coverImages = [
            'house-demolition' => $imageBase.'house-domollition.webp',
            'townhouse' => $imageBase.'townhouse-demolition.webp',
            'wooden-house' => $imageBase.'wooden-house.webp',
            'interior-demolition' => $imageBase.'interior-demolition.webp',
            'site-clearing' => $imageBase.'site-clearing.webp',
        ];

        $service = Service::query()->updateOrCreate(
            ['slug' => 'house-demolition'],
            [
                'category_id' => $category->id,
                'name' => 'รับรื้อถอนบ้าน',
                'description' => "{$brand} รับรื้อถอนบ้าน รับทุบบ้าน บ้านเดี่ยว ตึกแถว ทาวน์เฮาส์ และบ้านไม้ พร้อมเคลียร์พื้นที่ให้สร้างใหม่ได้ทันที ใบเสนอราคาแยกรายการ ดูแลเรื่องขออนุญาต และทำงานโยธาต่อในทีมเดียว",
                'excerpt' => 'รับรื้อถอนบ้าน · รับทุบบ้าน · เคลียร์พื้นที่',
                'cover_image' => $coverImages['house-demolition'],
                'service_type' => 'House demolition',
                'meta_title' => "รับรื้อถอนบ้าน ทุบบ้านทุกแบบ ประเมินหน้างานฟรี | {$brand}",
                'meta_description' => "รับรื้อถอนบ้าน รับทุบบ้าน {$areas} ประเมินหน้างานฟรี โทร {$phone}",
                'sort_order' => 0,
                'is_published' => true,
                'published_at' => $publishedAt,
            ],
        );

        $urls = [
            'hub' => route('services.show', [$category->slug, $service->slug], absolute: false),
            'townhouse' => route('services.items.show', [$category->slug, $service->slug, 'townhouse'], absolute: false),
            'wooden' => route('services.items.show', [$category->slug, $service->slug, 'wooden-house'], absolute: false),
            'interior' => route('services.items.show', [$category->slug, $service->slug, 'interior-demolition'], absolute: false),
            'clearing' => route('services.items.show', [$category->slug, $service->slug, 'site-clearing'], absolute: false),
            'retaining' => $this->publishedItemUrl('retaining-wall'),
            'filling' => $this->publishedItemUrl('land-filling'),
            'piles' => $this->publishedServiceUrl('piles-foundation'),
        ];

        $contents = require __DIR__.'/data/house_demolition_contents.php';
        $pageFields = $contents($urls, $brand, $legal, $phone, $lineId);

        $itemRows = [
            [
                'slug' => 'townhouse',
                'name' => 'รับทุบตึกแถวและทาวน์เฮาส์',
                'sort_order' => 1,
                'fields' => $pageFields['townhouse'],
            ],
            [
                'slug' => 'wooden-house',
                'name' => 'รับรื้อบ้านไม้เก่า',
                'sort_order' => 2,
                'fields' => $pageFields['wooden-house'],
            ],
            [
                'slug' => 'interior-demolition',
                'name' => 'รับรื้อถอนภายใน',
                'sort_order' => 3,
                'fields' => $pageFields['interior-demolition'],
            ],
            [
                'slug' => 'site-clearing',
                'name' => 'เคลียร์พื้นที่หลังรื้อถอน',
                'sort_order' => 4,
                'fields' => $pageFields['site-clearing'],
            ],
        ];

        $items = [];
        foreach ($itemRows as $row) {
            $fields = $row['fields'];
            $item = ServiceItem::query()->updateOrCreate(
                ['slug' => $row['slug']],
                [
                    'service_id' => $service->id,
                    'name' => $row['name'],
                    'description' => $fields['description'],
                    'headline' => $fields['headline'],
                    'excerpt' => $fields['excerpt'],
                    'content' => $fields['content'],
                    'cover_image' => $coverImages[$row['slug']] ?? null,
                    'meta_title' => $fields['meta_title'],
                    'meta_description' => $fields['meta_description'],
                    'sort_order' => $row['sort_order'],
                    'is_published' => true,
                    'published_at' => $publishedAt,
                ],
            );
            $items[$row['slug']] = $item;
        }

        $this->seedPrices($service, $items);
        $this->seedFaqs($items, $brand, $phone, $areas);

        $this->command?->info("อัปเดต house-demolition id={$service->id} + รายการย่อย ".count($items).' รายการ');
        $this->command?->info('URL: '.$service->url());
    }

    /**
     * @param  array<string, ServiceItem>  $items
     */
    private function seedPrices(Service $service, array $items): void
    {
        $service->prices()->delete();
        foreach ($items as $item) {
            $item->prices()->delete();
        }

        $service->prices()->createMany([
            [
                'price_type' => 'package',
                'label' => 'รื้อบ้านเดี่ยวชั้นเดียว (ประมาณการ)',
                'price_min' => 40000,
                'price_max' => 120000,
                'price_unit' => 'บาท/หลัง',
                'currency' => 'THB',
                'note' => 'ขึ้นกับพื้นที่ ทางเข้าซอย และค่าขนเศษไปทิ้ง',
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'price_type' => 'package',
                'label' => 'รื้อบ้านเดี่ยว 2 ชั้น (ประมาณการ)',
                'price_min' => 80000,
                'price_max' => 220000,
                'price_unit' => 'บาท/หลัง',
                'currency' => 'THB',
                'note' => 'ยังไม่รวมงานถอนเสาเข็มและค่าขออนุญาต',
                'is_visible' => true,
                'sort_order' => 2,
            ],
        ]);

        $itemPrices = [
            'townhouse' => [
                'price_type' => 'unit',
                'label' => 'ทุบตึกแถว / ทาวน์เฮาส์',
                'price_min' => 350,
                'price_max' => 800,
                'price_unit' => 'บาท/ตร.ม.',
                'note' => 'รวมค้ำยันผนังร่วมเบื้องต้น — ซอยแคบคิดเพิ่ม',
            ],
            'wooden-house' => [
                'price_type' => 'package',
                'label' => 'รื้อบ้านไม้เก่า',
                'price_min' => 15000,
                'price_max' => 80000,
                'price_unit' => 'บาท/หลัง',
                'note' => 'หักเศษไม้/เหล็กตามสภาพหลังสำรวจ',
            ],
            'interior-demolition' => [
                'price_type' => 'unit',
                'label' => 'รื้อถอนภายใน / ทุบผนัง',
                'price_min' => 200,
                'price_max' => 500,
                'price_unit' => 'บาท/ตร.ม.',
                'note' => 'งานที่แตะผนังรับน้ำหนักประเมินแยก',
            ],
            'site-clearing' => [
                'price_type' => 'unit',
                'label' => 'ขนเศษวัสดุเคลียร์พื้นที่',
                'price_min' => 2500,
                'price_max' => 4500,
                'price_unit' => 'บาท/เที่ยว',
                'note' => 'รถ 6–10 ล้อ ตามระยะทางและค่าบ่อทิ้ง',
            ],
        ];

        $sort = 1;
        foreach ($itemPrices as $slug => $row) {
            $items[$slug]->prices()->create([
                ...$row,
                'currency' => 'THB',
                'is_visible' => true,
                'sort_order' => $sort++,
            ]);
        }
    }

    /**
     * @param  array<string, ServiceItem>  $items
     */
    private function seedFaqs(array $items, string $brand, string $phone, string $areas): void
    {
        $faqsBySlug = [
            'townhouse' => [
                [
                    'question' => 'ทุบตึกแถว ทาวน์เฮาส์ ต้องขออนุญาตไหม',
                    'answer' => 'เกือบทุกหลังต้องขอ เพราะอยู่ห่างอาคารอื่นหรือที่สาธารณะน้อยกว่า 2 เมตร ตาม พ.ร.บ.ควบคุมอาคาร มาตรา 22 '.$brand.' ตรวจให้ตั้งแต่สำรวจหน้างาน และยื่นแบบ อ.1 แทนเจ้าของบ้านได้ในเขตที่รับงาน',
                ],
                [
                    'question' => 'ทุบบ้านติดกันแล้วบ้านข้างร้าว ใครรับผิดชอบ',
                    'answer' => 'ผู้รับเหมาที่ทำให้เกิดความเสียหายต้องซ่อมหรือชดใช้ เราบันทึกสภาพบ้านข้างก่อนเริ่ม ค้ำยันผนังร่วม และกันฝุ่นตามสัญญา หากร้าวใหม่ที่พิสูจน์ได้ว่ามาจากงานรื้อ เราเข้าตรวจและแก้ไข',
                ],
                [
                    'question' => 'ซอยแคบ รถแบคโฮเข้าไม่ได้ ทุบตึกแถวได้ไหม',
                    'answer' => 'ได้ แต่ต้องใช้เครื่องจักรเล็กหรือรื้อด้วยแรงคนร่วมด้วย จำนวนวันและราคาต่อตารางเมตรจึงสูงกว่างานที่รถใหญ่เข้าถึง ส่งรูปซอยทางเข้ามาตอนประเมิน จะบอกได้ว่าเข้าได้แค่ไหน',
                ],
                [
                    'question' => 'รับทุบตึกแถวราคาเท่าไหร่ต่อตารางเมตร',
                    'answer' => 'ช่วงประมาณ 350–800 บาทต่อตารางเมตร ขึ้นกับจำนวนชั้น ผนังร่วม ทางเข้าซอย และค่าขนเศษ ราคายืนยันหลังสำรวจหน้างาน โทร '.$phone.' เพื่อนัดประเมินฟรี',
                ],
            ],
            'wooden-house' => [
                [
                    'question' => 'รับรื้อบ้านไม้แล้วรับซื้อไม้เก่าไหม',
                    'answer' => $brand.' ไม่ได้ทำกิจการรับซื้อไม้แยกต่างหาก แต่ไม้ที่ยังใช้ได้และเศษเหล็กนำมาหักจากค่ารื้อได้ตามสภาพหน้างานจริง ไม้ผุ ปลวกกิน หรือทาสีหนา หักได้น้อยหรือไม่ได้',
                ],
                [
                    'question' => 'รื้อบ้านไม้เก่า ราคาเท่าไหร่',
                    'answer' => 'บ้านไม้ชั้นเดียวโดยประมาณ 15,000–80,000 บาทต่อหลัง ขึ้นกับขนาด วิธีรื้อแบบเก็บไม้หรือทุบ และปริมาณวัสดุที่หักได้ สำรวจหน้างานฟรีในพื้นที่ให้บริการ',
                ],
                [
                    'question' => 'บ้านไม้มีกระเบื้องใยหินบนหลังคา รื้อได้ไหม',
                    'answer' => 'ได้ แต่ต้องแยกแผ่นใยหินออกจากเศษทั่วไป ห้ามทุบปนกอง ค่าจัดการและขนทิ้งคิดแยก แจ้งตั้งแต่สำรวจหน้างาน',
                ],
                [
                    'question' => 'รื้อบ้านไม้ใช้เวลากี่วัน',
                    'answer' => 'บ้านไม้ชั้นเดียวที่รื้อเก็บไม้ ใช้ประมาณ 3–7 วันทำการ รวมขนเศษ หากทุบและไม่เก็บไม้จะสั้นกว่า กำหนดจริงอยู่ในสัญญา',
                ],
            ],
            'interior-demolition' => [
                [
                    'question' => 'ทุบผนังบ้าน ผนังไหนทุบได้ ผนังไหนห้าม',
                    'answer' => 'ผนังกั้นห้องที่ไม่รับน้ำหนักทุบได้ ผนังรับน้ำหนัก เสา คาน ห้ามทุบโดยไม่มีวิศวกรตรวจ ทีมงานชี้จุดให้ตั้งแต่สำรวจ ไม่ทุบตามคำสั่งที่เสี่ยงโครงสร้าง',
                ],
                [
                    'question' => 'รื้อห้องน้ำ รื้อครัว อยู่บ้านระหว่างงานได้ไหม',
                    'answer' => 'ได้นอกห้องที่รื้อ แต่มีฝุ่นและเสียง ควรปิดประตูห้องอื่น ย้ายของออกจากโซนงาน และตกลงช่วงเวลาทำงานในสัญญา โดยเฉพาะบ้านที่มีเด็กหรือผู้สูงอายุ',
                ],
                [
                    'question' => 'รื้อถอนภายในราคาเท่าไหร่ต่อตารางเมตร',
                    'answer' => 'ช่วงประมาณ 200–500 บาทต่อตารางเมตร สำหรับงานทุบผนังและรื้อผิวที่ไม่แตะโครงสร้าง งานระบบประปา ไฟฟ้า และผนังรับน้ำหนักประเมินแยก',
                ],
                [
                    'question' => 'รับรื้อถอนภายในพื้นที่ไหนบ้าง',
                    'answer' => "{$brand} รับงานใน{$areas} สำรวจหน้างานฟรี นัดหมายได้ที่โทร {$phone} หรือทาง LINE",
                ],
            ],
            'site-clearing' => [
                [
                    'question' => 'เคลียร์พื้นที่หลังรื้อถอน คิดราคายังไง',
                    'answer' => 'คิดเป็นเที่ยวรถบรรทุกประมาณ 2,500–4,500 บาทต่อเที่ยว ตามขนาดรถ ระยะทาง และค่าธรรมเนียมจุดทิ้ง จำนวนเที่ยวประมาณจากกองเศษหน้างาน ไม่เหมาต่อตารางเมตรโดยไม่ดูปริมาณ',
                ],
                [
                    'question' => 'ปรับหน้าดินหลังรื้อแล้วถมต่อได้เลยไหม',
                    'answer' => 'ได้ถ้าเคลียร์เศษและปอกวัสดุอินทรีย์ออกแล้ว การถมและบดอัดคิดเป็นงานแยก '.$brand.' รับถมดินต่อในทีมเดียวได้ ไม่ต้องหาผู้รับเหมาถมคนละเจ้า',
                ],
                [
                    'question' => 'หลังเคลียร์พื้นที่ทำกำแพงกันดินหรือรั้วต่อได้ไหม',
                    'answer' => 'ได้ และควรวางแผนตั้งแต่ตอนรื้อ เพื่อเว้นแนวและระดับที่ถูกต้อง งานกำแพงกันดินและรั้วรับต่อในสัญญาเดียวกันได้',
                ],
                [
                    'question' => 'ทิ้งเศษวัสดุก่อสร้างที่ไหน ผิดกฎหมายไหม',
                    'answer' => 'ต้องขนไปจุดทิ้งที่รับเศษก่อสร้างได้ การเททิ้งข้างทางหรือที่ว่างผิดกฎหมาย ค่าบ่อทิ้งอยู่ในใบเสนอราคาเป็นรายการแยก',
                ],
            ],
        ];

        foreach ($faqsBySlug as $slug => $faqs) {
            $item = $items[$slug];
            Faq::query()
                ->where('faqable_type', 'service_item')
                ->where('faqable_id', $item->id)
                ->delete();

            foreach ($faqs as $index => $faq) {
                Faq::query()->create([
                    'faqable_type' => 'service_item',
                    'faqable_id' => $item->id,
                    'question' => $faq['question'],
                    'answer' => $faq['answer'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]);
            }
        }
    }

    private function publishedItemUrl(string $slug): ?string
    {
        $item = ServiceItem::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->with('service.category')
            ->first();

        if (! $item) {
            return null;
        }

        return route('services.items.show', [
            $item->service->category->slug,
            $item->service->slug,
            $item->slug,
        ], absolute: false);
    }

    private function publishedServiceUrl(string $slug): ?string
    {
        $service = Service::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->with('category')
            ->first();

        if (! $service) {
            return null;
        }

        return route('services.show', [
            $service->category->slug,
            $service->slug,
        ], absolute: false);
    }
}
