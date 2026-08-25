<?php

namespace App\Support;

final class Coordinates
{
    /**
     * แยกพิกัดจากสตริง Google Maps → [lat, lng]
     *
     * @return array{0: float|null, 1: float|null}
     */
    public static function parse(mixed $value): array
    {
        if (! is_string($value) || trim($value) === '') {
            return [null, null];
        }

        if (! preg_match('/^\s*(-?\d+(?:\.\d+)?)\s*,\s*(-?\d+(?:\.\d+)?)\s*$/', $value, $matches)) {
            return [null, null];
        }

        return [(float) $matches[1], (float) $matches[2]];
    }

    public static function format(mixed $lat, mixed $lng): ?string
    {
        if ($lat === null || $lng === null || $lat === '' || $lng === '') {
            return null;
        }

        return rtrim(rtrim((string) $lat, '0'), '.').', '.rtrim(rtrim((string) $lng, '0'), '.');
    }

    public static function isValidFormat(mixed $value): bool
    {
        if (! is_string($value) || trim($value) === '') {
            return true;
        }

        return (bool) preg_match('/^\s*-?\d+(?:\.\d+)?\s*,\s*-?\d+(?:\.\d+)?\s*$/', $value);
    }
}
