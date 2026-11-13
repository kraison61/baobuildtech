<?php

namespace App\Support;

/**
 * เนื้อหาหน้าติดต่อเรา — แหล่งเดียวสำหรับ Blade และ meta tags
 */
class ContactContent
{
    public static function metaTitle(): string
    {
        return Locale::pick(
            'ติดต่อเรา — โทร ไลน์ ประเมินหน้างานฟรี | '.config('company.brand_name'),
            'Contact us — call, LINE, free site estimate | '.config('company.brand_name'),
        );
    }

    public static function metaDescription(): string
    {
        $phone = Company::phoneDisplay();
        $line = Company::lineId();

        return Locale::pick(
            "ติดต่อ BOA โทร {$phone}".($line ? " LINE {$line}" : '').' ส่งรูปหน้างานได้ช่วงราคาภายใน 1 วันทำการ กรุงเทพฯ และปริมณฑล',
            "Contact BOA at {$phone}".($line ? " or LINE {$line}" : '').'. Send site photos for a price range within 1 business day — Bangkok and surrounding provinces.',
        );
    }

    public static function heroEyebrow(): string
    {
        return Locale::pick('ติดต่อเรา', 'Contact us');
    }

    public static function heroTitle(): string
    {
        return Locale::pick(
            'ส่งรูปหน้างานมาก่อน ได้ช่วงราคาภายในหนึ่งวันทำการ',
            'Send site photos first — get a price range within one business day',
        );
    }

    public static function heroLead(): string
    {
        return Locale::pick(
            'ไม่ต้องมีแบบก่อสร้างก็คุยได้ ส่งรูปพื้นที่ ความสูงดิน และแนวเขตที่ดินมาทางไลน์หรือกรอกฟอร์มด้านล่าง ทีมช่างจะบอกแนวทางงาน ฐานรากที่ควรใช้ และช่วงราคาคร่าว ๆ ก่อนนัดเข้าสำรวจ โดยไม่มีค่าใช้จ่าย',
            'No construction drawings needed. Send site photos, soil height, and boundary lines via LINE or the form below. Our team will outline the approach, suitable foundation, and a rough range before a free survey visit.',
        );
    }

    public static function heroImage(): ?string
    {
        return rtrim((string) config('company.images_cdn'), '/').'/assets/contact/contact-hero.webp';
    }

    public static function heroImageAlt(): string
    {
        return Locale::pick(
            'หน้างานถมที่และเตรียมพื้นที่พร้อมรถขุดและอุปกรณ์สำรวจ — '.config('company.brand_name'),
            'Land-filling and site preparation with excavator and survey gear — '.config('company.brand_name'),
        );
    }

