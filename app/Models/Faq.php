<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[Fillable([
    'faqable_type',
    'faqable_id',
    'question',
    'question_en',
    'answer',
    'answer_en',
    'sort_order',
    'is_active',
])]
class Faq extends Model
{
    use HasTranslations;

    public const UPDATED_AT = null;

    public function translatedAttributes(): array
    {
        return ['question', 'answer'];
    }

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_active' => 'boolean',
            'created_at' => 'datetime',
        ];
    }

    public function faqable(): MorphTo
    {
        return $this->morphTo();
    }
}
