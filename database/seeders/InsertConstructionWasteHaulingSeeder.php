<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Database\Seeder;

/**
 * สร้าง/อัปเดต service_items slug=construction-waste-hauling ภายใต้ civil/earthwork
 *
 * URL: /services/civil/earthwork/construction-waste-hauling
 */
class InsertConstructionWasteHaulingSeeder extends Seeder
{
    public function run(): void
    {
        $parent = Service::query()
            ->where('slug', 'earthwork')
            ->with('category')
            ->first();

        if (! $parent) {
            $this->command?->error('ไม่พบ services slug=earthwork — สร้างงานเตรียมพื้นที่ก่อน');

            return;
        }

        $brand = (string) config('company.brand_name');
        $phone = (string) config('company.phone_format');
        $lineId = (string) config('company.line_id');
        $lineUrl = (string) config('company.line_url');
        $areas = implode(' ', array_slice(config('company.area_served', []), 0, 4));
        $imageBase = rtrim((string) config('company.images_cdn'), '/').'/assets/service-items/construction-wasted-hauling/';
        $coverImage = $imageBase.'construction-wasted-hauling-hero.webp';

        $landClearingUrl = $this->publishedItemUrl('land-clearing')
            ?: '/services/civil/earthwork/land-clearing';
        $landFillingUrl = $this->publishedItemUrl('land-filling')
            ?: '/services/civil/earthwork/land-filling';
        $siteClearingUrl = $this->publishedItemUrl('site-clearing')
            ?: '/services/civil/house-demolition/site-clearing';

        $item = ServiceItem::query()->updateOrCreate(
            ['slug' => 'construction-waste-hauling'],
            [
                'service_id' => $parent->id,
                'name' => 'งานขนขยะก่อสร้าง',
                'headline' => 'รับขนขยะก่อสร้าง เศษปูน เศษคอนกรีต ปทุมธานี–กรุงเทพฯ คิดราคาเป็นเที่ยวรถ',
                'excerpt' => "{$brand} รับขนขยะก่อสร้าง เศษคอนกรีต อิฐ ไม้ และเศษวัสดุจากรื้อถอนหรือต่อเติม ใน{$areas} ใช้รถกระบะ รถ 6 ล้อ และรถ 10 ล้อ ขนไปจุดทิ้งที่รับเศษก่อสร้างได้ ใบเสนอราคาแยกจำนวนเที่ยวและค่าบ่อทิ้ง ไม่เททิ้งข้างทาง",
                'description' => 'รับขนขยะก่อสร้าง เศษคอนกรีต อิฐ ไม้ จากไซต์งานก่อสร้างและรื้อถอน คิดราคาเป็นเที่ยวรถ ปทุมธานี–กรุงเทพฯ ประเมินฟรี',
                'meta_title' => "รับขนขยะก่อสร้าง เศษปูน คิดราคาเที่ยวรถ | {$brand}",
                'meta_description' => "รับขนขยะก่อสร้าง เศษคอนกรีต อิฐ ไม้ ไปจุดทิ้งที่รับได้ คิดราคาเป็นเที่ยวรถ ปทุมธานี–กรุงเทพฯ สำรวจฟรี โทร {$phone}",
                'cover_image' => $coverImage,
                'content' => $this->contentHtml(
                    $brand,
                    $phone,
                    $lineId,
                    $lineUrl,
                    $landClearingUrl,
                    $landFillingUrl,
                    $siteClearingUrl,
                    $imageBase,
                ),
                'sort_order' => 3,
                'is_published' => true,
                'published_at' => now()->subDay(),
            ],
        );

        $this->seedPrices($item);
        $this->syncFaqs($item, $brand, $phone, $areas);

        $this->command?->info("อัปเดต construction-waste-hauling id={$item->id} — content + FAQ + ServicePrice");
        $this->command?->info('URL: '.$item->url());
    }

