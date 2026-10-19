<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;

#[Fillable([
    'author_id',
    'title',
    'slug',
    'excerpt',
    'body',
    'image_16x9',
    'image_4x3',
    'image_1x1',
    'published_at',
    'meta_title',
    'meta_description',
    'word_count',
    'is_published',
])]
class Post extends Model
{
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'word_count' => 'integer',
            'is_published' => 'boolean',
        ];
    }

    /** disk ที่เก็บรูปบทความ (ใช้ร่วมกับ WorkImage) */
    public static function storageDisk(): string
    {
        return (string) config('filesystems.work_images_disk', 'public');
    }

    /** โฟลเดอร์บน disk: assets/blogs/{slug} */
    public static function storageDirectory(string $slug): string
    {
        return 'assets/blogs/'.$slug;
    }

    /**
     * URL รูปตาม ratio — ถ้าไม่มี 4:3 / 1:1 ให้ใช้ 16:9
     *
     * @param  '16x9'|'4x3'|'1x1'  $ratio
     */
    public function imageUrl(string $ratio = '16x9'): ?string
    {
        $url = match ($ratio) {
            '4x3' => $this->image_4x3 ?: $this->image_16x9,
            '1x1' => $this->image_1x1 ?: $this->image_16x9,
            default => $this->image_16x9 ?: $this->image_4x3 ?: $this->image_1x1,
        };

        return filled($url) ? (string) $url : null;
    }

    /**
     * รายการ URL รูปสำหรับ schema (คงลำดับ 16:9 → 4:3 → 1:1)
     *
     * @return list<string>
     */
    public function imageUrls(): array
    {
        return array_values(array_filter([
            $this->imageUrl('16x9'),
            $this->imageUrl('4x3'),
            $this->imageUrl('1x1'),
        ]));
    }

    /** แปลง CDN URL → relative path บน disk (เฉพาะ assets/blogs/...) */
    public static function pathFromUrl(?string $url): ?string
    {
        if (! filled($url)) {
            return null;
        }

        $path = parse_url((string) $url, PHP_URL_PATH);
        if (! is_string($path) || $path === '') {
            return null;
        }

        if (preg_match('#(?:^|/)(assets/blogs/.+)$#', $path, $matches) !== 1) {
            return null;
        }

        return $matches[1];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function faqs(): MorphMany
    {
        return $this->morphMany(Faq::class, 'faqable');
    }

    public function url(): string
    {
        return route('blog.show', $this->slug);
    }

    protected static function booted(): void
    {
        static::deleting(function (Post $post): void {
            $disk = Storage::disk(static::storageDisk());
            $paths = [];

            foreach (['image_16x9', 'image_4x3', 'image_1x1'] as $column) {
                $path = static::pathFromUrl($post->{$column});
                if ($path !== null) {
                    $paths[$path] = true;
                }
            }

            foreach (array_keys($paths) as $path) {
                $disk->delete($path);
            }
        });
    }
}
