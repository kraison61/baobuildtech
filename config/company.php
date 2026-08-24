<?php

/**
 * config/company.php
 *
 * ข้อมูลองค์กรทั้งหมด — ใช้สร้าง JSON-LD Schema ทุกหน้า
 * แก้ไขไฟล์นี้โดยตรง ไม่มี DB
 */

return [

    'legal_name'    => 'บีโอเอ และเพื่อน',
    'brand_name'    => 'BOA&Friends',
    'brand_mark'    => 'BOA',
    'business_type' => 'GeneralContractor',
    'tax_id'        => '0125555012345',
    'founding_year' => '2015',
    'site_url'      => env('APP_URL', 'https://example.com'),
    'description'   => 'ช่างเฉพาะทางงานกำแพงกันดิน คสล. งานฐานราก และงานโยธา พร้อมงานระบบไฟฟ้า ไฟเบอร์ LAN และ CCTV',

    'phone' => '+66812345678',
    'email' => 'work@theeraphong.co.th',
    'line_id' => '@theeraphong',

    'logo_url' => env('APP_URL', 'https://example.com').'/images/logo.png',

    'address' => [
        'street'      => '88/15 ถ.กาญจนาภิเษก',
        'district'    => 'บางใหญ่',
        'province'    => 'นนทบุรี',
        'postal_code' => '11140',
        'country'     => 'TH',
    ],

    'geo' => [
        'lat' => 13.8372,
        'lng' => 100.3965,
    ],

    'hours' => [
        'open_days'  => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        'open_time'  => '08:00',
        'close_time' => '18:00',
    ],

    'price_range' => '฿฿',

    'social' => [
        'facebook'    => null,
        'line'        => 'https://page.line.me/theeraphong',
        'youtube'     => null,
        'google_maps' => null,
    ],

];
