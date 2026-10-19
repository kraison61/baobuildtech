@props(['post' => null, 'authors' => []])

@php
    $fileInputClass = 'block w-full rounded-lg border border-slate-600 bg-slate-800 px-3 py-2 text-sm text-slate-100 file:me-3 file:rounded-md file:border-0 file:bg-emerald-600 file:px-3 file:py-1.5 file:text-sm file:text-white hover:file:bg-emerald-500';
@endphp

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

    <div class="sm:col-span-2">
        <p class="text-sm font-medium text-slate-200">รูปปกบทความ</p>
        <p class="mt-1 text-xs text-slate-500">เก็บที่ <code class="text-slate-400">assets/blogs/{slug}/</code> · 16:9 เป็นค่าหลัก · ถ้าไม่ใส่ 4:3 / 1:1 จะใช้รูปเดียวกับ 16:9</p>
    </div>

    <div>
        <x-ui.label for="image_16x9_file">รูป 16:9 (default)</x-ui.label>
        @if ($post?->image_16x9)
            <div class="mb-2 overflow-hidden rounded-lg border border-slate-600">
                <img src="{{ $post->image_16x9 }}" alt="" class="aspect-video w-full object-cover" />
            </div>
            <x-ui.checkbox name="remove_image_16x9" value="1" label="ลบรูป 16:9" :checked="old('remove_image_16x9', false)" />
        @endif
        <input type="file" name="image_16x9_file" id="image_16x9_file" accept="image/jpeg,image/png,image/webp" class="{{ $fileInputClass }} {{ $post?->image_16x9 ? 'mt-2' : '' }}" />
        <p class="mt-1 text-xs text-slate-500">แนะนำ 1200×675 px · jpg / png / webp · ไม่เกิน 3 MB</p>
        @error('image_16x9_file')
            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <x-ui.label for="image_4x3_file">รูป 4:3 (ถ้าไม่มีใช้ 16:9)</x-ui.label>
        @if ($post?->image_4x3)
            <div class="mb-2 overflow-hidden rounded-lg border border-slate-600">
                <img src="{{ $post->image_4x3 }}" alt="" class="aspect-[4/3] w-full object-cover" />
            </div>
            <x-ui.checkbox name="remove_image_4x3" value="1" label="ลบรูป 4:3" :checked="old('remove_image_4x3', false)" />
        @endif
        <input type="file" name="image_4x3_file" id="image_4x3_file" accept="image/jpeg,image/png,image/webp" class="{{ $fileInputClass }} {{ $post?->image_4x3 ? 'mt-2' : '' }}" />
        <p class="mt-1 text-xs text-slate-500">แนะนำ 1200×900 px · ไม่บังคับ</p>
        @error('image_4x3_file')
            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <x-ui.label for="image_1x1_file">รูป 1:1 (ถ้าไม่มีใช้ 16:9)</x-ui.label>
        @if ($post?->image_1x1)
            <div class="mb-2 overflow-hidden rounded-lg border border-slate-600">
                <img src="{{ $post->image_1x1 }}" alt="" class="aspect-square w-full object-cover" />
            </div>
            <x-ui.checkbox name="remove_image_1x1" value="1" label="ลบรูป 1:1" :checked="old('remove_image_1x1', false)" />
        @endif
        <input type="file" name="image_1x1_file" id="image_1x1_file" accept="image/jpeg,image/png,image/webp" class="{{ $fileInputClass }} {{ $post?->image_1x1 ? 'mt-2' : '' }}" />
        <p class="mt-1 text-xs text-slate-500">แนะนำ 1200×1200 px · ไม่บังคับ</p>
        @error('image_1x1_file')
            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
        @enderror
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
