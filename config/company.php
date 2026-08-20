<?php

/**
 * config/company.php
 *
 * ข้อมูลองค์กรทั้งหมด — ใช้สร้าง JSON-LD Schema ทุกหน้า
 * แก้ไขไฟล์นี้โดยตรง ไม่มี DB
 *
 * ใช้งาน: config('company.legal_name')
 *          config('company.address.province')
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Identity & Legal
    |--------------------------------------------------------------------------
    | schema: name, @type, taxID, foundingDate, url
    */
    'legal_name'    => 'บริษัท ตัวอย่าง จำกัด',
    'business_type' => 'GeneralContractor',   // schema.org @type
    'tax_id'        => '0000000000000',        // เลข 13 หลัก → schema: taxID
    'founding_year' => '2015',                 // schema: foundingDate
    'site_url'      => env('APP_URL', 'https://example.com'),
    'description'   => 'รับเหมาก่อสร้างกำแพงกันดิน รั้ว งานโยธา และระบบไฟฟ้า',

    /*
    |--------------------------------------------------------------------------
    | Contact
    |--------------------------------------------------------------------------
    | schema: telephone, email
    | phone: รูปแบบ E.164 เช่น +66810000000 (ไม่ใช้ขีด)
    */
    'phone' => '+66810000000',
    'email' => 'info@example.com',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    | schema: logo
    | - ต้องเป็น absolute URL
    | - PNG หรือ JPG เท่านั้น (ห้าม SVG)
    | - ขนาดขั้นต่ำ 112×112px แนะนำ 512×512px
    */
    'logo_url' => env('APP_URL', 'https://example.com') . '/images/logo.png',

    /*
    |--------------------------------------------------------------------------
    | Address (สำนักงานหลัก)
    |--------------------------------------------------------------------------
    | schema: PostalAddress
    | แยก column เพื่อ map เป๊ะ — ห้ามเก็บรวมเป็น string เดียว
    */
    'address' => [
        'street'      => '123 หมู่ 4 ถนนตัวอย่าง',   // streetAddress
        'district'    => 'เมือง',                       // addressLocality
        'province'    => 'กรุงเทพมหานคร',               // addressRegion
        'postal_code' => '10000',                       // postalCode
        'country'     => 'TH',                          // addressCountry (ISO 3166-1)
    ],

    /*
    |--------------------------------------------------------------------------
    | Geo Coordinates
    |--------------------------------------------------------------------------
    | schema: GeoCoordinates
    | วิธีหาค่า: Google Maps → right-click → "Copy coordinates"
    | ส่งเป็น float เสมอ (ไม่ใส่ quote)
    */
    'geo' => [
        'lat' => 13.75631,    // latitude  (-90 ถึง 90)
        'lng' => 100.50176,   // longitude (-180 ถึง 180)
    ],

    /*
    |--------------------------------------------------------------------------
    | Opening Hours
    |--------------------------------------------------------------------------
    | schema: OpeningHoursSpecification
    | open_days: ชื่อวันภาษาอังกฤษเท่านั้น (schema.org กำหนด)
    | open_time / close_time: รูปแบบ "HH:MM" (24 ชั่วโมง)
    */
    'hours' => [
        'open_days'  => ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
        'open_time'  => '08:00',
        'close_time' => '17:00',
    ],

    /*
    |--------------------------------------------------------------------------
    | Price Range
    |--------------------------------------------------------------------------
    | schema: priceRange (แสดงใน LocalBusiness)
    | ใช้สัญลักษณ์ ฿ 1–4 ตัว แทนระดับราคา
    */
    'price_range' => '฿฿',

    /*
    |--------------------------------------------------------------------------
    | Social Links → schema: sameAs[]
    |--------------------------------------------------------------------------
    | ใส่เฉพาะที่มีจริง — ค่า null จะถูกตัดออกอัตโนมัติ ไม่ generate
    */
    'social' => [
        'facebook'    => 'https://www.facebook.com/example',
        'line'        => 'https://page.line.me/example',
        'youtube'     => null,
        'google_maps' => 'https://maps.google.com/?cid=0000000000000',
    ],

];