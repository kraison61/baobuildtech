<?php

namespace App\Models;

use App\Support\Coordinates;
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
    'slug',
    'description',
    'cover_image',
    'client_name',
    'completed_at',
    'meta_title',
    'meta_description',
    'is_published',
])]
class Portfolio extends Model
{
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
}
