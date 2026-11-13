<?php

namespace App\Support;

/**
 * เนื้อหาหน้าเกี่ยวกับเรา — แหล่งเดียวสำหรับ Blade และ meta tags
 */
class AboutContent
{
    public static function metaTitle(): string
    {
        return Locale::pick(
            'เกี่ยวกับเรา — ทีมวิศวกรและช่าง BOA | '.config('company.brand_name'),
            'About us — BOA engineers and tradespeople | '.config('company.brand_name'),
        );
    }

    public static function metaDescription(): string
    {
        return Locale::pick(
            'เรื่องราว BOA (Build Operate Assure) ทีมวิศวกรคุมหน้างานเอง งานโยธา อลูมิเนียม และระบบจบในสัญญาเดียว กรุงเทพฯ และปริมณฑล',
            'The BOA (Build Operate Assure) story — engineer-led site control, civil works, aluminium, and systems under one contract in Bangkok and surrounding provinces.',
        );
    }

    public static function heroEyebrow(): string
    {
        return Locale::pick('เกี่ยวกับเรา', 'About us');
    }

    public static function heroTitle(): string
    {
        return Locale::pick(
            'ทีมที่ทำงานโครงสร้างเอง ตั้งแต่ถมดินถึงส่งมอบระบบ',
            'A team that builds the structure itself — from fill to system handover',
        );
    }

    public static function heroLead(): string
    {
        return Locale::pick(
            'BOA รับเหมาก่อสร้างครบวงจรในกรุงเทพฯ และปริมณฑล ตั้งแต่ถมดิน ออกแบบ งานโครงสร้าง งานอลูมิเนียมและกระจก จนถึงระบบไฟฟ้า ประปา และ IT Infrastructure — ทีมช่างประจำของตัวเอง ไม่ส่งต่อผู้รับเหมาช่วง และส่งมอบเอกสารตรวจสอบทุกงานที่รับ',
            'BOA is a full-service contractor in Bangkok and surrounding provinces — from land filling and design through structure, aluminium and glass, electrical, plumbing, and IT infrastructure. Our own crews, no structural subcontract flip, with inspection documents on every job.',
        );
    }

    public static function heroImage(): ?string
    {
        return rtrim((string) config('company.images_cdn'), '/').'/assets/about/about-hero.webp';
    }

    public static function heroImageAlt(): string
    {
        return Locale::pick(
            'วิศวกรตรวจแบบก่อสร้างพร้อมหมวกนิรภัยและแผนผังอาคาร — '.config('company.brand_name'),
            'Engineer reviewing construction drawings with hard hat and building plans — '.config('company.brand_name'),
        );
    }

    /**
     * @return array<int, array{value: string, label: string}>
     */
    public static function stats(): array
    {
        return Locale::pickAny(
            [
                ['value' => '20+ ปี', 'label' => 'ประสบการณ์วิศวกรผู้คุมงานหน้างานเอง'],
                ['value' => '4 สายงาน', 'label' => 'โยธา · บริหารโครงการ · อลูมิเนียม · ไอที'],
                ['value' => 'ทีมประจำ', 'label' => 'ช่างของเราเอง ไม่ใช้ผู้รับเหมาช่วงในงานโครงสร้าง'],
                ['value' => '2 ปี', 'label' => 'รับประกันงานโครงสร้าง ระบุในสัญญา'],
            ],
            [
                ['value' => '20+ yrs', 'label' => 'Engineer experience supervising work on site'],
                ['value' => '4 disciplines', 'label' => 'Civil · Project management · Aluminium · IT'],
                ['value' => 'In-house crew', 'label' => 'Our own trades — no structural subcontract flip'],
                ['value' => '2 years', 'label' => 'Structural warranty stated in the contract'],
            ],
        );
    }

    public static function storyEyebrow(): string
    {
        return Locale::pick('ที่มาของเรา', 'Our origin');
    }

    public static function storyTitle(): string
    {
        return Locale::pick(
            'เริ่มจากช่องว่างหลังโครงสร้างเสร็จ',
            'It started with the gap after the structure is finished',
        );
    }

