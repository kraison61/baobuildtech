<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::query()
            ->with('category')
            ->withCount('items')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(20);

        return view('admin.services.index', compact('services'));
    }

    public function create(): View
    {
        return view('admin.services.create', [
            'categories' => ServiceCategory::query()->orderBy('sort_order')->orderBy('name')->get(),
        ]);
    }

    public function store(ServiceRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->resolveSlug($data, 'name', Service::class);
        $this->syncPublishedAt($data);

        Service::query()->create($data);
        $this->forgetNavigationCache();

        return $this->redirectWithSuccess('admin.services.index', 'เพิ่มบริการเรียบร้อยแล้ว');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.edit', [
            'service' => $service,
            'categories' => ServiceCategory::query()->orderBy('sort_order')->orderBy('name')->get(),
        ]);
    }

    public function update(ServiceRequest $request, Service $service): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->resolveSlug($data, 'name', Service::class, $service->id);
        $this->syncPublishedAt($data);

        $service->update($data);
        $this->forgetNavigationCache();

        return $this->redirectWithSuccess('admin.services.index', 'อัปเดตบริการเรียบร้อยแล้ว');
    }

    public function destroy(Service $service): RedirectResponse
    {
        if ($service->items()->exists()) {
            return back()->with('error', 'ไม่สามารถลบบริการที่มีรายการบริการอยู่ได้');
        }

        $service->delete();
        $this->forgetNavigationCache();

        return $this->redirectWithSuccess('admin.services.index', 'ลบบริการเรียบร้อยแล้ว');
    }
}
