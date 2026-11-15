<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceItem;
use App\Support\Navigation;
use Illuminate\Database\Seeder;

/**
 * หมวดงานรถรับจ้าง + หน้ารับจ้างรถหกล้อ/รถกระบะ
 *
 * Canonical: /services/truck-hire/hired-truck
 */
class InsertTruckHireSeeder extends Seeder
{
    public function run(): void
    {
        $category = ServiceCategory::query()->updateOrCreate(
            ['slug' => 'truck-hire'],
            [
                'name' => 'งานรถรับจ้าง',
                'name_en' => 'Truck hire',
                'description' => 'รถกระบะและรถหกล้อรับจ้างขนดิน ทราย วัสดุก่อสร้าง และเศษจากไซต์งาน — คิดราคาเป็นเที่ยว',
                'description_en' => 'Pickup and 6-wheel truck hire for soil, sand, materials, and site debris — priced per trip',
                'cover_image' => rtrim((string) config('company.images_cdn'), '/').'/assets/service-items/construction-wasted-hauling/construction-wasted-hauling-hero.webp',
                'sort_order' => 5,
                'is_active' => true,
            ],
        );

        $brand = (string) config('company.brand_name');
        $phone = (string) config('company.phone_format');
        $lineId = (string) config('company.line_id');
        $lineUrl = (string) config('company.line_url');
        $areas = implode(' ', array_slice(config('company.area_served', []), 0, 4));
        $imageBase = rtrim((string) config('company.images_cdn'), '/').'/assets/service-items/construction-wasted-hauling/';
        $coverImage = $imageBase.'construction-wasted-hauling-hero.webp';

        $wasteUrl = $this->publishedItemUrl('construction-waste-hauling')
            ?: '/services/civil/earthwork/construction-waste-hauling';
        $landFillingUrl = $this->publishedItemUrl('land-filling')
            ?: '/services/civil/earthwork/land-filling';
        $landClearingUrl = $this->publishedItemUrl('land-clearing')
            ?: '/services/civil/earthwork/land-clearing';

        $service = Service::query()->updateOrCreate(
            ['slug' => 'hired-truck'],
            [
                'category_id' => $category->id,
                'name' => 'รับจ้างรถหกล้อ',
                'name_en' => '6-wheel truck hire',
                'headline' => 'รถรับจ้างหกล้อ–กระบะ ปทุมธานี–กรุงเทพฯ คิดราคาเป็นเที่ยว',
                'headline_en' => '6-wheel and pickup truck hire in Pathum Thani–Bangkok — priced per trip',
                'excerpt' => 'รถกระบะ · รถหกล้อ 3 คิว / 7 คิว · พร้อมแรงงาน',
                'excerpt_en' => 'Pickup · 3 / 7 cu.m. 6-wheel · with labour option',
                'description' => "{$brand} รับจ้างรถกระบะและรถหกล้อขนดิน ทราย หิน วัสดุก่อสร้าง และเศษจากไซต์ ใน{$areas} คิดราคาเป็นเที่ยวตามขนาดรถและแรงงาน ใบเสนอราคาแยกค่าเที่ยวชัดเจน ราคาเริ่มต้นอาจปรับตามค่าน้ำมัน",
                'description_en' => "{$brand} hires pickup and 6-wheel trucks for soil, sand, gravel, materials, and site debris in {$areas}. Priced per trip by truck size and labour. Starting rates may change with fuel prices.",
                'meta_title' => "รถรับจ้างหกล้อ รถกระบะ คิดราคาเที่ยว | {$brand}",
                'meta_title_en' => "6-wheel & pickup truck hire per trip | {$brand}",
                'meta_description' => "รถรับจ้างหกล้อ–กระบะขนดิน ทราย วัสดุ และเศษไซต์ ปทุมธานี–กรุงเทพฯ คิดราคาเป็นเที่ยว สำรวจฟรี โทร {$phone}",
                'meta_description_en' => "Hire 6-wheel or pickup trucks for soil, sand, materials, and site debris in Pathum Thani–Bangkok. Per-trip rates. Free estimate. Call {$phone}",
                'cover_image' => $coverImage,
                'service_type' => 'รถรับจ้าง',
                'service_type_en' => 'TruckHire',
                'sort_order' => 1,
                'is_published' => true,
                'published_at' => now()->subDay(),
                'content' => $this->contentHtml(
                    $brand,
                    $phone,
                    $lineId,
                    $lineUrl,
                    $wasteUrl,
                    $landFillingUrl,
                    $landClearingUrl,
                    $imageBase,
                ),
            ],
        );

        $this->seedPrices($service);
        $this->syncFaqs($service, $brand, $phone, $areas);

        Navigation::forgetCache();

        $this->command?->info("หมวด truck-hire id={$category->id}");
        $this->command?->info("บริการ hired-truck id={$service->id}");
        $this->command?->info('URL: '.$service->url());
    }

