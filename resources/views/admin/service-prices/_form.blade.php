@props(['price' => null, 'priceableTypes' => [], 'priceTypes' => [], 'recordsByType' => []])

<div class="space-y-4">
    <x-admin.morph-select
        type-name="priceable_type"
        id-name="priceable_id"
        :types="$priceableTypes"
        :records-by-type="$recordsByType"
        :selected-type="old('priceable_type', $price?->priceable_type ?? 'service')"
        :selected-id="old('priceable_id', $price?->priceable_id ?? '')"
    />

    <div class="grid gap-4 sm:grid-cols-2">
        <div>
            <x-ui.label for="price_type">ประเภทราคา *</x-ui.label>
            <x-ui.select name="price_type" id="price_type" required>
                @foreach ($priceTypes as $value => $label)
                    <option value="{{ $value }}" @selected(old('price_type', $price?->price_type) === $value)>{{ $label }}</option>
                @endforeach
            </x-ui.select>
        </div>
        <div>
            <x-ui.label for="label">Label *</x-ui.label>
            <x-ui.input type="text" name="label" id="label" :value="old('label', $price?->label)" required />
        </div>
        <div>
            <x-ui.label for="price_min">ราคาต่ำสุด</x-ui.label>
            <x-ui.input type="number" name="price_min" id="price_min" step="0.01" min="0" :value="old('price_min', $price?->price_min)" />
        </div>
        <div>
            <x-ui.label for="price_max">ราคาสูงสุด</x-ui.label>
            <x-ui.input type="number" name="price_max" id="price_max" step="0.01" min="0" :value="old('price_max', $price?->price_max)" />
        </div>
        <div>
            <x-ui.label for="price_unit">หน่วย</x-ui.label>
            <x-ui.input type="text" name="price_unit" id="price_unit" :value="old('price_unit', $price?->price_unit)" placeholder="บาท/ตร.ม." />
        </div>
        <div>
            <x-ui.label for="currency">สกุลเงิน</x-ui.label>
            <x-ui.input type="text" name="currency" id="currency" :value="old('currency', $price?->currency ?? 'THB')" maxlength="3" />
        </div>
        <div class="sm:col-span-2">
            <x-ui.label for="note">หมายเหตุ</x-ui.label>
            <x-ui.textarea name="note" id="note" rows="2">{{ old('note', $price?->note) }}</x-ui.textarea>
        </div>
        <div>
            <x-ui.label for="sort_order">ลำดับ</x-ui.label>
            <x-ui.input type="number" name="sort_order" id="sort_order" :value="old('sort_order', $price?->sort_order ?? 0)" min="0" />
        </div>
        <div class="flex items-end">
            <x-ui.checkbox name="is_visible" value="1" label="แสดงบนหน้าเว็บ" :checked="old('is_visible', $price?->is_visible ?? true)" />
        </div>
    </div>
</div>
