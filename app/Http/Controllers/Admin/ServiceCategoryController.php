<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ServiceCategoryRequest;
use App\Models\ServiceCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceCategoryController extends Controller
{
    public function index(): View
    {
        $categories = ServiceCategory::query()
            ->withCount('services')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(20);

        return view('admin.service-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.service-categories.create');
    }

    public function store(ServiceCategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->resolveSlug($data, 'name', ServiceCategory::class);

        ServiceCategory::query()->create($data);
        $this->forgetNavigationCache();

        return $this->redirectWithSuccess('admin.service-categories.index', 'เพิ่มหมวดหมู่บริการเรียบร้อยแล้ว');
    }

    public function edit(ServiceCategory $serviceCategory): View
    {
        return view('admin.service-categories.edit', ['category' => $serviceCategory]);
    }

    public function update(ServiceCategoryRequest $request, ServiceCategory $serviceCategory): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->resolveSlug($data, 'name', ServiceCategory::class, $serviceCategory->id);

        $serviceCategory->update($data);
        $this->forgetNavigationCache();

        return $this->redirectWithSuccess('admin.service-categories.index', 'อัปเดตหมวดหมู่บริการเรียบร้อยแล้ว');
    }

    public function destroy(ServiceCategory $serviceCategory): RedirectResponse
    {
        if ($serviceCategory->services()->exists()) {
            return back()->with('error', 'ไม่สามารถลบหมวดหมู่ที่มีบริการอยู่ได้');
        }

        $serviceCategory->delete();
        $this->forgetNavigationCache();

        return $this->redirectWithSuccess('admin.service-categories.index', 'ลบหมวดหมู่บริการเรียบร้อยแล้ว');
    }
}
