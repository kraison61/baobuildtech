<?php

namespace App\Support;

/**
 * สร้าง mock image (SVG data URI) สำหรับ slot ที่ยังไม่มีรูปจริง
 */
final class ImagePlaceholder
{
    public static function url(
        string $label = 'รูปภาพ',
        string $spec = '1600×1200',
        ?string $ratio = null,
        int $width = 1600,
        int $height = 1200,
    ): string {
        $width = max(1, $width);
        $height = max(1, $height);
        $caption = $spec.($ratio ? " · {$ratio}" : '').' px';
        $scale = max(12, min($width, $height) * 0.045);

        $lines = [
            ['text' => 'PLACEHOLDER', 'size' => $scale * 0.85, 'weight' => 600, 'fill' => '#1E3A32', 'opacity' => 0.35],
            ['text' => self::truncate($label, 48), 'size' => $scale * 1.05, 'weight' => 700, 'fill' => '#1E3A32', 'opacity' => 0.9],
            ['text' => $caption, 'size' => $scale * 0.95, 'weight' => 600, 'fill' => '#6B6558', 'opacity' => 0.85],
        ];

        $lineHeight = 1.45;
        $totalHeight = array_sum(array_map(static fn (array $line) => $line['size'] * $lineHeight, $lines));
        $y = ($height - $totalHeight) / 2;

        $textNodes = '';
        foreach ($lines as $line) {
            $y += $line['size'];
            $textNodes .= sprintf(
                '<text x="50%%" y="%.2f" text-anchor="middle" font-family="system-ui,sans-serif" font-size="%.2f" font-weight="%d" fill="%s" fill-opacity="%.2f">%s</text>',
                $y,
                $line['size'],
                $line['weight'],
                $line['fill'],
                $line['opacity'],
                self::escape($line['text']),
            );
            $y += ($line['size'] * ($lineHeight - 1));
        }

        $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="{$width}" height="{$height}" viewBox="0 0 {$width} {$height}" role="img">
  <rect width="100%" height="100%" fill="#F5F2EB"/>
  <rect x="1.5%" y="1.5%" width="97%" height="97%" fill="none" stroke="#1E3A32" stroke-opacity="0.22" stroke-width="3" stroke-dasharray="12 8" rx="8"/>
  {$textNodes}
</svg>
SVG;

        return 'data:image/svg+xml,'.rawurlencode($svg);
    }

    private static function truncate(string $text, int $max): string
    {
        return mb_strlen($text) > $max ? mb_substr($text, 0, $max - 1).'…' : $text;
    }

    private static function escape(string $text): string
    {
        return htmlspecialchars($text, ENT_XML1 | ENT_QUOTES, 'UTF-8');
    }
}
