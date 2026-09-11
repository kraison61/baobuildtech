<?php

/**
 * ทดสอบ POST ฟอร์ม /contact แบบ end-to-end
 * แล้วตรวจว่ามีการสร้าง QuoteRequest + ส่ง LINE
 */

$base = getenv('APP_URL') ?: 'http://127.0.0.1:8000';
$base = rtrim($base, '/');

$cookieFile = sys_get_temp_dir().DIRECTORY_SEPARATOR.'boa-contact-test-cookies.txt';
@unlink($cookieFile);

function http(string $method, string $url, ?array $postFields, string $cookieFile): array
{
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_COOKIEJAR => $cookieFile,
        CURLOPT_COOKIEFILE => $cookieFile,
        CURLOPT_HEADER => true,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_TIMEOUT => 30,
    ]);

    if ($postFields !== null) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded',
            'Accept: text/html',
        ]);
    }

    $raw = curl_exec($ch);
    if ($raw === false) {
        throw new RuntimeException('cURL error: '.curl_error($ch));
    }

    $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $headerSize = (int) curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    curl_close($ch);

    return [
        'status' => $status,
        'headers' => substr($raw, 0, $headerSize),
        'body' => substr($raw, $headerSize),
    ];
}

echo "GET {$base}/contact".PHP_EOL;
$get = http('GET', $base.'/contact', null, $cookieFile);
echo "GET status={$get['status']}".PHP_EOL;

if (! preg_match('/name="_token"\s+value="([^"]+)"/', $get['body'], $m)
    && ! preg_match('/name="_token"\s+value=\'([^\']+)\'/', $get['body'], $m)) {
    fwrite(STDERR, "ไม่พบ CSRF token ในหน้า contact\n");
    exit(1);
}

$token = $m[1];
$payload = [
    '_token' => $token,
    'name' => 'ทดสอบระบบ LINE',
    'phone' => '081-000-9999',
    'job' => 'civil',
    'area' => 'ธัญบุรี ปทุมธานี',
    'detail' => 'ข้อความทดสอบจากสคริปต์ — ถมดินแปลงทดสอบ ส่งฟอร์มอัตโนมัติ',
];

echo 'POST '.$base.'/contact'.PHP_EOL;
$post = http('POST', $base.'/contact', $payload, $cookieFile);
echo "POST status={$post['status']}".PHP_EOL;

if (preg_match('/^Location:\s*(.+)$/mi', $post['headers'], $loc)) {
    echo 'Location: '.trim($loc[1]).PHP_EOL;
}

require dirname(__DIR__).'/vendor/autoload.php';
$app = require dirname(__DIR__).'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$quote = App\Models\QuoteRequest::query()->latest('id')->first();
if (! $quote) {
    fwrite(STDERR, "ไม่พบ QuoteRequest หลังส่งฟอร์ม\n");
    exit(1);
}

echo "quote_id={$quote->id}".PHP_EOL;
echo "quote_name={$quote->name}".PHP_EOL;
echo "quote_phone={$quote->phone}".PHP_EOL;
echo "quote_job={$quote->job_type}".PHP_EOL;
echo "quote_area={$quote->area}".PHP_EOL;
echo "created_at={$quote->created_at}".PHP_EOL;

$okForm = $quote->name === 'ทดสอบระบบ LINE'
    && $quote->phone === '081-000-9999'
    && in_array($post['status'], [302, 303], true);

if (! $okForm) {
    fwrite(STDERR, "FORM_RESULT: FAIL — สถานะหรือข้อมูลไม่ตรง\n");
    exit(1);
}

echo 'FORM_RESULT: OK'.PHP_EOL;
echo 'หมายเหตุ: LINE ถูกส่งผ่าน dispatchAfterResponse ตอนจบ request ของเว็บเซิร์ฟเวอร์ — ตรวจข้อความในแอป LINE'.PHP_EOL;
