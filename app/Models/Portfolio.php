<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use App\Support\Coordinates;
use App\Support\Locale;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

#[Fillable([
    'service_id',
    'service_item_id',
    'location_id',
    'lat',
    'lng',
    'title',
    'title_en',
    'slug',
    'description',
    'description_en',
    'content',
    'content_en',
    'cover_image',
    'client_name',
    'client_name_en',
    'completed_at',
    'meta_title',
    'meta_title_en',
    'meta_description',
    'meta_description_en',
    'is_published',
])]
class Portfolio extends Model
{
    use HasTranslations;

    public function translatedAttributes(): array
    {
        return ['title', 'description', 'content', 'client_name', 'meta_title', 'meta_description'];
    }

    protected function casts(): array
    {
        return [
            'lat' => 'decimal:8',
            'lng' => 'decimal:8',
            'completed_at' => 'date',
            'is_published' => 'boolean',
        ];
    }

    /** พิกัดแบบ Google Maps: "lat, lng" */
    public function getCoordinatesAttribute(): ?string
    {
        return Coordinates::format($this->lat, $this->lng);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function serviceItem(): BelongsTo
    {
        return $this->belongsTo(ServiceItem::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(PortfolioImage::class)->orderBy('sort_order');
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
        return Locale::route('works.show', $this->slug);
    }
}
