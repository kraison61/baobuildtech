<?php

namespace App\Support;

/** เตรียม HTML จาก DB ก่อน render บนหน้า front */
final class RichHtml
{
    public static function prepare(string $html): string
    {
        if ($html === '') {
            return '';
        }

        $wrapped = preg_replace(
            ['/<table(\s[^>]*)?>/i', '/<\/table>/i'],
            [
                '<div class="max-w-full overflow-x-auto overscroll-x-contain pb-1 [-webkit-overflow-scrolling:touch] [scrollbar-width:thin]"><table$1>',
                '</table></div>',
            ],
            $html,
        );

        return $wrapped ?? $html;
    }
}
