<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ServicePriceRequest;
use App\Models\ServicePrice;
use App\Support\Admin\MorphOptions;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServicePriceController extends Controller
{
    public function index(): View
    {
        $prices = ServicePrice::query()
            ->with('priceable')
            ->orderBy('sort_order')
            ->paginate(20);

        return view('admin.service-prices.index', compact('prices'));
    }

    public function create(): View
    {
        return view('admin.service-prices.create', [
            'priceableTypes' => MorphOptions::priceableTypes(),
            'priceTypes' => MorphOptions::priceTypes(),
            'recordsByType' => $this->recordsByType(),
        ]);
    }

    public function store(ServicePriceRequest $request): RedirectResponse
    {
        ServicePrice::query()->create($request->validated());

        return $this->redirectWithSuccess('admin.service-prices.index', 'เพิ่มราคาบริการเรียบร้อยแล้ว');
    }

    public function edit(ServicePrice $servicePrice): View
    {
        return view('admin.service-prices.edit', [
            'price' => $servicePrice,
            'priceableTypes' => MorphOptions::priceableTypes(),
            'priceTypes' => MorphOptions::priceTypes(),
            'recordsByType' => $this->recordsByType(),
        ]);
    }

    public function update(ServicePriceRequest $request, ServicePrice $servicePrice): RedirectResponse
    {
        $servicePrice->update($request->validated());

        return $this->redirectWithSuccess('admin.service-prices.index', 'อัปเดตราคาบริการเรียบร้อยแล้ว');
    }

    public function destroy(ServicePrice $servicePrice): RedirectResponse
    {
        $servicePrice->delete();

        return $this->redirectWithSuccess('admin.service-prices.index', 'ลบราคาบริการเรียบร้อยแล้ว');
    }

    /** @return array<string, list<array{id: int, label: string}>> */
    private function recordsByType(): array
    {
        $records = [];
        foreach (array_keys(MorphOptions::priceableTypes()) as $type) {
            $records[$type] = MorphOptions::priceableRecords($type);
        }

        return $records;
    }
}