    private function seedPrices(ServiceItem $item): void
    {
        $item->prices()->delete();

        $fuelNote = 'ราคาเริ่มต้น — ปรับขึ้นลงตามราคาค่าน้ำมัน';

        $item->prices()->createMany([
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
                'label' => 'รถหกล้อ 3 คิว ขนไปต่างจังหวัด',
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
                'label' => 'รถหกล้อ 7 คิว ขนไปต่างจังหวัด',
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

    private function syncFaqs(ServiceItem $item, string $brand, string $phone, string $areas): void
    {
        Faq::query()
            ->where('faqable_type', 'service_item')
            ->where('faqable_id', $item->id)
            ->delete();

        $faqs = [
            [
                'question' => 'ขนขยะก่อสร้างราคาเท่าไหร่ต่อเที่ยว',
                'answer' => 'รถหกล้อ 3 คิวเริ่มต้น 800 บาทต่อเที่ยว หรือ 1,400 บาทต่อเที่ยวถ้าพร้อมแรงงาน รถหกล้อ 7 คิวเริ่มต้น 1,400 บาทต่อเที่ยว หรือ 2,000 บาทต่อเที่ยวถ้าพร้อมแรงงาน ขนไปต่างจังหวัดคิดกิโลเมตรละ 32 บาท (รถ 3 คิว) และ 35 บาท (รถ 7 คิว) ราคาปรับขึ้นลงตามค่าน้ำมัน โทร '.$phone.' เพื่อยืนยันราคาวันจ้าง',
            ],
            [
                'question' => 'ขนขยะก่อสร้างทิ้งที่ไหนได้ ผิดกฎหมายไหม',
                'answer' => 'ต้องขนไปจุดทิ้งหรือบ่อที่รับเศษวัสดุก่อสร้างได้ตามที่ท้องถิ่นอนุญาต การเททิ้งข้างทาง ที่ว่าง หรือแม่น้ำลำคลองผิดกฎหมาย '.$brand.' ระบุจุดทิ้งและค่าบ่อทิ้งไว้ในใบเสนอราคา ไม่เททิ้งนอกสถานที่ที่รับได้',
            ],
            [
                'question' => 'เศษคอนกรีต อิฐ ไม้ และกระเบื้องใยหินขนรวมกันได้ไหม',
                'answer' => 'เศษคอนกรีต อิฐ กระเบื้องทั่วไป และไม้ส่วนใหญ่ขนรวมได้ถ้าจุดทิ้งรับ แต่กระเบื้องใยหิน (แร่ใยหิน) ต้องแยกกองและจัดการต่างหาก ห้ามทุบปนเศษทั่วไป แจ้งตั้งแต่ส่งรูปประเมินเพื่อจัดวิธีขนให้ถูก',
            ],
            [
                'question' => 'ซอยแคบ รถ 6 ล้อเข้าไม่ได้ ขนขยะก่อสร้างได้ไหม',
                'answer' => 'ได้ โดยใช้รถกระบะหรือรถเล็กหลายเที่ยว หรือขนออกปากซอยก่อนค่อยเทขึ้นรถใหญ่ จำนวนเที่ยวและราคาต่อเที่ยวจึงสูงกว่างานที่รถใหญ่เข้าถึง ส่งรูปปากซอยและจุดกลับรถมาตอนประเมิน',
            ],
            [
                'question' => 'จ้างแค่ขนขยะ โดยไม่จ้างรื้อหรือเคลียร์ที่ ได้ไหม',
                'answer' => 'ได้ หน้านี้คืองานขนเศษอย่างเดียว เหมาะกับไซต์ที่มีกองเศษพร้อมแล้ว ส่วนงานถางตัดต้นไม้อยู่ที่งานเคลียร์ริ่งพื้นที่ และงานเคลียร์หลังรื้อบ้านอยู่ที่หน้าเคลียร์พื้นที่หลังรื้อถอน',
            ],
            [
                'question' => 'รับขนขยะก่อสร้างพื้นที่ไหนบ้าง',
                'answer' => "{$brand} รับงานใน{$areas} และจังหวัดใกล้เคียง สำรวจหรือประเมินจากรูปทาง LINE ไม่มีค่าใช้จ่ายในพื้นที่ให้บริการ นัดหมายที่โทร {$phone}",
            ],
        ];

        foreach ($faqs as $index => $faq) {
            $item->faqs()->create([
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
        string $landClearingUrl,
        string $landFillingUrl,
        string $siteClearingUrl,
        string $imageBase,
    ): string {
        $workPhotos = $this->workPhotosHtml($brand, $imageBase);

        return <<<HTML
<p><em>โดย ทีมงาน {$brand} • อัปเดตล่าสุด 19 ตุลาคม 2569</em></p>

<h2>งานขนขยะก่อสร้างคืออะไร ต่างจากเคลียร์พื้นที่อย่างไร</h2>
<p>งานขนขยะก่อสร้างคือการขนเศษวัสดุจากไซต์งาน — เศษคอนกรีต อิฐ ปูน ไม้ กระเบื้อง ถุงปูน และเศษจากต่อเติมหรือรื้อถอน — ออกนอกพื้นที่ไปยังจุดทิ้งที่รับเศษก่อสร้างได้ คิดราคาเป็นเที่ยวรถตามขนาดรถและปริมาณเศษ</p>
<p>คนละงานกับ<a href="{$landClearingUrl}">เคลียร์ริ่งพื้นที่</a>ที่เน้นถางพืช ตัดต้นไม้ และขุดตอ และคนละงานกับ<a href="{$siteClearingUrl}">เคลียร์พื้นที่หลังรื้อถอน</a>ที่รวมปรับหน้าดินหลังทุบบ้าน หน้านี้โฟกัสการขนเศษที่มีกองอยู่แล้ว หรือขนระหว่างไซต์ก่อสร้างที่ต้องการเคลียร์ทางทำงาน</p>

<h2>รับขนขยะก่อสร้างอะไรบ้าง</h2>
<ul>
<li><strong>เศษคอนกรีตและอิฐ</strong> — จากทุบพื้น ทุบผนัง หรือรื้อโครงสร้าง</li>
<li><strong>เศษไม้และแบบหล่อ</strong> — แบบไม้เก่า พาเลท เศษโครงหลังคา</li>
<li><strong>เศษกระเบื้อง ปูน และถุงวัสดุ</strong> — จากงานตกแต่งและต่อเติม</li>
<li><strong>เศษโลหะเบา</strong> — ท่อ เหล็กแผ่น เหล็กดัด ที่ไม่ได้ขายแยก</li>
<li><strong>ขยะก่อสร้างทั่วไปจากไซต์</strong> — ที่จุดทิ้งรับได้และไม่ใช่ของอันตรายพิเศษ</li>
</ul>
<p>กระเบื้องใยหินและวัสดุที่ต้องจัดการพิเศษต้องแจ้งก่อนเสมอ ทีมงานจะแยกวิธีขนและค่าใช้จ่ายให้ชัดในใบเสนอราคา</p>

{$workPhotos}

<h2>ตารางราคารับขนขยะก่อสร้าง (ราคาเริ่มต้น)</h2>
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
<tr><td>รถหกล้อ 3 คิว ขนไปต่างจังหวัด</td><td>32</td><td>บาท/กม.</td><td>ราคาเริ่มต้น</td></tr>
<tr><td>รถหกล้อ 7 คิว ขนไปต่างจังหวัด</td><td>35</td><td>บาท/กม.</td><td>ราคาเริ่มต้น</td></tr>
</tbody>
</table>
<p><em>ราคาปรับขึ้นลงตามราคาค่าน้ำมัน — ยืนยันราคาก่อนวันเข้าขนทุกครั้ง</em></p>

<h3>ปัจจัยที่ทำให้จำนวนเที่ยวและราคาเปลี่ยน</h3>
<ol>
<li><strong>ราคาค่าน้ำมัน</strong> — ราคาเริ่มต้นปรับขึ้นลงตามต้นทุนเชื้อเพลิง</li>
<li><strong>ความจุกระบะและความหนาแน่นของเศษ</strong> — คอนกรีตหนักกินคิวเร็วกว่าเศษไม้</li>
<li><strong>แรงงานยกเศษขึ้นรถ</strong> — เลือกรถอย่างเดียวหรือพร้อมแรงงาน</li>
<li><strong>ระยะทางไปต่างจังหวัด</strong> — คิดเป็นบาทต่อกิโลเมตรตามขนาดรถ</li>
<li><strong>ทางเข้าไซต์</strong> — ซอยแคบอาจต้องใช้รถเล็กหรือขนหลายเที่ยว</li>
</ol>

<h2>ขั้นตอนจ้างขนขยะก่อสร้าง</h2>
<ol>
<li><strong>ส่งรูปกองเศษและพิกัด</strong> — ทาง <a href="{$lineUrl}">LINE {$lineId}</a> เพื่อประเมินขนาดรถและจำนวนเที่ยวคร่าว ๆ</li>
<li><strong>ยืนยันช่วงราคาและวันเข้าขน</strong> — ระบุรวม/ไม่รวมค่าบ่อทิ้ง และจุดจอดรถ</li>
<li><strong>ขนออกนอกพื้นที่</strong> — เทขึ้นรถ ขนไปจุดทิ้งที่รับได้ กวาดเศษหกบนทางเข้าตามที่ตกลง</li>
<li><strong>ส่งมอบ</strong> — แจ้งจำนวนเที่ยวจริงและหลักฐานการทิ้งเมื่อร้องขอ</li>
</ol>

<h2>ทำไมต้องเลือก {$brand}</h2>
<ul>
<li><strong>คิดราคาเป็นเที่ยว แยกค่าบ่อทิ้งชัด</strong> — ไม่เหมาก้อนเดียวแล้วบวกทีหลังโดยไม่บอกเหตุผล</li>
<li><strong>ขนไปจุดทิ้งที่รับเศษก่อสร้างได้</strong> — ไม่เททิ้งข้างทางหรือที่ว่าง</li>
<li><strong>ทีมในปทุมธานี</strong> — นัดขนโซนรังสิต ธัญบุรี ลำลูกกา และกรุงเทพฯ ปริมณฑลได้เร็ว</li>
<li><strong>ต่องานเตรียมพื้นที่ในทีมเดียว</strong> — <a href="{$landClearingUrl}">เคลียร์ริ่ง</a> <a href="{$landFillingUrl}">ถมดิน</a> และเคลียร์หลังรื้อถอน ไม่ต้องหาคนละเจ้า</li>
</ul>

<h2>ขอใบเสนอราคาขนขยะก่อสร้าง</h2>
<p>ส่งรูปกองเศษ พิกัดไซต์ และบอกชนิดเศษหลักมาทาง <a href="{$lineUrl}">LINE {$lineId}</a> ทีมงาน {$brand} จะแจ้งช่วงราคาและขนาดรถที่เหมาะ โทร {$phone}</p>
HTML;
    }

    private function workPhotosHtml(string $brand, string $imageBase): string
    {
        return $this->photoGroup('ภาพหน้างานขนขยะก่อสร้าง', 'content-gallery--3', $imageBase, [
            ['136696_0.webp', "รถหกล้อขนเศษวัสดุก่อสร้างออกจากไซต์งาน — {$brand}"],
            ['136753_0.webp', "กองเศษคอนกรีตและเศษปูนรอขนออกนอกพื้นที่ — {$brand}"],
            ['74397_0.webp', "ทีมงานขนขยะก่อสร้างขึ้นรถหกล้อหน้างาน — {$brand}"],
            ['74398_0.webp', "รถหกล้อบรรทุกเศษวัสดุก่อสร้างเต็มคัน — {$brand}"],
            ['74400_0.webp', "ขนเศษอิฐและเศษไม้จากงานรื้อถอน — {$brand}"],
            ['S__44531717_0.webp', "หน้างานหลังขนขยะก่อสร้างออกพื้นที่แล้ว — {$brand}"],
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
