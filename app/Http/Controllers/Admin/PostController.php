<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PostRequest;
use App\Models\Author;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::query()
            ->with('author')
            ->orderByDesc('published_at')
            ->paginate(20);

        return view('admin.posts.index', compact('posts'));
    }

    public function create(): View
    {
        return view('admin.posts.create', [
            'authors' => Author::query()->where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->resolveSlug($data, 'title', Post::class);
        $data['word_count'] = $this->wordCount($data['body'] ?? null);
        $this->syncPublishedAt($data);

        Post::query()->create($data);

        return $this->redirectWithSuccess('admin.posts.index', 'เพิ่มบทความเรียบร้อยแล้ว');
    }

    public function edit(Post $post): View
    {
        return view('admin.posts.edit', [
            'post' => $post,
            'authors' => Author::query()->where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->resolveSlug($data, 'title', Post::class, $post->id);
        $data['word_count'] = $this->wordCount($data['body'] ?? null);
        $this->syncPublishedAt($data);

        $post->update($data);

        return $this->redirectWithSuccess('admin.posts.index', 'อัปเดตบทความเรียบร้อยแล้ว');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return $this->redirectWithSuccess('admin.posts.index', 'ลบบทความเรียบร้อยแล้ว');
    }
}
