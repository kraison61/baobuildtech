<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use App\Support\Locale;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

#[Fillable([
    'service_id',
    'name',
    'name_en',
    'slug',
    'description',
    'description_en',
    'headline',
    'headline_en',
    'excerpt',
    'excerpt_en',
    'content',
    'content_en',
    'cover_image',
    'meta_title',
    'meta_title_en',
    'meta_description',
    'meta_description_en',
    'sort_order',
    'is_published',
    'published_at',
])]
class ServiceItem extends Model
{
    use HasTranslations;

    public function translatedAttributes(): array
    {
        return [
            'name', 'description', 'headline', 'excerpt', 'content',
            'meta_title', 'meta_description',
        ];
    }

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

        return Locale::route('services.items.show', [
            $this->service->category->slug,
            $this->service->slug,
            $this->slug,
        ]);
    }
}
