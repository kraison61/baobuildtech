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
}
