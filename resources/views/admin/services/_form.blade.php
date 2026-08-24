@props(['service' => null, 'categories' => []])

<div class="grid gap-4 sm:grid-cols-2">
    <div class="sm:col-span-2">
        <x-ui.label for="category_id">หมวดหมู่ *</x-ui.label>
        <x-ui.select name="category_id" id="category_id" required>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" @selected(old('category_id', $service?->category_id) == $cat->id)>{{ $cat->name }}</option>
            @endforeach
        </x-ui.select>
    </div>
    <div class="sm:col-span-2">
        <x-ui.label for="name">ชื่อบริการ *</x-ui.label>
        <x-ui.input type="text" name="name" id="name" :value="old('name', $service?->name)" required />
    </div>
    <div>
        <x-ui.label for="slug">Slug</x-ui.label>
        <x-ui.input type="text" name="slug" id="slug" :value="old('slug', $service?->slug)" />
    </div>
    <div>
        <x-ui.label for="service_type">Service Type (schema.org)</x-ui.label>
        <x-ui.input type="text" name="service_type" id="service_type" :value="old('service_type', $service?->service_type)" />
    </div>
    <div class="sm:col-span-2">
        <x-ui.label for="excerpt">Excerpt</x-ui.label>
        <x-ui.textarea name="excerpt" id="excerpt" rows="2">{{ old('excerpt', $service?->excerpt) }}</x-ui.textarea>
    </div>
    <div class="sm:col-span-2">
        <x-ui.label for="description">คำอธิบาย</x-ui.label>
        <x-ui.textarea name="description" id="description" rows="4">{{ old('description', $service?->description) }}</x-ui.textarea>
    </div>
    <div class="sm:col-span-2">
        <x-ui.label for="cover_image">รูปปก (URL)</x-ui.label>
        <x-ui.input type="url" name="cover_image" id="cover_image" :value="old('cover_image', $service?->cover_image)" />
    </div>
    <div>
        <x-ui.label for="meta_title">Meta Title</x-ui.label>
        <x-ui.input type="text" name="meta_title" id="meta_title" :value="old('meta_title', $service?->meta_title)" maxlength="100" />
    </div>
    <div>
        <x-ui.label for="meta_description">Meta Description</x-ui.label>
        <x-ui.input type="text" name="meta_description" id="meta_description" :value="old('meta_description', $service?->meta_description)" maxlength="160" />
    </div>
    <div>
        <x-ui.label for="sort_order">ลำดับ</x-ui.label>
        <x-ui.input type="number" name="sort_order" id="sort_order" :value="old('sort_order', $service?->sort_order ?? 0)" min="0" />
    </div>
    <div>
        <x-ui.label for="published_at">วันที่เผยแพร่</x-ui.label>
        <x-ui.input type="datetime-local" name="published_at" id="published_at" :value="old('published_at', $service?->published_at?->format('Y-m-d\TH:i'))" />
    </div>
    <div class="sm:col-span-2">
        <x-ui.checkbox name="is_published" value="1" label="เผยแพร่" description="ปิด = ไม่แสดงบนหน้าเว็บ" :checked="old('is_published', $service?->is_published ?? false)" />
    </div>
</div>
