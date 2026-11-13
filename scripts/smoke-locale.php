<?php

require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

app()->setLocale('th');
echo "TH category: ".\App\Models\ServiceCategory::find(12)->name.PHP_EOL;
echo "TH home meta: ".\App\Support\HomeContent::metaTitle().PHP_EOL;

app()->setLocale('en');
echo "EN category: ".\App\Models\ServiceCategory::find(12)->name.PHP_EOL;
echo "EN home meta: ".\App\Support\HomeContent::metaTitle().PHP_EOL;
echo "EN service url: ".\App\Models\Service::query()->where('is_published', true)->with('category')->first()?->url().PHP_EOL;
echo "EN route home: ".\App\Support\Locale::route('home').PHP_EOL;
echo "inLanguage: ".\App\Support\Locale::inLanguage().PHP_EOL;

$faq = \App\Models\Faq::query()->whereNotNull('question_en')->first();
echo 'EN faq: '.($faq?->question ?? 'none').PHP_EOL;

echo 'OK'.PHP_EOL;
