<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\QuoteRequestRequest;
use App\Models\QuoteRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuoteRequestController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->string('status')->toString();

        $quoteRequests = QuoteRequest::query()
            ->when(
                $status !== '' && in_array($status, QuoteRequest::statuses(), true),
                fn ($query) => $query->where('status', $status)
            )
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        return view('admin.quote-requests.index', compact('quoteRequests', 'status'));
    }

    public function create(): View
    {
        return view('admin.quote-requests.create');
    }

    public function store(QuoteRequestRequest $request): RedirectResponse
    {
        $data = $this->prepareData($request->validated());

        QuoteRequest::query()->create($data);

        return $this->redirectWithSuccess('admin.quote-requests.index', 'เพิ่มคำขอใบเสนอราคาเรียบร้อยแล้ว');
    }

    public function edit(QuoteRequest $quoteRequest): View
    {
        return view('admin.quote-requests.edit', compact('quoteRequest'));
    }

    public function update(QuoteRequestRequest $request, QuoteRequest $quoteRequest): RedirectResponse
    {
        $data = $this->prepareData($request->validated(), $quoteRequest);

        $quoteRequest->update($data);

        return $this->redirectWithSuccess('admin.quote-requests.index', 'อัปเดตคำขอใบเสนอราคาเรียบร้อยแล้ว');
    }

    public function destroy(QuoteRequest $quoteRequest): RedirectResponse
    {
        $quoteRequest->delete();

        return $this->redirectWithSuccess('admin.quote-requests.index', 'ลบคำขอใบเสนอราคาเรียบร้อยแล้ว');
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function prepareData(array $data, ?QuoteRequest $quoteRequest = null): array
    {
        if (
            in_array($data['status'], [QuoteRequest::STATUS_CONTACTED, QuoteRequest::STATUS_QUOTED], true)
            && empty($data['contacted_at'])
            && ($quoteRequest === null || $quoteRequest->contacted_at === null)
        ) {
            $data['contacted_at'] = now();
        }

        return $data;
    }
}
