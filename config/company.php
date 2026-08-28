<?php

/**
 * config/company.php
 *
 * ข้อมูลองค์กรทั้งหมด — ใช้สร้าง JSON-LD Schema ทุกหน้า
 * แก้ไขไฟล์นี้โดยตรง ไม่มี DB
 */

return [

    'legal_name'    => 'บีเอโอ และเพื่อน',
    'brand_name'    => 'BAO-Buildtech',
    'brand_mark'    => 'BAO',
    'business_type' => 'GeneralContractor',
    'tax_id'        => '0125555012345',
    'founding_year' => '2026',
    'site_url'      => env('APP_URL', 'https://example.com'),
    'description'   => 'รับเหมาก่อสร้างครบวงจรในกรุงเทพฯ และปริมณฑล ตั้งแต่ถมดิน ออกแบบ งานโครงสร้าง งานอลูมิเนียมและกระจก จนถึงระบบไฟฟ้า ประปา และ IT Infrastructure',

    'phone' => '+66615639228',
    'phone_format' => '061-563-9228',
    'email' => 'bao.buildtech2011@gmail.com',
    'line_id' => '@baobuildtech',
    'line_url' => 'https://lin.ee/V2S0HT6',

    'logo_url' => env('APP_URL', 'https://example.com').'/images/logo.png',

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
        'line'        => 'https://lin.ee/V2S0HT6',
        'youtube'     => null,
        'google_maps' => 'https://maps.app.goo.gl/MvrDLjCYanoYfiDz9',
    ],

];
