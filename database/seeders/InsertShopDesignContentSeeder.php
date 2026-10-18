<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

/**
 * สร้าง/อัปเดตหน้า /services/architecture/shop-design
 * รูป: CDN assets/service-items/shop-design/
 */
class InsertShopDesignContentSeeder extends Seeder
{
    public function run(): void
    {
        $category = ServiceCategory::query()->where('slug', 'architecture')->first();

        if ($category && ! $category->is_active) {
            $category->update(['is_active' => true]);
        }

        if (! $category) {
            $category = ServiceCategory::query()->create([
                'name' => 'งานสถาปัตยกรรม',
                'slug' => 'architecture',
                'description' => 'งานสถาปัตยกรรม ออกแบบตกแต่ง และงานติดตั้งที่เกี่ยวข้อง',
                'cover_image' => null,
                'sort_order' => 4,
                'is_active' => true,
            ]);
            $this->command?->info('สร้างหมวด service_categories slug=architecture');
        }

        $brand = (string) config('company.brand_name');
        $phone = (string) config('company.phone_format');
        $lineId = (string) config('company.line_id');
        $areas = implode(' ', array_slice(config('company.area_served', []), 0, 6));
        $imageBase = rtrim((string) config('company.images_cdn'), '/').'/assets/service-items/shop-design/';
        $coverImage = $imageBase.'shop-design-hero.webp';
        $publishedAt = now();

        $aluminiumUrl = $this->publishedServiceUrl('aluminum-works')
            ?: '/services/architecture/aluminum-works';
        $electricalUrl = $this->publishedServiceUrl('electrical')
            ?: '/services/mechanical-and-electrical-work/electrical';

        $service = Service::query()->updateOrCreate(
            ['slug' => 'shop-design'],
            [
                'category_id' => $category->id,
                'name' => 'รับออกแบบร้าน',
                'headline' => 'รับออกแบบร้าน ตกแต่งร้านค้า คาเฟ่ โชว์รูม — จากแบบถึงติดตั้งจบในทีมเดียว',
                'excerpt' => 'รับออกแบบร้าน · ตกแต่งร้านค้า · Fit-out ครบวงจร',
                'description' => "{$brand} รับออกแบบร้านและตกแต่งร้านค้าครบวงจร ทั้งร้านค้าปลีก คาเฟ่ ร้านอาหาร คลินิก โชว์รูม และบูธในห้าง ตั้งแต่บรีฟงาน วัดพื้นที่ แบบ 2D/3D ใบเสนอราคาแยกรายการ ไปจนถึงงานก่อสร้าง Fit-out งานอลูมิเนียม-กระจก และงานระบบไฟฟ้าให้เปิดร้านได้จริง ใน{$areas} สำรวจและประเมินงบฟรี",
                'cover_image' => $coverImage,
                'service_type' => 'ออกแบบและตกแต่งร้านค้า',
                'meta_title' => "รับออกแบบร้าน ตกแต่งร้านค้า คาเฟ่ โชว์รูม | {$brand}",
                'meta_description' => "รับออกแบบร้าน ตกแต่งร้านค้า คาเฟ่ โชว์รูม {$areas} จากแบบ 2D/3D ถึง Fit-out งานระบบครบ สำรวจประเมินงบฟรี โทร {$phone}",
                'sort_order' => 2,
                'is_published' => true,
                'published_at' => $publishedAt,
                'content' => $this->contentHtml($brand, $phone, $lineId, $imageBase, $aluminiumUrl, $electricalUrl),
            ],
        );

        $this->seedPrices($service);
        $this->seedFaqs($service, $brand, $phone, $areas);

        $this->command?->info("อัปเดต shop-design id={$service->id} — cover + content + ราคา + FAQ");
        $this->command?->info('URL: '.$service->url());
    }

