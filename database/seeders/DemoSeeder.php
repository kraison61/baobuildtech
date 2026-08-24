<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Faq;
use App\Models\Location;
use App\Models\Portfolio;
use App\Models\PortfolioImage;
use App\Models\Post;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceItem;
use App\Models\ServicePrice;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * ข้อมูลจำลองสำหรับทดสอบ — อ้างอิงเนื้อหาจากหน้า landing / services
 */
class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedUsers();
        $this->resetServiceTaxonomy();
        $categories = $this->seedServiceCategories();
        $services = $this->seedServices($categories);
        $items = $this->seedServiceItems($services);
        $this->seedServicePrices($services, $items);
        $locations = $this->seedLocations();
        $authors = $this->seedAuthors();
        $posts = $this->seedPosts($authors);
        $portfolios = $this->seedPortfolios($services, $items, $locations);
        $this->seedFaqs($categories, $services, $items, $locations, $posts, $portfolios);
    }

    /** ล้างข้อมูลหมวด/บริการเดิมก่อน seed ลำดับชั้นใหม่ (เคารพ FK) */
    private function resetServiceTaxonomy(): void
    {
        ServicePrice::query()->delete();
        Faq::query()->whereIn('faqable_type', [
            'service_category',
            'service',
            'service_item',
        ])->delete();
        PortfolioImage::query()->delete();
        Portfolio::query()->delete();
        ServiceItem::query()->delete();
        Service::query()->delete();
        ServiceCategory::query()->delete();
    }

    private function seedUsers(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@baobuildtech.test'],
            [
                'name' => 'Admin BAO',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
    }

    /** @return array<string, ServiceCategory> */
    private function seedServiceCategories(): array
    {
        // ชั้นที่ 1: หมวดหมู่งาน (เช่น งานโยธา)
        $rows = [
            [
                'name' => 'งานโยธา',
                'slug' => 'civil',
                'description' => 'งานโยธาครบวงจร — สำรวจ เสาเข็มและฐานราก โครงสร้าง บริหารงานก่อสร้าง และสุขาภิบาล',
                'cover_image' => 'https://images.unsplash.com/photo-1531834685032-c34bf0d84c77?w=1200&q=80&auto=format&fit=crop',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'งานไอที',
                'slug' => 'it',
                'description' => 'ระบบไฟฟ้า สายสัญญาณไฟเบอร์/LAN และกล้องวงจรปิด เป็นบริการเสริมภายในโครงการเดียวกัน',
                'cover_image' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=1200&q=80&auto=format&fit=crop',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'หมวดร่าง (ไม่แสดง)',
                'slug' => 'draft-category',
                'description' => 'หมวดทดสอบ is_active = false ห้าม expose',
                'cover_image' => null,
                'sort_order' => 99,
                'is_active' => false,
            ],
        ];

        $out = [];
        foreach ($rows as $row) {
            $out[$row['slug']] = ServiceCategory::query()->updateOrCreate(
                ['slug' => $row['slug']],
                $row
            );
        }

        return $out;
    }

    /**
     * ชั้นที่ 2: งานภายใต้หมวด (เช่น งานโยธา → โครงสร้าง)
     *
     * @param  array<string, ServiceCategory>  $categories
     * @return array<string, Service>
     */
    private function seedServices(array $categories): array
    {
        $publishedAt = now()->subMonths(2);

        $rows = [
            [
                'category' => 'civil',
                'name' => 'สำรวจ',
                'slug' => 'survey',
                'description' => 'สำรวจหน้างาน วางผัง ตรวจระดับและแนวโครงสร้างก่อนและระหว่างก่อสร้าง เพื่อให้ตำแหน่งฐานราก กำแพง และระบบระบายน้ำตรงแบบ',
                'excerpt' => 'วางผัง · ระดับ · ตรวจสอบแนว',
                'cover_image' => 'https://images.unsplash.com/photo-1581094794329-c8112a89af12?w=1200&q=80&auto=format&fit=crop',
                'service_type' => 'Surveying',
                'meta_title' => 'งานสำรวจ | ธีรพงษ์การช่าง',
                'meta_description' => 'รับงานสำรวจหน้างาน วางผัง และตรวจระดับก่อนก่อสร้าง',
                'sort_order' => 1,
                'is_published' => true,
                'published_at' => $publishedAt,
            ],
            [
                'category' => 'civil',
                'name' => 'เสาเข็มและฐานราก',
                'slug' => 'piles-foundation',
                'description' => 'งานเสาเข็มและฐานรากอาคาร โรงงาน และงานเสริมฐานรากเดิมที่ทรุดตัว เลือกชนิดเข็มจากสภาพชั้นดินและข้อจำกัดทางเข้าหน้างาน',
                'excerpt' => 'กดเสาเข็ม · เข็มเจาะ · ไมโครไพล์ · ฟุตติ้ง',
                'cover_image' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1200&q=80&auto=format&fit=crop',
                'service_type' => 'FoundationContractor',
                'meta_title' => 'เสาเข็มและฐานราก | ธีรพงษ์การช่าง',
                'meta_description' => 'รับงานกดเสาเข็ม เข็มเจาะ ไมโครไพล์ และฟุตติ้ง พร้อมรายงาน pile record',
                'sort_order' => 2,
                'is_published' => true,
                'published_at' => $publishedAt,
            ],
            [
                'category' => 'civil',
                'name' => 'โครงสร้าง',
                'slug' => 'structure',
                'description' => 'งานโครงสร้างคอนกรีตเสริมเหล็ก กำแพงกันดิน รั้วเหล็กและก่อฉาบ เขื่อนกันดิน เทคอนกรีต และโครงเหล็ก ทุกแบบคำนวณและลงนามโดยวิศวกรก่อนเริ่มงาน',
                'excerpt' => 'กำแพงกันดิน · รั้ว · เทคอนกรีต · โครงเหล็ก',
                'cover_image' => 'https://images.unsplash.com/photo-1531834685032-c34bf0d84c77?w=1200&q=80&auto=format&fit=crop',
                'service_type' => 'StructuralEngineering',
                'meta_title' => 'งานโครงสร้าง | ธีรพงษ์การช่าง',
                'meta_description' => 'รับงานโครงสร้าง กำแพงกันดิน รั้วเหล็กและก่อฉาบ เทคอนกรีต และโครงเหล็ก',
                'sort_order' => 3,
                'is_published' => true,
                'published_at' => $publishedAt,
            ],
            [
                'category' => 'civil',
                'name' => 'บริหารงานก่อสร้าง',
                'slug' => 'construction-mgmt',
                'description' => 'วางแผนงาน ควบคุมคุณภาพวัสดุและขั้นตอนก่อสร้าง ประสานทีมหน้างาน และจัดชุดเอกสารส่งมอบให้ตรวจสอบได้ทุกชั้นงาน',
                'excerpt' => 'แผนงาน · ควบคุมคุณภาพ · ส่งมอบ',
                'cover_image' => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=1200&q=80&auto=format&fit=crop',
                'service_type' => 'ConstructionManagement',
                'meta_title' => 'บริหารงานก่อสร้าง | ธีรพงษ์การช่าง',
                'meta_description' => 'บริการบริหารและควบคุมงานก่อสร้าง พร้อมเอกสารส่งมอบครบถ้วน',
                'sort_order' => 4,
                'is_published' => true,
                'published_at' => $publishedAt,
            ],
            [
                'category' => 'civil',
                'name' => 'สุขาภิบาล',
                'slug' => 'sanitation',
                'description' => 'ระบบสุขาภิบาลรอบโครงการ — ติดตั้งถังบำบัดน้ำเสีย วางท่อระบายน้ำ และแนวระบายน้ำหลังโครงสร้าง เพื่อลดน้ำขังและความชื้นที่ทำลายฐานราก',
                'excerpt' => 'ถังบำบัด · ท่อระบายน้ำ · บ่อพัก',
                'cover_image' => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=1200&q=80&auto=format&fit=crop',
                'service_type' => 'Plumbing',
                'meta_title' => 'งานสุขาภิบาล | ธีรพงษ์การช่าง',
                'meta_description' => 'รับติดตั้งถังบำบัดน้ำเสียและวางท่อระบายน้ำรอบโครงการ',
                'sort_order' => 5,
                'is_published' => true,
                'published_at' => $publishedAt,
            ],
            [
                'category' => 'it',
                'name' => 'ระบบไฟฟ้า',
                'slug' => 'electrical',
                'description' => 'เดินระบบไฟฟ้าภายในโครงการ ร้อยท่อไปพร้อมงานโครงสร้าง ไม่ต้องรื้อผิวคอนกรีตซ้ำภายหลัง',
                'excerpt' => 'เดินสายไฟฟ้า · ร้อยท่อ EMT/HDPE',
                'cover_image' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=1200&q=80&auto=format&fit=crop',
                'service_type' => 'ElectricalInstallation',
                'meta_title' => 'ระบบไฟฟ้า | ธีรพงษ์การช่าง',
                'meta_description' => 'รับเดินสายไฟฟ้าพร้อมงานโครงสร้างในสัญญาเดียว',
                'sort_order' => 1,
                'is_published' => true,
                'published_at' => $publishedAt,
            ],
            [
                'category' => 'it',
                'name' => 'สายสัญญาณ',
                'slug' => 'network-cabling',
                'description' => 'เดินสายไฟเบอร์และ LAN ภายนอกอาคาร พร้อมผลทดสอบสาย และสไปซ์ในตู้',
                'excerpt' => 'ไฟเบอร์ · LAN ภายนอกอาคาร',
                'cover_image' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=1200&q=80&auto=format&fit=crop',
                'service_type' => 'NetworkInstallation',
                'meta_title' => 'สายสัญญาณ ไฟเบอร์ LAN | ธีรพงษ์การช่าง',
                'meta_description' => 'รับเดินไฟเบอร์และ LAN ภายนอกอาคารพร้อมผลทดสอบ',
                'sort_order' => 2,
                'is_published' => true,
                'published_at' => $publishedAt,
            ],
            [
                'category' => 'it',
                'name' => 'กล้องวงจรปิด',
                'slug' => 'cctv',
                'description' => 'ติดตั้งกล้องวงจรปิดครบวงจร สำรวจจุดติดตั้ง เดินสาย ตั้งค่าระบบ และทดสอบส่งมอบ',
                'excerpt' => 'ติดตั้งกล้อง · ดูผ่านมือถือ',
                'cover_image' => 'https://images.unsplash.com/photo-1557597774-9d273605dfa9?w=1200&q=80&auto=format&fit=crop',
                'service_type' => 'SecuritySystem',
                'meta_title' => 'กล้องวงจรปิด | ธีรพงษ์การช่าง',
                'meta_description' => 'รับติดตั้งกล้องวงจรปิดพร้อมงานโครงสร้าง',
                'sort_order' => 3,
                'is_published' => true,
                'published_at' => $publishedAt,
            ],
            [
                'category' => 'draft-category',
                'name' => 'บริการร่าง (ไม่เผยแพร่)',
                'slug' => 'draft-service',
                'description' => 'บริการทดสอบ is_published = false',
                'excerpt' => 'ไม่ควรแสดงบนหน้าเว็บ',
                'cover_image' => null,
                'service_type' => null,
                'meta_title' => null,
                'meta_description' => null,
                'sort_order' => 99,
                'is_published' => false,
                'published_at' => null,
            ],
        ];

        $out = [];
        foreach ($rows as $row) {
            $categorySlug = $row['category'];
            unset($row['category']);
            $row['category_id'] = $categories[$categorySlug]->id;
            $out[$row['slug']] = Service::query()->updateOrCreate(
                ['slug' => $row['slug']],
                $row
            );
        }

        return $out;
    }

    /**
     * ชั้นที่ 3: รายการงานย่อย (เช่น งานโยธา → โครงสร้าง → รั้วเหล็ก และก่อฉาบ)
     *
     * @param  array<string, Service>  $services
     * @return array<string, ServiceItem>
     */
    private function seedServiceItems(array $services): array
    {
        $publishedAt = now()->subMonths(2);
        $pageFields = require __DIR__.'/data/service_item_contents.php';

        $rows = [
            // สำรวจ
            [
                'service' => 'survey',
                'name' => 'สำรวจหน้างาน',
                'slug' => 'site-survey',
                'description' => 'นัดเข้าสำรวจหน้างาน ประเมินสภาพดิน ระดับ และข้อจำกัดทางเข้าก่อนเสนอราคา',
                'cover_image' => null,
                'meta_title' => 'สำรวจหน้างาน',
                'meta_description' => 'บริการสำรวจหน้างานก่อนเริ่มก่อสร้าง',
                'sort_order' => 1,
                'is_published' => true,
            ],
            [
                'service' => 'survey',
                'name' => 'วางผังและตรวจระดับ',
                'slug' => 'layout-leveling',
                'description' => 'วางผังตามพิกัดแบบ ตรวจระดับอ้างอิง BM โครงการ และตรวจสอบแนวโครงสร้างก่อนเท',
                'cover_image' => null,
                'meta_title' => 'วางผังและตรวจระดับ',
                'meta_description' => 'วางผังและตรวจระดับหน้างานก่อสร้าง',
                'sort_order' => 2,
                'is_published' => true,
            ],

            // เสาเข็มและฐานราก
            [
                'service' => 'piles-foundation',
                'name' => 'กดเสาเข็ม',
                'slug' => 'driven-pile',
                'description' => 'กดเสาเข็มตามแบบวิศวกร พร้อมบันทึกความลึกและแรงปฏิกิริยาทุกต้น',
                'cover_image' => null,
                'meta_title' => 'กดเสาเข็ม',
                'meta_description' => 'รับกดเสาเข็มพร้อมรายงานหน้างาน',
                'sort_order' => 1,
                'is_published' => true,
            ],
            [
                'service' => 'piles-foundation',
                'name' => 'เข็มเจาะ',
                'slug' => 'bored-pile',
                'description' => 'เข็มเจาะ Ø35 ซม. ความลึกตามชั้นดินที่สำรวจ พร้อม pile record ทุกต้น',
                'cover_image' => null,
                'meta_title' => 'เข็มเจาะ',
                'meta_description' => 'งานเข็มเจาะพร้อมรายงานตำแหน่งและความลึก',
                'sort_order' => 2,
                'is_published' => true,
            ],
            [
                'service' => 'piles-foundation',
                'name' => 'ไมโครไพล์',
                'slug' => 'micropile',
                'description' => 'งานเสริมฐานรากเดิมในที่แคบ เครื่องจักรเข้าหน้างานได้จำกัด',
                'cover_image' => null,
                'meta_title' => 'ไมโครไพล์',
                'meta_description' => 'ไมโครไพล์สำหรับงานเสริมฐานรากในพื้นที่แคบ',
                'sort_order' => 3,
                'is_published' => true,
            ],
            [
                'service' => 'piles-foundation',
                'name' => 'ฟุตติ้ง',
                'slug' => 'footing',
                'description' => 'ฐานรากตื้นรับน้ำหนักเสาและกระจายลงดิน ใช้กับบ้านพักอาศัย โกดัง รั้ว และงานโยธาขนาดกลาง',
                'cover_image' => null,
                'meta_title' => 'ฟุตติ้ง',
                'meta_description' => 'รับทำฟุตติ้งฐานรากตื้นตามแบบวิศวกร',
                'sort_order' => 4,
                'is_published' => true,
            ],

            // โครงสร้าง
            [
                'service' => 'structure',
                'name' => 'กำแพงกันดิน',
                'slug' => 'retaining-wall',
                'description' => 'กำแพงกันดิน คสล. แบบ Cantilever / Counterfort / เข็มพืด คำนวณจากแรงดันดินจริง สูงถึง 4.0 เมตร',
                'cover_image' => 'https://images.unsplash.com/photo-1531834685032-c34bf0d84c77?w=800&q=80&auto=format&fit=crop',
                'meta_title' => 'กำแพงกันดิน คสล. | ธีรพงษ์การช่าง',
                'meta_description' => 'รับเหมากำแพงกันดิน คสล. พร้อมแบบวิศวกร สเปกวัสดุ และระบบระบายน้ำหลังกำแพง',
                'sort_order' => 1,
                'is_published' => true,
                'published_at' => $publishedAt,
            ],
            [
                'service' => 'structure',
                'name' => 'รั้วเหล็ก และก่อฉาบ',
                'slug' => 'steel-plaster-fence',
                'description' => 'รั้วเหล็ก รั้วก่อฉาบ และรั้วผสม ตามแบบและความสูงที่ต้องการ พร้อมฐานรากและเสารั้วตามมาตรฐาน',
                'cover_image' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=800&q=80&auto=format&fit=crop',
                'meta_title' => 'รั้วเหล็ก และก่อฉาบ',
                'meta_description' => 'รับสร้างรั้วเหล็กและรั้วก่อฉาบ พร้อมฐานราก',
                'sort_order' => 2,
                'is_published' => true,
            ],
            [
                'service' => 'structure',
                'name' => 'เขื่อนกันดิน',
                'slug' => 'sheet-pile-wall',
                'description' => 'เขื่อนกันดินด้วยเสาเข็มไอหรือระบบโครงสร้างตามขนาดหน้างาน ใช้เมื่อต้องกั้นดินชิดแนวเขต',
                'cover_image' => null,
                'meta_title' => 'เขื่อนกันดิน',
                'meta_description' => 'รับทำเขื่อนกันดินตามแบบวิศวกร',
                'sort_order' => 3,
                'is_published' => true,
            ],
            [
                'service' => 'structure',
                'name' => 'เทคอนกรีต',
                'slug' => 'concrete-pour',
                'description' => 'เทพื้นคอนกรีต ลานคอนกรีต และงานปูนโครงสร้าง ตามความหนาและเหล็กเสริมที่แบบกำหนด',
                'cover_image' => 'https://images.unsplash.com/photo-1517089596392-fb9a9033e05b?w=800&q=80&auto=format&fit=crop',
                'meta_title' => 'เทคอนกรีต',
                'meta_description' => 'รับเทพื้นและลานคอนกรีตพร้อมตะแกรงเหล็ก',
                'sort_order' => 4,
                'is_published' => true,
            ],
            [
                'service' => 'structure',
                'name' => 'โครงเหล็ก',
                'slug' => 'steel-frame',
                'description' => 'โครงหลังคาเหล็กและโครงสร้างเหล็ก ตามระยะพาด ความสูง และภาระใช้งาน',
                'cover_image' => null,
                'meta_title' => 'โครงเหล็ก',
                'meta_description' => 'รับงานโครงเหล็กและโครงหลังคาเหล็ก',
                'sort_order' => 5,
                'is_published' => true,
            ],

            // บริหารงานก่อสร้าง
            [
                'service' => 'construction-mgmt',
                'name' => 'วางแผนและควบคุมงาน',
                'slug' => 'planning-control',
                'description' => 'จัดทำกำหนดการ จุดตรวจ และเช็คลิสต์ควบคุมคุณภาพรายชั้นงาน',
                'cover_image' => null,
                'meta_title' => 'วางแผนและควบคุมงาน',
                'meta_description' => 'บริการวางแผนและควบคุมงานก่อสร้าง',
                'sort_order' => 1,
                'is_published' => true,
            ],
            [
                'service' => 'construction-mgmt',
                'name' => 'ตรวจรับและส่งมอบ',
                'slug' => 'handover-inspection',
                'description' => 'ตรวจรับงานพร้อมเจ้าของบ้าน จัดชุดเอกสารปิดงาน แบบ as-built และหนังสือรับประกัน',
                'cover_image' => null,
                'meta_title' => 'ตรวจรับและส่งมอบ',
                'meta_description' => 'บริการตรวจรับงานและจัดเอกสารส่งมอบ',
                'sort_order' => 2,
                'is_published' => true,
            ],

            // สุขาภิบาล
            [
                'service' => 'sanitation',
                'name' => 'ติดตั้งถังบำบัดน้ำเสีย',
                'slug' => 'septic-tank',
                'description' => 'ติดตั้งถังบำบัดตามขนาดผู้ใช้ ขุดหลุม ฝังถัง และต่อท่อเข้า–ออก',
                'cover_image' => null,
                'meta_title' => 'ติดตั้งถังบำบัดน้ำเสีย',
                'meta_description' => 'รับติดตั้งถังบำบัดน้ำเสียพร้อมงานต่อท่อ',
                'sort_order' => 1,
                'is_published' => true,
            ],
            [
                'service' => 'sanitation',
                'name' => 'วางท่อระบายน้ำ',
                'slug' => 'drainage-pipe',
                'description' => 'วางท่อระบายน้ำรอบโครงการ ท่อ PVC/HDPE บ่อพัก และความชันตามแบบวิศวกร',
                'cover_image' => null,
                'meta_title' => 'วางท่อระบายน้ำ',
                'meta_description' => 'รับวางท่อระบายน้ำรอบบ้านและโครงการ',
                'sort_order' => 2,
                'is_published' => true,
            ],

            // งานไอที
            [
                'service' => 'electrical',
                'name' => 'เดินสายไฟฟ้า',
                'slug' => 'electrical-wiring',
                'description' => 'เดินสายไฟฟ้ามาตรฐาน มอก. ร้อยท่อ EMT/HDPE ไปพร้อมงานโครงสร้าง',
                'cover_image' => null,
                'meta_title' => 'เดินสายไฟฟ้า',
                'meta_description' => 'รับเดินสายไฟฟ้าพร้อมงานโครงสร้าง',
                'sort_order' => 1,
                'is_published' => true,
            ],
            [
                'service' => 'network-cabling',
                'name' => 'ไฟเบอร์',
                'slug' => 'fiber',
                'description' => 'เดินสายไฟเบอร์ Single-mode สไปซ์ในตู้ พร้อมผลทดสอบ',
                'cover_image' => null,
                'meta_title' => 'ไฟเบอร์',
                'meta_description' => 'รับเดินสายไฟเบอร์พร้อมสไปซ์และทดสอบ',
                'sort_order' => 1,
                'is_published' => true,
            ],
            [
                'service' => 'network-cabling',
                'name' => 'LAN ภายนอกอาคาร',
                'slug' => 'outdoor-lan',
                'description' => 'เดินสาย LAN CAT6 ภายนอกอาคาร พร้อมผลทดสอบสาย',
                'cover_image' => null,
                'meta_title' => 'LAN ภายนอกอาคาร',
                'meta_description' => 'รับเดินสาย LAN ภายนอกอาคารพร้อมผลทดสอบ',
                'sort_order' => 2,
                'is_published' => true,
            ],
            [
                'service' => 'cctv',
                'name' => 'ติดตั้งกล้องวงจรปิด',
                'slug' => 'cctv-install',
                'description' => 'สำรวจจุดติดตั้ง เดินสาย ติดตั้งกล้องและเครื่องบันทึก ตั้งค่าระบบ ดูผ่านมือถือ และทดสอบส่งมอบ',
                'cover_image' => null,
                'meta_title' => 'ติดตั้งกล้องวงจรปิด',
                'meta_description' => 'รับติดตั้งกล้องวงจรปิดครบวงจร',
                'sort_order' => 1,
                'is_published' => true,
            ],

            // ร่าง
            [
                'service' => 'draft-service',
                'name' => 'รายการร่าง',
                'slug' => 'draft-item',
                'description' => 'รายการทดสอบที่ไม่เผยแพร่',
                'cover_image' => null,
                'meta_title' => null,
                'meta_description' => null,
                'sort_order' => 1,
                'is_published' => false,
            ],
        ];

        $out = [];
        foreach ($rows as $row) {
            $serviceSlug = $row['service'];
            unset($row['service']);

            if (isset($pageFields[$row['slug']])) {
                $fields = $pageFields[$row['slug']];
                if (($fields['content'] ?? null) === null) {
                    $fields['content'] = $this->retainingWallPageContent();
                }
                $row = array_merge($fields, $row);
            }

            if (($row['is_published'] ?? false) && ! array_key_exists('published_at', $row)) {
                $row['published_at'] = $publishedAt;
            }

            $row['service_id'] = $services[$serviceSlug]->id;
            $out[$row['slug']] = ServiceItem::query()->updateOrCreate(
                ['slug' => $row['slug']],
                $row
            );
        }

        return $out;
    }

    /** เนื้อหา SEO หน้ากำแพงกันดิน (service_items.content) */
    private function retainingWallPageContent(): string
    {
        return <<<'HTML'
<h2>เลือกรูปแบบกำแพงจากความสูงดินและระยะร่น</h2>
<p>รูปแบบไม่ได้เลือกจากราคาที่ถูกที่สุด แต่เลือกจากความสูงดินที่ต้องกั้น พื้นที่ว่างสำหรับฐาน และระยะห่างจากแนวเขตที่ดินข้างเคียง</p>
<h3>Cantilever</h3>
<p>รูปแบบมาตรฐานสำหรับที่ดินทั่วไป ฐานยื่นเข้าด้านในเพื่อถ่วงโมเมนต์ เหมาะกับความสูงดินไม่เกิน 3.0 ม. เมื่อมีพื้นที่ให้ยื่นฐานเข้าใน</p>
<h3>Counterfort</h3>
<p>เพิ่มครีบยึดด้านหลังเป็นช่วง ลดความหนาผนังกำแพงเมื่อดินสูงมาก เหมาะกับความสูงดิน 3.0–4.0 ม. และงานยาวต่อเนื่อง</p>
<h3>กำแพงเข็มพืด</h3>
<p>ใช้เมื่อไม่มีพื้นที่ทำฐานยื่น หรือต้องกั้นดินชิดแนวเขตที่ดิน ระยะร่นที่ต้องการน้อยที่สุดในสามแบบ</p>

<h2>สเปกวัสดุ เกณฑ์ทดสอบ และเอกสารที่ได้รับ</h2>
<p>ทุกบรรทัดในตารางนี้อยู่ในสัญญา และมีเอกสารยืนยันเมื่อส่งมอบงาน</p>
<table>
<thead>
<tr><th>รายการ</th><th>สเปกที่ใช้</th><th>เอกสารยืนยัน</th></tr>
</thead>
<tbody>
<tr><td>คอนกรีต</td><td>ผสมเสร็จ กำลังอัด 280 ksc ค่ายุบตัวควบคุมหน้างาน</td><td>ผลทดสอบลูกปูน 7 และ 28 วัน</td></tr>
<tr><td>เหล็กเสริม</td><td>SD40 DB12–DB16 ระยะเรียงตามแบบ ระยะหุ้ม 5 ซม.</td><td>ใบรับรองโรงงาน + ภาพก่อนเทคอนกรีต</td></tr>
<tr><td>ฐานรากและเข็ม</td><td>เข็มเจาะ Ø35 ซม. ความลึกตามชั้นดินที่สำรวจ</td><td>Pile record ทุกต้น</td></tr>
<tr><td>ระบายน้ำหลังกำแพง</td><td>ท่อ PVC เจาะรู + หินกรอง + แผ่นกรองกันดินอุดตัน</td><td>ภาพขั้นตอนติดตั้งก่อนถมกลบ</td></tr>
<tr><td>ดินถมหลังกำแพง</td><td>บดอัดชั้นละ 30 ซม. ≥ 95% Mod. Proctor</td><td>ผลทดสอบความหนาแน่นทุกชั้น</td></tr>
</tbody>
</table>

<h2>ขั้นตอนงานกำแพงกันดิน 6 ขั้น</h2>
<ol>
<li><strong>สำรวจระดับดินและแนวเขต</strong> — วัดความสูงดินที่ต้องกั้น ระยะร่นจากแนวเขต และทิศทางการไหลของน้ำผิวดิน</li>
<li><strong>คำนวณและออกแบบโครงสร้าง</strong> — กำหนดรูปแบบกำแพง ขนาดฐาน และเหล็กเสริมจากแรงดันดินจริง</li>
<li><strong>งานเข็มและฐานราก</strong> — เจาะเข็มตามตำแหน่งในแบบ ตัดหัวเข็ม เทคอนกรีตหยาบ และผูกเหล็กฐาน</li>
<li><strong>ตรวจสอบก่อนเทคอนกรีต</strong> — วิศวกรตรวจระยะเรียงเหล็ก ระยะหุ้มคอนกรีต ไม้แบบ และค้ำยัน เจ้าของงานเซ็นรับก่อนเทเสมอ</li>
<li><strong>เทคอนกรีตและบ่ม</strong> — เทเป็นช่วงตามรอยต่อที่กำหนด เก็บลูกปูนส่งทดสอบ และบ่มตามข้อกำหนด</li>
<li><strong>ติดตั้งระบบระบายน้ำและถมกลบ</strong> — วางท่อระบายและหินกรองหลังกำแพง ถมบดอัดชั้นละ 30 ซม. พร้อมส่งมอบเอกสารครบชุด</li>
</ol>

<h2>ปัจจัยที่ทำให้ราคากำแพงต่างกัน</h2>
<p>สี่ปัจจัยนี้กำหนดปริมาณเหล็ก คอนกรีต และงานเข็ม ซึ่งเป็นต้นทุนหลักของงานกำแพง</p>
<ul>
<li><strong>ความสูงดินที่ต้องกั้น</strong> — แรงดันดินเพิ่มเร็วกว่าความสูงที่เพิ่ม กำแพงสูงขึ้นเท่าตัวไม่ได้ใช้เหล็กเพิ่มเท่าตัว</li>
<li><strong>ชั้นดินและชนิดเข็ม</strong> — ดินอ่อนต้องใช้เข็มยาวขึ้นหรือเปลี่ยนชนิดเข็ม</li>
<li><strong>ทางเข้าหน้างาน</strong> — ถ้ารถโม่และเครื่องจักรเข้าไม่ถึง ต้องใช้ปั๊มหรือขนย้ายเพิ่ม</li>
<li><strong>น้ำหนักบรรทุกบนดินหลังกำแพง</strong> — ถ้าจะมีถนน ลานจอดรถ หรืออาคารบนดินหลังกำแพง ต้องคำนวณเพิ่มตั้งแต่ออกแบบ</li>
</ul>
HTML;
    }

    /**
     * @param  array<string, Service>  $services
     * @param  array<string, ServiceItem>  $items
     */
    private function seedServicePrices(array $services, array $items): void
    {
        ServicePrice::query()->delete();

        $prices = [
            [
                'priceable' => $services['structure'],
                'price_type' => 'unit',
                'label' => 'กำแพงกันดิน คสล. (ประมาณการ)',
                'price_min' => 8500,
                'price_max' => 16000,
                'price_unit' => 'บาท/ตร.ม.',
                'note' => 'ขึ้นกับความสูงดิน ชนิดเข็ม และระยะทางเข้าหน้างาน',
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'priceable' => $items['retaining-wall'],
                'price_type' => 'unit',
                'label' => 'กำแพงกันดิน',
                'price_min' => 8500,
                'price_max' => 16000,
                'price_unit' => 'บาท/ตร.ม.',
                'note' => null,
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'priceable' => $items['steel-plaster-fence'],
                'price_type' => 'unit',
                'label' => 'รั้วเหล็ก และก่อฉาบ',
                'price_min' => 1000,
                'price_max' => 3500,
                'price_unit' => 'บาท/ม.',
                'note' => 'ขึ้นกับแบบ ความสูง และชนิดฐานราก',
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'priceable' => $services['piles-foundation'],
                'price_type' => 'unit',
                'label' => 'เข็มเจาะ Ø35 ซม.',
                'price_min' => 2800,
                'price_max' => 4500,
                'price_unit' => 'บาท/ม.',
                'note' => 'ขึ้นกับความลึกและชั้นดิน',
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'priceable' => $items['driven-pile'],
                'price_type' => 'unit',
                'label' => 'กดเสาเข็ม',
                'price_min' => 70,
                'price_max' => null,
                'price_unit' => 'บาท/ม.',
                'note' => 'ราคาเริ่มต้น — ขึ้นกับขนาดเสาและความลึก',
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'priceable' => $items['concrete-pour'],
                'price_type' => 'unit',
                'label' => 'ลานคอนกรีตหนา 15 ซม.',
                'price_min' => 450,
                'price_max' => 650,
                'price_unit' => 'บาท/ตร.ม.',
                'note' => 'รวมตะแกรงเหล็ก',
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'priceable' => $items['septic-tank'],
                'price_type' => 'package',
                'label' => 'ติดตั้งถังบำบัดน้ำเสีย',
                'price_min' => 6000,
                'price_max' => null,
                'price_unit' => 'บาท/ชุด',
                'note' => 'ขึ้นกับขนาดถังและงานขุด–ต่อท่อ',
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'priceable' => $services['draft-service'],
                'price_type' => 'unit',
                'label' => 'ราคาซ่อน',
                'price_min' => 1000,
                'price_max' => null,
                'price_unit' => 'บาท',
                'note' => 'is_visible = false',
                'is_visible' => false,
                'sort_order' => 1,
            ],
        ];

        foreach ($prices as $row) {
            /** @var Service|ServiceItem $priceable */
            $priceable = $row['priceable'];
            unset($row['priceable']);

            $priceable->prices()->create([
                ...$row,
                'currency' => 'THB',
            ]);
        }
    }

    /** @return array<string, Location> */
    private function seedLocations(): array
    {
        $rows = [
            [
                'name' => 'นนทบุรี',
                'slug' => 'nonthaburi',
                'province' => 'นนทบุรี',
                'district' => 'บางใหญ่',
                'description' => 'พื้นที่หลักของทีมช่าง — สำนักงานอยู่ถ.กาญจนาภิเษก บางใหญ่',
                'phone' => '+66812345678',
                'street' => '88/15 ถ.กาญจนาภิเษก',
                'postal_code' => '11140',
                'lat' => 13.83720000,
                'lng' => 100.39650000,
                'meta_title' => 'รับเหมากำแพงกันดิน นนทบุรี',
                'meta_description' => 'ธีรพงษ์การช่างรับงานกำแพงกันดินและฐานรากในนนทบุรี',
                'is_published' => true,
            ],
            [
                'name' => 'กรุงเทพฯ',
                'slug' => 'bangkok',
                'province' => 'กรุงเทพมหานคร',
                'district' => null,
                'description' => 'รับงานในกรุงเทพฯ โดยเฉพาะโซนตะวันตกและเหนือ',
                'phone' => null,
                'street' => null,
                'postal_code' => null,
                'lat' => null,
                'lng' => null,
                'meta_title' => 'รับเหมากำแพงกันดิน กรุงเทพฯ',
                'meta_description' => 'รับงานกำแพงกันดิน ฐานราก ในกรุงเทพฯ',
                'is_published' => true,
            ],
            [
                'name' => 'ปทุมธานี',
                'slug' => 'pathum-thani',
                'province' => 'ปทุมธานี',
                'district' => null,
                'description' => 'รับงานโรงงานและที่ดินจัดสรรในปทุมธานี',
                'phone' => null,
                'street' => null,
                'postal_code' => null,
                'lat' => null,
                'lng' => null,
                'meta_title' => 'รับเหมาฐานราก ปทุมธานี',
                'meta_description' => 'รับงานฐานรากและโยธาในปทุมธานี',
                'is_published' => true,
            ],
            [
                'name' => 'สมุทรปราการ',
                'slug' => 'samut-prakan',
                'province' => 'สมุทรปราการ',
                'district' => null,
                'description' => 'รับงานในสมุทรปราการตามขนาดโครงการ',
                'phone' => null,
                'street' => null,
                'postal_code' => null,
                'lat' => null,
                'lng' => null,
                'meta_title' => 'รับเหมางานโยธา สมุทรปราการ',
                'meta_description' => 'รับงานโยธาและกำแพงกันดินในสมุทรปราการ',
                'is_published' => true,
            ],
            [
                'name' => 'พื้นที่ร่าง',
                'slug' => 'draft-location',
                'province' => 'นครปฐม',
                'district' => null,
                'description' => 'location ทดสอบที่ไม่เผยแพร่',
                'phone' => null,
                'street' => null,
                'postal_code' => null,
                'lat' => null,
                'lng' => null,
                'meta_title' => null,
                'meta_description' => null,
                'is_published' => false,
            ],
        ];

        $out = [];
        foreach ($rows as $row) {
            $out[$row['slug']] = Location::query()->updateOrCreate(
                ['slug' => $row['slug']],
                $row
            );
        }

        return $out;
    }

    /** @return array<string, Author> */
    private function seedAuthors(): array
    {
        $rows = [
            [
                'name' => 'ธีรพงษ์ จันทร์ทอง',
                'slug' => 'theeraphong',
                'bio' => 'วิศวกรโยธาและหัวหน้าทีมหน้างาน มีประสบการณ์งานกำแพงกันดินและฐานรากมากกว่า 10 ปี',
                'avatar' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400&q=80&auto=format&fit=crop',
                'job_title' => 'วิศวกรโยธา / หัวหน้าทีม',
                'social_links' => [
                    'line' => 'https://page.line.me/theeraphong',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'สุภาวดี เขียนบทความ',
                'slug' => 'supawadee',
                'bio' => 'ดูแลเนื้อหาเทคนิคและคู่มือเจ้าของบ้าน สำหรับงานโครงสร้างขนาดเล็ก–กลาง',
                'avatar' => null,
                'job_title' => 'Content Editor',
                'social_links' => null,
                'is_active' => true,
            ],
            [
                'name' => 'ผู้เขียนร่าง',
                'slug' => 'draft-author',
                'bio' => 'author ทดสอบ is_active = false',
                'avatar' => null,
                'job_title' => null,
                'social_links' => null,
                'is_active' => false,
            ],
        ];

        $out = [];
        foreach ($rows as $row) {
            $out[$row['slug']] = Author::query()->updateOrCreate(
                ['slug' => $row['slug']],
                $row
            );
        }

        return $out;
    }

    /**
     * @param  array<string, Author>  $authors
     * @return array<string, Post>
     */
    private function seedPosts(array $authors): array
    {
        $body1 = <<<'HTML'
<p>กำแพงกันดินที่เอนหรือร้าวเกือบทั้งหมดพลาดที่สามจุดเดียวกัน คือฐานรากรับโมเมนต์ไม่พอ เหล็กเสริมด้านรับแรงดึงน้อยกว่าแบบ และไม่มีทางระบายน้ำหลังกำแพง</p>
<p>บทความนี้อธิบายวิธีตรวจใบเสนอราคาและจุดที่ควรขอเอกสารยืนยันก่อนเริ่มงาน เพื่อไม่ให้ต้นทุนถูกตัดในจุดที่กระทบความปลอดภัย</p>
HTML;

        $body2 = <<<'HTML'
<p>เข็มเจาะกับไมโครไพล์ใช้คนละเงื่อนไขหน้างาน การเลือกผิดทำให้ทั้งราคาและระยะเวลาเพี้ยน</p>
<p>สรุปสั้น ๆ: ถ้าเครื่องจักรใหญ่เข้าได้และต้องการกำลังรับน้ำหนักสูง ใช้เข็มเจาะ หากพื้นที่แคบหรือเป็นงานเสริมฐานรากเดิม ให้พิจารณาไมโครไพล์</p>
HTML;

        $rows = [
            [
                'author' => 'theeraphong',
                'title' => '3 จุดที่ทำให้กำแพงกันดินพังก่อนอายุงาน',
                'slug' => '3-causes-retaining-wall-failure',
                'excerpt' => 'ฐานราก เหล็กเสริม และการระบายน้ำหลังกำแพง — จุดที่ใบเสนอราคาถูกมักตัดออก',
                'body' => $body1,
                'image_16x9' => 'https://images.unsplash.com/photo-1531834685032-c34bf0d84c77?w=1200&h=675&fit=crop',
                'image_4x3' => 'https://images.unsplash.com/photo-1531834685032-c34bf0d84c77?w=1200&h=900&fit=crop',
                'image_1x1' => 'https://images.unsplash.com/photo-1531834685032-c34bf0d84c77?w=1200&h=1200&fit=crop',
                'published_at' => now()->subDays(20),
                'meta_title' => '3 จุดที่ทำให้กำแพงกันดินพังก่อนอายุงาน',
                'meta_description' => 'ตรวจใบเสนอราคาก่อนรับเหมากำแพงกันดิน อย่าให้ตัดฐานราก เหล็ก หรือระบบระบายน้ำ',
                'word_count' => str_word_count(strip_tags($body1)),
                'is_published' => true,
            ],
            [
                'author' => 'supawadee',
                'title' => 'เข็มเจาะหรือไมโครไพล์ เลือกแบบไหนให้เหมาะหน้างาน',
                'slug' => 'bored-pile-vs-micropile',
                'excerpt' => 'เปรียบเทียบเงื่อนไขทางเข้าหน้างาน กำลังรับน้ำหนัก และต้นทุนโดยรวม',
                'body' => $body2,
                'image_16x9' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1200&h=675&fit=crop',
                'image_4x3' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1200&h=900&fit=crop',
                'image_1x1' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1200&h=1200&fit=crop',
                'published_at' => now()->subDays(7),
                'meta_title' => 'เข็มเจาะหรือไมโครไพล์',
                'meta_description' => 'คู่มือเลือกชนิดเข็มสำหรับงานฐานรากและเสริมฐานรากเดิม',
                'word_count' => str_word_count(strip_tags($body2)),
                'is_published' => true,
            ],
            [
                'author' => 'theeraphong',
                'title' => 'บทความร่าง (ไม่เผยแพร่)',
                'slug' => 'draft-post',
                'excerpt' => 'โพสต์ทดสอบ is_published = false',
                'body' => '<p>เนื้อหาร่างสำหรับทดสอบ</p>',
                'image_16x9' => null,
                'image_4x3' => null,
                'image_1x1' => null,
                'published_at' => null,
                'meta_title' => null,
                'meta_description' => null,
                'word_count' => 3,
                'is_published' => false,
            ],
        ];

        $out = [];
        foreach ($rows as $row) {
            $authorSlug = $row['author'];
            unset($row['author']);
            $row['author_id'] = $authors[$authorSlug]->id;
            $out[$row['slug']] = Post::query()->updateOrCreate(
                ['slug' => $row['slug']],
                $row
            );
        }

        return $out;
    }

    /**
     * @param  array<string, Service>  $services
     * @param  array<string, ServiceItem>  $items
     * @param  array<string, Location>  $locations
     * @return array<string, Portfolio>
     */
    private function seedPortfolios(array $services, array $items, array $locations): array
    {
        $rows = [
            [
                'service' => 'structure',
                'service_item' => 'retaining-wall',
                'location' => 'nonthaburi',
                'title' => 'กำแพงกันดินบ้านพักอาศัย บางใหญ่',
                'slug' => 'retaining-wall-bang-yai',
                'description' => 'กำแพงกันดิน คสล. สูง 2.8 ม. ความยาว 48 ม. พร้อมเข็มเจาะและระบบระบายน้ำหลังกำแพง',
                'cover_image' => 'https://images.unsplash.com/photo-1531834685032-c34bf0d84c77?w=1200&q=80&auto=format&fit=crop',
                'client_name' => 'คุณกิตติ',
                'completed_at' => '2025-11-18',
                'meta_title' => 'ผลงานกำแพงกันดิน บางใหญ่',
                'meta_description' => 'ผลงานกำแพงกันดิน คสล. บ้านพักอาศัย นนทบุรี',
                'is_published' => true,
                'images' => [
                    [
                        'image_url' => 'https://images.unsplash.com/photo-1531834685032-c34bf0d84c77?w=1200&q=80&auto=format&fit=crop',
                        'alt_text' => 'โครงเหล็กเสริมกำแพงระหว่างก่อสร้าง',
                        'width' => 1200,
                        'height' => 800,
                        'sort_order' => 1,
                    ],
                    [
                        'image_url' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1200&q=80&auto=format&fit=crop',
                        'alt_text' => 'งานฐานรากและเหล็กเสริมหน้างาน',
                        'width' => 1200,
                        'height' => 800,
                        'sort_order' => 2,
                    ],
                ],
            ],
            [
                'service' => 'piles-foundation',
                'service_item' => 'micropile',
                'location' => 'bangkok',
                'title' => 'เสริมฐานรากเดิมโรงงานบางขุนเทียน',
                'slug' => 'micropile-bang-khun-thian',
                'description' => 'ไมโครไพล์ในพื้นที่แคบใต้โรงงานเดิม ลดการทรุดตัวของพื้นชั้นล่าง',
                'cover_image' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1200&q=80&auto=format&fit=crop',
                'client_name' => null,
                'completed_at' => '2026-02-05',
                'meta_title' => 'ผลงานไมโครไพล์ กรุงเทพฯ',
                'meta_description' => 'งานเสริมฐานรากด้วยไมโครไพล์ในโรงงาน',
                'is_published' => true,
                'images' => [
                    [
                        'image_url' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1200&q=80&auto=format&fit=crop',
                        'alt_text' => 'งานเหล็กเสริมฐานรากหน้างาน',
                        'width' => 1200,
                        'height' => 800,
                        'sort_order' => 1,
                    ],
                ],
            ],
            [
                'service' => 'structure',
                'service_item' => 'concrete-pour',
                'location' => 'pathum-thani',
                'title' => 'ลานคอนกรีตและปรับพื้นที่ คลองหลวง',
                'slug' => 'concrete-yard-khlong-luang',
                'description' => 'ถมบดอัดและเทลานคอนกรีตหนา 15 ซม. พื้นที่ประมาณ 1,200 ตร.ม.',
                'cover_image' => 'https://images.unsplash.com/photo-1517089596392-fb9a9033e05b?w=1200&q=80&auto=format&fit=crop',
                'client_name' => 'บจก.ตัวอย่างโลจิสติกส์',
                'completed_at' => '2025-08-30',
                'meta_title' => 'ผลงานลานคอนกรีต ปทุมธานี',
                'meta_description' => 'งานปรับพื้นที่และลานคอนกรีต คลองหลวง',
                'is_published' => true,
                'images' => [
                    [
                        'image_url' => 'https://images.unsplash.com/photo-1517089596392-fb9a9033e05b?w=1200&q=80&auto=format&fit=crop',
                        'alt_text' => 'งานปรับพื้นที่และบดอัดดิน',
                        'width' => 1200,
                        'height' => 800,
                        'sort_order' => 1,
                    ],
                ],
            ],
            [
                'service' => 'structure',
                'service_item' => 'steel-plaster-fence',
                'location' => 'draft-location',
                'title' => 'ผลงานร่าง (ไม่เผยแพร่)',
                'slug' => 'draft-portfolio',
                'description' => 'portfolio ทดสอบ is_published = false',
                'cover_image' => null,
                'client_name' => null,
                'completed_at' => null,
                'meta_title' => null,
                'meta_description' => null,
                'is_published' => false,
                'images' => [],
            ],
        ];

        $out = [];
        foreach ($rows as $row) {
            $images = $row['images'];
            unset($row['images']);

            $row['service_id'] = $services[$row['service']]->id;
            unset($row['service']);

            $row['service_item_id'] = $row['service_item']
                ? $items[$row['service_item']]->id
                : null;
            unset($row['service_item']);

            $row['location_id'] = $locations[$row['location']]->id;
            unset($row['location']);

            $portfolio = Portfolio::query()->updateOrCreate(
                ['slug' => $row['slug']],
                $row
            );

            $portfolio->images()->delete();
            foreach ($images as $image) {
                $portfolio->images()->create($image);
            }

            $out[$portfolio->slug] = $portfolio;
        }

        return $out;
    }

    /**
     * @param  array<string, ServiceCategory>  $categories
     * @param  array<string, Service>  $services
     * @param  array<string, ServiceItem>  $items
     * @param  array<string, Location>  $locations
     * @param  array<string, Post>  $posts
     * @param  array<string, Portfolio>  $portfolios
     */
    private function seedFaqs(
        array $categories,
        array $services,
        array $items,
        array $locations,
        array $posts,
        array $portfolios,
    ): void {
        Faq::query()->delete();

        $faqs = [
            // FAQ งานโครงสร้าง / กำแพงกันดิน
            [$services['structure'], 'ราคาประเมินยึดจากอะไร', 'ยึดจากปริมาณงานจริง — ความสูงและความยาวกำแพง ชนิดฐานราก และปริมาณดินที่ต้องบดอัด ใบเสนอราคาแยกรายการวัสดุ ค่าแรง และงานทดสอบให้เห็นทุกบรรทัด', 1],
            [$services['structure'], 'ใช้เวลาทำงานนานเท่าไร', 'กำแพงกันดินความยาว 60 เมตร ใช้เวลาประมาณ 28–35 วันทำการ รวมเวลาบ่มคอนกรีตตามข้อกำหนด เราไม่ลดเวลาบ่มเพื่อเร่งส่งมอบ', 2],
            [$services['structure'], 'เก็บมัดจำอย่างไร แบ่งงวดกี่งวด', 'มัดจำ 25% เพื่อสั่งวัสดุและเข็ม งวดถัดไปจ่ายตามความคืบหน้าที่ตรวจรับแล้ว และงวดสุดท้าย 10% หลังส่งมอบเอกสารครบ ทุกงวดมีใบเสร็จและเอกสารตรวจรับ', 3],
            [$services['structure'], 'รับงานพื้นที่ไหน', 'กรุงเทพฯ นนทบุรี ปทุมธานี สมุทรปราการ สมุทรสาคร และนครปฐม โครงการนอกพื้นที่พิจารณาเป็นรายกรณีตามขนาดงาน', 4],
            [$services['structure'], 'ถ้ากำแพงมีปัญหาหลังส่งมอบ', 'แจ้งได้ตลอดอายุรับประกัน 2 ปี เราเข้าตรวจหน้างานภายใน 3 วันทำการ และแจ้งสาเหตุพร้อมแนวทางแก้ไขเป็นเอกสาร งานที่อยู่ในขอบเขตรับประกันไม่มีค่าใช้จ่าย', 5],

            [$categories['civil'], 'หมวดงานโยธารวมงานอะไรบ้าง', 'รวมสำรวจ เสาเข็มและฐานราก โครงสร้าง บริหารงานก่อสร้าง และสุขาภิบาล โดยทีมช่างทำเองทั้งกระบวนการ', 1],
            [$items['steel-plaster-fence'], 'รั้วเหล็กและก่อฉาบราคาประมาณเท่าไร', 'เริ่มต้นประมาณ 1,000–3,500 บาท/เมตร ขึ้นกับแบบ ความสูง ชนิดวัสดุ และฐานราก', 1],
            [$items['retaining-wall'], 'กำแพงกันดินสูงได้กี่เมตร', 'รับงานกำแพงกันดิน คสล. สูงถึงประมาณ 4.0 เมตร เลือกรูปแบบจากความสูงดินและระยะร่นที่ดิน', 1],
            [$items['retaining-wall'], 'ไม่ลงเข็มได้ไหม ถ้าดินแข็ง', 'ตัดสินจากผลสำรวจชั้นดิน ไม่ใช่จากผิวดินที่เห็น ถ้าแบบกำหนดให้ลงเข็ม เราไม่รับงานที่ขอตัดเข็มออก', 2],
            [$items['retaining-wall'], 'กำแพงเดิมเอนแล้ว ซ่อมได้หรือต้องรื้อ', 'ขึ้นกับว่าฐานรากยังอยู่ในสภาพรับแรงได้หรือไม่ เราเข้าตรวจและแจ้งเป็นเอกสารสองทางเลือกพร้อมราคา', 3],
            [$items['retaining-wall'], 'ต้องขออนุญาตก่อสร้างหรือไม่', 'กำแพงกันดินที่ความสูงเกินเกณฑ์ของท้องถิ่นต้องยื่นแบบขออนุญาต เราเตรียมแบบและรายการคำนวณลงนามโดยวิศวกรให้ใช้ยื่นได้', 4],
            [$locations['nonthaburi'], 'มีสำนักงานที่นนทบุรีไหม', 'ใช่ สำนักงานอยู่ถ.กาญจนาภิเษก บางใหญ่ นนทบุรี 11140', 1],
            [$posts['3-causes-retaining-wall-failure'], 'ต้องมีวิศวกรลงนามแบบไหม', 'ใช่ แบบก่อสร้างต้องลงนามโดยวิศวกรก่อนเริ่มงาน และส่งมอบแบบก่อสร้างจริงพร้อมหนังสือรับประกัน', 1],
            [$portfolios['retaining-wall-bang-yai'], 'งานนี้ใช้เวลากี่วัน', 'ประมาณ 30 วันทำการ รวมบ่มคอนกรีตและความยาวกำแพง 48 เมตร', 1],

            // FAQ ที่ปิดไว้
            [$services['draft-service'], 'คำถามร่าง', 'คำตอบร่าง — is_active = false', 1, false],
        ];

        foreach ($faqs as $faq) {
            [$faqable, $question, $answer, $sortOrder] = $faq;
            $isActive = $faq[4] ?? true;

            $faqable->faqs()->create([
                'question' => $question,
                'answer' => $answer,
                'sort_order' => $sortOrder,
                'is_active' => $isActive,
            ]);
        }
    }
}