    private function seedPrices(Service $service): void
    {
        $service->prices()->delete();

        $fuelNote = 'ราคาเริ่มต้น — ปรับขึ้นลงตามราคาค่าน้ำมัน';

        $service->prices()->createMany([
            [
                'price_type' => 'unit',
                'label' => 'รถหกล้อ 3 คิว',
                'price_min' => 800,
                'price_max' => null,
                'price_unit' => 'บาท/เที่ยว',
                'currency' => 'THB',
                'note' => $fuelNote,
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'price_type' => 'unit',
                'label' => 'รถหกล้อ 3 คิว พร้อมแรงงาน',
                'price_min' => 1400,
                'price_max' => null,
                'price_unit' => 'บาท/เที่ยว',
                'currency' => 'THB',
                'note' => $fuelNote,
                'is_visible' => true,
                'sort_order' => 2,
            ],
            [
                'price_type' => 'unit',
                'label' => 'รถหกล้อ 7 คิว',
                'price_min' => 1400,
                'price_max' => null,
                'price_unit' => 'บาท/เที่ยว',
                'currency' => 'THB',
                'note' => $fuelNote,
                'is_visible' => true,
                'sort_order' => 3,
            ],
            [
                'price_type' => 'unit',
                'label' => 'รถหกล้อ 7 คิว พร้อมแรงงาน',
                'price_min' => 2000,
                'price_max' => null,
                'price_unit' => 'บาท/เที่ยว',
                'currency' => 'THB',
                'note' => $fuelNote,
                'is_visible' => true,
                'sort_order' => 4,
            ],
            [
                'price_type' => 'unit',
                'label' => 'รถหกล้อ 3 คิว ไปต่างจังหวัด',
                'price_min' => 32,
                'price_max' => null,
                'price_unit' => 'บาท/กม.',
                'currency' => 'THB',
                'note' => $fuelNote,
                'is_visible' => true,
                'sort_order' => 5,
            ],
            [
                'price_type' => 'unit',
                'label' => 'รถหกล้อ 7 คิว ไปต่างจังหวัด',
                'price_min' => 35,
                'price_max' => null,
                'price_unit' => 'บาท/กม.',
                'currency' => 'THB',
                'note' => $fuelNote,
                'is_visible' => true,
                'sort_order' => 6,
            ],
        ]);
    }

