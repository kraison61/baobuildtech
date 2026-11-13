@props(['location' => null])

<div class="grid gap-4 sm:grid-cols-2">
    <div class="sm:col-span-2">
        <x-ui.label for="name">ชื่อพื้นที่ *</x-ui.label>
        <x-ui.input type="text" name="name" id="name" :value="old('name', $location?->name)" required />
    </div>
    <div>
        <x-ui.label for="slug">Slug</x-ui.label>
        <x-ui.input type="text" name="slug" id="slug" :value="old('slug', $location?->slug)" />
    </div>
    <div>
        <x-ui.label for="phone">เบอร์โทร (override)</x-ui.label>
        <x-ui.input type="text" name="phone" id="phone" :value="old('phone', $location?->phone)" />
    </div>
    <div>
        <x-ui.label for="province">จังหวัด</x-ui.label>
        <x-ui.input type="text" name="province" id="province" :value="old('province', $location?->province)" />
    </div>
    <div>
        <x-ui.label for="district">อำเภอ/เขต</x-ui.label>
        <x-ui.input type="text" name="district" id="district" :value="old('district', $location?->district)" />
    </div>
    <div class="sm:col-span-2">
        <x-ui.label for="street">ที่อยู่</x-ui.label>
        <x-ui.input type="text" name="street" id="street" :value="old('street', $location?->street)" />
    </div>
    <div>
        <x-ui.label for="postal_code">รหัสไปรษณีย์</x-ui.label>
        <x-ui.input type="text" name="postal_code" id="postal_code" :value="old('postal_code', $location?->postal_code)" />
    </div>
    <div>
        <x-ui.label for="lat">Latitude</x-ui.label>
        <x-ui.input type="number" name="lat" id="lat" step="any" :value="old('lat', $location?->lat)" />
    </div>
    <div>
        <x-ui.label for="lng">Longitude</x-ui.label>
        <x-ui.input type="number" name="lng" id="lng" step="any" :value="old('lng', $location?->lng)" />
    </div>
    <div class="sm:col-span-2">
        <x-ui.label for="description">คำอธิบาย</x-ui.label>
        <x-ui.textarea name="description" id="description" rows="4">{{ old('description', $location?->description) }}</x-ui.textarea>
    </div>
    <div>
        <x-ui.label for="meta_title">Meta Title</x-ui.label>
        <x-ui.input type="text" name="meta_title" id="meta_title" :value="old('meta_title', $location?->meta_title)" maxlength="100" />
    </div>
    <div>
        <x-ui.label for="meta_description">Meta Description</x-ui.label>
        <x-ui.input type="text" name="meta_description" id="meta_description" :value="old('meta_description', $location?->meta_description)" maxlength="160" />
    </div>

    <div class="sm:col-span-2 mt-2 border-t border-slate-200 pt-4">
        <h3 class="text-sm font-semibold text-slate-700">English</h3>
    </div>
    <div class="sm:col-span-2">
        <x-ui.label for="name_en">Name (EN)</x-ui.label>
        <x-ui.input type="text" name="name_en" id="name_en" :value="old('name_en', $location?->name_en)" />
    </div>
    <div>
        <x-ui.label for="province_en">Province (EN)</x-ui.label>
        <x-ui.input type="text" name="province_en" id="province_en" :value="old('province_en', $location?->province_en)" />
    </div>
    <div>
        <x-ui.label for="district_en">District (EN)</x-ui.label>
        <x-ui.input type="text" name="district_en" id="district_en" :value="old('district_en', $location?->district_en)" />
    </div>
    <div class="sm:col-span-2">
        <x-ui.label for="description_en">Description (EN)</x-ui.label>
        <x-ui.textarea name="description_en" id="description_en" rows="4">{{ old('description_en', $location?->description_en) }}</x-ui.textarea>
    </div>
    <div>
        <x-ui.label for="meta_title_en">Meta Title (EN)</x-ui.label>
        <x-ui.input type="text" name="meta_title_en" id="meta_title_en" :value="old('meta_title_en', $location?->meta_title_en)" maxlength="100" />
    </div>
    <div>
        <x-ui.label for="meta_description_en">Meta Description (EN)</x-ui.label>
        <x-ui.input type="text" name="meta_description_en" id="meta_description_en" :value="old('meta_description_en', $location?->meta_description_en)" maxlength="160" />
    </div>

    <div class="sm:col-span-2">
        <x-ui.checkbox name="is_published" value="1" label="เผยแพร่" :checked="old('is_published', $location?->is_published ?? false)" />
    </div>
</div>
