<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
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

    /**
     * ราคาที่แสดงบน front ได้ — is_visible และเจ้าของเผยแพร่แล้ว
     * (service_item ต้องมี service แม่เผยแพร่ด้วย)
     */
    public function scopeForPublicDisplay(Builder $query): Builder
    {
        return $query
            ->where('is_visible', true)
            ->where(function (Builder $q): void {
                $q->where(function (Builder $q): void {
                    $q->where('priceable_type', 'service')
                        ->whereHasMorph(
                            'priceable',
                            [Service::class],
                            static fn (Builder $owner) => $owner->where('is_published', true),
                        );
                })->orWhere(function (Builder $q): void {
                    $q->where('priceable_type', 'service_item')
                        ->whereHasMorph(
                            'priceable',
                            [ServiceItem::class],
                            static fn (Builder $owner) => $owner
                                ->where('is_published', true)
                                ->whereHas(
                                    'service',
                                    static fn (Builder $s) => $s->where('is_published', true),
                                ),
                        );
                });
            });
    }

    public function formattedRange(): string
    {
        $min = $this->formattedMin();
        $max = $this->formattedMax();
        $unit = $this->price_unit ? ' '.$this->price_unit : '';

        if ($min && $max) {
            return $min.'–'.$max.$unit;
        }

        if ($min) {
            return 'เริ่ม '.$min.$unit;
        }

        return trim($unit) !== '' ? trim($unit) : 'สอบถาม';
    }

    public function formattedMin(): ?string
    {
        return $this->price_min !== null
            ? number_format((float) $this->price_min)
            : null;
    }

    public function formattedMax(): ?string
    {
        return $this->price_max !== null
            ? number_format((float) $this->price_max)
            : null;
    }
}
