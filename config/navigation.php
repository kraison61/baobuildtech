<?php

/**
 * เมนูนำทางหน้าเว็บสาธารณะ
 * mega menu แบบ theeraphong: หมวด → กลุ่มงาน → รายการย่อย
 */

return [
    [
        'label' => 'หน้าแรก',
        'href' => '/',
        'route' => 'home',
    ],
    [
        'label' => 'งานบริการ',
        'href' => '/services',
        'route' => 'services',
        'mega' => true,
        'sections' => [
            [
                'label' => 'งานโยธา',
                'href' => '/services#civil',
                'groups' => [
                    [
                        'label' => 'สำรวจ',
                        'href' => '/services#survey',
                        'children' => [
                            ['label' => 'สำรวจหน้างาน', 'href' => '/services#site-survey'],
                            ['label' => 'วางผังและตรวจระดับ', 'href' => '/services#layout-leveling'],
                        ],
                    ],
                    [
                        'label' => 'เสาเข็มและฐานราก',
                        'href' => '/services#piles-foundation',
                        'children' => [
                            ['label' => 'กดเสาเข็ม', 'href' => '/services#driven-pile'],
                            ['label' => 'เข็มเจาะ', 'href' => '/services#bored-pile'],
                            ['label' => 'ไมโครไพล์', 'href' => '/services#micropile'],
                            ['label' => 'ฟุตติ้ง', 'href' => '/services#footing'],
                        ],
                    ],
                    [
                        'label' => 'โครงสร้าง',
                        'href' => '/services#structure',
                        'children' => [
                            ['label' => 'กำแพงกันดิน', 'href' => '/services#retaining-wall'],
                            ['label' => 'รั้วเหล็ก และก่อฉาบ', 'href' => '/services#steel-plaster-fence'],
                            ['label' => 'เขื่อนกันดิน', 'href' => '/services#sheet-pile-wall'],
                            ['label' => 'เทคอนกรีต', 'href' => '/services#concrete-pour'],
                            ['label' => 'โครงเหล็ก', 'href' => '/services#steel-frame'],
                        ],
                    ],
                    [
                        'label' => 'บริหารงานก่อสร้าง',
                        'href' => '/services#construction-mgmt',
                        'children' => [
                            ['label' => 'วางแผนและควบคุมงาน', 'href' => '/services#planning-control'],
                            ['label' => 'ตรวจรับและส่งมอบ', 'href' => '/services#handover-inspection'],
                        ],
                    ],
                    [
                        'label' => 'สุขาภิบาล',
                        'href' => '/services#sanitation',
                        'children' => [
                            ['label' => 'ติดตั้งถังบำบัดน้ำเสีย', 'href' => '/services#septic-tank'],
                            ['label' => 'วางท่อระบายน้ำ', 'href' => '/services#drainage-pipe'],
                        ],
                    ],
                ],
            ],
            [
                'label' => 'งานไอที',
                'href' => '/services#it',
                'groups' => [
                    [
                        'label' => 'ระบบไฟฟ้า',
                        'href' => '/services#electrical',
                        'children' => [
                            ['label' => 'เดินสายไฟฟ้า', 'href' => '/services#electrical-wiring'],
                        ],
                    ],
                    [
                        'label' => 'สายสัญญาณ',
                        'href' => '/services#network-cabling',
                        'children' => [
                            ['label' => 'ไฟเบอร์', 'href' => '/services#fiber'],
                            ['label' => 'LAN ภายนอกอาคาร', 'href' => '/services#outdoor-lan'],
                        ],
                    ],
                    [
                        'label' => 'กล้องวงจรปิด',
                        'href' => '/services#cctv',
                        'children' => [
                            ['label' => 'ติดตั้งกล้องวงจรปิด', 'href' => '/services#cctv-install'],
                        ],
                    ],
                ],
            ],
        ],
    ],
    [
        'label' => 'ผลงาน',
        'href' => '/works',
        'route' => 'works',
    ],
    [
        'label' => 'บทความ',
        'href' => '/articles',
        'route' => 'articles',
    ],
    [
        'label' => 'คลังภาพผลงาน',
        'href' => '/gallery',
        'route' => 'gallery',
    ],
    [
        'label' => 'เกี่ยวกับเรา',
        'href' => '/about',
        'route' => 'about',
    ],
];
