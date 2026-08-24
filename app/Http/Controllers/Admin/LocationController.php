<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\LocationRequest;
use App\Models\Location;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LocationController extends Controller
{
    public function index(): View
    {
        $locations = Location::query()
            ->withCount('portfolios')
            ->orderBy('province')
            ->orderBy('name')
            ->paginate(20);

        return view('admin.locations.index', compact('locations'));
    }

    public function create(): View
    {
        return view('admin.locations.create');
    }

    public function store(LocationRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->resolveSlug($data, 'name', Location::class);

        Location::query()->create($data);

        return $this->redirectWithSuccess('admin.locations.index', 'เพิ่มพื้นที่ให้บริการเรียบร้อยแล้ว');
    }

    public function edit(Location $location): View
    {
        return view('admin.locations.edit', compact('location'));
    }

    public function update(LocationRequest $request, Location $location): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->resolveSlug($data, 'name', Location::class, $location->id);

        $location->update($data);

        return $this->redirectWithSuccess('admin.locations.index', 'อัปเดตพื้นที่ให้บริการเรียบร้อยแล้ว');
    }

    public function destroy(Location $location): RedirectResponse
    {
        if ($location->portfolios()->exists()) {
            return back()->with('error', 'ไม่สามารถลบพื้นที่ที่มีผลงานอ้างอิงอยู่ได้');
        }

        $location->delete();

        return $this->redirectWithSuccess('admin.locations.index', 'ลบพื้นที่ให้บริการเรียบร้อยแล้ว');
    }
}