    private function syncFaqs(Service $service, string $brand, string $phone, string $areas): void
    {
        Faq::query()
            ->where('faqable_type', 'service')
            ->where('faqable_id', $service->id)
            ->delete();

        $faqs = [
            [
                'question' => 'รถรับจ้างหกล้อราคาเท่าไหร่ต่อเที่ยว',
                'answer' => 'รถหกล้อ 3 คิวเริ่มต้น 800 บาทต่อเที่ยว หรือ 1,400 บาทต่อเที่ยวถ้าพร้อมแรงงาน รถหกล้อ 7 คิวเริ่มต้น 1,400 บาทต่อเที่ยว หรือ 2,000 บาทต่อเที่ยวถ้าพร้อมแรงงาน ไปต่างจังหวัดคิดกิโลเมตรละ 32 บาท (รถ 3 คิว) และ 35 บาท (รถ 7 คิว) ราคาปรับขึ้นลงตามค่าน้ำมัน โทร '.$phone.' เพื่อยืนยันราคาวันจ้าง',
            ],
            [
                'question' => 'จ้างรถกระบะหรือรถหกล้อ ขนอะไรได้บ้าง',
                'answer' => 'ขนดิน ทราย หิน ปูน วัสดุก่อสร้างทั่วไป และเศษจากไซต์ที่จุดทิ้งรับได้ ถ้าเป็นงานขนขยะก่อสร้างเป็นหลัก แนะนำหน้าขนขยะก่อสร้างที่แยกค่าบ่อทิ้งชัด วัสดุอันตรายหรือกระเบื้องใยหินต้องแจ้งก่อนเสมอ',
            ],
            [
                'question' => 'ซอยแคบ รถหกล้อเข้าไม่ได้ จ้างได้ไหม',
                'answer' => 'ได้ โดยใช้รถกระบะหรือรถเล็กหลายเที่ยว หรือขนออกปากซอยก่อนค่อยเทขึ้นรถใหญ่ จำนวนเที่ยวและราคาต่อเที่ยวจึงสูงกว่างานที่รถใหญ่เข้าถึง ส่งรูปปากซอยและจุดกลับรถมาตอนประเมิน',
            ],
            [
                'question' => 'จ้างแค่รถ โดยไม่จ้างแรงงานยก ได้ไหม',
                'answer' => 'ได้ เลือกรถอย่างเดียวหรือพร้อมแรงงานได้ในใบเสนอราคา ถ้าวัสดุหนักหรือกองสูง การมีแรงงานช่วยลดเวลาจอดรถและจำนวนเที่ยว',
            ],
            [
                'question' => 'รับจ้างรถหกล้อพื้นที่ไหนบ้าง',
                'answer' => "{$brand} รับงานใน{$areas} และจังหวัดใกล้เคียง ประเมินจากรูปทาง LINE ไม่มีค่าใช้จ่ายในพื้นที่ให้บริการ นัดหมายที่โทร {$phone}",
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
        string $lineUrl,
        string $wasteUrl,
        string $landFillingUrl,
        string $landClearingUrl,
        string $imageBase,
    ): string {
        $workPhotos = $this->workPhotosHtml($brand, $imageBase);

        return <<<HTML
<p><em>โดย ทีมงาน {$brand} • อัปเดตล่าสุด 14 พฤศจิกายน 2569</em></p>

<h2>รถรับจ้างหกล้อคืออะไร เหมาะกับงานแบบไหน</h2>
<p>รถรับจ้างหกล้อและรถกระบะคือบริการให้รถพร้อมคนขับเพื่อขนดิน ทราย หิน วัสดุก่อสร้าง หรือเศษจากไซต์ คิดราคาเป็นเที่ยวตามขนาดกระบะและว่ามีแรงงานช่วยยกหรือไม่ เหมาะกับไซต์ที่ต้องการเคลียร์ทางทำงาน เติมวัสดุ หรือขนของระหว่างจุดในพื้นที่เดียวกัน</p>
<p>ถ้าโฟกัสขนเศษคอนกรีต อิฐ ไม้ ไปจุดทิ้งที่รับเศษก่อสร้าง ดูหน้า<a href="{$wasteUrl}">รับขนขยะก่อสร้าง</a> ที่แยกจำนวนเที่ยวและค่าบ่อทิ้งชัด ส่วนงานถมดินหรือเคลียร์พื้นที่อยู่ที่<a href="{$landFillingUrl}">รับเหมาถมที่</a> และ<a href="{$landClearingUrl}">รับเคลียร์ริ่งพื้นที่</a></p>

<h2>ประเภทรถที่รับจ้าง</h2>
<ul>
<li><strong>รถหกล้อ 3 คิว</strong> — ซอยค่อนข้างแคบ ปริมาณต่อเที่ยวไม่มาก</li>
<li><strong>รถหกล้อ 7 คิว</strong> — ปริมาณต่อเที่ยวสูงกว่า เหมาะกับงานต่อเนื่อง</li>
<li><strong>รถกระบะ / รถเล็ก</strong> — เมื่อรถหกล้อเข้าไซต์ไม่ได้ ใช้หลายเที่ยวแทน</li>
<li><strong>ตัวเลือกพร้อมแรงงาน</strong> — มีคนช่วยยกวัสดุหรือเศษขึ้นรถ</li>
</ul>

{$workPhotos}

<h2>ตารางราคารถรับจ้าง (ราคาเริ่มต้น)</h2>
<p>ราคารถหกล้อของ {$brand} ตามความจุกระบะและแรงงาน ราคาเริ่มต้นอาจปรับขึ้นลงตามราคาค่าน้ำมัน</p>
<table>
<thead>
<tr><th>รายการ</th><th>ราคาเริ่มต้น</th><th>หน่วย</th><th>หมายเหตุ</th></tr>
</thead>
<tbody>
<tr><td>รถหกล้อ 3 คิว</td><td>800</td><td>บาท/เที่ยว</td><td>ราคาเริ่มต้น</td></tr>
<tr><td>รถหกล้อ 3 คิว พร้อมแรงงาน</td><td>1,400</td><td>บาท/เที่ยว</td><td>ราคาเริ่มต้น</td></tr>
<tr><td>รถหกล้อ 7 คิว</td><td>1,400</td><td>บาท/เที่ยว</td><td>ราคาเริ่มต้น</td></tr>
<tr><td>รถหกล้อ 7 คิว พร้อมแรงงาน</td><td>2,000</td><td>บาท/เที่ยว</td><td>ราคาเริ่มต้น</td></tr>
<tr><td>รถหกล้อ 3 คิว ไปต่างจังหวัด</td><td>32</td><td>บาท/กม.</td><td>ราคาเริ่มต้น</td></tr>
<tr><td>รถหกล้อ 7 คิว ไปต่างจังหวัด</td><td>35</td><td>บาท/กม.</td><td>ราคาเริ่มต้น</td></tr>
</tbody>
</table>
<p><em>ราคาปรับขึ้นลงตามราคาค่าน้ำมัน — ยืนยันราคาก่อนวันเข้างานทุกครั้ง</em></p>

<h3>ปัจจัยที่ทำให้จำนวนเที่ยวและราคาเปลี่ยน</h3>
<ol>
<li><strong>ราคาค่าน้ำมัน</strong> — ราคาเริ่มต้นปรับขึ้นลงตามต้นทุนเชื้อเพลิง</li>
<li><strong>ความจุกระบะและความหนาแน่นของของ</strong> — ของหนักกินคิวเร็วกว่าของเบา</li>
<li><strong>แรงงานยกขึ้นรถ</strong> — เลือกรถอย่างเดียวหรือพร้อมแรงงาน</li>
<li><strong>ระยะทางไปต่างจังหวัด</strong> — คิดเป็นบาทต่อกิโลเมตรตามขนาดรถ</li>
<li><strong>ทางเข้าไซต์</strong> — ซอยแคบอาจต้องใช้รถเล็กหรือขนหลายเที่ยว</li>
</ol>

<h2>ขั้นตอนจ้างรถ</h2>
<ol>
<li><strong>ส่งรูปของที่จะขนและพิกัด</strong> — ทาง <a href="{$lineUrl}">LINE {$lineId}</a> เพื่อประเมินขนาดรถและจำนวนเที่ยวคร่าว ๆ</li>
<li><strong>ยืนยันช่วงราคาและวันเข้างาน</strong> — ระบุรวม/ไม่รวมแรงงาน และจุดจอดรถ</li>
<li><strong>เข้าขนตามนัด</strong> — คนขับถึงไซต์ ขนตามที่ตกลง กวาดเศษหกบนทางเข้าถ้าเป็นส่วนของงาน</li>
<li><strong>สรุปจำนวนเที่ยวจริง</strong> — แจ้งยอดก่อนปิดงาน</li>
</ol>

<h2>ทำไมต้องเลือก {$brand}</h2>
<ul>
<li><strong>คิดราคาเป็นเที่ยวชัด</strong> — ไม่เหมาก้อนเดียวแล้วบวกทีหลังโดยไม่บอกเหตุผล</li>
<li><strong>ทีมในปทุมธานี</strong> — นัดรถโซนรังสิต ธัญบุรี ลำลูกกา และกรุงเทพฯ ปริมณฑลได้เร็ว</li>
<li><strong>ต่องานเตรียมพื้นที่ในทีมเดียว</strong> — <a href="{$landClearingUrl}">เคลียร์ริ่ง</a> <a href="{$landFillingUrl}">ถมดิน</a> และ<a href="{$wasteUrl}">ขนขยะก่อสร้าง</a> ไม่ต้องหาคนละเจ้า</li>
</ul>

<h2>ขอใบเสนอราคารถรับจ้าง</h2>
<p>ส่งรูปของที่จะขน พิกัดไซต์ และบอกชนิดวัสดุหลักมาทาง <a href="{$lineUrl}">LINE {$lineId}</a> ทีมงาน {$brand} จะแจ้งช่วงราคาและขนาดรถที่เหมาะ โทร {$phone}</p>
HTML;
    }

    private function workPhotosHtml(string $brand, string $imageBase): string
    {
        return $this->photoGroup('ภาพรถหกล้อหน้างาน', 'content-gallery--3', $imageBase, [
            ['136696_0.webp', "รถหกล้อรับจ้างขนวัสดุออกจากไซต์งาน — {$brand}"],
            ['74397_0.webp', "ทีมงานยกของขึ้นรถหกล้อหน้างาน — {$brand}"],
            ['74398_0.webp', "รถหกล้อบรรทุกเต็มคันหลังขนเสร็จ — {$brand}"],
            ['74400_0.webp', "ขนเศษวัสดุจากงานก่อสร้างด้วยรถหกล้อ — {$brand}"],
            ['136753_0.webp', "กองวัสดุรอขนด้วยรถรับจ้าง — {$brand}"],
            ['S__44531717_0.webp', "หน้างานหลังขนด้วยรถหกล้อแล้ว — {$brand}"],
        ]);
    }

    /**
     * @param  array<int, array{0: string, 1: string}>  $images
     */
    private function photoGroup(string $title, string $gridClass, string $imageBase, array $images): string
    {
        $figures = '';

        foreach ($images as [$file, $alt]) {
            $src = $imageBase.$file;
            $figures .= <<<HTML
<figure>
<img src="{$src}" alt="{$alt}" width="960" height="720" loading="lazy" decoding="async">
</figure>

HTML;
        }

        return <<<HTML
<h3>{$title}</h3>
<div class="content-gallery {$gridClass}">
{$figures}</div>
HTML;
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
}
