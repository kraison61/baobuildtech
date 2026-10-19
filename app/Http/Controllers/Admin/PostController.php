<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PostRequest;
use App\Models\Author;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PostController extends Controller
{
    /** @var array<string, string> ratio => DB column */
    private const IMAGE_FIELDS = [
        '16x9' => 'image_16x9',
        '4x3' => 'image_4x3',
        '1x1' => 'image_1x1',
    ];

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
        $data = $request->safe()->except($this->imageRequestKeys());
        $data['slug'] = $this->resolveSlug($data, 'title', Post::class);
        $data['word_count'] = $this->wordCount($data['body'] ?? null);
        $this->syncPublishedAt($data);
        $this->syncPostImages($data, $request, null, $data['slug']);

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
        $data = $request->safe()->except($this->imageRequestKeys());
        $data['slug'] = $this->resolveSlug($data, 'title', Post::class, $post->id);
        $data['word_count'] = $this->wordCount($data['body'] ?? null);
        $this->syncPublishedAt($data);
        $this->syncPostImages($data, $request, $post, $data['slug']);

        $post->update($data);

        return $this->redirectWithSuccess('admin.posts.index', 'อัปเดตบทความเรียบร้อยแล้ว');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return $this->redirectWithSuccess('admin.posts.index', 'ลบบทความเรียบร้อยแล้ว');
    }

    /** @return list<string> */
    private function imageRequestKeys(): array
    {
        $keys = [];

        foreach (self::IMAGE_FIELDS as $column) {
            $keys[] = $column.'_file';
            $keys[] = 'remove_'.$column;
        }

        return $keys;
    }

    /**
     * อัปโหลด / ลบรูป และ fallback 4:3 / 1:1 → 16:9
     *
     * @param  array<string, mixed>  $data
     */
    private function syncPostImages(array &$data, PostRequest $request, ?Post $post, string $slug): void
    {
        foreach (self::IMAGE_FIELDS as $column) {
            $data[$column] = $post?->{$column};
        }

        $pendingDelete = [];

        foreach (self::IMAGE_FIELDS as $column) {
            if ($request->boolean('remove_'.$column)) {
                if (filled($data[$column] ?? null)) {
                    $pendingDelete[] = (string) $data[$column];
                }
                $data[$column] = null;
            }
        }

        foreach (self::IMAGE_FIELDS as $ratio => $column) {
            if (! $request->hasFile($column.'_file')) {
                continue;
            }

            $file = $request->file($column.'_file');
            if (! $file instanceof UploadedFile) {
                continue;
            }

            if (filled($data[$column] ?? null)) {
                $pendingDelete[] = (string) $data[$column];
            }

            $data[$column] = $this->storePostImage($file, $slug, $ratio);
        }

        $url16 = filled($data['image_16x9'] ?? null) ? (string) $data['image_16x9'] : null;

        if ($url16 !== null) {
            if (empty($data['image_4x3'])) {
                $data['image_4x3'] = $url16;
            }
            if (empty($data['image_1x1'])) {
                $data['image_1x1'] = $url16;
            }
        }

        $stillUsed = array_filter([
            $data['image_16x9'] ?? null,
            $data['image_4x3'] ?? null,
            $data['image_1x1'] ?? null,
        ]);

        foreach (array_unique($pendingDelete) as $url) {
            if (! in_array($url, $stillUsed, true)) {
                $this->deleteStoredImage($url);
            }
        }
    }

    private function storePostImage(UploadedFile $file, string $slug, string $ratio): string
    {
        $disk = Post::storageDisk();
        $storage = Storage::disk($disk);
        $ext = strtolower($file->getClientOriginalExtension() ?: $file->extension() ?: 'webp');
        $directory = Post::storageDirectory($slug);
        $filename = $ratio.'.'.$ext;

        // ลบไฟล์ ratio เดิม (ext อาจต่าง) ก่อนเขียนทับ
        foreach (['jpg', 'jpeg', 'png', 'webp'] as $oldExt) {
            $storage->delete($directory.'/'.$ratio.'.'.$oldExt);
        }

        $path = $file->storeAs($directory, $filename, $disk);

        return $storage->url($path);
    }

    private function deleteStoredImage(?string $url): void
    {
        $path = Post::pathFromUrl($url);
        if ($path === null) {
            return;
        }

        Storage::disk(Post::storageDisk())->delete($path);
    }
}
