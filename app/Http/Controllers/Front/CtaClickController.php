<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\CtaClickRequest;
use App\Models\CtaClick;
use Illuminate\Http\Response;

class CtaClickController extends Controller
{
    public function store(CtaClickRequest $request): Response
    {
        $validated = $request->validated();

        CtaClick::query()->create([
            'channel' => $validated['channel'],
            'source' => $validated['source'],
            'page_url' => $validated['page_url'] ?? null,
            'referrer' => $this->truncate($request->headers->get('referer')),
            'user_agent' => $this->truncate($request->userAgent()),
            'ip' => $request->ip(),
        ]);

        return response()->noContent();
    }

    private function truncate(?string $value, int $max = 500): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        return mb_substr($value, 0, $max);
    }
}
