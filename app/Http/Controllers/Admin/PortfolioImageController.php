<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PortfolioImageRequest;
use App\Models\Portfolio;
use App\Models\PortfolioImage;
use Illuminate\Http\RedirectResponse;

class PortfolioImageController extends Controller
{
    public function store(PortfolioImageRequest $request, Portfolio $portfolio): RedirectResponse
    {
        $portfolio->images()->create($request->validated());

        return $this->redirectWithSuccess('admin.portfolios.edit', 'เพิ่มรูปภาพเรียบร้อยแล้ว', $portfolio);
    }

    public function destroy(PortfolioImage $portfolioImage): RedirectResponse
    {
        $portfolio = $portfolioImage->portfolio;
        $portfolioImage->delete();

        return $this->redirectWithSuccess('admin.portfolios.edit', 'ลบรูปภาพเรียบร้อยแล้ว', $portfolio);
    }
}
