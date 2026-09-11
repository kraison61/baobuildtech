<?php

use App\Services\LineMessagingService;
use Illuminate\Contracts\Console\Kernel;

require dirname(__DIR__).'/vendor/autoload.php';

$app = require dirname(__DIR__).'/bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

$token = (string) config('services.line.channel_access_token');

echo 'LINE enabled: '.(config('services.line.enabled') ? 'yes' : 'no').PHP_EOL;
echo 'Token length: '.strlen($token).PHP_EOL;

if (strlen($token) < 50) {
    echo 'WARNING: Channel Access Token มักยาวกว่านี้มาก (มัก >100 ตัวอักษร)'.PHP_EOL;
    echo 'ค่าที่ใส่อาจเป็น Channel secret / Channel ID ไม่ใช่ Access Token'.PHP_EOL;
}

$line = $app->make(LineMessagingService::class);

try {
    $line->broadcast([
        [
            'type' => 'text',
            'text' => "[ทดสอบ] ระบบแจ้งเตือนใบเสนอราคา BOA-Buildtech\nเวลา: ".now()->format('d/m/Y H:i'),
        ],
    ]);
    echo 'RESULT: OK — ส่ง broadcast สำเร็จ'.PHP_EOL;
} catch (Throwable $e) {
    echo 'RESULT: FAIL'.PHP_EOL;
    echo 'Error: '.$e->getMessage().PHP_EOL;
    if (method_exists($e, 'response') && $e->response()) {
        echo 'HTTP: '.$e->response()->status().PHP_EOL;
        echo 'Body: '.$e->response()->body().PHP_EOL;
    }
    exit(1);
}
