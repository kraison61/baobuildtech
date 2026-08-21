<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[Fillable([
    'faqable_type',
    'faqable_id',
    'question',
    'answer',
    'sort_order',
    'is_active',
])]
class Faq extends Model
{
    public const UPDATED_AT = null;

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
