@props(['author' => null])

<div class="grid gap-4 sm:grid-cols-2">
    <div class="sm:col-span-2">
        <x-ui.label for="name">ชื่อ *</x-ui.label>
        <x-ui.input type="text" name="name" id="name" :value="old('name', $author?->name)" required />
    </div>
    <div>
        <x-ui.label for="slug">Slug</x-ui.label>
        <x-ui.input type="text" name="slug" id="slug" :value="old('slug', $author?->slug)" />
    </div>
    <div>
        <x-ui.label for="job_title">ตำแหน่ง</x-ui.label>
        <x-ui.input type="text" name="job_title" id="job_title" :value="old('job_title', $author?->job_title)" />
    </div>
    <div class="sm:col-span-2">
        <x-ui.label for="bio">ประวัติ</x-ui.label>
        <x-ui.textarea name="bio" id="bio" rows="4">{{ old('bio', $author?->bio) }}</x-ui.textarea>
    </div>
    <div class="sm:col-span-2">
        <x-ui.label for="avatar">รูปโปรไฟล์ (URL)</x-ui.label>
        <x-ui.input type="url" name="avatar" id="avatar" :value="old('avatar', $author?->avatar)" />
    </div>
    <div class="sm:col-span-2">
        <x-ui.label for="social_links">Social Links (JSON)</x-ui.label>
        <x-ui.textarea name="social_links" id="social_links" rows="3" class="font-mono text-xs" placeholder='{"facebook":"https://..."}'>{{ old('social_links', $author?->social_links ? json_encode($author->social_links, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) : '') }}</x-ui.textarea>
    </div>
    <div class="sm:col-span-2">
        <x-ui.checkbox name="is_active" value="1" label="เปิดใช้งาน" :checked="old('is_active', $author?->is_active ?? true)" />
    </div>
</div>
