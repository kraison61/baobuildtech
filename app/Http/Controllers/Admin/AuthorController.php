<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthorController extends Controller
{
    public function index(): View
    {
        $authors = Author::query()
            ->withCount('posts')
            ->orderBy('name')
            ->paginate(20);

        return view('admin.authors.index', compact('authors'));
    }

    public function create(): View
    {
        return view('admin.authors.create');
    }

    public function store(AuthorRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->resolveSlug($data, 'name', Author::class);

        Author::query()->create($data);

        return $this->redirectWithSuccess('admin.authors.index', 'เพิ่มผู้เขียนเรียบร้อยแล้ว');
    }

    public function edit(Author $author): View
    {
        return view('admin.authors.edit', compact('author'));
    }

    public function update(AuthorRequest $request, Author $author): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->resolveSlug($data, 'name', Author::class, $author->id);

        $author->update($data);

        return $this->redirectWithSuccess('admin.authors.index', 'อัปเดตผู้เขียนเรียบร้อยแล้ว');
    }

    public function destroy(Author $author): RedirectResponse
    {
        if ($author->posts()->exists()) {
            return back()->with('error', 'ไม่สามารถลบผู้เขียนที่มีบทความอยู่ได้');
        }

        $author->delete();

        return $this->redirectWithSuccess('admin.authors.index', 'ลบผู้เขียนเรียบร้อยแล้ว');
    }
}
