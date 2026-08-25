<?php

namespace App\Support;

class Company
{
    /**
     * เบอร์โทรแสดงผล เช่น 081-000-0000
     */
    public static function phoneDisplay(?string $e164 = null): string
    {
        $e164 ??= (string) config('company.phone');
        $local = preg_replace('/^\+66/', '0', $e164) ?? $e164;

        return preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1-$2-$3', $local) ?? $local;
    }

    /**
     * tel: href จากเบอร์บริษัท
     */
    public static function phoneHref(?string $e164 = null): string
    {
        $digits = preg_replace('/\D/', '', self::phoneDisplay($e164)) ?? '';

        return 'tel:'.$digits;
    }

    /**
     * LINE display id เช่น @baogroup
     */
    public static function lineId(): ?string
    {
        $id = config('company.line_id');

        return filled($id) ? (string) $id : null;
    }

    /**
     * URL แชท LINE (หรือ null ถ้ายังไม่มี)
     */
    public static function lineUrl(): ?string
    {
        $url = config('company.social.line');

        return filled($url) ? (string) $url : null;
    }

    /**
     * ที่อยู่แสดงผลบรรทัดเดียว จาก config/company.php
     */
    public static function addressDisplay(): string
    {
        $address = config('company.address', []);

        return trim(implode(' ', array_filter([
            $address['street'] ?? null,
            $address['district'] ?? null,
            $address['province'] ?? null,
            $address['postal_code'] ?? null,
        ])));
    }

    /**
     * PostalAddress สำหรับ JSON-LD จาก config/company.php
     *
     * @return array<string, string>
     */
    public static function postalAddress(): array
    {
        $address = config('company.address', []);

        return array_filter([
            '@type' => 'PostalAddress',
            'streetAddress' => (string) ($address['street'] ?? ''),
            'addressLocality' => (string) ($address['district'] ?? ''),
            'addressRegion' => (string) ($address['province'] ?? ''),
            'postalCode' => (string) ($address['postal_code'] ?? ''),
            'addressCountry' => (string) ($address['country'] ?? 'TH'),
        ], static fn ($value) => $value !== null && $value !== '');
    }

    /**
     * เวลาทำการแสดงผล เช่น จันทร์–เสาร์ 08:00–18:00
     */
    public static function hoursDisplay(): string
    {
        $days = config('company.hours.open_days', []);
        $open = (string) config('company.hours.open_time', '08:00');
        $close = (string) config('company.hours.close_time', '18:00');

        $label = match (true) {
            $days === ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] => 'จันทร์–เสาร์',
            $days === ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] => 'จันทร์–ศุกร์',
            default => 'เวลาทำการ',
        };

        return $label.' '.$open.'–'.$close;
    }

    /**
     * openingHours (Text) ตาม schema.org/openingHours เช่น Mo-Sa 08:00-18:00
     */
    public static function openingHours(): ?string
    {
        $map = [
            'Monday' => 'Mo',
            'Tuesday' => 'Tu',
            'Wednesday' => 'We',
            'Thursday' => 'Th',
            'Friday' => 'Fr',
            'Saturday' => 'Sa',
            'Sunday' => 'Su',
        ];

        $days = config('company.hours.open_days', []);
        $codes = [];

        foreach ($days as $day) {
            if (isset($map[$day])) {
                $codes[] = $map[$day];
            }
        }

        if ($codes === []) {
            return null;
        }

        $open = (string) config('company.hours.open_time', '08:00');
        $close = (string) config('company.hours.close_time', '18:00');

        $range = count($codes) === 1
            ? $codes[0]
            : $codes[0].'-'.$codes[array_key_last($codes)];

        return $range.' '.$open.'-'.$close;
    }

    /**
     * OpeningHoursSpecification ตาม schema.org/OpeningHoursSpecification
     *
     * @return array<string, mixed>|null
     */
    public static function openingHoursSpecification(): ?array
    {
        $allowed = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $days = array_values(array_filter(
            config('company.hours.open_days', []),
            static fn ($day) => in_array($day, $allowed, true),
        ));

        if ($days === []) {
            return null;
        }

        return [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => $days,
            'opens' => (string) config('company.hours.open_time', '08:00'),
            'closes' => (string) config('company.hours.close_time', '18:00'),
        ];
    }

    /**
     * GeoCoordinates ตาม schema.org/GeoCoordinates (lat/lng เป็น number)
     *
     * @return array<string, mixed>|null
     */
    public static function geoCoordinates(): ?array
    {
        $lat = config('company.geo.lat');
        $lng = config('company.geo.lng');

        if (! is_numeric($lat) || ! is_numeric($lng)) {
            return null;
        }

        return [
            '@type' => 'GeoCoordinates',
            'latitude' => (float) $lat,
            'longitude' => (float) $lng,
        ];
    }

    /**
     * sameAs ตาม schema.org/sameAs — URL โปรไฟล์ที่อ้างถึงองค์กร
     *
     * @return array<int, string>
     */
    public static function sameAs(): array
    {
        $urls = [];

        foreach (config('company.social', []) as $url) {
            if (filled($url)) {
                $urls[] = (string) $url;
            }
        }

        return array_values(array_unique($urls));
    }

    /**
     * พื้นที่ให้บริการจาก config/company.php — ใช้ทั้งหน้าเว็บและ JSON-LD areaServed
     *
     * @return array<int, string>
     */
    public static function serviceAreas(bool $includeCountry = true): array
    {
        /** @var array<int, string> $areas */
        $areas = config('company.area_served', []);

        if (! $includeCountry) {
            $areas = array_values(array_filter(
                $areas,
                static fn (string $name): bool => $name !== 'ประเทศไทย',
            ));
        }

        return $areas;
    }

    /**
     * logo เป็น ImageObject ตาม schema.org/ImageObject
     *
     * @return array<string, string>|null
     */
    public static function logoImageObject(): ?array
    {
        $url = config('company.logo_url');

        if (! filled($url)) {
            return null;
        }

        return [
            '@type' => 'ImageObject',
            'url' => (string) $url,
        ];
    }
}
