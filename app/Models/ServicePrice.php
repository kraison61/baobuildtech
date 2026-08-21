<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[Fillable([
    'priceable_type',
    'priceable_id',
    'price_type',
    'label',
    'price_min',
    'price_max',
    'price_unit',
    'currency',
    'note',
    'is_visible',
    'sort_order',
])]
class ServicePrice extends Model
{
    protected function casts(): array
    {
        return [
            'price_min' => 'decimal:2',
            'price_max' => 'decimal:2',
            'is_visible' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function priceable(): MorphTo
    {
        return $this->morphTo();
    }
}
