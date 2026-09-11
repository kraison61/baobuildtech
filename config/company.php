<?php

/**
 * config/company.php
 *
 * ข้อมูลองค์กรทั้งหมด — ใช้สร้าง JSON-LD Schema ทุกหน้า
 * แก้ไขไฟล์นี้โดยตรง ไม่มี DB
 */

return [

    'legal_name'    => 'บีโอเอ และเพื่อน',
    'brand_name'    => 'BOA-Buildtech',
    'brand_mark'    => 'BOA',
    'business_type' => 'GeneralContractor',
    'tax_id'        => '0125555012345',
    'founding_year' => '2026',
    'site_url'      => env('APP_URL', 'https://boabuildtech.com'),
    'description'   => 'รับเหมาก่อสร้างครบวงจรในกรุงเทพฯ และปริมณฑล ตั้งแต่ถมดิน ออกแบบ งานโครงสร้าง งานอลูมิเนียมและกระจก จนถึงระบบไฟฟ้า ประปา และ IT Infrastructure',

    // Cloudflare R2 custom domain — ใช้กับโลโก้และรูป asset สาธารณะ
    'images_cdn' => rtrim(env('AWS_URL', 'https://images.boabuildtech.com'), '/'),

    'phone' => '+66617439900',
    'phone_format' => '061-743-9900',
    'email' => 'boa.buildtech@gmail.com',
    'line_id' => '@062mhmap',
    'line_url' => 'https://lin.ee/ohwR1wC',
    'line_qr' => 'https://qr-official.line.me/gs/M_062mhmap_BW.png?oat_content=qr',

    'logo_url' => rtrim(env('AWS_URL', 'https://images.boabuildtech.com'), '/').'/assets/boa-logo.png',

    'address' => [
        'street'      => '88/120 หมู่บ้านธัญญาภิรมย์แกรนด์วิลล์ หมู่ 1 ถนนรังสิต-นครนายก ตำบลลำผักกูด',
        'district'    => 'อำเภอธัญบุรี',
        'province'    => 'จังหวัดปทุมธานี',
        'postal_code' => '12110',
        'country'     => 'TH',
    ],

    'geo' => [
        'lat' => 14.02334531153182,
        'lng' => 100.75723541543825,
    ],

    'hours' => [
        'open_days'  => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        'open_time'  => '08:00',
        'close_time' => '18:00',
    ],

    'price_range' => '฿฿',

    // พื้นที่ให้บริการ — ใช้ทั้งหน้าเว็บและ JSON-LD areaServed
    'area_served' => [
        'กรุงเทพมหานคร',
        'นนทบุรี',
        'ปทุมธานี',
        'สมุทรปราการ',
        'สมุทรสาคร',
        'นครปฐม',
        'ประเทศไทย',
    ],

    'social' => [
        'facebook'    => null,
        // ต้องตรงกับ line_url ด้านบน — ใช้ใน JSON-LD sameAs
        'line'        => 'https://lin.ee/ohwR1wC',
        'youtube'     => null,
        'google_maps' => 'https://maps.app.goo.gl/MvrDLjCYanoYfiDz9',
    ],

];
