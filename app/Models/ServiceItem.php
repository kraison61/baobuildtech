<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

#[Fillable([
    'service_id',
    'name',
    'slug',
    'description',
    'headline',
    'excerpt',
    'content',
    'cover_image',
    'meta_title',
    'meta_description',
    'sort_order',
    'is_published',
    'published_at',
])]
class ServiceItem extends Model
{
    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'sort_order' => 'integer',
            'published_at' => 'datetime',
        ];
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function prices(): MorphMany
    {
        return $this->morphMany(ServicePrice::class, 'priceable');
    }

    public function portfolios(): HasMany
    {
        return $this->hasMany(Portfolio::class);
    }

    public function workImages(): HasMany
    {
        return $this->hasMany(WorkImage::class)->orderBy('sort_order');
    }

    public function faqs(): MorphMany
    {
        return $this->morphMany(Faq::class, 'faqable');
    }

    public function url(): string
    {
        $this->loadMissing('service.category');

        return route('services.items.show', [
            $this->service->category->slug,
            $this->service->slug,
            $this->slug,
        ]);
    }
}
