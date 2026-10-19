<?php

namespace App\Http\Controllers\Admin;

use App\Models\CtaClick;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CtaClickController extends Controller
{
    public function index(Request $request): View
    {
        $channel = $request->string('channel')->toString();

        $ctaClicks = CtaClick::query()
            ->when(
                $channel !== '' && in_array($channel, CtaClick::channels(), true),
                fn ($query) => $query->where('channel', $channel)
            )
            ->orderByDesc('created_at')
            ->paginate(30)
            ->withQueryString();

        $totals = [
            'line' => CtaClick::query()->where('channel', CtaClick::CHANNEL_LINE)->count(),
            'phone' => CtaClick::query()->where('channel', CtaClick::CHANNEL_PHONE)->count(),
        ];

        return view('admin.cta-clicks.index', compact('ctaClicks', 'channel', 'totals'));
    }
}
