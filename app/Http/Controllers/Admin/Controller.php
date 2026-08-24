<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use App\Support\Navigation;
use App\Support\SlugGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

abstract class Controller extends BaseController
{
    protected function redirectWithSuccess(string $route, string $message, mixed $parameters = []): RedirectResponse
    {
        return redirect()->route($route, $parameters)->with('success', $message);
    }

    protected function resolveSlug(array $data, string $sourceField, string $modelClass, ?int $ignoreId = null): string
    {
        $slug = trim((string) ($data['slug'] ?? ''));

        if ($slug !== '') {
            return SlugGenerator::unique($slug, $modelClass, $ignoreId);
        }

        return SlugGenerator::unique((string) $data[$sourceField], $modelClass, $ignoreId);
    }

    protected function forgetNavigationCache(): void
    {
        Navigation::forgetCache();
    }

    /**
     * @param  array<string, mixed>  $data
     */
    protected function syncPublishedAt(array &$data): void
    {
        if (! empty($data['is_published']) && empty($data['published_at'])) {
            $data['published_at'] = now();
        }
    }

    protected function wordCount(?string $html): int
    {
        if ($html === null || $html === '') {
            return 0;
        }

        return str_word_count(strip_tags($html));
    }
}