    /**
     * @return array<int, string>
     */
    public static function storyParagraphs(): array
    {
        return Locale::pickAny(
            [
                'BOA ย่อมาจาก Build Operate Assure สะท้อนวิธีทำงานสามขั้น คือสร้างให้ได้มาตรฐาน ส่งมอบระบบที่ใช้งานได้จริง และตรวจสอบให้มั่นใจ',
                'ปัญหาที่เจ้าของงานเจอบ่อยคือ ผู้รับเหมาโครงสร้างจบงานแล้วโยนต่อให้หาช่างอลูมิเนียม ช่างไฟ ช่างเน็ตเอง พอมีปัญหาก็โทษกันไปมา เราจึงตั้งวิธีทำงานที่ปิดช่องนี้โดยเฉพาะ — งานอยู่ในสัญญาเดียวและความรับผิดชอบเดียว',
            ],
            [
                'BOA stands for Build Operate Assure — three steps: build to standard, hand over systems that actually work, and verify with confidence.',
                'Owners often finish structural work then chase aluminium, electrical, and network trades themselves — who then blame each other. We designed our method to close that gap: one contract, one accountability.',
            ],
        );
    }

    /**
     * @return array{before: string, link_text: string, link_url: string, after: string}
     */
    public static function affiliateDisclosure(): array
    {
        return Locale::pickAny(
            [
                'before' => config('company.brand_name').' (บีโอเอ บิลด์เทค) ดำเนินงานร่วมกับ ',
                'link_text' => 'บจก.ธีรพงษ์ เซอร์วิส',
                'link_url' => 'https://theeraphong.com',
                'after' => ' โดยแบ่งสายบริการและพื้นที่รับงานให้ชัดเจน — BOA-Buildtech โฟกัสงานอลูมิเนียม โซล่าเซลล์ รื้อถอน/รีโนเวท และถมที่ในโซนปทุมธานี–รังสิต–ธัญบุรี–ลำลูกกา',
            ],
            [
                'before' => config('company.brand_name').' (BOA Buildtech) works alongside ',
                'link_text' => 'Theeraphong Service Co., Ltd.',
                'link_url' => 'https://theeraphong.com',
                'after' => ' with clear service and area splits — BOA-Buildtech focuses on aluminium, solar, demolition/renovation, and land filling in Pathum Thani–Rangsit–Thanyaburi–Lam Luk Ka.',
            ],
        );
    }

    public static function storyImage(): ?string
    {
        return rtrim((string) config('company.images_cdn'), '/').'/assets/about/about-story.webp';
    }

    public static function storyImageAlt(): string
    {
        return Locale::pick(
            'ทีมวิศวกรและเจ้าหน้าที่ร่วมตรวจแบบก่อสร้างบนโต๊ะทำงาน — '.config('company.brand_name'),
            'Engineers and staff reviewing construction drawings at a work table — '.config('company.brand_name'),
        );
    }

    public static function principlesEyebrow(): string
    {
        return Locale::pick('หลักการทำงาน', 'Working principles');
    }

    public static function principlesTitle(): string
    {
        return Locale::pick(
            'สี่ข้อที่เราไม่ลดให้ ไม่ว่างานจะเร่งแค่ไหน',
            'Four rules we never drop — no matter how urgent the job',
        );
    }

    public static function principlesLead(): string
    {
        return Locale::pick(
            'ทั้งสี่ข้อนี้เขียนไว้ในสัญญาทุกฉบับ ถ้าเจ้าของงานขอให้ข้ามข้อใดข้อหนึ่ง เราจะบอกตรง ๆ ว่ารับงานนั้นไม่ได้',
            'All four are written into every contract. If an owner asks us to skip one, we say plainly that we cannot take that job.',
        );
    }

