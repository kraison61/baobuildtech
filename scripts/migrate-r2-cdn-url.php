<?php

/**
 * เปลี่ยน public R2 URL เก่า → custom domain images.boabuildtech.com
 * Usage: php scripts/migrate-r2-cdn-url.php
 */

declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$from = 'https://pub-b9d717abf918492ebdfeacb62e2977a0.r2.dev';
$to = rtrim((string) (env('AWS_URL') ?: 'https://images.boabuildtech.com'), '/');

echo "From: {$from}\n";
echo "To:   {$to}\n";

$updates = [
    ['service_items', 'cover_image'],
    ['service_items', 'content'],
    ['services', 'cover_image'],
    ['service_categories', 'cover_image'],
    ['posts', 'image_16x9'],
    ['posts', 'image_4x3'],
    ['posts', 'image_1x1'],
    ['portfolios', 'cover_image'],
    ['portfolio_images', 'image_url'],
];

foreach ($updates as [$table, $column]) {
    $count = DB::table($table)
        ->where($column, 'like', '%'.$from.'%')
        ->update([
            $column => DB::raw(
                "REPLACE({$column}, ".DB::getPdo()->quote($from).', '.DB::getPdo()->quote($to).')'
            ),
        ]);

    echo "{$table}.{$column}: {$count}\n";
}

echo "Done.\n";
