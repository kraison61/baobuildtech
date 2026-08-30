@props(['category' => null])

<div class="grid gap-4 sm:grid-cols-2">
    <div class="sm:col-span-2">
        <x-ui.label for="name">ชื่อหมวดหมู่ *</x-ui.label>
        <x-ui.input type="text" name="name" id="name" :value="old('name', $category?->name)" required />
    </div>
    <div>
        <x-ui.label for="slug">Slug</x-ui.label>
        <x-ui.input type="text" name="slug" id="slug" :value="old('slug', $category?->slug)" placeholder="auto จากชื่อ" />
    </div>
    <div>
        <x-ui.label for="sort_order">ลำดับ</x-ui.label>
        <x-ui.input type="number" name="sort_order" id="sort_order" :value="old('sort_order', $category?->sort_order ?? 0)" min="0" />
    </div>
    <div class="sm:col-span-2">
        <x-ui.label for="description">คำอธิบาย</x-ui.label>
        <x-ui.textarea name="description" id="description" rows="3">{{ old('description', $category?->description) }}</x-ui.textarea>
    </div>
    <div class="sm:col-span-2">
        <x-ui.label for="cover_image">รูปปก (URL)</x-ui.label>
        <x-ui.input type="url" name="cover_image" id="cover_image" :value="old('cover_image', $category?->cover_image)" />
        <p class="mt-1 text-xs text-slate-500">แนะนำ 1200×900 px (4:3)</p>
    </div>
    <div class="sm:col-span-2">
        <x-ui.checkbox name="is_active" value="1" label="เปิดใช้งาน" description="ปิด = ไม่แสดงบนหน้าเว็บ" :checked="old('is_active', $category?->is_active ?? true)" />
    </div>
</div>
