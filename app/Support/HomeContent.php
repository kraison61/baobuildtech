<?php

namespace App\Support;

/**
 * เนื้อหาหน้าแรก v2 — แหล่งเดียวสำหรับ Blade และ JSON-LD
 * (FAQ ใน schema ต้องตรงกับที่แสดงบนหน้าทุกตัวอักษร)
 */
class HomeContent
{
    public static function metaTitle(): string
    {
        return Locale::pick(
            'รับเหมาก่อสร้างครบวงจร กรุงเทพฯ-ปริมณฑล วิศวกรคุมงานเอง | '.config('company.brand_name'),
            'Full-service construction contractor in Bangkok — engineer-led site control | '.config('company.brand_name'),
        );
    }

    public static function metaDescription(): string
    {
        return Locale::pick(
            'รับเหมาครบวงจร ถมดิน โครงสร้าง อลูมิเนียม ไฟฟ้า ประปา ไอที จบในสัญญาเดียว วิศวกรลงหน้างานเอง BOQ แยกรายการทุกบาท กันงวดสุดท้ายไว้หลังตรวจรับ ประเมินฟรี',
            'Full-package contracting: earthwork, structure, aluminium, electrical, plumbing, and IT under one contract. Licensed engineers on site, itemized BOQ, final payment held until handover. Free estimate.',
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
                ['value' => '2 ปี', 'label' => 'รับประกันงานโครงสร้าง ระบุในสัญญา'],
            ],
            [
                ['value' => '20+ yrs', 'label' => 'Engineer experience supervising work on site'],
                ['value' => '4 disciplines', 'label' => 'Civil · Project management · Aluminium · IT'],
                ['value' => '2 years', 'label' => 'Structural warranty stated in the contract'],
            ],
        );
    }

    /**
     * @return array<int, string>
     */
    public static function concerns(): array
    {
        return Locale::pickAny(
            [
                'จ่ายมัดจำไปแล้ว งานหยุดกลางคัน โทรตามแล้วเงียบ',
                'ราคาเหมารวมก้อนเดียว พอถึงหน้างานมีค่าเพิ่มตลอด',
                'โครงสร้างเสร็จแล้วช่างหายไป ต้องหาช่างอลูมิเนียม ช่างไฟ ช่างเน็ตต่อเอง พอมีปัญหาก็โทษกันไปมา',
                'ติดหน้าต่างเสร็จสวยดี พอฝนสาดครั้งแรกน้ำรั่วเข้าตามขอบวงกบ',
            ],
            [
                'Deposit paid, work stalled mid-project, calls go unanswered',
                'One lump-sum price — then extras keep appearing once work starts',
                'Structure finished, trades vanish; you chase aluminium, electrical, and network contractors yourself — and they blame each other',
                'Windows look fine until the first heavy rain leaks through the frame edges',
            ],
        );
    }

    /**
     * @return array<int, array{fear: string, fix: string}>
     */
    public static function concernFixes(): array
    {
        return Locale::pickAny(
            [
                [
                    'fear' => 'ทิ้งงานกลางคัน',
                    'fix' => 'งวดงานผูกกับเนื้องานที่ตรวจได้ ไม่ใช่ผูกกับปฏิทิน และทุกสัญญากันงวดสุดท้ายไว้จนหลังตรวจรับ สัดส่วนระบุชัดในสัญญาแต่ละโครงการ',
                ],
                [
                    'fear' => 'ราคาบวกทีหลัง',
                    'fix' => 'BOQ แยกรายการทุกหมวด ระบุชัดว่าอะไรไม่รวมในราคา และเขียนเงื่อนไขงานเพิ่ม-งานลดไว้ในสัญญา',
                ],
                [
                    'fear' => 'งานต่อไม่ติด',
                    'fix' => 'โครงสร้าง อลูมิเนียม ไฟฟ้า ประปา ไอที อยู่ในสัญญาเดียวและความรับผิดชอบเดียว',
                ],
                [
                    'fear' => 'วิศวกรเซ็นแบบแล้วหาย',
                    'fix' => 'วิศวกรผู้ถือใบอนุญาตคือคนคุมหน้างานเอง ขอดูสำเนาใบอนุญาตได้ก่อนเซ็นสัญญา',
                ],
                [
                    'fear' => 'ไม่พอใจงานแล้วแก้ไม่ได้',
                    'fix' => 'ตรวจ Defect ร่วมกับคุณ แก้ให้เรียบร้อยก่อนปิดงวดสุดท้าย พร้อมรับประกันเป็นลายลักษณ์อักษร โครงสร้าง 2 ปี งานระบบและสถาปัตยกรรม 1 ปี',
                ],
            ],
            [
                [
                    'fear' => 'Abandoned mid-project',
                    'fix' => 'Payments are tied to inspectable work stages — not the calendar — and every contract holds the final payment until after handover. Ratios are stated clearly per project.',
                ],
                [
                    'fear' => 'Hidden extras later',
                    'fix' => 'Itemized BOQ by category, clear exclusions, and written variation terms in the contract.',
                ],
                [
                    'fear' => 'Trades that do not connect',
                    'fix' => 'Structure, aluminium, electrical, plumbing, and IT stay under one contract and one accountability.',
                ],
                [
                    'fear' => 'Engineer stamps drawings then disappears',
                    'fix' => 'The licensed engineer is the same person supervising the site. You can review the license copy before signing.',
                ],
                [
                    'fear' => 'Defects left unresolved',
                    'fix' => 'Joint defect inspection; fixes completed before the final payment, with written warranty — 2 years structure, 1 year systems and architectural works.',
                ],
            ],
        );
    }

    /**
     * @return array<int, array{title: string, body: string}>
     */
    public static function reasons(): array
    {
        return Locale::pickAny(
            [
                [
                    'title' => 'งวดงานผูกกับเนื้องาน ไม่ใช่ผูกกับเวลา',
                    'body' => 'คุณจ่ายเมื่องานเสร็จตามที่ตกลงและตรวจได้จริง ไม่ใช่จ่ายตามวันที่ในปฏิทิน และทุกสัญญาจะกันงวดสุดท้ายไว้จนหลังตรวจรับ',
                ],
                [
                    'title' => 'ราคาโปร่งใส เห็นทุกบาทว่าไปอยู่ตรงไหน',
                    'body' => 'ใบเสนอราคามาพร้อม BOQ แยกรายการเป็นหมวด คุณรู้ก่อนเซ็นว่าอะไรรวมและอะไรไม่รวม ไม่ใช่รู้ตอนงานเดินไปครึ่งทาง',
                ],
                [
                    'title' => 'วิศวกรที่เซ็นแบบ คือคนเดียวกับที่ลงหน้างาน',
                    'body' => 'ไม่ใช่การจ้างวิศวกรภายนอกมาเซ็นแบบตอนขออนุญาตแล้วไม่เคยเห็นหน้าอีกเลย',
                ],
                [
                    'title' => 'จบเจ้าเดียว ไม่ต้องเป็นคนกลางประสานเอง',
                    'body' => 'ปัญหาอย่างก่อผนังเสร็จแล้วต้องสกัดใหม่เพราะลืมท่อร้อยสาย หรือช่างอลูมิเนียมมาวัดช่องเปิดทีหลังแล้วเจอผนังไม่ได้ฉาก จะไม่เกิดเมื่อทีมเดียวกันวางแผนทั้งหมดตั้งแต่วันแรก',
                ],
                [
                    'title' => 'คุณรู้ตลอดว่างานอยู่ตรงไหน โดยไม่ต้องโทรตาม',
                    'body' => 'มีแผนงานและรายงานความคืบหน้าเป็นระยะ ตามวิธีบริหารโครงการที่ทีมเราใช้กับงานระดับองค์กรมากว่า 20 ปี',
                ],
                [
                    'title' => 'เราบอกตรง ๆ ว่างานแบบไหนเราไม่รับ',
                    'body' => 'เรารับออกแบบและคำนวณโครงสร้างอาคารสูงไม่เกิน 4 ชั้น และควบคุมงานก่อสร้างไม่เกิน 8 ชั้น ตามขอบเขตข้อบังคับสภาวิศวกร ถ้าโครงการใหญ่กว่านั้น เราจัดสามัญวิศวกรหรือวุฒิวิศวกรลงนามร่วมให้ถูกต้อง เราเลือกบอกไว้บนหน้าเว็บ แทนที่จะรอให้คุณมาถามทีหลัง',
                ],
            ],
            [
                [
                    'title' => 'Payments follow completed work — not the calendar',
                    'body' => 'You pay when agreed, inspectable work is done — not on a date in the calendar. Every contract holds the final payment until after handover.',
                ],
                [
                    'title' => 'Transparent pricing — you see where every baht goes',
                    'body' => 'Quotes come with a categorized BOQ. You know inclusions and exclusions before signing — not halfway through the job.',
                ],
                [
                    'title' => 'The engineer who stamps drawings is on site',
                    'body' => 'Not an outside stamp for permits who never appears again.',
                ],
                [
                    'title' => 'One contractor — you are not the coordinator',
                    'body' => 'Issues like cutting finished walls for forgotten conduits, or aluminium crews measuring openings that are out of square, are avoided when one team plans everything from day one.',
                ],
                [
                    'title' => 'You always know where the work stands — without chasing calls',
                    'body' => 'Schedules and progress reports follow the project-management approach our team has used on enterprise work for 20+ years.',
                ],
                [
                    'title' => 'We say plainly which jobs we will not take',
                    'body' => 'We design and calculate structures up to 4 storeys and supervise construction up to 8 storeys per Council of Engineers rules. Larger projects get co-signing by appropriately licensed engineers. We state this on the site instead of waiting for you to ask.',
                ],
            ],
        );
    }

    /**
     * @return array<int, array{label: string, icon: string}>
     */
    public static function timelinePhases(): array
    {
        return Locale::pickAny(
            [
                ['label' => 'เคลียริ่ง-ถมดิน', 'icon' => 'clearing'],
                ['label' => 'สำรวจดิน-ออกแบบ-ขออนุญาต', 'icon' => 'survey'],
                ['label' => 'ฐานราก-เสาเข็ม', 'icon' => 'foundation'],
                ['label' => 'โครงสร้าง คสล.', 'icon' => 'structure'],
                ['label' => 'สถาปัตยกรรม-อลูมิเนียม', 'icon' => 'aluminium'],
                ['label' => 'ไฟฟ้า-ประปา', 'icon' => 'mep'],
                ['label' => 'IT Infrastructure', 'icon' => 'it'],
                ['label' => 'ตรวจรับ-รับประกัน', 'icon' => 'handover'],
            ],
            [
                ['label' => 'Clearing & filling', 'icon' => 'clearing'],
                ['label' => 'Survey, design, permits', 'icon' => 'survey'],
                ['label' => 'Foundation & piles', 'icon' => 'foundation'],
                ['label' => 'RC structure', 'icon' => 'structure'],
                ['label' => 'Architecture & aluminium', 'icon' => 'aluminium'],
                ['label' => 'Electrical & plumbing', 'icon' => 'mep'],
                ['label' => 'IT Infrastructure', 'icon' => 'it'],
                ['label' => 'Handover & warranty', 'icon' => 'handover'],
            ],
        );
    }

    /**
     * @return array<int, array{title: string, body: string}>
     */
    public static function team(): array
    {
        return Locale::pickAny(
            [
                [
                    'title' => 'วิศวกรผู้ควบคุมงาน',
                    'body' => 'คุมงานบ้านพักอาศัยและอาคารพาณิชย์มากว่า 20 ปี ถือใบอนุญาตประกอบวิชาชีพวิศวกรรมควบคุม สาขาวิศวกรรมโยธา ระดับภาคีวิศวกร เป็นผู้ออกแบบ คำนวณโครงสร้าง และลงคุมหน้างานเอง',
                ],
                [
                    'title' => 'ผู้บริหารโครงการ',
                    'body' => 'บริหารโครงการระดับองค์กรมากว่า 20 ปี ถือวุฒิบัตร PMP, CGEIT, RMP — แปลเป็นภาษาหน้างานคือคุณจะได้แผนงานที่มีวันที่จริง และการเตือนล่วงหน้าเมื่อมีอะไรจะกระทบกำหนดส่งมอบ',
                ],
                [
                    'title' => 'ผู้เชี่ยวชาญ IT Infrastructure',
                    'body' => 'วางระบบเครือข่ายและกล้องวงจรปิดให้องค์กรขนาดใหญ่ ตั้งแต่ออกแบบผังจุดติดตั้ง เดินสายตั้งแต่ระยะโครงสร้าง จนส่งมอบระบบที่เปิดใช้ได้ทันที',
                ],
            ],
            [
                [
                    'title' => 'Supervising engineer',
                    'body' => '20+ years controlling residential and commercial builds. Licensed professional civil engineer (Associate level) — designs, calculates structure, and supervises the site personally.',
                ],
                [
                    'title' => 'Project manager',
                    'body' => '20+ years of enterprise project management with PMP, CGEIT, and RMP credentials — meaning real dates on the plan and early warnings when delivery risk appears.',
                ],
                [
                    'title' => 'IT infrastructure specialist',
                    'body' => 'Designs networks and CCTV for large organizations — from layout planning and rough-in cabling through systems ready to use at handover.',
                ],
            ],
        );
    }

    /**
     * @return array<int, array{title: string, items: array<int, array{label: string, href: string}>}>
     */
    public static function serviceGroups(): array
    {
        $item = static fn (string $c, string $s, string $i): string => Locale::route('services.items.show', [$c, $s, $i]);
        $svc = static fn (string $c, string $s): string => Locale::route('services.show', [$c, $s]);

        return Locale::pickAny(
            [
                [
                    'title' => 'งานเตรียมพื้นที่และงานโยธา',
                    'items' => [
                        ['label' => 'งานเคลียร์ริ่งพื้นที่', 'href' => $item('civil', 'earthwork', 'land-clearing')],
                        ['label' => 'ถมดินและปรับระดับ', 'href' => $item('civil', 'earthwork', 'land-filling')],
                        ['label' => 'ฐานรากและเสาเข็ม', 'href' => $svc('civil', 'piles-foundation')],
                        ['label' => 'กำแพงกันดินและรั้ว', 'href' => $item('civil', 'structure', 'retaining-wall')],
                    ],
                ],
                [
                    'title' => 'งานก่อสร้างอาคาร',
                    'items' => [
                        ['label' => 'รับสร้างบ้าน', 'href' => $svc('civil', 'structure')],
                        ['label' => 'อาคารพาณิชย์', 'href' => $svc('civil', 'structure')],
                        ['label' => 'ต่อเติมและปรับปรุง', 'href' => $svc('civil', 'construction-mgmt')],
                        ['label' => 'ออกแบบและขออนุญาต', 'href' => $svc('civil', 'survey')],
                    ],
                ],
                [
                    'title' => 'งานอลูมิเนียมและกระจก',
                    'items' => [
                        ['label' => 'รับเหมางานอลูมิเนียมครบวงจร', 'href' => $svc('architecture', 'aluminum-works')],
                        ['label' => 'ประตูหน้าต่างอลูมิเนียมและงานกระจก', 'href' => $item('architecture', 'aluminum-works', 'aluminium-door-window')],
                    ],
                ],
                [
                    'title' => 'งานระบบและไอที',
                    'items' => [
                        ['label' => 'ระบบไฟฟ้าอาคาร', 'href' => $svc('mechanical-and-electrical-work', 'electrical')],
                        ['label' => 'ติดตั้งโซล่าเซลล์', 'href' => $item('mechanical-and-electrical-work', 'electrical', 'solar-cell-installation')],
                        ['label' => 'IT Infrastructure', 'href' => $svc('mechanical-and-electrical-work', 'network-cabling')],
                        ['label' => 'กล้องวงจรปิด', 'href' => $svc('mechanical-and-electrical-work', 'cctv')],
                    ],
                ],
            ],
            [
                [
                    'title' => 'Site preparation & civil works',
                    'items' => [
                        ['label' => 'Land clearing', 'href' => $item('civil', 'earthwork', 'land-clearing')],
                        ['label' => 'Land filling & grading', 'href' => $item('civil', 'earthwork', 'land-filling')],
                        ['label' => 'Foundation & piles', 'href' => $svc('civil', 'piles-foundation')],
                        ['label' => 'Retaining walls & fencing', 'href' => $item('civil', 'structure', 'retaining-wall')],
                    ],
                ],
                [
                    'title' => 'Building construction',
                    'items' => [
                        ['label' => 'House construction', 'href' => $svc('civil', 'structure')],
                        ['label' => 'Commercial buildings', 'href' => $svc('civil', 'structure')],
                        ['label' => 'Extensions & renovation', 'href' => $svc('civil', 'construction-mgmt')],
                        ['label' => 'Design & permits', 'href' => $svc('civil', 'survey')],
                    ],
                ],
                [
                    'title' => 'Aluminium & glass',
                    'items' => [
                        ['label' => 'Full aluminium contracting', 'href' => $svc('architecture', 'aluminum-works')],
                        ['label' => 'Aluminium doors, windows & glazing', 'href' => $item('architecture', 'aluminum-works', 'aluminium-door-window')],
                    ],
                ],
                [
                    'title' => 'Systems & IT',
                    'items' => [
                        ['label' => 'Building electrical systems', 'href' => $svc('mechanical-and-electrical-work', 'electrical')],
                        ['label' => 'Solar installation', 'href' => $item('mechanical-and-electrical-work', 'electrical', 'solar-cell-installation')],
                        ['label' => 'IT Infrastructure', 'href' => $svc('mechanical-and-electrical-work', 'network-cabling')],
                        ['label' => 'CCTV', 'href' => $svc('mechanical-and-electrical-work', 'cctv')],
                    ],
                ],
            ],
        );
    }

    /**
     * @return array<int, string>
     */
    public static function schemaServiceNames(): array
    {
        $names = [];

        foreach (self::serviceGroups() as $group) {
            foreach ($group['items'] as $item) {
                $names[] = $item['label'];
            }
        }

        return $names;
    }

    /**
     * @return array<int, array{no: string, title: string, body: string}>
     */
    public static function processSteps(): array
    {
        return Locale::pickAny(
            [
                ['no' => '01', 'title' => 'ติดต่อและเล่าความต้องการ', 'body' => 'โทรหรือ LINE'],
                ['no' => '02', 'title' => 'เข้าดูหน้างานและประเมินฟรี', 'body' => 'กรุงเทพฯ และปริมณฑล'],
                ['no' => '03', 'title' => 'เสนอ BOQ และใบเสนอราคา', 'body' => 'แยกรายการชัดเจน ภายใน 3 วันทำการ'],
                ['no' => '04', 'title' => 'เซ็นสัญญาและแบ่งงวดงาน', 'body' => 'ระบุขอบเขต ระยะเวลา ค่าปรับล่าช้า และเงื่อนไขงานเพิ่ม-งานลด'],
                ['no' => '05', 'title' => 'ก่อสร้างพร้อมรายงานความคืบหน้า', 'body' => 'วิศวกรควบคุมงานตลอดโครงการ'],
                ['no' => '06', 'title' => 'ตรวจรับและส่งมอบ', 'body' => 'ตรวจ Defect ร่วมกัน แก้ให้เรียบร้อยก่อนปิดงวดสุดท้าย'],
            ],
            [
                ['no' => '01', 'title' => 'Contact us and share your needs', 'body' => 'Call or LINE'],
                ['no' => '02', 'title' => 'Free site visit and estimate', 'body' => 'Bangkok and surrounding provinces'],
                ['no' => '03', 'title' => 'BOQ and quotation', 'body' => 'Clear line items within 3 business days'],
                ['no' => '04', 'title' => 'Contract and payment stages', 'body' => 'Scope, timeline, delay penalties, and variation terms'],
                ['no' => '05', 'title' => 'Build with progress reports', 'body' => 'Engineer supervision throughout the project'],
                ['no' => '06', 'title' => 'Inspection and handover', 'body' => 'Joint defect check; fixes before final payment'],
            ],
        );
    }

    public static function serviceAreaText(): string
    {
        return Locale::pick(
            'พื้นที่ให้บริการ: กรุงเทพมหานคร นนทบุรี ปทุมธานี สมุทรปราการ สมุทรสาคร และนครปฐม เข้าประเมินหน้างานฟรี สำหรับต่างจังหวัดรับงานได้ทั่วประเทศ อาจมีค่าเดินทางสำรวจหน้างาน แต่หักลดกับราคางานได้หากตกลงจ้าง',
            'Service area: Bangkok, Nonthaburi, Pathum Thani, Samut Prakan, Samut Sakhon, and Nakhon Pathom — free on-site estimates. Nationwide projects accepted; survey travel may apply and can be credited if you hire us.',
        );
    }

    /**
     * @return array<int, string>
     */
    public static function serviceAreas(): array
    {
        return Company::serviceAreas();
    }

    /**
     * @return array<int, array{q: string, a: string, open?: bool, schema?: bool}>
     */
    public static function faqs(): array
    {
        return Locale::pickAny(
            [
                [
                    'q' => 'ราคาประมาณเท่าไหร่',
                    'a' => 'ราคาจริงขึ้นกับสภาพดิน ระดับวัสดุ และแบบที่เลือก เราคิดจากปริมาณงานจริงตาม BOQ ไม่ใช่เหมารวมก้อนเดียว ส่งรูปที่ดินหรือแบบมาทางไลน์ เราตีราคาเบื้องต้นให้ฟรี',
                    'open' => true,
                ],
                [
                    'q' => 'ถ้างานหยุดกลางคัน ลูกค้าได้ความคุ้มครองอะไร',
                    'a' => 'สัญญาระบุขอบเขตงาน กำหนดส่งมอบ ค่าปรับความล่าช้า และแบ่งงวดตามเนื้องานที่ตรวจได้ พร้อมกันงวดสุดท้ายไว้จ่ายหลังตรวจรับ',
                    'schema' => true,
                ],
                [
                    'q' => 'รับงานเฉพาะบางส่วนได้ไหม',
                    'a' => 'ได้ครับ ลูกค้าจำนวนมากจ้างเราเฉพาะงานถมดิน กำแพงกันดิน เปลี่ยนประตูหน้าต่างอลูมิเนียม หรืองานระบบไฟฟ้าและไอทีของอาคารที่สร้างเสร็จแล้ว การจ้างครบวงจรเป็นทางเลือก ไม่ใช่เงื่อนไขบังคับ',
                    'schema' => true,
                ],
                [
                    'q' => 'มีวิศวกรควบคุมงานจริงหรือไม่ รับอาคารได้สูงกี่ชั้น',
                    'a' => 'มีครับ งานโครงสร้างทุกโครงการควบคุมโดยวิศวกรผู้ถือใบอนุญาตประกอบวิชาชีพวิศวกรรมควบคุม สาขาวิศวกรรมโยธา ประสบการณ์กว่า 20 ปี และเป็นผู้ลงหน้างานเอง เรารับออกแบบและคำนวณโครงสร้างอาคารสูงไม่เกิน 4 ชั้น ควบคุมงานก่อสร้างไม่เกิน 8 ชั้น ตามข้อบังคับสภาวิศวกร โครงการที่ใหญ่กว่านั้นจัดสามัญวิศวกรหรือวุฒิวิศวกรลงนามร่วม ขอดูสำเนาใบอนุญาตได้ก่อนเซ็นสัญญา',
                    'schema' => true,
                ],
                [
                    'q' => 'ยังไม่มีแบบ ยังไม่รู้จะเริ่มยังไง คุยได้ไหม',
                    'a' => 'ได้ครับ ลูกค้าส่วนใหญ่เริ่มจากจุดนี้ มีแค่โฉนดหรือรูปที่ดินก็คุยกันได้ เราช่วยดูตั้งแต่ว่าที่ดินต้องถมเท่าไหร่ ต้องขออนุญาตอะไรบ้าง และควรตั้งงบไว้ประมาณเท่าไหร่',
                    'schema' => true,
                ],
            ],
            [
                [
                    'q' => 'How much will it cost?',
                    'a' => 'Price depends on soil conditions, material grade, and the design. We price from real quantities in a BOQ — not a vague lump sum. Send land photos or drawings via LINE for a free preliminary estimate.',
                    'open' => true,
                ],
                [
                    'q' => 'If work stops mid-project, what protection do I have?',
                    'a' => 'The contract states scope, delivery dates, delay penalties, and stage payments tied to inspectable work, with the final payment held until after handover.',
                    'schema' => true,
                ],
                [
                    'q' => 'Can you take only part of the job?',
                    'a' => 'Yes. Many clients hire us only for filling, retaining walls, aluminium doors and windows, or electrical/IT for finished buildings. Full-package contracting is optional — not required.',
                    'schema' => true,
                ],
                [
                    'q' => 'Do you have a real supervising engineer? How many storeys?',
                    'a' => 'Yes. Every structural project is controlled by a licensed civil engineer with 20+ years of experience who works on site. We design/calculate up to 4 storeys and supervise construction up to 8 storeys per Council of Engineers rules. Larger projects get co-signing by appropriately licensed engineers. License copies are available before signing.',
                    'schema' => true,
                ],
                [
                    'q' => 'I have no drawings and do not know where to start — can we talk?',
                    'a' => 'Yes. Most clients start here. A title deed or land photos are enough. We help estimate fill height, permits, and a realistic budget.',
                    'schema' => true,
                ],
            ],
        );
    }

    /**
     * @return array<int, array{q: string, a: string}>
     */
    public static function schemaFaqs(): array
    {
        return array_values(array_filter(
            self::faqs(),
            static fn (array $faq): bool => ($faq['schema'] ?? false) === true,
        ));
    }

    public static function heroHeadline(): string
    {
        return Locale::pick(
            'รับเหมาก่อสร้างครบวงจร กรุงเทพฯ และปริมณฑล — วิศวกรลงหน้างานเอง จบครบในสัญญาเดียว',
            'Full-service construction in Bangkok and surrounding provinces — engineer on site, one contract end to end',
        );
    }

    public static function heroLead(): string
    {
        return Locale::pick(
            'ตั้งแต่ที่ดินเปล่าจนถึงวันเข้าอยู่ โครงสร้าง อลูมิเนียม ไฟฟ้า ประปา และระบบไอที อยู่ในความรับผิดชอบทีมเดียว',
            'From bare land to move-in day — structure, aluminium, electrical, plumbing, and IT under one team',
        );
    }

    public static function heroLeadAccent(): string
    {
        return Locale::pick(
            'งวดงานผูกกับเนื้องานที่ตรวจได้ และทุกสัญญากันงวดสุดท้ายไว้จนหลังตรวจรับ',
            'Payments follow inspectable work stages, and every contract holds the final payment until handover',
        );
    }

    public static function heroCtaPrimary(): string
    {
        return Locale::pick(
            'ส่งรูปหน้างานทางไลน์ — ประเมินราคาเบื้องต้นฟรี',
            'Send site photos on LINE — free preliminary estimate',
        );
    }

    public static function heroCtaPhone(): string
    {
        return Locale::pick('โทรคุยกับวิศวกร', 'Call an engineer');
    }

    public static function heroNote(): string
    {
        return Locale::pick(
            'ประเมินหน้างานฟรีในกรุงเทพฯ-ปริมณฑล · ไม่ผูกมัด · ขอดูสำเนาใบอนุญาตวิศวกรได้ก่อนตัดสินใจ',
            'Free site estimate in Bangkok and nearby provinces · no obligation · engineer license available before you decide',
        );
    }

    public static function heroBody1(): string
    {
        return Locale::pick(
            'BOA (Build Operate Assure) คือทีมรับเหมาก่อสร้างครบวงจรในกรุงเทพฯ ปริมณฑล และรับงานทั่วประเทศ ดูแลตั้งแต่ถมดิน ออกแบบ งานโครงสร้าง งานอลูมิเนียมและกระจก จนถึงระบบไฟฟ้า ประปา และ IT Infrastructure ในสัญญาเดียว',
            'BOA (Build Operate Assure) is a full-service construction team in Bangkok and surrounding provinces, and we take projects nationwide — from land filling and design through structure, aluminium and glass, electrical, plumbing, and IT infrastructure under one contract',
        );
    }

    public static function heroBody2(): string
    {
        return Locale::pick(
            'ทีมของเรามาจากคนทำงานจริงสามสาย — วิศวกรโยธาที่คุมงานมากว่า 20 ปี ผู้บริหารโครงการระดับองค์กร และผู้เชี่ยวชาญระบบเครือข่าย คุณจึงไม่ต้องเป็นคนกลางคอยประสานช่างหลายเจ้า และไม่ต้องรับความเสี่ยงเองเวลางานต่อไม่ติด',
            'Our team comes from three real working lines — a civil engineer with 20+ years on site, enterprise project managers, and network specialists. You do not have to coordinate multiple trades or carry the risk when work stages fail to connect',
        );
    }

    public static function heroImageAlt(): string
    {
        return Locale::pick(
            'ทีมวิศวกร BOA ตรวจงานโครงสร้างบ้านพักอาศัย กรุงเทพฯ',
            'BOA engineers inspecting residential structural work in Bangkok',
        );
    }

    public static function heroImageLabel(): string
    {
        return Locale::pick('Hero — หน้าแรก', 'Hero — Home');
    }

    public static function painTitle(): string
    {
        return Locale::pick(
            'ก่อนเซ็นสัญญากับผู้รับเหมา คุณกำลังกังวลเรื่องพวกนี้อยู่ใช่ไหม',
            'Before you sign with a contractor — are these the worries on your mind?',
        );
    }

    public static function painOutro(): string
    {
        return Locale::pick(
            'ทั้งหมดนี้คือเหตุผลที่ BOA ถูกตั้งขึ้นมา และเราออกแบบวิธีทำงานเพื่อปิดช่องทีละข้อ',
            'These are exactly why BOA exists — and why we designed our method to close each gap one by one',
        );
    }

    public static function painFearCol(): string
    {
        return Locale::pick('สิ่งที่คุณกลัว', 'What you fear');
    }

    public static function painFixCol(): string
    {
        return Locale::pick('วิธีที่ BOA ปิดช่อง', 'How BOA closes the gap');
    }

    public static function painCta(): string
    {
        return Locale::pick('ปรึกษาฟรี ไม่ผูกมัด', 'Free consultation — no obligation');
    }

    public static function proofEyebrow(): string
    {
        return Locale::pick('ผลงาน', 'Our work');
    }

    public static function proofTitle(): string
    {
        return Locale::pick('ผลงานล่าสุดของเรา', 'Recent projects');
    }

    public static function proofLead(): string
    {
        return Locale::pick(
            'ประเภทงาน + พื้นที่ + ระยะเวลา — หลักฐานก่อนคำอธิบาย',
            'Work type + location + timeline — evidence before explanation',
        );
    }

    public static function proofEmpty(): string
    {
        return Locale::pick(
            'กำลังรวบรวมรูป Before-After และตัวอย่าง BOQ จริง — สอบถามตัวอย่างงานที่เกี่ยวข้องได้โดยตรงทางไลน์',
            'We are gathering before/after photos and real BOQ samples — ask for relevant examples directly on LINE',
        );
    }

    public static function proofCta(): string
    {
        return Locale::pick('ดูผลงานทั้งหมดของ BOA', 'View all BOA projects');
    }

    public static function proofDelivered(): string
    {
        return Locale::pick('ส่งมอบ', 'Delivered');
    }

    public static function whyTitle(): string
    {
        return Locale::pick('ทำไมเจ้าของงานถึงเลือก BOA', 'Why owners choose BOA');
    }

    public static function phasesTitle(): string
    {
        return Locale::pick(
            'จากที่ดินเปล่าถึงวันเข้าอยู่ — 8 ขั้นตอนที่เราดูแลให้',
            'From bare land to move-in — eight stages we cover',
        );
    }

    public static function phasesAria(): string
    {
        return Locale::pick(
            '8 ขั้นตอนจากที่ดินเปล่าถึงวันเข้าอยู่',
            'Eight stages from bare land to move-in',
        );
    }

    public static function phasesNote(): string
    {
        return Locale::pick(
            'รับครบทั้ง 8 ขั้นในสัญญาเดียว หรือเลือกจ้างเฉพาะบางขั้นก็ได้',
            'Take all eight stages in one contract — or hire only the stages you need',
        );
    }

    public static function phasesCta(): string
    {
        return Locale::pick('ดูรายละเอียดแต่ละขั้นตอน', 'See details for each stage');
    }

    public static function servicesTitle(): string
    {
        return Locale::pick('บริการของเรา', 'Our services');
    }

    public static function servicesNoteLead(): string
    {
        return Locale::pick('รับเป็นงานเดี่ยวได้ทุกรายการ', 'Every item can be hired on its own');
    }

    public static function servicesNoteBody(): string
    {
        return Locale::pick(
            ' ไม่จำเป็นต้องจ้างครบวงจร ลูกค้าจำนวนมากเริ่มจากงานเล็กอย่างเปลี่ยนประตูหน้าต่างอลูมิเนียมหรือถมดินก่อน แล้วค่อยกลับมาคุยเรื่องงานใหญ่ทีหลัง',
            ' — a full package is optional. Many clients start with a smaller job such as aluminium doors and windows or land filling, then return for larger work later',
        );
    }

    public static function aboutTitle(): string
    {
        return Locale::pick('BOA คือใคร', 'Who is BOA');
    }

    public static function aboutP1Html(): string
    {
        return Locale::pick(
            'BOA ย่อมาจาก <strong class="font-semibold text-ink">Build Operate Assure</strong> สะท้อนวิธีทำงานสามขั้นของเรา คือสร้างให้ได้มาตรฐาน ส่งมอบระบบที่ใช้งานได้จริง และตรวจสอบให้มั่นใจ',
            'BOA stands for <strong class="font-semibold text-ink">Build Operate Assure</strong> — three steps: build to standard, hand over systems that work, and verify with confidence',
        );
    }

    public static function aboutP2(): string
    {
        return Locale::pick(
            'ปัญหาที่เจ้าของงานเจอบ่อยที่สุดคือ ผู้รับเหมาโครงสร้างจบงานแล้วโยนต่อให้เจ้าของบ้านไปหาช่างอลูมิเนียม ช่างไฟ ช่างเน็ต ช่างกล้องเอง พอมีปัญหาก็โทษกันไปมา BOA ตั้งขึ้นมาเพื่อปิดช่องนี้โดยเฉพาะ',
            'The most common owner problem: the structural contractor finishes and leaves you to find aluminium, electrical, network, and CCTV trades yourself — who then blame each other. BOA was built to close that gap',
        );
    }

    public static function processTitle(): string
    {
        return Locale::pick('เริ่มงานกับเรายังไง', 'How to start with us');
    }

    public static function faqTitle(): string
    {
        return Locale::pick('คำถามที่พบบ่อย', 'Frequently asked questions');
    }

    public static function ctaTitle(): string
    {
        return Locale::pick(
            'เล่าให้เราฟังก่อนก็ได้ ยังไม่ต้องตัดสินใจอะไรทั้งนั้น',
            'Tell us the situation first — no decision required yet',
        );
    }

    public static function ctaBody(): string
    {
        return Locale::pick(
            'ส่งรูปที่ดิน แบบบ้าน หรือรูปช่องประตูหน้าต่างที่อยากเปลี่ยน มาทางไลน์ เราจะดูให้ว่าเป็นไปได้แค่ไหน ต้องเตรียมงบประมาณเท่าไหร่ และมีอะไรควรระวังตั้งแต่ตอนนี้ ถ้าต้องการตัวเลขจริง เราเข้าไปดูหน้างานและทำใบเสนอราคาพร้อม BOQ ให้ โดยไม่มีค่าใช้จ่ายและไม่ผูกมัด',
            'Send land photos, house drawings, or door/window openings via LINE. We will tell you what is feasible, what budget to prepare, and what to watch for now. If you need real numbers, we visit the site and prepare a quotation with BOQ — free and with no obligation',
        );
    }

    public static function ctaLine(): string
    {
        return Locale::pick('ทักไลน์ ส่งรูปหน้างาน ประเมินฟรี', 'Message on LINE — free site estimate');
    }

    public static function ctaPhone(): string
    {
        return Locale::pick('โทรคุยกับวิศวกร', 'Call an engineer');
    }

    public static function ctaPhoneLabel(): string
    {
        return Locale::pick('โทร', 'Call');
    }

    public static function ctaEmailLabel(): string
    {
        return Locale::pick('อีเมล', 'Email');
    }

    public static function ctaHoursLabel(): string
    {
        return Locale::pick('เวลาทำการ', 'Hours');
    }

    public static function ctaAddressLabel(): string
    {
        return Locale::pick('ที่อยู่', 'Address');
    }

    public static function trustAria(): string
    {
        return Locale::pick('ตัวเลขสำคัญ', 'Key figures');
    }
}
