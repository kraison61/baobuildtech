<?php

namespace App\Providers;

use App\Models\Location;
use App\Models\Portfolio;
use App\Models\Post;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceItem;
use App\Support\DotEnvFile;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // process env อาจค้าง LINE token เก่าไว้ (Dotenv ไม่ทับ) — บังคับอ่านจาก .env
        $token = DotEnvFile::get('LINE_CHANNEL_ACCESS_TOKEN');

        if ($token !== null && $token !== '') {
            putenv('LINE_CHANNEL_ACCESS_TOKEN='.$token);
            $_ENV['LINE_CHANNEL_ACCESS_TOKEN'] = $token;
            $_SERVER['LINE_CHANNEL_ACCESS_TOKEN'] = $token;
        }

        $enabled = DotEnvFile::get('LINE_NOTIFY_ENABLED');

        if ($enabled !== null && $enabled !== '') {
            putenv('LINE_NOTIFY_ENABLED='.$enabled);
            $_ENV['LINE_NOTIFY_ENABLED'] = $enabled;
            $_SERVER['LINE_NOTIFY_ENABLED'] = $enabled;
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (isset($_ENV['LINE_CHANNEL_ACCESS_TOKEN'])) {
            config([
                'services.line.channel_access_token' => $_ENV['LINE_CHANNEL_ACCESS_TOKEN'],
                'services.line.enabled' => filter_var(
                    $_ENV['LINE_NOTIFY_ENABLED'] ?? true,
                    FILTER_VALIDATE_BOOLEAN
                ),
            ]);
        }

        Relation::enforceMorphMap([
            'service_category' => ServiceCategory::class,
            'service' => Service::class,
            'service_item' => ServiceItem::class,
            'post' => Post::class,
            'location' => Location::class,
            'portfolio' => Portfolio::class,
        ]);
    }
}
