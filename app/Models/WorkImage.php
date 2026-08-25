<?php

namespace App\Models;

use App\Support\Coordinates;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

#[Fillable([
    'portfolio_id',
    'service_item_id',
    'path',
    'original_name',
    'mime_type',
    'size_bytes',
    'alt_text',
    'caption',
    'lat',
    'lng',
    'sort_order',
    'is_published',
])]
class WorkImage extends Model
{
    protected function casts(): array
    {
        return [
            'lat' => 'decimal:8',
            'lng' => 'decimal:8',
            'size_bytes' => 'integer',
            'sort_order' => 'integer',
            'is_published' => 'boolean',
        ];
    }

    /** URL สาธารณะของไฟล์ */
    public function getUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->path);
    }

    /** พิกัดแบบ Google Maps: "lat, lng" */
    public function getCoordinatesAttribute(): ?string
    {
        return Coordinates::format($this->lat, $this->lng);
    }

    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }

    public function serviceItem(): BelongsTo
    {
        return $this->belongsTo(ServiceItem::class);
    }

    protected static function booted(): void
    {
        static::deleting(function (WorkImage $image): void {
            if ($image->path !== '' && Storage::disk('public')->exists($image->path)) {
                Storage::disk('public')->delete($image->path);
            }
        });
    }
}
