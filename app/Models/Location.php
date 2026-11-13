<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

#[Fillable([
    'name',
    'name_en',
    'slug',
    'province',
    'province_en',
    'district',
    'district_en',
    'description',
    'description_en',
    'phone',
    'street',
    'postal_code',
    'lat',
    'lng',
    'meta_title',
    'meta_title_en',
    'meta_description',
    'meta_description_en',
    'is_published',
])]
class Location extends Model
{
    use HasTranslations;

    public function translatedAttributes(): array
    {
        return [
            'name', 'province', 'district', 'description',
            'meta_title', 'meta_description',
        ];
    }

    protected function casts(): array
    {
        return [
            'lat' => 'decimal:8',
            'lng' => 'decimal:8',
            'is_published' => 'boolean',
        ];
    }

    public function portfolios(): HasMany
    {
        return $this->hasMany(Portfolio::class);
    }

    public function faqs(): MorphMany
    {
        return $this->morphMany(Faq::class, 'faqable');
    }
}
