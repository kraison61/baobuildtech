<?php

/**
 * ชั้นแสดงผลหมวดงานบริการ (IA ฝั่งลูกค้า)
 * จัดกลุ่ม/ชื่อ/ลำดับเท่านั้น — ไม่เปลี่ยน slug / URL / route name
 *
 * บริการที่ยังไม่ publish จะถูกข้ามอัตโนมัติตอน hydrate
 */

return [
    'menu_intro' => [
        'th' => 'งานบริการ — คุณกำลังจะเริ่มอะไร?',
        'en' => 'Services — where are you starting?',
    ],

    'groups' => [
        [
            'key' => 'demolition-prep',
            'number' => 1,
            'label' => [
                'th' => 'รื้อถอน & เตรียมที่ดิน',
                'en' => 'Demolition & site prep',
            ],
            'description' => [
                'th' => 'มีบ้านเก่าหรือที่ดินต้องเคลียร์ก่อนสร้าง',
                'en' => 'Clear an old building or prepare the land before building',
            ],
            'service_slugs' => [
                'house-demolition',
                'earthwork',
                'buy-old-air-conditioner',
            ],
        ],
        [
            'key' => 'foundation-structure',
            'number' => 2,
            'label' => [
                'th' => 'ฐานรากและโครงสร้าง',
                'en' => 'Foundation & structure',
            ],
            'description' => [
                'th' => 'วางฐานให้มั่นก่อนขึ้นโครงอาคาร',
                'en' => 'Set a solid foundation before the building frame',
            ],
            'service_slugs' => [
                'survey',
                'piles-foundation',
                'structure',
            ],
        ],
        [
            'key' => 'architecture-finish',
            'number' => 3,
            'label' => [
                'th' => 'งานสถาปัตย์ปิดงาน',
                'en' => 'Architectural finishing',
            ],
            'description' => [
                'th' => 'ปิดงานให้ใช้งานได้จริง — ประตู หน้าต่าง กันสาด ร้าน',
                'en' => 'Finish the job — doors, windows, awnings, shop fit-out',
            ],
            'service_slugs' => [
                'aluminum-works',
                'shop-design',
            ],
        ],
        [
            'key' => 'systems',
            'number' => 4,
            'label' => [
                'th' => 'งานระบบในโครงการเดียวกัน',
                'en' => 'Systems in the same project',
            ],
            'description' => [
                'th' => 'ไฟฟ้าและโซล่า — รับเมื่อทำร่วมงานโครงสร้าง',
                'en' => 'Electrical and solar — with structural work only',
            ],
            'badge' => [
                'th' => 'รับเมื่อทำร่วมงานโครงสร้าง',
                'en' => 'Only with structural work',
            ],
            'service_slugs' => [
                'electrical',
                'network-cabling',
                'cctv',
            ],
        ],
        [
            'key' => 'truck-hire',
            'number' => 5,
            'label' => [
                'th' => 'งานรถรับจ้าง',
                'en' => 'Truck hire',
            ],
            'description' => [
                'th' => 'ต้องการรถขนดิน ทราย วัสดุ หรือเศษจากไซต์',
                'en' => 'Need a truck for soil, sand, materials, or site debris',
            ],
            'service_slugs' => [
                'hired-truck',
            ],
        ],
    ],

    'bottom_bar' => [
        'text' => [
            'th' => 'วิศวกรคุมงานทุกขั้น · รับประกันโครงสร้าง 2 ปีในสัญญา',
            'en' => 'Engineer-led at every stage · 2-year structural warranty in contract',
        ],
        'cta' => [
            'th' => 'ส่งรูปหน้างาน ประเมินฟรี',
            'en' => 'Send a site photo — free estimate',
        ],
        'mgmt_slug' => 'construction-mgmt',
        'mgmt_label' => [
            'th' => 'วิศวกรคุมงานทุกขั้น (บริหารโครงการ)',
            'en' => 'Engineer-led project management',
        ],
    ],

    /**
     * ชื่อที่แสดงในเมนู/หน้ารวม — ไม่แก้ slug
     * คีย์ = service หรือ item slug
     */
    'label_overrides' => [
        'house-demolition' => [
            'th' => 'รับรื้อถอนบ้าน',
            'en' => 'House demolition',
        ],
        'earthwork' => [
            'th' => 'รับเตรียมพื้นที่',
            'en' => 'Site preparation',
        ],
        'land-clearing' => [
            'th' => 'รับเคลียร์ริ่งพื้นที่',
            'en' => 'Land clearing',
        ],
        'land-filling' => [
            'th' => 'รับเหมาถมที่',
            'en' => 'Land filling',
        ],
        'construction-waste-hauling' => [
            'th' => 'รับขนขยะก่อสร้าง',
            'en' => 'Construction waste hauling',
        ],
        'buy-old-air-conditioner' => [
            'th' => 'รับซื้อแอร์เก่าจากงานรื้อ (หักจากค่ารื้อ)',
            'en' => 'Buy used ACs from demolition (credited to fee)',
        ],
        'piles-foundation' => [
            'th' => 'รับทำเสาเข็ม',
            'en' => 'Pile foundation work',
        ],
        'survey' => [
            'th' => 'รับสำรวจหน้างาน',
            'en' => 'Site survey',
        ],
        'structure' => [
            'th' => 'รับทำกำแพงกันดิน · งานโครงสร้าง',
            'en' => 'Retaining walls & structure',
        ],
        'aluminum-works' => [
            'th' => 'รับติดตั้งอลูมิเนียม',
            'en' => 'Aluminium installation',
        ],
        'shop-design' => [
            'th' => 'รับออกแบบและต่อเติมร้าน',
            'en' => 'Shop design & fit-out',
        ],
        'electrical' => [
            'th' => 'รับเดินระบบไฟฟ้า',
            'en' => 'Electrical systems',
        ],
        'solar-cell-installation' => [
            'th' => 'รับติดตั้งโซล่าเซลล์',
            'en' => 'Solar installation',
        ],
        'network-cabling' => [
            'th' => 'รับเดินสายสัญญาณ',
            'en' => 'Network cabling',
        ],
        'cctv' => [
            'th' => 'รับติดตั้ง CCTV',
            'en' => 'CCTV installation',
        ],
        'site-clearing' => [
            'th' => 'รับเคลียร์พื้นที่หลังรื้อ',
            'en' => 'Post-demolition site clearing',
        ],
        'hired-truck' => [
            'th' => 'รับจ้างรถหกล้อ · รถกระบะ',
            'en' => '6-wheel & pickup truck hire',
        ],
    ],
];