    /**
     * @return array<int, array{label: string, value: string, hint: string, href?: string|null, external?: bool, cta?: string|null}>
     */
    public static function channels(): array
    {
        $phoneDisplay = Company::phoneDisplay();
        $hours = Company::hoursDisplay();
        $lineId = Company::lineId();
        $lineUrl = Company::lineUrl();
        $email = (string) config('company.email');

        return array_values(array_filter(Locale::pickAny(
            [
                [
                    'label' => 'โทรหาทีมช่าง',
                    'value' => $phoneDisplay,
                    'hint' => $hours.' ตอบเรื่องหน้างานได้ทันที',
                    'href' => Company::phoneHref(),
                    'external' => false,
                    'cta' => 'phone',
                ],
                $lineId ? [
                    'label' => 'ไลน์ (ส่งรูปได้)',
                    'value' => $lineId,
                    'hint' => 'ช่องทางที่เร็วที่สุดสำหรับส่งรูปพื้นที่และแบบ',
                    'href' => $lineUrl,
                    'external' => filled($lineUrl),
                    'cta' => filled($lineUrl) ? 'line' : null,
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
            ],
            [
                [
                    'label' => 'Call the crew',
                    'value' => $phoneDisplay,
                    'hint' => $hours.' — site questions answered immediately',
                    'href' => Company::phoneHref(),
                    'external' => false,
                    'cta' => 'phone',
                ],
                $lineId ? [
                    'label' => 'LINE (send photos)',
                    'value' => $lineId,
                    'hint' => 'Fastest channel for site photos and drawings',
                    'href' => $lineUrl,
                    'external' => filled($lineUrl),
                    'cta' => filled($lineUrl) ? 'line' : null,
                ] : null,
                $email !== '' ? [
                    'label' => 'Email',
                    'value' => $email,
                    'hint' => 'For government, factory, and tender documents',
                    'href' => 'mailto:'.$email,
                    'external' => false,
                ] : null,
                [
                    'label' => 'Response time',
                    'value' => 'Within 1 business day',
                    'hint' => 'Requests after 15:00 on Saturday get a Monday reply',
                    'href' => null,
                    'external' => false,
                ],
            ],
        )));
    }

    /**
     * @return array<int, array{value: string, label: string}>
     */
    public static function jobTypes(): array
    {
        return Locale::pickAny(
            [
                ['value' => 'structure', 'label' => 'งานโครงสร้าง / กำแพงกันดิน'],
                ['value' => 'foundation', 'label' => 'งานฐานรากและเข็ม'],
                ['value' => 'civil', 'label' => 'งานโยธาและปรับพื้นที่'],
                ['value' => 'aluminium', 'label' => 'งานอลูมิเนียมและกระจก'],
                ['value' => 'systems', 'label' => 'งานระบบไฟฟ้า ประปา ไอที CCTV'],
                ['value' => 'other', 'label' => 'ยังไม่แน่ใจ'],
            ],
            [
                ['value' => 'structure', 'label' => 'Structure / retaining wall'],
                ['value' => 'foundation', 'label' => 'Foundation & piles'],
                ['value' => 'civil', 'label' => 'Civil works & site prep'],
                ['value' => 'aluminium', 'label' => 'Aluminium & glass'],
                ['value' => 'systems', 'label' => 'Electrical, plumbing, IT, CCTV'],
                ['value' => 'other', 'label' => 'Not sure yet'],
            ],
        );
    }

    /**
     * @return array<int, string>
     */
    public static function prepareItems(): array
    {
        return Locale::pickAny(
            [
                'รูปพื้นที่ 3–4 รูป ถ่ายให้เห็นแนวเขตและระดับดิน',
                'ความสูงต่างระดับของดินโดยประมาณ',
                'ความยาวแนวกำแพงหรือขนาดพื้นที่เป็นตารางวา/ไร่',
                'ทางเข้าหน้างาน รถบรรทุกและเครื่องจักรเข้าได้หรือไม่',
                'โฉนดหรือแบบก่อสร้าง ถ้ามี',
            ],
            [
                '3–4 site photos showing boundaries and ground level',
                'Approximate soil height difference',
                'Wall length or area in sq.wah / rai',
                'Site access for trucks and machinery',
                'Title deed or drawings if available',
            ],
        );
    }

    public static function officeEyebrow(): string
    {
        return Locale::pick('ที่ตั้งสำนักงาน', 'Office location');
    }

    public static function officeTitle(): string
    {
        return Locale::pick(
            'เข้ามาคุยที่สำนักงานได้ นัดล่วงหน้าหนึ่งวัน',
            'Visit the office — please book one day ahead',
        );
    }

    public static function officeLead(): string
    {
        return Locale::pick(
            'ทีมช่างส่วนใหญ่อยู่หน้างานในเวลาทำการ ถ้าจะเข้ามาดูตัวอย่างงานและคุยรายละเอียดที่สำนักงาน โทรนัดล่วงหน้าอย่างน้อยหนึ่งวัน',
            'Most of the crew is on site during business hours. To review sample work and discuss details at the office, please call at least one day ahead.',
        );
    }

    /**
     * @return array<int, array{label: string, value: string, href?: string|null}>
     */
    public static function officeFacts(): array
    {
        $mapsUrl = config('company.social.google_maps');

        return Locale::pickAny(
            [
                ['label' => 'ที่อยู่', 'value' => Company::addressDisplay()],
                ['label' => 'เวลาทำการ', 'value' => Company::hoursDisplay()],
                ['label' => 'วันหยุด', 'value' => 'อาทิตย์และวันหยุดนักขัตฤกษ์'],
                [
                    'label' => 'แผนที่',
                    'value' => 'เปิดใน Google Maps',
                    'href' => filled($mapsUrl) ? (string) $mapsUrl : null,
                ],
            ],
            [
                ['label' => 'Address', 'value' => Company::addressDisplay()],
                ['label' => 'Hours', 'value' => Company::hoursDisplay()],
                ['label' => 'Closed', 'value' => 'Sundays and public holidays'],
                [
                    'label' => 'Map',
                    'value' => 'Open in Google Maps',
                    'href' => filled($mapsUrl) ? (string) $mapsUrl : null,
                ],
            ],
        );
    }

    public static function faqEyebrow(): string
    {
        return Locale::pick('คำถามก่อนติดต่อ', 'Before you contact us');
    }

    public static function faqTitle(): string
    {
        return Locale::pick(
            'สี่ข้อที่ลูกค้าถามบ่อยที่สุด',
            'Four questions clients ask most',
        );
    }

    /**
     * @return array<int, array{q: string, a: string}>
     */
    public static function faqs(): array
    {
        return Locale::pickAny(
            [
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
            ],
            [
                [
                    'q' => 'Is the estimate free?',
                    'a' => 'Yes — both photo-based estimates and on-site surveys in our service area.',
                ],
                [
                    'q' => 'Can we talk without construction drawings?',
                    'a' => 'Yes. Send photos and soil height first; the engineer prepares drawings and calculations at the quotation stage.',
                ],
                [
                    'q' => 'Can you take only part of the work?',
                    'a' => 'Yes. Many clients hire us only for filling, retaining walls, aluminium doors and windows, or building systems after the structure is done.',
                ],
                [
                    'q' => 'How soon can work start?',
                    'a' => 'Typically 3–4 weeks after signing, depending on queue and signed drawing lead time.',
                ],
            ],
        );
    }
}
