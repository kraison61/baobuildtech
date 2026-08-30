<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('storage:r2-test', function () {
    $diskName = (string) config('filesystems.work_images_disk', 'r2');
    $endpoint = config("filesystems.disks.{$diskName}.endpoint");

    $this->info("Disk: {$diskName}");
    $this->line('Bucket: '.config("filesystems.disks.{$diskName}.bucket"));
    $this->line('Endpoint: '.($endpoint ?: '(not configured)'));

    if ($diskName === 'r2' && blank($endpoint)) {
        $this->error('ตั้ง CLOUDFLARE_ACCOUNT_ID หรือ AWS_ENDPOINT ใน .env');
        $this->line('Cloudflare Dashboard → R2 → Overview → Account ID');

        return 1;
    }

    $disk = Storage::disk($diskName);
    $key = 'test/r2-crud-'.now()->format('Ymd-His').'.txt';

    try {
        $this->info("[CREATE] {$key}");
        $disk->put($key, 'hello R2 CRUD test');

        $content = $disk->get($key);
        $this->info('[READ] '.$content);
        $this->line('URL: '.$disk->url($key));

        if ($content !== 'hello R2 CRUD test') {
            throw new RuntimeException('read content mismatch');
        }

        $this->info('[UPDATE]');
        $disk->put($key, 'updated R2 CRUD test');

        if ($disk->get($key) !== 'updated R2 CRUD test') {
            throw new RuntimeException('update content mismatch');
        }

        $this->info('[DELETE]');
        $disk->delete($key);

        $this->newLine();
        $this->info('CRUD test PASSED');

        return 0;
    } catch (Throwable $e) {
        $this->error('CRUD test FAILED: '.$e->getMessage());

        return 1;
    }
})->purpose('ทดสอบ CRUD ไฟล์บน Cloudflare R2');
