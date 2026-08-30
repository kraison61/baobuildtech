<?php

namespace App\Support;

/**
 * เนื้อหาหน้าเกี่ยวกับเรา — ตามโครงสร้าง example/About Us.dc.html
 * แหล่งเดียวสำหรับ Blade และ meta tags
 */
class AboutContent
{
    public static function metaTitle(): string
    {
        return 'เกี่ยวกับเรา — ทีมวิศวกรและช่าง BOA | '.config('company.brand_name');
    }

    public static function metaDescription(): string
    {
        return 'เรื่องราว BOA (Build–Assure–Operate) ทีมวิศวกรคุมหน้างานเอง งานโยธา อลูมิเนียม และระบบจบในสัญญาเดียว กรุงเทพฯ และปริมณฑล';
    }

    public static function heroEyebrow(): string
    {
        return 'เกี่ยวกับเรา';
    }

    public static function heroTitle(): string
    {
        return 'ทีมที่ทำงานโครงสร้างเอง ตั้งแต่ถมดินถึงส่งมอบระบบ';
    }

    public static function heroLead(): string
    {
        return 'BOA รับเหมาก่อสร้างครบวงจรในกรุงเทพฯ และปริมณฑล ตั้งแต่ถมดิน ออกแบบ งานโครงสร้าง งานอลูมิเนียมและกระจก จนถึงระบบไฟฟ้า ประปา และ IT Infrastructure — ทีมช่างประจำของตัวเอง ไม่ส่งต่อผู้รับเหมาช่วง และส่งมอบเอกสารตรวจสอบทุกงานที่รับ';
    }

    public static function heroImage(): ?string
    {
        return null;
    }

    public static function heroImageAlt(): string
    {
        return 'หน้างานก่อสร้างโครงสร้างคอนกรีตในเมือง';
    }

    /**
     * @return array<int, array{value: string, label: string}>
     */
    public static function stats(): array
    {
        return [
            ['value' => '20+ ปี', 'label' => 'ประสบการณ์วิศวกรผู้คุมงานหน้างานเอง'],
            ['value' => '4 สายงาน', 'label' => 'โยธา · บริหารโครงการ · อลูมิเนียม · ไอที'],
            ['value' => 'ทีมประจำ', 'label' => 'ช่างของเราเอง ไม่ใช้ผู้รับเหมาช่วงในงานโครงสร้าง'],
            ['value' => '2 ปี', 'label' => 'รับประกันงานโครงสร้าง ระบุในสัญญา'],
        ];
    }

    public static function storyEyebrow(): string
    {
        return 'ที่มาของเรา';
    }

    public static function storyTitle(): string
    {
        return 'เริ่มจากช่องว่างหลังโครงสร้างเสร็จ';
    }

    /**
     * @return array<int, string>
     */
    public static function storyParagraphs(): array
    {
        return [
            'BOA ย่อมาจาก Build – Assure – Operate สะท้อนวิธีทำงานสามขั้น คือสร้างให้ได้มาตรฐาน ตรวจสอบให้มั่นใจ และส่งมอบระบบที่ใช้งานได้จริง',
            'ปัญหาที่เจ้าของงานเจอบ่อยคือ ผู้รับเหมาโครงสร้างจบงานแล้วโยนต่อให้หาช่างอลูมิเนียม ช่างไฟ ช่างเน็ตเอง พอมีปัญหาก็โทษกันไปมา เราจึงตั้งวิธีทำงานที่ปิดช่องนี้โดยเฉพาะ — งานอยู่ในสัญญาเดียวและความรับผิดชอบเดียว',
        ];
    }

    public static function storyImage(): ?string
    {
        return null;
    }

    public static function storyImageAlt(): string
    {
        return 'วิศวกรตรวจแบบร่วมกับช่างที่หน้างาน';
    }

    public static function principlesEyebrow(): string
    {
        return 'หลักการทำงาน';
    }

    public static function principlesTitle(): string
    {
        return 'สี่ข้อที่เราไม่ลดให้ ไม่ว่างานจะเร่งแค่ไหน';
    }

    public static function principlesLead(): string
    {
        return 'ทั้งสี่ข้อนี้เขียนไว้ในสัญญาทุกฉบับ ถ้าเจ้าของงานขอให้ข้ามข้อใดข้อหนึ่ง เราจะบอกตรง ๆ ว่ารับงานนั้นไม่ได้';
    }

    /**
     * @return array<int, array{no: string, title: string, body: string}>
     */
    public static function principles(): array
    {
        return [
            [
                'no' => '01',
                'title' => 'แบบต้องลงนามก่อนลงมือ',
                'body' => 'งานโครงสร้างคำนวณและลงนามโดยวิศวกร ไม่เริ่มงานจากการประมาณหน้างาน',
            ],
            [
                'no' => '02',
                'title' => 'BOQ แยกรายการทุกบาท',
                'body' => 'ใบเสนอราคาแยกหมวดวัสดุและแรงงาน ระบุชัดว่าอะไรรวมและอะไรไม่รวมก่อนเซ็นสัญญา',
            ],
            [
                'no' => '03',
                'title' => 'งวดงานผูกกับเนื้องานที่ตรวจได้',
                'body' => 'จ่ายเมื่องานเสร็จตามที่ตกลง ไม่ใช่จ่ายตามปฏิทิน และกันงวดสุดท้ายไว้จนหลังตรวจรับ',
            ],
            [
                'no' => '04',
                'title' => 'ทีมช่างของเราเอง',
                'body' => 'งานโครงสร้าง อลูมิเนียม และระบบทำโดยทีมประจำ ไม่ส่งต่อผู้รับเหมาช่วงแล้วโยนความรับผิดชอบ',
            ],
        ];
    }

