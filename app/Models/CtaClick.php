<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'channel',
    'source',
    'page_url',
    'referrer',
    'user_agent',
    'ip',
])]
class CtaClick extends Model
{
    public const UPDATED_AT = null;

    public const CHANNEL_LINE = 'line';

    public const CHANNEL_PHONE = 'phone';

    /** @return list<string> */
    public static function channels(): array
    {
        return [
            self::CHANNEL_LINE,
            self::CHANNEL_PHONE,
        ];
    }

    /** @return array<string, string> */
    public static function channelLabels(): array
    {
        return [
            self::CHANNEL_LINE => 'ไลน์',
            self::CHANNEL_PHONE => 'โทร',
        ];
    }

    public function channelLabel(): string
    {
        return self::channelLabels()[$this->channel] ?? $this->channel;
    }

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }
}
