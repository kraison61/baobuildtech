<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ServiceItemRequest;
use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceItemController extends Controller
{
    public function index(): View
    {
        $items = ServiceItem::query()
            ->with('service.category')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(20);

        return view('admin.service-items.index', compact('items'));
    }

    public function create(): View
    {
        return view('admin.service-items.create', [
            'services' => Service::query()->with('category')->orderBy('sort_order')->orderBy('name')->get(),
        ]);
    }

    public function store(ServiceItemRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->resolveSlug($data, 'name', ServiceItem::class);
        $this->syncPublishedAt($data);

        ServiceItem::query()->create($data);
        $this->forgetNavigationCache();

        return $this->redirectWithSuccess('admin.service-items.index', 'เพิ่มรายการบริการเรียบร้อยแล้ว');
    }

    public function edit(ServiceItem $serviceItem): View
    {
        return view('admin.service-items.edit', [
            'item' => $serviceItem,
            'services' => Service::query()->with('category')->orderBy('sort_order')->orderBy('name')->get(),
        ]);
    }

    public function update(ServiceItemRequest $request, ServiceItem $serviceItem): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->resolveSlug($data, 'name', ServiceItem::class, $serviceItem->id);
        $this->syncPublishedAt($data);

        $serviceItem->update($data);
        $this->forgetNavigationCache();

        return $this->redirectWithSuccess('admin.service-items.index', 'อัปเดตรายการบริการเรียบร้อยแล้ว');
    }

    public function destroy(ServiceItem $serviceItem): RedirectResponse
    {
        $serviceItem->delete();
        $this->forgetNavigationCache();

        return $this->redirectWithSuccess('admin.service-items.index', 'ลบรายการบริการเรียบร้อยแล้ว');
    }
}
