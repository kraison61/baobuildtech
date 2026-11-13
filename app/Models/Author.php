<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'name',
    'slug',
    'bio',
    'bio_en',
    'avatar',
    'job_title',
    'job_title_en',
    'social_links',
    'is_active',
])]
class Author extends Model
{
    use HasTranslations;

    public function translatedAttributes(): array
    {
        return ['bio', 'job_title'];
    }

    protected function casts(): array
    {
        return [
            'social_links' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
