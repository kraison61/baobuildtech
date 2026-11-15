<?php

/**
 * เมนูนำทางหน้าเว็บสาธารณะ
 * รายการ source=services จะ hydrate sections จาก ServiceDisplayGroups (IA ฝั่งลูกค้า + URL เดิม)
 * label_key อ้างอิง lang/th/ui.php และ lang/en/ui.php
 */

return [
    [
        'label_key' => 'ui.home',
        'href' => '/',
        'route' => 'home',
    ],
    [
        'label_key' => 'ui.services',
        'href' => '/services',
        'route' => 'services',
        'mega' => true,
        'source' => 'services',
    ],
    [
        'label_key' => 'ui.works',
        'href' => '/works',
        'route' => 'works',
    ],
    [
        'label_key' => 'ui.blog',
        'href' => '/blog',
        'route' => 'blog.index',
    ],
    [
        'label_key' => 'ui.gallery',
        'href' => '/gallery',
        'route' => 'gallery',
    ],
    [
        'label_key' => 'ui.about',
        'href' => '/about',
        'route' => 'about',
    ],
    [
        'label_key' => 'ui.contact',
        'href' => '/contact',
        'route' => 'contact',
    ],
];
