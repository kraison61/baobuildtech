<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SlugGenerator
{
    /**
     * สร้าง slug ที่ไม่ซ้ำในตาราง
     */
    public static function unique(string $value, string $modelClass, ?int $ignoreId = null): string
    {
        $slug = Str::slug($value);
        $base = $slug !== '' ? $slug : 'item';
        $candidate = $base;
        $counter = 2;

        /** @var class-string<Model> $modelClass */
        while (self::exists($modelClass, $candidate, $ignoreId)) {
            $candidate = $base.'-'.$counter;
            $counter++;
        }

        return $candidate;
    }

    /**
     * @param  class-string<Model>  $modelClass
     */
    private static function exists(string $modelClass, string $slug, ?int $ignoreId): bool
    {
        $query = $modelClass::query()->where('slug', $slug);

        if ($ignoreId !== null) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists();
    }
}
