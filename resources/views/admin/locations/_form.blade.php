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
    <div class="sm:col-span-2">
        <x-ui.checkbox name="is_published" value="1" label="เผยแพร่" :checked="old('is_published', $location?->is_published ?? false)" />
    </div>
</div>
