<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::query()
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->with('author')
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->get();

        return view('front.blog.index', compact('posts'));
    }

    public function show(Request $request, string $slug): View
    {
        $post = Post::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->with([
                'author' => static fn ($q) => $q->where('is_active', true),
                'faqs' => static fn ($q) => $q
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->orderBy('id'),
            ])
            ->firstOrFail();

        return view('front.blog.show', compact('post'));
    }
}
