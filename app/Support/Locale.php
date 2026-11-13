<?php

namespace App\Support;

use Illuminate\Support\Facades\Route;

class Locale
{
    public const TH = 'th';

    public const EN = 'en';

    /** @return list<string> */
    public static function supported(): array
    {
        return [self::TH, self::EN];
    }

    public static function current(): string
    {
        $locale = app()->getLocale();

        return in_array($locale, self::supported(), true) ? $locale : self::TH;
    }

    public static function isEnglish(): bool
    {
        return self::current() === self::EN;
    }

    /** ชื่อ route ตาม locale ปัจจุบัน (เช่น home → en.home) */
    public static function routeName(string $name): string
    {
        if (self::isEnglish() && ! str_starts_with($name, 'en.') && ! str_starts_with($name, 'admin.')) {
            return 'en.'.$name;
        }

        return $name;
    }

    /**
     * @param  mixed  $parameters
     */
    public static function route(string $name, mixed $parameters = [], bool $absolute = true): string
    {
        return route(self::routeName($name), $parameters, $absolute);
    }

    /** สลับ path ปัจจุบันไปอีกภาษา (คง path หลัง /en) */
    public static function switchUrl(string $targetLocale): string
    {
        $path = '/'.ltrim(request()->path(), '/');

        if ($path === '/') {
            return $targetLocale === self::EN ? url('/en') : url('/');
        }

        if (str_starts_with($path, '/en/') || $path === '/en') {
            $withoutEn = $path === '/en' ? '/' : substr($path, 3);

            return $targetLocale === self::EN
                ? url($path)
                : url($withoutEn === '' ? '/' : $withoutEn);
        }

        return $targetLocale === self::EN
            ? url('/en'.$path)
            : url($path);
    }

    public static function inLanguage(): string
    {
        return self::isEnglish() ? 'en-US' : 'th-TH';
    }

    public static function pick(string $th, string $en): string
    {
        return self::isEnglish() ? $en : $th;
    }

    /**
     * @template T
     * @param  T  $th
     * @param  T  $en
     * @return T
     */
    public static function pickAny(mixed $th, mixed $en): mixed
    {
        return self::isEnglish() ? $en : $th;
    }

    /** URL ของหน้าเดียวกันใน locale ที่ระบุ (จาก named route ปัจจุบัน) */
    public static function alternateUrl(string $locale): ?string
    {
        $route = request()->route();
        if ($route === null) {
            return self::switchUrl($locale);
        }

        $name = $route->getName();
        if (! is_string($name) || $name === '' || str_starts_with($name, 'admin.')) {
            return self::switchUrl($locale);
        }

        $baseName = str_starts_with($name, 'en.') ? substr($name, 3) : $name;
        $targetName = $locale === self::EN ? 'en.'.$baseName : $baseName;

        if (! Route::has($targetName)) {
            return self::switchUrl($locale);
        }

        $params = $route->parameters();

        try {
            return route($targetName, $params);
        } catch (\Throwable) {
            return self::switchUrl($locale);
        }
    }
}
