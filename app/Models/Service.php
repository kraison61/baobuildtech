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
    'category_id',
    'name',
    'name_en',
    'slug',
    'headline',
    'headline_en',
    'description',
    'description_en',
    'content',
    'content_en',
    'excerpt',
    'excerpt_en',
    'cover_image',
    'service_type',
    'service_type_en',
    'meta_title',
    'meta_title_en',
    'meta_description',
    'meta_description_en',
    'sort_order',
    'is_published',
    'published_at',
])]
class Service extends Model
{
    use HasTranslations;

    public function translatedAttributes(): array
    {
        return [
            'name', 'headline', 'description', 'content', 'excerpt',
            'service_type', 'meta_title', 'meta_description',
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(ServiceItem::class);
    }

    public function prices(): MorphMany
    {
        return $this->morphMany(ServicePrice::class, 'priceable');
    }

    public function portfolios(): HasMany
    {
        return $this->hasMany(Portfolio::class);
    }

    public function faqs(): MorphMany
    {
        return $this->morphMany(Faq::class, 'faqable');
    }

    public function url(): string
    {
        $this->loadMissing('category');

        return Locale::route('services.show', [$this->category->slug, $this->slug]);
    }
}
