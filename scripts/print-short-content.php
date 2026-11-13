<?php

$j = json_decode(file_get_contents(__DIR__.'/../storage/app/content-th-dump.json'), true);

foreach (['service_categories', 'portfolios', 'locations', 'authors'] as $k) {
    echo "## {$k}\n";
    foreach ($j[$k] as $r) {
        unset($r['content'], $r['body']);
        echo json_encode($r, JSON_UNESCAPED_UNICODE)."\n";
    }
}

echo "## services short\n";
foreach ($j['services'] as $r) {
    unset($r['content']);
    echo json_encode($r, JSON_UNESCAPED_UNICODE)."\n";
}

echo "## items short\n";
foreach ($j['service_items'] as $r) {
    unset($r['content']);
    echo json_encode($r, JSON_UNESCAPED_UNICODE)."\n";
}

echo "## posts short\n";
foreach ($j['posts'] as $r) {
    unset($r['body']);
    echo json_encode($r, JSON_UNESCAPED_UNICODE)."\n";
}

echo "## prices\n";
foreach ($j['service_prices'] as $r) {
    echo json_encode($r, JSON_UNESCAPED_UNICODE)."\n";
}

echo "## faqs sample\n";
foreach (array_slice($j['faqs'], 0, 15) as $r) {
    echo json_encode($r, JSON_UNESCAPED_UNICODE)."\n";
}
