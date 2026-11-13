<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(): View
    {
        $portfolios = Portfolio::query()
            ->where('is_published', true)
            ->with('location')
            ->orderByDesc('completed_at')
            ->orderByDesc('id')
            ->get();

        return view('front.works.index', compact('portfolios'));
    }

    public function show(Request $request, string $slug): View
    {
        $portfolio = Portfolio::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->with([
                'location',
                'service.category',
                'serviceItem.service.category',
                'images',
                'faqs' => static fn ($q) => $q
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->orderBy('id'),
            ])
            ->firstOrFail();

        return view('front.works.show', compact('portfolio'));
    }
}
