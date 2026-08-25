<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\ContactRequest;
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
        // เก็บไว้ใน session เพื่อแสดงข้อความสำเร็จ — ยังไม่ผูกอีเมล/DB
        return redirect()
            ->route('contact')
            ->with('contact_sent', true)
            ->withFragment('form');
    }
}
