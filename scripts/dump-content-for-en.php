<?php

require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$db = Illuminate\Support\Facades\DB::connection();
$out = [];

$out['service_categories'] = $db->table('service_categories')->get(['id', 'name', 'description', 'slug'])->all();
$out['services'] = $db->table('services')->get([
    'id', 'name', 'headline', 'description', 'excerpt', 'service_type',
    'meta_title', 'meta_description', 'slug', 'content',
])->all();
$out['service_items'] = $db->table('service_items')->get([
    'id', 'name', 'headline', 'description', 'excerpt',
    'meta_title', 'meta_description', 'slug', 'content',
])->all();
$out['posts'] = $db->table('posts')->get([
    'id', 'title', 'excerpt', 'meta_title', 'meta_description', 'slug', 'body',
])->all();
$out['portfolios'] = $db->table('portfolios')->get([
    'id', 'title', 'description', 'client_name', 'meta_title', 'meta_description', 'slug',
])->all();
$out['locations'] = $db->table('locations')->get([
    'id', 'name', 'province', 'district', 'description', 'meta_title', 'meta_description', 'slug',
])->all();
$out['authors'] = $db->table('authors')->get(['id', 'name', 'bio', 'job_title', 'slug'])->all();
$out['service_prices'] = $db->table('service_prices')->get(['id', 'label', 'price_unit', 'note'])->all();
$out['faqs'] = $db->table('faqs')->get(['id', 'question', 'answer'])->all();

$path = __DIR__.'/../storage/app/content-th-dump.json';
file_put_contents($path, json_encode($out, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
echo "Wrote {$path}\n";
echo 'categories='.count($out['service_categories']).' services='.count($out['services']).' items='.count($out['service_items'])."\n";
echo 'posts='.count($out['posts']).' portfolios='.count($out['portfolios']).' faqs='.count($out['faqs'])."\n";
