<?php

namespace App\Support;

/**
 * เนื้อหาหน้าติดต่อเรา — ตามโครงสร้าง example/Contact Us.dc.html
 * แหล่งเดียวสำหรับ Blade และ meta tags
 */
class ContactContent
{
    public static function metaTitle(): string
    {
        return 'ติดต่อเรา — โทร ไลน์ ประเมินหน้างานฟรี | '.config('company.brand_name');
    }

    public static function metaDescription(): string
    {
        $phone = Company::phoneDisplay();
        $line = config('company.line_id');

        return "ติดต่อ BOA โทร {$phone}".($line ? " LINE {$line}" : '').' ส่งรูปหน้างานได้ช่วงราคาภายใน 1 วันทำการ กรุงเทพฯ และปริมณฑล';
    }

    public static function heroEyebrow(): string
    {
        return 'ติดต่อเรา';
    }

    public static function heroTitle(): string
    {
        return 'ส่งรูปหน้างานมาก่อน ได้ช่วงราคาภายในหนึ่งวันทำการ';
    }

    public static function heroLead(): string
    {
        return 'ไม่ต้องมีแบบก่อสร้างก็คุยได้ ส่งรูปพื้นที่ ความสูงดิน และแนวเขตที่ดินมาทางไลน์หรือกรอกฟอร์มด้านล่าง ทีมช่างจะบอกแนวทางงาน ฐานรากที่ควรใช้ และช่วงราคาคร่าว ๆ ก่อนนัดเข้าสำรวจ โดยไม่มีค่าใช้จ่าย';
    }

    public static function heroImage(): string
    {
        return 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1600&q=80&auto=format&fit=crop';
    }

    public static function heroImageAlt(): string
    {
        return 'ช่างและเหล็กเสริมที่หน้างานก่อสร้าง';
    }

    /**
     * @return array<int, array{label: string, value: string, hint: string, href?: string|null, external?: bool}>
     */
    public static function channels(): array
    {
        $phoneDisplay = Company::phoneDisplay();
        $hours = Company::hoursDisplay();
        $lineId = Company::lineId();
        $lineUrl = Company::lineUrl();
        $email = (string) config('company.email');

        return array_values(array_filter([
            [
                'label' => 'โทรหาทีมช่าง',
                'value' => $phoneDisplay,
                'hint' => $hours.' ตอบเรื่องหน้างานได้ทันที',
                'href' => Company::phoneHref(),
                'external' => false,
            ],
            $lineId ? [
                'label' => 'ไลน์ (ส่งรูปได้)',
                'value' => $lineId,
                'hint' => 'ช่องทางที่เร็วที่สุดสำหรับส่งรูปพื้นที่และแบบ',
                'href' => $lineUrl,
                'external' => filled($lineUrl),
            ] : null,
            $email !== '' ? [
                'label' => 'อีเมล',
                'value' => $email,
                'hint' => 'สำหรับงานราชการ งานโรงงาน และเอกสารประกวดราคา',
                'href' => 'mailto:'.$email,
                'external' => false,
            ] : null,
            [
                'label' => 'เวลาตอบกลับ',
                'value' => 'ภายใน 1 วันทำการ',
                'hint' => 'งานที่ส่งเสาร์บ่ายหลัง 15:00 น. ตอบวันจันทร์',
                'href' => null,
                'external' => false,
            ],
        ]));
    }

    /**
     * @return array<int, array{value: string, label: string}>
     */
    public static function jobTypes(): array
    {
        return [
            ['value' => 'structure', 'label' => 'งานโครงสร้าง / กำแพงกันดิน'],
            ['value' => 'foundation', 'label' => 'งานฐานรากและเข็ม'],
            ['value' => 'civil', 'label' => 'งานโยธาและปรับพื้นที่'],
            ['value' => 'aluminium', 'label' => 'งานอลูมิเนียมและกระจก'],
            ['value' => 'systems', 'label' => 'งานระบบไฟฟ้า ประปา ไอที CCTV'],
            ['value' => 'other', 'label' => 'ยังไม่แน่ใจ'],
        ];
    }

    /**
     * @return array<int, string>
     */
    public static function prepareItems(): array
    {
        return [
            'รูปพื้นที่ 3–4 รูป ถ่ายให้เห็นแนวเขตและระดับดิน',
            'ความสูงต่างระดับของดินโดยประมาณ',
            'ความยาวแนวกำแพงหรือขนาดพื้นที่เป็นตารางวา/ไร่',
            'ทางเข้าหน้างาน รถบรรทุกและเครื่องจักรเข้าได้หรือไม่',
            'โฉนดหรือแบบก่อสร้าง ถ้ามี',
        ];
    }

    public static function officeEyebrow(): string
    {
        return 'ที่ตั้งสำนักงาน';
    }

    public static function officeTitle(): string
    {
        return 'เข้ามาคุยที่สำนักงานได้ นัดล่วงหน้าหนึ่งวัน';
    }

    public static function officeLead(): string
    {
        return 'ทีมช่างส่วนใหญ่อยู่หน้างานในเวลาทำการ ถ้าจะเข้ามาดูตัวอย่างงานและคุยรายละเอียดที่สำนักงาน โทรนัดล่วงหน้าอย่างน้อยหนึ่งวัน';
    }

    /**
     * @return array<int, array{label: string, value: string, href?: string|null}>
     */
    public static function officeFacts(): array
    {
        $mapsUrl = config('company.social.google_maps');

        return [
            ['label' => 'ที่อยู่', 'value' => Company::addressDisplay()],
            ['label' => 'เวลาทำการ', 'value' => Company::hoursDisplay()],
            ['label' => 'วันหยุด', 'value' => 'อาทิตย์และวันหยุดนักขัตฤกษ์'],
            [
                'label' => 'แผนที่',
                'value' => 'เปิดใน Google Maps',
                'href' => filled($mapsUrl) ? (string) $mapsUrl : null,
            ],
        ];
    }

    public static function faqEyebrow(): string
    {
        return 'คำถามก่อนติดต่อ';
    }

    public static function faqTitle(): string
    {
        return 'สี่ข้อที่ลูกค้าถามบ่อยที่สุด';
    }

    /**
     * @return array<int, array{q: string, a: string}>
     */
    public static function faqs(): array
    {
        return [
            [
                'q' => 'ประเมินราคาคิดค่าใช้จ่ายไหม',
                'a' => 'ไม่คิด ทั้งการประเมินจากรูปและการเข้าสำรวจหน้างานในพื้นที่ที่เรารับงาน',
            ],
            [
                'q' => 'ยังไม่มีแบบก่อสร้าง คุยได้ไหม',
                'a' => 'ได้ ส่งรูปและความสูงดินมาก่อน วิศวกรจะทำแบบและคำนวณให้ในขั้นเสนอราคา',
            ],
            [
                'q' => 'รับงานเฉพาะบางส่วนได้ไหม',
                'a' => 'ได้ ลูกค้าจำนวนมากจ้างเฉพาะงานถมดิน กำแพงกันดิน เปลี่ยนประตูหน้าต่างอลูมิเนียม หรืองานระบบของอาคารที่สร้างเสร็จแล้ว',
            ],
            [
                'q' => 'เริ่มงานได้เร็วสุดเมื่อไร',
                'a' => 'ปกติ 3–4 สัปดาห์หลังเซ็นสัญญา ขึ้นกับคิวงานและระยะเวลาทำแบบลงนาม',
            ],
        ];
    }
}
