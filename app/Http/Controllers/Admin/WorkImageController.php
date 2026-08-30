<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\WorkImageStoreRequest;
use App\Http\Requests\Admin\WorkImageUpdateRequest;
use App\Models\Portfolio;
use App\Models\ServiceItem;
use App\Models\WorkImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class WorkImageController extends Controller
{
    public function index(): View
    {
        $images = WorkImage::query()
            ->with(['portfolio', 'serviceItem.service'])
            ->when(request('portfolio_id'), fn ($q, $id) => $q->where('portfolio_id', $id))
            ->when(request('service_item_id'), fn ($q, $id) => $q->where('service_item_id', $id))
            ->orderByDesc('id')
            ->paginate(24)
            ->withQueryString();

        return view('admin.work-images.index', [
            'images' => $images,
            'portfolios' => Portfolio::query()->orderByDesc('completed_at')->orderBy('title')->get(),
            'serviceItems' => ServiceItem::query()->with('service')->orderBy('sort_order')->orderBy('name')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.work-images.create', $this->formOptions());
    }

    public function store(WorkImageStoreRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['coordinates', 'images']);
        $files = $request->file('images', []);
        $created = 0;

        foreach ($files as $file) {
            if (! $file instanceof UploadedFile) {
                continue;
            }

            $path = $file->store('work-images', WorkImage::storageDisk());

            WorkImage::query()->create([
                ...$data,
                'path' => $path,
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'size_bytes' => $file->getSize(),
            ]);

            $created++;
        }

        return $this->redirectWithSuccess(
            'admin.work-images.index',
            "อัปโหลดรูปภาพ {$created} ไฟล์เรียบร้อยแล้ว",
        );
    }

    public function edit(WorkImage $workImage): View
    {
        return view('admin.work-images.edit', [
            'workImage' => $workImage,
            ...$this->formOptions(),
        ]);
    }

    public function update(WorkImageUpdateRequest $request, WorkImage $workImage): RedirectResponse
    {
        $data = $request->safe()->except(['coordinates', 'image']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $disk = WorkImage::storageDisk();
            $newPath = $file->store('work-images', $disk);

            if ($workImage->path !== '') {
                Storage::disk($disk)->delete($workImage->path);
            }

            $data['path'] = $newPath;
            $data['original_name'] = $file->getClientOriginalName();
            $data['mime_type'] = $file->getMimeType();
            $data['size_bytes'] = $file->getSize();
        }

        $workImage->update($data);

        return $this->redirectWithSuccess('admin.work-images.index', 'อัปเดตรูปภาพเรียบร้อยแล้ว');
    }

    public function destroy(WorkImage $workImage): RedirectResponse
    {
        $workImage->delete();

        return $this->redirectWithSuccess('admin.work-images.index', 'ลบรูปภาพเรียบร้อยแล้ว');
    }

    /** @return array<string, mixed> */
    private function formOptions(): array
    {
        return [
            'portfolios' => Portfolio::query()->orderByDesc('completed_at')->orderBy('title')->get(),
            'serviceItems' => ServiceItem::query()->with('service')->orderBy('sort_order')->orderBy('name')->get(),
        ];
    }
}
