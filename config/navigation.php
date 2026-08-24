<?php

/**
 * เมนูนำทางหน้าเว็บสาธารณะ
 * รายการ source=services จะ hydrate sections จาก DB (Category → Service → Item)
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
        'source' => 'services',
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
