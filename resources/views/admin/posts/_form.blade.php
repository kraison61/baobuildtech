@props(['post' => null, 'authors' => []])

<div class="grid gap-4 sm:grid-cols-2">
    <div class="sm:col-span-2">
        <x-ui.label for="title">หัวข้อ *</x-ui.label>
        <x-ui.input type="text" name="title" id="title" :value="old('title', $post?->title)" required />
    </div>
    <div>
        <x-ui.label for="slug">Slug</x-ui.label>
        <x-ui.input type="text" name="slug" id="slug" :value="old('slug', $post?->slug)" />
    </div>
    <div>
        <x-ui.label for="author_id">ผู้เขียน *</x-ui.label>
        <x-ui.select name="author_id" id="author_id" required>
            @foreach ($authors as $author)
                <option value="{{ $author->id }}" @selected(old('author_id', $post?->author_id) == $author->id)>{{ $author->name }}</option>
            @endforeach
        </x-ui.select>
    </div>
    <div class="sm:col-span-2">
        <x-ui.label for="excerpt">Excerpt</x-ui.label>
        <x-ui.textarea name="excerpt" id="excerpt" rows="2">{{ old('excerpt', $post?->excerpt) }}</x-ui.textarea>
    </div>
    <div class="sm:col-span-2">
        <x-ui.label for="body">เนื้อหา (HTML)</x-ui.label>
        <x-ui.textarea name="body" id="body" rows="12" class="font-mono text-xs">{{ old('body', $post?->body) }}</x-ui.textarea>
    </div>
    <div>
        <x-ui.label for="image_16x9">รูป 16:9 (URL)</x-ui.label>
        <x-ui.input type="url" name="image_16x9" id="image_16x9" :value="old('image_16x9', $post?->image_16x9)" />
    </div>
    <div>
        <x-ui.label for="image_4x3">รูป 4:3 (URL)</x-ui.label>
        <x-ui.input type="url" name="image_4x3" id="image_4x3" :value="old('image_4x3', $post?->image_4x3)" />
    </div>
    <div>
        <x-ui.label for="image_1x1">รูป 1:1 (URL)</x-ui.label>
        <x-ui.input type="url" name="image_1x1" id="image_1x1" :value="old('image_1x1', $post?->image_1x1)" />
    </div>
    <div>
        <x-ui.label for="published_at">วันที่เผยแพร่</x-ui.label>
        <x-ui.input type="datetime-local" name="published_at" id="published_at" :value="old('published_at', $post?->published_at?->format('Y-m-d\TH:i'))" />
    </div>
    <div>
        <x-ui.label for="meta_title">Meta Title</x-ui.label>
        <x-ui.input type="text" name="meta_title" id="meta_title" :value="old('meta_title', $post?->meta_title)" maxlength="100" />
    </div>
    <div>
        <x-ui.label for="meta_description">Meta Description</x-ui.label>
        <x-ui.input type="text" name="meta_description" id="meta_description" :value="old('meta_description', $post?->meta_description)" maxlength="160" />
    </div>
    <div class="sm:col-span-2">
        <x-ui.checkbox name="is_published" value="1" label="เผยแพร่" :checked="old('is_published', $post?->is_published ?? false)" />
    </div>
</div>
