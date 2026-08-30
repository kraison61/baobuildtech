<?php

declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Storage;

$diskName = (string) config('filesystems.work_images_disk', 'r2');
$endpoint = config("filesystems.disks.{$diskName}.endpoint");

echo "Disk: {$diskName}\n";
echo 'Bucket: '.config("filesystems.disks.{$diskName}.bucket")."\n";
echo 'Endpoint: '.($endpoint ?: '(not configured)')."\n\n";

if ($diskName === 'r2' && blank($endpoint)) {
    fwrite(STDERR, "ERROR: ตั้ง CLOUDFLARE_ACCOUNT_ID หรือ AWS_ENDPOINT ใน .env\n");
    fwrite(STDERR, "  Cloudflare Dashboard → R2 → Overview → Account ID\n");
    exit(1);
}

$disk = Storage::disk($diskName);
$key = 'test/r2-crud-'.date('Ymd-His').'.txt';

try {
    echo "[CREATE] put {$key}\n";
    $disk->put($key, 'hello R2 CRUD test');
    echo "  OK\n";

    echo "[READ] get + url\n";
    $content = $disk->get($key);
    echo '  content='.$content."\n";
    echo '  url='.$disk->url($key)."\n";

    if ($content !== 'hello R2 CRUD test') {
        throw new RuntimeException('read content mismatch');
    }

    echo "[UPDATE] overwrite\n";
    $disk->put($key, 'updated R2 CRUD test');
    $updated = $disk->get($key);
    echo '  content='.$updated."\n";

    if ($updated !== 'updated R2 CRUD test') {
        throw new RuntimeException('update content mismatch');
    }

    echo "[DELETE] remove\n";
    $disk->delete($key);

    echo "\nCRUD test PASSED\n";
    exit(0);
} catch (Throwable $e) {
    echo "\nCRUD test FAILED: ".$e->getMessage()."\n";
    exit(1);
}
