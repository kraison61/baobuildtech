<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'phone',
    'job_type',
    'area',
    'detail',
    'status',
    'admin_notes',
    'contacted_at',
])]
class QuoteRequest extends Model
{
    public const STATUS_PENDING = 'pending';

    public const STATUS_CONTACTED = 'contacted';

    public const STATUS_QUOTED = 'quoted';

    public const STATUS_CLOSED = 'closed';

    /** @return list<string> */
    public static function statuses(): array
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_CONTACTED,
            self::STATUS_QUOTED,
            self::STATUS_CLOSED,
        ];
    }

    /** @return array<string, string> */
    public static function statusLabels(): array
    {
        return [
            self::STATUS_PENDING => 'รอติดต่อ',
            self::STATUS_CONTACTED => 'ติดต่อแล้ว',
            self::STATUS_QUOTED => 'ส่งใบเสนอราคาแล้ว',
            self::STATUS_CLOSED => 'ปิดเคส',
        ];
    }

    public function statusLabel(): string
    {
        return self::statusLabels()[$this->status] ?? $this->status;
    }

    public function statusVariant(): string
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'warning',
            self::STATUS_CONTACTED => 'default',
            self::STATUS_QUOTED => 'success',
            self::STATUS_CLOSED => 'danger',
            default => 'default',
        };
    }

    public function jobTypeLabel(): string
    {
        foreach (\App\Support\ContactContent::jobTypes() as $type) {
            if ($type['value'] === $this->job_type) {
                return $type['label'];
            }
        }

        return $this->job_type;
    }

    protected function casts(): array
    {
        return [
            'contacted_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