    public static function teamEyebrow(): string
    {
        return 'ทีมและเครื่องจักร';
    }

    public static function teamTitle(): string
    {
        return 'ใครอยู่หน้างาน และรับผิดชอบอะไร';
    }

    public static function teamLead(): string
    {
        return 'ทุกโครงการมีวิศวกรหรือโฟร์แมนที่ติดต่อได้ตลอดสัญญา ไม่ต้องเล่าเรื่องเดิมซ้ำกับคนใหม่';
    }

    /**
     * @return array<int, array{label: string, value: string}>
     */
    public static function teamFacts(): array
    {
        return [
            ['label' => 'วิศวกรผู้ควบคุมงาน', 'value' => 'ภาคีวิศวกรโยธา · ลงหน้างานเอง'],
            ['label' => 'ผู้บริหารโครงการ', 'value' => 'PMP · CGEIT · RMP'],
            ['label' => 'งานอลูมิเนียมและกระจก', 'value' => 'ทีมช่างประจำ'],
            ['label' => 'IT Infrastructure', 'value' => 'เครือข่าย · CCTV · สายสัญญาณ'],
            ['label' => 'รับประกันผลงาน', 'value' => 'โครงสร้าง 2 ปี · ระบบ 1 ปี'],
        ];
    }

    /**
     * @return array<int, array{src: ?string, alt: string, label: string, spec: string, class: string}>
     */
    public static function teamImages(): array
    {
        return [
            [
                'src' => null,
                'alt' => 'ทีมช่างทำงานโครงสร้างที่หน้างาน',
                'label' => 'ทีมช่างหน้างาน',
                'spec' => '1200×800',
                'class' => 'h-[clamp(220px,30vw,300px)]',
            ],
            [
                'src' => null,
                'alt' => 'เครื่องจักรปรับพื้นที่ในโครงการ',
                'label' => 'เครื่องจักรหน้างาน',
                'spec' => '1200×800',
                'class' => 'h-[clamp(180px,24vw,240px)]',
            ],
        ];
    }

    public static function processEyebrow(): string
    {
        return 'ขั้นตอนการทำงาน';
    }

    public static function processTitle(): string
    {
        return 'ห้าขั้นจากรูปหน้างานถึงส่งมอบ';
    }

    /**
     * @return array<int, array{no: string, title: string, body: string}>
     */
    public static function processSteps(): array
    {
        return [
            [
                'no' => 'ขั้นที่ 1',
                'title' => 'ดูรูปและประเมินเบื้องต้น',
                'body' => 'ส่งรูปพื้นที่ ความสูงดิน และแนวเขต ได้ช่วงราคาคร่าว ๆ ภายใน 1 วันทำการ',
            ],
            [
                'no' => 'ขั้นที่ 2',
                'title' => 'เข้าสำรวจหน้างาน',
                'body' => 'วัดระดับ ตรวจสภาพชั้นดินและทางเข้าเครื่องจักร ไม่มีค่าใช้จ่ายในพื้นที่ที่เรารับงาน',
            ],
            [
                'no' => 'ขั้นที่ 3',
                'title' => 'แบบและใบเสนอราคา',
                'body' => 'ใบเสนอราคาแยกรายการวัสดุและแรงงาน พร้อมแบบที่วิศวกรลงนาม',
            ],
            [
                'no' => 'ขั้นที่ 4',
                'title' => 'ทำงานและรายงานความคืบหน้า',
                'body' => 'รายงานภาพหน้างานเป็นระยะ ระบุงานที่เสร็จและงานที่ค้างพร้อมเหตุผล',
            ],
            [
                'no' => 'ขั้นที่ 5',
                'title' => 'ส่งมอบพร้อมเอกสาร',
                'body' => 'ตรวจ Defect ร่วมกัน แก้ให้เรียบร้อยก่อนปิดงวดสุดท้าย พร้อมเอกสารรับประกัน',
            ],
        ];
    }

    public static function companyEyebrow(): string
    {
        return 'ข้อมูลบริษัท';
    }

    public static function companyTitle(): string
    {
        return 'ตรวจสอบเราได้ก่อนเซ็นสัญญา';
    }

    /**
     * @return array<int, array{label: string, value: string}>
     */
    public static function companyFacts(): array
    {
        return [
            ['label' => 'ชื่อจดทะเบียน', 'value' => (string) config('company.legal_name')],
            ['label' => 'เลขผู้เสียภาษี', 'value' => (string) config('company.tax_id')],
            ['label' => 'ก่อตั้ง', 'value' => 'พ.ศ. '.config('company.founding_year')],
            ['label' => 'ที่ตั้งสำนักงาน', 'value' => Company::addressDisplay()],
            ['label' => 'เวลาทำการ', 'value' => Company::hoursDisplay()],
        ];
    }

    public static function ctaTitle(): string
    {
        return 'อยากรู้ว่าเราทำงานยังไง ให้ดูหน้างานจริง';
    }

    public static function ctaBody(): string
    {
        return 'ส่งรูปพื้นที่ ความสูงดิน และแนวเขตที่ดินมาทางไลน์ ทีมช่างจะบอกแนวทางงาน ฐานรากที่ควรใช้ และช่วงราคาคร่าว ๆ ก่อนนัดเข้าสำรวจ โดยไม่มีค่าใช้จ่าย';
    }
}
