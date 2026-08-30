@props(['portfolio' => null, 'services' => [], 'serviceItems' => [], 'locations' => []])

<div class="grid gap-4 sm:grid-cols-2">
    <div class="sm:col-span-2">
        <x-ui.label for="title">ชื่อโครงการ *</x-ui.label>
        <x-ui.input type="text" name="title" id="title" :value="old('title', $portfolio?->title)" required />
    </div>
    <div>
        <x-ui.label for="slug">Slug</x-ui.label>
        <x-ui.input type="text" name="slug" id="slug" :value="old('slug', $portfolio?->slug)" />
    </div>
    <div>
        <x-ui.label for="client_name">ชื่อลูกค้า</x-ui.label>
        <x-ui.input type="text" name="client_name" id="client_name" :value="old('client_name', $portfolio?->client_name)" />
    </div>
    <div>
        <x-ui.label for="service_id">บริการ</x-ui.label>
        <x-ui.select name="service_id" id="service_id">
            <option value="">— ไม่ระบุ —</option>
            @foreach ($services as $svc)
                <option value="{{ $svc->id }}" @selected(old('service_id', $portfolio?->service_id) == $svc->id)>{{ $svc->name }}</option>
            @endforeach
        </x-ui.select>
    </div>
    <div>
        <x-ui.label for="service_item_id">รายการบริการ</x-ui.label>
        <x-ui.select name="service_item_id" id="service_item_id">
            <option value="">— ไม่ระบุ —</option>
            @foreach ($serviceItems as $item)
                <option value="{{ $item->id }}" @selected(old('service_item_id', $portfolio?->service_item_id) == $item->id)>
                    {{ $item->service?->name ? $item->service->name.' › ' : '' }}{{ $item->name }}
                </option>
            @endforeach
        </x-ui.select>
    </div>
    <div>
        <x-ui.label for="location_id">พื้นที่</x-ui.label>
        <x-ui.select name="location_id" id="location_id">
            <option value="">— ไม่ระบุ —</option>
            @foreach ($locations as $loc)
                <option value="{{ $loc->id }}" @selected(old('location_id', $portfolio?->location_id) == $loc->id)>{{ $loc->name }}</option>
            @endforeach
        </x-ui.select>
    </div>
    <div>
        <x-ui.label for="completed_at">วันที่แล้วเสร็จ</x-ui.label>
        <x-ui.input type="date" name="completed_at" id="completed_at" :value="old('completed_at', $portfolio?->completed_at?->format('Y-m-d'))" />
    </div>
    <div class="sm:col-span-2">
        <x-ui.label for="coordinates">พิกัด GPS (คัดลอกจาก Google Maps)</x-ui.label>
        <x-ui.input
            type="text"
            name="coordinates"
            id="coordinates"
            :value="old('coordinates', $portfolio?->coordinates)"
            placeholder="13.748436414898316, 100.48145963665914"
        />
        <p class="mt-1 text-xs text-slate-500">วางรูปแบบ lat, lng เช่น 13.748436414898316, 100.48145963665914</p>
    </div>
    <div class="sm:col-span-2">
        <x-ui.label for="description">รายละเอียด</x-ui.label>
        <x-ui.textarea name="description" id="description" rows="4">{{ old('description', $portfolio?->description) }}</x-ui.textarea>
    </div>
    <div class="sm:col-span-2">
        <x-ui.label for="cover_image">รูปปก (URL)</x-ui.label>
        <x-ui.input type="url" name="cover_image" id="cover_image" :value="old('cover_image', $portfolio?->cover_image)" />
        <p class="mt-1 text-xs text-slate-500">แนะนำ 800×600 px (4:3) การ์ดผลงาน · 680×408 px (5:3) carousel</p>
    </div>
    <div>
        <x-ui.label for="meta_title">Meta Title</x-ui.label>
        <x-ui.input type="text" name="meta_title" id="meta_title" :value="old('meta_title', $portfolio?->meta_title)" maxlength="100" />
    </div>
    <div>
        <x-ui.label for="meta_description">Meta Description</x-ui.label>
        <x-ui.input type="text" name="meta_description" id="meta_description" :value="old('meta_description', $portfolio?->meta_description)" maxlength="160" />
    </div>
    <div class="sm:col-span-2">
        <x-ui.checkbox name="is_published" value="1" label="เผยแพร่" :checked="old('is_published', $portfolio?->is_published ?? false)" />
    </div>
</div>
