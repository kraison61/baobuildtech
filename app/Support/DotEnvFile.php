<?php

namespace App\Support;

/**
 * อ่านค่าจากไฟล์ .env โดยตรง — ใช้เมื่อ process environment
 * มีค่าเก่าทับ (Dotenv immutable จะไม่ override)
 */
class DotEnvFile
{
    public static function get(string $key): ?string
    {
        $path = base_path('.env');

        if (! is_readable($path)) {
            return null;
        }

        $prefix = $key.'=';
        $handle = fopen($path, 'r');

        if ($handle === false) {
            return null;
        }

        try {
            while (($line = fgets($handle)) !== false) {
                $line = trim($line);

                if ($line === '' || str_starts_with($line, '#') || ! str_starts_with($line, $prefix)) {
                    continue;
                }

                $value = substr($line, strlen($prefix));

                return self::parseValue($value);
            }
        } finally {
            fclose($handle);
        }

        return null;
    }

    private static function parseValue(string $value): string
    {
        $value = trim($value);

        if ($value === '') {
            return '';
        }

        $quote = $value[0];

        if (($quote === '"' || $quote === "'") && str_ends_with($value, $quote) && strlen($value) >= 2) {
            $inner = substr($value, 1, -1);

            return $quote === '"'
                ? stripcslashes($inner)
                : $inner;
        }

        // ค่าไม่มี quote — ตัด inline comment หลังช่องว่าง+#
        if (preg_match('/\s+#/', $value, $m, PREG_OFFSET_CAPTURE)) {
            $value = rtrim(substr($value, 0, $m[0][1]));
        }

        return $value;
    }
}
