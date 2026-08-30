<?php

declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use App\Models\WorkImage;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Storage;

$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

$disk = (string) config('filesystems.work_images_disk', 'r2');
echo "Testing WorkImage CRUD on disk: {$disk}\n";

if ($disk === 'r2' && blank(config('filesystems.disks.r2.endpoint'))) {
    fwrite(STDERR, "SKIP: ตั้ง CLOUDFLARE_ACCOUNT_ID ใน .env ก่อน\n");
    exit(1);
}

$png = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAEhQGAhKmMIQAAAABJRU5ErkJggg==');
$storage = Storage::disk(WorkImage::storageDisk());
$key = 'work-images/test-'.time().'.png';

try {
    echo "[CREATE] put {$key}\n";
    $storage->put($key, $png, ['visibility' => 'public']);

    $image = WorkImage::query()->create([
        'path' => $key,
        'original_name' => 'test.png',
        'mime_type' => 'image/png',
        'size_bytes' => strlen($png),
        'is_published' => false,
    ]);
    echo '  model id='.$image->id."\n";
    echo '  url='.$image->url."\n";

    echo "[READ] get bytes\n";
    $read = $storage->get($key);
    if (strlen($read) !== strlen($png)) {
        throw new RuntimeException('read size mismatch');
    }
    echo "  OK ({$image->original_name})\n";

    echo "[UPDATE] replace file + metadata\n";
    $newKey = 'work-images/test-updated-'.time().'.png';
    $storage->put($newKey, $png, ['visibility' => 'public']);
    if ($image->path !== '') {
        $storage->delete($image->path);
    }
    $image->update([
        'path' => $newKey,
        'original_name' => 'test-updated.png',
    ]);
    echo '  url='.$image->fresh()->url."\n";

    echo "[DELETE] model + file\n";
    $deletedPath = $image->path;
    $image->delete();

    if ($disk !== 'r2') {
        if ($storage->exists($deletedPath)) {
            throw new RuntimeException('file still exists after delete');
        }
    }

    echo "\nWorkImage CRUD PASSED\n";
    exit(0);
} catch (Throwable $e) {
    echo "\nWorkImage CRUD FAILED: ".$e->getMessage()."\n";
    if (isset($image) && $image->exists) {
        $image->delete();
    }
    exit(1);
}
