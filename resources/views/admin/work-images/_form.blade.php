@props(['workImage' => null, 'portfolios' => [], 'serviceItems' => [], 'bulk' => false])

@php
    $selectedPortfolio = old('portfolio_id', $workImage?->portfolio_id ?? request('portfolio_id'));
    $selectedItem = old('service_item_id', $workImage?->service_item_id ?? request('service_item_id'));
@endphp

<div class="grid gap-4 sm:grid-cols-2">
    <div>
        <x-ui.label for="portfolio_id">หน้างาน (ผลงาน)</x-ui.label>
        <x-ui.select name="portfolio_id" id="portfolio_id">
            <option value="">— ไม่ระบุ —</option>
            @foreach ($portfolios as $portfolio)
                <option value="{{ $portfolio->id }}" @selected($selectedPortfolio == $portfolio->id)>
                    {{ $portfolio->title }}
                </option>
            @endforeach
        </x-ui.select>
    </div>
    <div>
        <x-ui.label for="service_item_id">รายการบริการ</x-ui.label>
        <x-ui.select name="service_item_id" id="service_item_id">
            <option value="">— ไม่ระบุ —</option>
            @foreach ($serviceItems as $item)
                <option value="{{ $item->id }}" @selected($selectedItem == $item->id)>
                    {{ $item->service?->name ? $item->service->name.' › ' : '' }}{{ $item->name }}
                </option>
            @endforeach
        </x-ui.select>
    </div>

    <div class="sm:col-span-2">
        <x-ui.label for="coordinates">พิกัด GPS หน้างาน (คัดลอกจาก Google Maps)</x-ui.label>
        <x-ui.input
            type="text"
            name="coordinates"
            id="coordinates"
            :value="old('coordinates', $workImage?->coordinates)"
            placeholder="13.748436414898316, 100.48145963665914"
        />
        <p class="mt-1 text-xs text-slate-500">รูปแบบ lat, lng เช่น 13.748436414898316, 100.48145963665914</p>
        @error('coordinates')
            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
        @enderror
        @error('portfolio_id')
            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
        @enderror
    </div>

    @if ($bulk)
        <div class="sm:col-span-2">
            <x-ui.label for="images">รูปภาพ * (เลือกหลายไฟล์ได้)</x-ui.label>
            <input
                type="file"
                name="images[]"
                id="images"
                multiple
                accept="image/jpeg,image/png,image/webp"
                class="block w-full rounded-lg border border-slate-600 bg-slate-800 px-3 py-2 text-sm text-slate-100 file:me-3 file:rounded-md file:border-0 file:bg-emerald-600 file:px-3 file:py-1.5 file:text-sm file:text-white hover:file:bg-emerald-500"
                required
            />
            <p class="mt-1 text-xs text-slate-500">jpg / png / webp · ไม่เกิน 3 MB ต่อไฟล์ · สูงสุด 30 ไฟล์ต่อครั้ง</p>
            @error('images')
                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
            @enderror
            @error('images.*')
                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>
    @else
        <div class="sm:col-span-2">
            <x-ui.label for="image">เปลี่ยนไฟล์รูป (ไม่บังคับ)</x-ui.label>
            <input
                type="file"
                name="image"
                id="image"
                accept="image/jpeg,image/png,image/webp"
                class="block w-full rounded-lg border border-slate-600 bg-slate-800 px-3 py-2 text-sm text-slate-100 file:me-3 file:rounded-md file:border-0 file:bg-emerald-600 file:px-3 file:py-1.5 file:text-sm file:text-white hover:file:bg-emerald-500"
            />
            <p class="mt-1 text-xs text-slate-500">jpg / png / webp · ไม่เกิน 3 MB</p>
            @error('image')
                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>
    @endif

    <div>
        <x-ui.label for="alt_text">Alt Text</x-ui.label>
        <x-ui.input type="text" name="alt_text" id="alt_text" :value="old('alt_text', $workImage?->alt_text)" />
    </div>
    <div>
        <x-ui.label for="caption">คำบรรยาย</x-ui.label>
        <x-ui.input type="text" name="caption" id="caption" :value="old('caption', $workImage?->caption)" />
    </div>
    <div>
        <x-ui.label for="sort_order">ลำดับ</x-ui.label>
        <x-ui.input type="number" name="sort_order" id="sort_order" min="0" :value="old('sort_order', $workImage?->sort_order ?? 0)" />
    </div>
    <div class="flex items-end">
        <x-ui.checkbox name="is_published" value="1" label="เผยแพร่" :checked="old('is_published', $workImage?->is_published ?? false)" />
    </div>
</div>