    /**
     * @return array<int, array{no: string, title: string, body: string}>
     */
    public static function principles(): array
    {
        return Locale::pickAny(
            [
                ['no' => '01', 'title' => 'แบบต้องลงนามก่อนลงมือ', 'body' => 'งานโครงสร้างคำนวณและลงนามโดยวิศวกร ไม่เริ่มงานจากการประมาณหน้างาน'],
                ['no' => '02', 'title' => 'BOQ แยกรายการทุกบาท', 'body' => 'ใบเสนอราคาแยกหมวดวัสดุและแรงงาน ระบุชัดว่าอะไรรวมและอะไรไม่รวมก่อนเซ็นสัญญา'],
                ['no' => '03', 'title' => 'งวดงานผูกกับเนื้องานที่ตรวจได้', 'body' => 'จ่ายเมื่องานเสร็จตามที่ตกลง ไม่ใช่จ่ายตามปฏิทิน และกันงวดสุดท้ายไว้จนหลังตรวจรับ'],
                ['no' => '04', 'title' => 'ทีมช่างของเราเอง', 'body' => 'งานโครงสร้าง อลูมิเนียม และระบบทำโดยทีมประจำ ไม่ส่งต่อผู้รับเหมาช่วงแล้วโยนความรับผิดชอบ'],
            ],
            [
                ['no' => '01', 'title' => 'Drawings signed before work starts', 'body' => 'Structural work is calculated and signed by an engineer — never started from a rough site guess'],
                ['no' => '02', 'title' => 'Itemized BOQ down to every baht', 'body' => 'Quotes separate materials and labour, with clear inclusions and exclusions before signing'],
                ['no' => '03', 'title' => 'Payments tied to inspectable work', 'body' => 'Pay when agreed work is done — not by the calendar — and hold the final payment until after handover'],
                ['no' => '04', 'title' => 'Our own crews', 'body' => 'Structure, aluminium, and systems are done by our standing teams — not flipped to subcontractors'],
            ],
        );
    }

    public static function teamEyebrow(): string
    {
        return Locale::pick('ทีมและเครื่องจักร', 'Team & equipment');
    }

    public static function teamTitle(): string
    {
        return Locale::pick(
            'ใครอยู่หน้างาน และรับผิดชอบอะไร',
            'Who is on site — and who is accountable for what',
        );
    }

    public static function teamLead(): string
    {
        return Locale::pick(
            'ทุกโครงการมีวิศวกรหรือโฟร์แมนที่ติดต่อได้ตลอดสัญญา ไม่ต้องเล่าเรื่องเดิมซ้ำกับคนใหม่',
            'Every project has an engineer or foreman reachable for the full contract — you should not retell the story to a new person.',
        );
    }

    /**
     * @return array<int, array{label: string, value: string}>
     */
    public static function teamFacts(): array
    {
        return Locale::pickAny(
            [
                ['label' => 'วิศวกรผู้ควบคุมงาน', 'value' => 'ภาคีวิศวกรโยธา · ลงหน้างานเอง'],
                ['label' => 'ผู้บริหารโครงการ', 'value' => 'PMP · CGEIT · RMP'],
                ['label' => 'งานอลูมิเนียมและกระจก', 'value' => 'ทีมช่างประจำ'],
                ['label' => 'IT Infrastructure', 'value' => 'เครือข่าย · CCTV · สายสัญญาณ'],
                ['label' => 'รับประกันผลงาน', 'value' => 'โครงสร้าง 2 ปี · ระบบ 1 ปี'],
            ],
            [
                ['label' => 'Supervising engineer', 'value' => 'Associate civil engineer · on site personally'],
                ['label' => 'Project manager', 'value' => 'PMP · CGEIT · RMP'],
                ['label' => 'Aluminium & glass', 'value' => 'Standing crew'],
                ['label' => 'IT Infrastructure', 'value' => 'Network · CCTV · cabling'],
                ['label' => 'Warranty', 'value' => 'Structure 2 years · systems 1 year'],
            ],
        );
    }

    /**
     * @return array<int, array{src: ?string, alt: string, label: string, spec: string, class: string}>
     */
    public static function teamImages(): array
    {
        return Locale::pickAny(
            [
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
            ],
            [
                [
                    'src' => null,
                    'alt' => 'Crew performing structural work on site',
                    'label' => 'Site crew',
                    'spec' => '1200×800',
                    'class' => 'h-[clamp(220px,30vw,300px)]',
                ],
                [
                    'src' => null,
                    'alt' => 'Earthmoving equipment on a project site',
                    'label' => 'Site equipment',
                    'spec' => '1200×800',
                    'class' => 'h-[clamp(180px,24vw,240px)]',
                ],
            ],
        );
    }

    public static function processEyebrow(): string
    {
        return Locale::pick('ขั้นตอนการทำงาน', 'How we work');
    }

    public static function processTitle(): string
    {
        return Locale::pick(
            'ห้าขั้นจากรูปหน้างานถึงส่งมอบ',
            'Five steps from site photos to handover',
        );
    }

