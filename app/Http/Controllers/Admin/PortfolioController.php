<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PortfolioRequest;
use App\Models\Location;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        $portfolios = Portfolio::query()
            ->with(['service', 'serviceItem', 'location'])
            ->withCount('images')
            ->orderByDesc('completed_at')
            ->paginate(20);

        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create(): View
    {
        return view('admin.portfolios.create', $this->formOptions());
    }

    public function store(PortfolioRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->resolveSlug($data, 'title', Portfolio::class);

        Portfolio::query()->create($data);

        return $this->redirectWithSuccess('admin.portfolios.index', 'เพิ่มผลงานเรียบร้อยแล้ว');
    }

    public function edit(Portfolio $portfolio): View
    {
        $portfolio->load('images');

        return view('admin.portfolios.edit', [
            'portfolio' => $portfolio,
            ...$this->formOptions(),
        ]);
    }

    public function update(PortfolioRequest $request, Portfolio $portfolio): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->resolveSlug($data, 'title', Portfolio::class, $portfolio->id);

        $portfolio->update($data);

        return $this->redirectWithSuccess('admin.portfolios.edit', 'อัปเดตผลงานเรียบร้อยแล้ว', $portfolio);
    }

    public function destroy(Portfolio $portfolio): RedirectResponse
    {
        $portfolio->delete();

        return $this->redirectWithSuccess('admin.portfolios.index', 'ลบผลงานเรียบร้อยแล้ว');
    }

    /** @return array<string, mixed> */
    private function formOptions(): array
    {
        return [
            'services' => Service::query()->orderBy('sort_order')->orderBy('name')->get(),
            'serviceItems' => ServiceItem::query()->with('service')->orderBy('sort_order')->orderBy('name')->get(),
            'locations' => Location::query()->orderBy('name')->get(),
        ];
    }
}
