<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\ContactRequest;
use App\Models\QuoteRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('front.contact');
    }

    public function store(ContactRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        QuoteRequest::query()->create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'job_type' => $validated['job'],
            'area' => $validated['area'],
            'detail' => $validated['detail'] ?? null,
            'status' => QuoteRequest::STATUS_PENDING,
        ]);

        return redirect()
            ->route('contact')
            ->with('contact_sent', true)
            ->withFragment('form');
    }
}