    /**
     * @return array<int, array{no: string, title: string, body: string}>
     */
    public static function processSteps(): array
    {
        return Locale::pickAny(
            [
                ['no' => 'ขั้นที่ 1', 'title' => 'ดูรูปและประเมินเบื้องต้น', 'body' => 'ส่งรูปพื้นที่ ความสูงดิน และแนวเขต ได้ช่วงราคาคร่าว ๆ ภายใน 1 วันทำการ'],
                ['no' => 'ขั้นที่ 2', 'title' => 'เข้าสำรวจหน้างาน', 'body' => 'วัดระดับ ตรวจสภาพชั้นดินและทางเข้าเครื่องจักร ไม่มีค่าใช้จ่ายในพื้นที่ที่เรารับงาน'],
                ['no' => 'ขั้นที่ 3', 'title' => 'แบบและใบเสนอราคา', 'body' => 'ใบเสนอราคาแยกรายการวัสดุและแรงงาน พร้อมแบบที่วิศวกรลงนาม'],
                ['no' => 'ขั้นที่ 4', 'title' => 'ทำงานและรายงานความคืบหน้า', 'body' => 'รายงานภาพหน้างานเป็นระยะ ระบุงานที่เสร็จและงานที่ค้างพร้อมเหตุผล'],
                ['no' => 'ขั้นที่ 5', 'title' => 'ส่งมอบพร้อมเอกสาร', 'body' => 'ตรวจ Defect ร่วมกัน แก้ให้เรียบร้อยก่อนปิดงวดสุดท้าย พร้อมเอกสารรับประกัน'],
            ],
            [
                ['no' => 'Step 1', 'title' => 'Review photos and rough estimate', 'body' => 'Send site photos, soil height, and boundary lines — get a price range within 1 business day'],
                ['no' => 'Step 2', 'title' => 'On-site survey', 'body' => 'Level check, soil layers, and machine access — free in our service area'],
                ['no' => 'Step 3', 'title' => 'Drawings and quotation', 'body' => 'Itemized materials and labour with engineer-signed drawings'],
                ['no' => 'Step 4', 'title' => 'Build with progress reports', 'body' => 'Periodic site photos with completed and pending work plus reasons'],
                ['no' => 'Step 5', 'title' => 'Handover with documents', 'body' => 'Joint defect inspection; fixes before final payment, with warranty papers'],
            ],
        );
    }

    public static function companyEyebrow(): string
    {
        return Locale::pick('ข้อมูลบริษัท', 'Company details');
    }

    public static function companyTitle(): string
    {
        return Locale::pick(
            'ตรวจสอบเราได้ก่อนเซ็นสัญญา',
            'Verify us before you sign',
        );
    }

    /**
     * @return array<int, array{label: string, value: string}>
     */
    public static function companyFacts(): array
    {
        return Locale::pickAny(
            [
                ['label' => 'ชื่อจดทะเบียน', 'value' => (string) config('company.legal_name')],
                ['label' => 'เลขผู้เสียภาษี', 'value' => (string) config('company.tax_id')],
                ['label' => 'ก่อตั้ง', 'value' => 'พ.ศ. '.config('company.founding_year')],
                ['label' => 'ที่ตั้งสำนักงาน', 'value' => Company::addressDisplay()],
                ['label' => 'เวลาทำการ', 'value' => Company::hoursDisplay()],
            ],
            [
                ['label' => 'Legal name', 'value' => (string) config('company.legal_name')],
                ['label' => 'Tax ID', 'value' => (string) config('company.tax_id')],
                ['label' => 'Founded', 'value' => (string) config('company.founding_year')],
                ['label' => 'Office', 'value' => Company::addressDisplay()],
                ['label' => 'Hours', 'value' => Company::hoursDisplay()],
            ],
        );
    }

    public static function ctaTitle(): string
    {
        return Locale::pick(
            'อยากรู้ว่าเราทำงานยังไง ให้ดูหน้างานจริง',
            'Want to see how we work? Start with real site photos',
        );
    }

    public static function ctaBody(): string
    {
        return Locale::pick(
            'ส่งรูปพื้นที่ ความสูงดิน และแนวเขตที่ดินมาทางไลน์ ทีมช่างจะบอกแนวทางงาน ฐานรากที่ควรใช้ และช่วงราคาคร่าว ๆ ก่อนนัดเข้าสำรวจ โดยไม่มีค่าใช้จ่าย',
            'Send site photos, soil height, and boundary lines via LINE. Our team will outline the approach, suitable foundation, and a rough price range before scheduling a free survey.',
        );
    }
}