    private function seedPrices(Service $service): void
    {
        $service->prices()->delete();

        $service->prices()->createMany([
            [
                'price_type' => 'unit',
                'label' => 'ค่าออกแบบร้าน (แบบผัง + 3D concept)',
                'price_min' => 800,
                'price_max' => 2000,
                'price_unit' => 'บาท/ตร.ม.',
                'currency' => 'THB',
                'note' => 'ขึ้นกับขนาดพื้นที่ ความละเอียดแบบ และจำนวนรอบแก้แบบ — ยืนยันหลังบรีฟ',
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'price_type' => 'unit',
                'label' => 'Fit-out ร้านค้าปลีก / ไลฟ์สไตล์',
                'price_min' => 8000,
                'price_max' => 25000,
                'price_unit' => 'บาท/ตร.ม.',
                'currency' => 'THB',
                'note' => 'งานพื้น ผนัง ฝ้า ไฟ ชั้นโชว์และเคาน์เตอร์พื้นฐาน — ไม่รวมงานครัวหนัก',
                'is_visible' => true,
                'sort_order' => 2,
            ],
            [
                'price_type' => 'unit',
                'label' => 'Fit-out คาเฟ่ / ร้านเครื่องดื่ม',
                'price_min' => 18000,
                'price_max' => 35000,
                'price_unit' => 'บาท/ตร.ม.',
                'currency' => 'THB',
                'note' => 'รวมงานเคาน์เตอร์บาร์ งานน้ำ และระบบไฟฟ้ากำลังบางส่วน — ครัวเปียกยืนยันแยก',
                'is_visible' => true,
                'sort_order' => 3,
            ],
            [
                'price_type' => 'unit',
                'label' => 'Fit-out ร้านอาหารมีครัว',
                'price_min' => 25000,
                'price_max' => 45000,
                'price_unit' => 'บาท/ตร.ม.',
                'currency' => 'THB',
                'note' => 'รวมครัว ดูดควัน และงานระบบที่เกี่ยวข้องตามขอบเขตในสัญญา',
                'is_visible' => true,
                'sort_order' => 4,
            ],
            [
                'price_type' => 'package',
                'label' => 'บูธ / Kiosk ในห้าง (ประมาณการ)',
                'price_min' => 80000,
                'price_max' => 350000,
                'price_unit' => 'บาท/บูธ',
                'currency' => 'THB',
                'note' => 'ขึ้นกับขนาดบูธ วัสดุ CI และข้อกำหนดห้าง — สำรวจก่อนตีราคา',
                'is_visible' => true,
                'sort_order' => 5,
            ],
        ]);
    }

