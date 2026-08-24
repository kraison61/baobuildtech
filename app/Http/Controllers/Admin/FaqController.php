<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\FaqRequest;
use App\Models\Faq;
use App\Support\Admin\MorphOptions;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(): View
    {
        $faqs = Faq::query()
            ->with('faqable')
            ->orderBy('sort_order')
            ->paginate(20);

        return view('admin.faqs.index', compact('faqs'));
    }

    public function create(): View
    {
        return view('admin.faqs.create', [
            'faqableTypes' => MorphOptions::faqableTypes(),
            'recordsByType' => $this->recordsByType(),
        ]);
    }

    public function store(FaqRequest $request): RedirectResponse
    {
        Faq::query()->create($request->validated());

        return $this->redirectWithSuccess('admin.faqs.index', 'เพิ่ม FAQ เรียบร้อยแล้ว');
    }

    public function edit(Faq $faq): View
    {
        return view('admin.faqs.edit', [
            'faq' => $faq,
            'faqableTypes' => MorphOptions::faqableTypes(),
            'recordsByType' => $this->recordsByType(),
        ]);
    }

    public function update(FaqRequest $request, Faq $faq): RedirectResponse
    {
        $faq->update($request->validated());

        return $this->redirectWithSuccess('admin.faqs.index', 'อัปเดต FAQ เรียบร้อยแล้ว');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();

        return $this->redirectWithSuccess('admin.faqs.index', 'ลบ FAQ เรียบร้อยแล้ว');
    }

    /** @return array<string, list<array{id: int, label: string}>> */
    private function recordsByType(): array
    {
        $records = [];
        foreach (array_keys(MorphOptions::faqableTypes()) as $type) {
            $records[$type] = MorphOptions::faqableRecords($type);
        }

        return $records;
    }
}
