<?php

namespace App\Providers;

use App\Models\Location;
use App\Models\Portfolio;
use App\Models\Post;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceItem;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
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