    private function seedFaqs(Service $service, string $brand, string $phone, string $areas): void
    {
        Faq::query()
            ->where('faqable_type', $service->getMorphClass())
            ->where('faqable_id', $service->id)
            ->delete();

        $faqs = [
            [
                'question' => 'รับออกแบบร้านราคาเท่าไหร่?',
                'answer' => "ค่าออกแบบร้านโดยทั่วไปอยู่ที่ประมาณ 800–2,000 บาทต่อตารางเมตร ขึ้นกับขนาดพื้นที่ ความละเอียดของแบบ 2D/3D และจำนวนรอบแก้แบบ ส่วนงาน Fit-out ติดตั้งจริงเริ่มราว 8,000–25,000 บาทต่อตารางเมตรสำหรับร้านค้าปลีก และสูงขึ้นถ้าเป็นคาเฟ่หรือร้านอาหารที่มีงานครัว {$brand} สำรวจและประเมินงบฟรี โทร {$phone}",
            ],
            [
                'question' => 'ออกแบบร้านใช้เวลากี่วัน?',
                'answer' => 'หลังสำรวจหน้างาน แบบผังใช้งานและ mood board ใช้เวลาประมาณ 5–10 วันทำการ แบบ 3D และรายการวัสดุอีกประมาณ 7–14 วันทำการ ขึ้นกับขนาดร้านและความเร็วในการคอนเฟิร์มของเจ้าของร้าน งานก่อสร้าง Fit-out ร้านขนาดเล็กถึงกลางมักใช้เวลา 3–6 สัปดาห์หลังเซ็นสัญญาและวัสดุพร้อม',
            ],
            [
                'question' => 'รับออกแบบอย่างเดียว หรือทำถึงติดตั้งด้วย?',
                'answer' => "{$brand} ให้เลือกได้ทั้งแบบออกแบบอย่างเดียว และแบบออกแบบพร้อม Fit-out ติดตั้งจบในทีมเดียว รวมงานพื้น ผนัง ฝ้า บิลท์อิน งานอลูมิเนียม-กระจก และงานระบบไฟฟ้า เพื่อลดการประสานผู้รับเหมาหลายเจ้าและคุมงบได้ชัดเจนกว่า",
            ],
            [
                'question' => 'ออกแบบร้านในห้างต้องรู้อะไรบ้าง?',
                'answer' => 'ร้านในห้างต้องทำตามคู่มือผู้เช่า (Tenant Manual) ของห้าง เช่น เวลาทำงาน เสียง ฝุ่น จุดรับไฟ-น้ำ ระบบดับเพลิง และมาตรฐานวัสดุหน้าร้าน ควรขอไฟล์ข้อกำหนดจากห้างก่อนออกแบบ เพื่อไม่ให้แก้แบบและแก้หน้างานภายหลัง ใบเสนอราคาควรเผื่อ contingency อีกประมาณ 10–15 เปอร์เซ็นต์สำหรับงานที่ห้างตรวจเพิ่ม',
            ],
            [
                'question' => 'ต้องเตรียมอะไรก่อนเริ่มออกแบบ?',
                'answer' => 'เตรียมผังพื้นที่หรือขนาดโดยประมาณ งบประมาณคร่าว ๆ สไตล์ที่ชอบ ตัวอย่างแบรนด์อ้างอิง รายการสินค้า/เมนูหลัก จุดขายที่อยากเน้น และถ้าเป็นร้านในห้างให้แนบ Tenant Manual ด้วย ส่งรูปหน้างานทางไลน์ได้เลย ทีมงานตอบช่วงงบและแนวทางภายใน 1 วันทำการ',
            ],
            [
                'question' => 'รับงานพื้นที่ไหนบ้าง?',
                'answer' => "{$brand} ให้บริการออกแบบและตกแต่งร้านใน{$areas} สำนักงานอยู่ธัญบุรี ปทุมธานี เข้าสำรวจโซนรังสิต กรุงเทพฯ และปริมณฑลได้รวดเร็ว",
            ],
        ];

        foreach ($faqs as $index => $faq) {
            $service->faqs()->create([
                'question' => $faq['question'],
                'answer' => $faq['answer'],
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);
        }
    }

    private function contentHtml(
        string $brand,
        string $phone,
        string $lineId,
        string $imageBase,
        string $aluminiumUrl,
        string $electricalUrl,
    ): string {
        $hero = $imageBase.'shop-design-hero.webp';
        $i1 = $imageBase.'interior-01.webp';
        $i2 = $imageBase.'interior-02.webp';
        $i3 = $imageBase.'interior-03.webp';
        $i4 = $imageBase.'interior-04.webp';

        return <<<HTML
<p><em>โดย ทีมออกแบบและก่อสร้าง {$brand} • อัปเดตล่าสุด 17 ตุลาคม 2569</em></p>

<h2>รับออกแบบร้าน คืออะไร ครอบคลุมงานถึงไหน</h2>
<p><strong>{$brand} รับออกแบบร้านและตกแต่งร้านค้าให้เปิดใช้งานได้จริง</strong> ไม่ได้หยุดแค่ภาพสวยบนจอ แต่ต่อเนื่องถึงงาน Fit-out ติดตั้ง งานอลูมิเนียม-กระจก และงานระบบไฟฟ้าในทีมเดียว เพื่อให้เจ้าของร้านคุมงบ คุมเวลา และลดการประสานผู้รับเหมาหลายเจ้า</p>
<p>เหมาะกับร้านค้าปลีก คาเฟ่ ร้านเครื่องดื่ม ร้านอาหาร คลินิก ความงาม โชว์รูม สำนักงานหน้าร้าน และบูธในห้าง ทั้งพื้นที่เช่าใหม่และรีโนเวทร้านเดิม</p>

<figure>
<img src="{$hero}" alt="ภาพรวมงานออกแบบและตกแต่งร้านค้าโดย {$brand}" width="1200" height="800" loading="lazy" decoding="async">
</figure>

<h2>บริการออกแบบและตกแต่งร้านของ {$brand}</h2>
<ul>
<li><strong>บรีฟและวางคอนเซ็ปต์</strong> — วิเคราะห์แบรนด์ จุดขาย การไหลของลูกค้า และงบประมาณก่อนลงแบบ</li>
<li><strong>แบบผังใช้งาน 2D</strong> — จัดโซนหน้าร้าน เคาน์เตอร์ สต็อก ทางเดิน และจุดชำระเงินให้ใช้งานจริง</li>
<li><strong>ภาพ 3D / Mood board</strong> — ให้เห็นวัสดุ แสง สี และบรรยากาศก่อนตัดสินใจก่อสร้าง</li>
<li><strong>BOQ และใบเสนอราคาแยกรายการ</strong> — แยกงานพื้น ผนัง ฝ้า ไฟ เฟอร์นิเจอร์ และงานระบบ ไม่เหมารวมบรรทัดเดียว</li>
<li><strong>Fit-out ติดตั้งครบ</strong> — ก่อสร้าง บิลท์อิน งานกระจก และระบบไฟ ให้พร้อมเปิดร้าน</li>
</ul>

<div class="content-gallery content-gallery--2">
<figure>
<img src="{$i1}" alt="มุมภายในร้านหลังตกแต่ง — เคาน์เตอร์และโซนจัดแสดงสินค้า โดย {$brand}" width="960" height="720" loading="lazy" decoding="async">
</figure>
<figure>
<img src="{$i2}" alt="งานออกแบบร้านเน้นแสงและการจัดวางชั้นโชว์ให้เดินชอปสะดวก โดย {$brand}" width="960" height="720" loading="lazy" decoding="async">
</figure>
</div>

<h2>ประเภทร้านที่รับออกแบบ</h2>
<table>
<thead>
<tr><th>ประเภทร้าน</th><th>จุดโฟกัสหลัก</th><th>ช่วง Fit-out โดยประมาณ</th></tr>
</thead>
<tbody>
<tr><td>ร้านค้าปลีก / ไลฟ์สไตล์</td><td>หน้าร้าน ชั้นโชว์ ระบบไฟเน้นสินค้า</td><td>8,000–25,000 บาท/ตร.ม.</td></tr>
<tr><td>คาเฟ่ / ร้านเครื่องดื่ม</td><td>เคาน์เตอร์บาร์ ที่นั่ง งานน้ำและไฟกำลัง</td><td>18,000–35,000 บาท/ตร.ม.</td></tr>
<tr><td>ร้านอาหารมีครัว</td><td>ครัว ดูดควัน ระบายอากาศ และโซนลูกค้า</td><td>25,000–45,000 บาท/ตร.ม.</td></tr>
<tr><td>คลินิก / ความงาม</td><td>ความเป็นส่วนตัว สุขลักษณะ ทางไหลของผู้รับบริการ</td><td>ประเมินตามแบบและระบบ</td></tr>
<tr><td>โชว์รูม / สำนักงานหน้าร้าน</td><td>แบรนด์ไอเดนทิตี พื้นที่ประชุมและจัดแสดง</td><td>ประเมินตามวัสดุและขนาด</td></tr>
<tr><td>บูธ / Kiosk ในห้าง</td><td>CI แบรนด์ ข้อกำหนดห้าง และติดตั้งเร็ว</td><td>80,000–350,000 บาท/บูธ</td></tr>
</tbody>
</table>
<p><em>ราคาเป็นช่วงประมาณการสำหรับงานในกรุงเทพฯ และปริมณฑล ปี 2569 ราคาสุดท้ายยืนยันหลังสำรวจหน้างานและสรุปสเปกวัสดุ</em></p>

<figure>
<img src="{$i3}" alt="ตัวอย่างบรรยากาศภายในร้านที่ออกแบบให้รองรับการใช้งานจริง โดย {$brand}" width="1200" height="800" loading="lazy" decoding="async">
</figure>

<h2>ขั้นตอนทำงานกับ {$brand}</h2>
<table>
<thead>
<tr><th>ขั้นตอน</th><th>สิ่งที่ได้รับ</th><th>ระยะเวลาโดยประมาณ</th></tr>
</thead>
<tbody>
<tr><td>1. ส่งบรีฟ / รูปหน้างาน</td><td>ช่วงงบคร่าว ๆ และแนวทางคอนเซ็ปต์</td><td>ตอบกลับภายใน 1 วันทำการ</td></tr>
<tr><td>2. สำรวจวัดพื้นที่</td><td>ผังหน้างานจริง ข้อจำกัดโครงสร้างและระบบ</td><td>1 วัน (ประเมินฟรี)</td></tr>
<tr><td>3. แบบผัง + Mood board</td><td>ผังใช้งาน วัสดุหลัก ทิศทางดีไซน์</td><td>5–10 วันทำการ</td></tr>
<tr><td>4. แบบ 3D + BOQ</td><td>ภาพจำลอง รายการวัสดุ ใบเสนอราคาแยกรายการ</td><td>7–14 วันทำการ</td></tr>
<tr><td>5. เซ็นสัญญาและสั่งวัสดุ</td><td>กำหนดการติดตั้ง งวดงานชัดเจน</td><td>ตามลีดไทม์วัสดุ</td></tr>
<tr><td>6. Fit-out ติดตั้ง</td><td>งานก่อสร้าง บิลท์อิน กระจก ระบบไฟ</td><td>3–6 สัปดาห์ (ร้านทั่วไป)</td></tr>
<tr><td>7. ส่งมอบและปรับแต่ง</td><td>ตรวจงาน ปรับรายละเอียดก่อนเปิดร้าน</td><td>1–3 วัน</td></tr>
</tbody>
</table>

<h3>สิ่งที่เจ้าของร้านควรเตรียมก่อนเริ่ม</h3>
<ul>
<li>ขนาดพื้นที่หรือผังร้าน (ถ้ามี) และรูปหน้างานหลายมุม</li>
<li>งบประมาณคร่าว ๆ และวันเปิดร้านเป้าหมาย</li>
<li>ตัวอย่างสไตล์ / แบรนด์อ้างอิง และรายการสินค้าหรือเมนูหลัก</li>
<li>ถ้าเป็นร้านในห้าง — ไฟล์ Tenant Manual และข้อกำหนด CI ของห้าง</li>
<li>จุดที่ต้องคงไว้หรือรื้อ เช่น เคาน์เตอร์เดิม ห้องน้ำ ทางหนีไฟ</li>
</ul>

<figure>
<img src="{$i4}" alt="รายละเอียดงานตกแต่งภายในร้านหลัง Fit-out พร้อมเปิดใช้งาน โดย {$brand}" width="1200" height="800" loading="lazy" decoding="async">
</figure>

<h2>ปัจจัยที่ทำให้งบออกแบบร้านต่างกัน</h2>
<ol>
<li><strong>ขนาดและรูปทรงพื้นที่</strong> — พื้นที่แคบ เสาเยอะ หรือเพดานต่ำ ใช้แบบและงานโครงสร้างย่อยมากกว่า</li>
<li><strong>ระดับวัสดุและ CI แบรนด์</strong> — วัสดุพิเศษ ไฟเน้นสินค้า และงานกระจกหน้าร้านดันงบขึ้นชัด</li>
<li><strong>งานครัว / งานน้ำ / ไฟกำลัง</strong> — คาเฟ่และร้านอาหารมีต้นทุนระบบสูงกว่าร้านค้าทั่วไป</li>
<li><strong>ข้อกำหนดห้างหรืออาคาร</strong> — เวลาทำงานกลางคืน ค่าประกัน และมาตรฐานวัสดุเพิ่มต้นทุนแฝง</li>
<li><strong>ขอบเขตที่รวมในสัญญา</strong> — ออกแบบอย่างเดียวกับออกแบบพร้อมติดตั้งราคาต่างกันมาก ควรเทียบขอบเขตให้ตรงกัน</li>
</ol>

<h2>ทำไมต้องเลือก {$brand}</h2>
<ul>
<li><strong>ออกแบบแล้วต่อได้ถึงติดตั้ง</strong> — ไม่ทิ้งให้เจ้าของร้านหาผู้รับเหมาเองหลังได้แบบ</li>
<li><strong>ใบเสนอราคาแยกรายการ</strong> — เห็นงานก่อสร้าง เฟอร์นิเจอร์ และงานระบบแยกกัน คุมงบได้</li>
<li><strong>งานเกี่ยวเนื่องในทีมเดียว</strong> — ต่อได้กับ <a href="{$aluminiumUrl}">งานอลูมิเนียมและกระจก</a> และ <a href="{$electricalUrl}">งานระบบไฟฟ้า</a></li>
<li><strong>โฟกัสพื้นที่กรุงเทพฯ–ปริมณฑล</strong> — สำนักงานธัญบุรี เข้าสำรวจรังสิตและโซนใกล้เคียงได้เร็ว</li>
<li><strong>ไม่โทรรบกวน</strong> — ส่งรูปทางไลน์แล้วได้แนวทางงบ โดยไม่ต้องให้เบอร์ถ้ายังไม่พร้อม</li>
</ul>

<h2>ติดต่อขอประเมินออกแบบร้านฟรี</h2>
<p>ส่งรูปหน้างาน ขนาดพื้นที่คร่าว ๆ และสไตล์ที่อยากได้มาทางไลน์ ทีมงานตอบแนวทางงบและขั้นตอนภายใน 1 วันทำการ</p>
<ul>
<li><strong>โทร:</strong> {$phone}</li>
<li><strong>LINE:</strong> {$lineId}</li>
</ul>
<p>พื้นที่ให้บริการ: กรุงเทพฯ นนทบุรี ปทุมธานี สมุทรปราการ สมุทรสาคร นครปฐม · เวลาทำการ จันทร์–เสาร์ 08:00–18:00</p>
<p><strong>{$brand}</strong> — รับออกแบบร้าน ตกแต่งร้านค้า คาเฟ่ โชว์รูม และ Fit-out ครบวงจร จากแบบถึงเปิดร้าน</p>
HTML;
    }

    private function publishedServiceUrl(string $slug): ?string
    {
        $service = Service::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->with('category')
            ->first();

        if (! $service?->category) {
            return null;
        }

        return route('services.show', [$service->category->slug, $service->slug], absolute: false);
    }
}
