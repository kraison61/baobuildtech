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
        <x-ui.label for="description">รายละเอียดสั้น</x-ui.label>
        <x-ui.textarea name="description" id="description" rows="4">{{ old('description', $portfolio?->description) }}</x-ui.textarea>
    </div>
    <div class="sm:col-span-2">
        <x-ui.label for="content">เนื้อหาเต็ม (HTML)</x-ui.label>
        <x-ui.textarea name="content" id="content" rows="12">{{ old('content', $portfolio?->content) }}</x-ui.textarea>
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

    <div class="sm:col-span-2 mt-2 border-t border-slate-200 pt-4">
        <h3 class="text-sm font-semibold text-slate-700">English</h3>
    </div>
    <div class="sm:col-span-2">
        <x-ui.label for="title_en">Title (EN)</x-ui.label>
        <x-ui.input type="text" name="title_en" id="title_en" :value="old('title_en', $portfolio?->title_en)" />
    </div>
    <div class="sm:col-span-2">
        <x-ui.label for="client_name_en">Client Name (EN)</x-ui.label>
        <x-ui.input type="text" name="client_name_en" id="client_name_en" :value="old('client_name_en', $portfolio?->client_name_en)" />
    </div>
    <div class="sm:col-span-2">
        <x-ui.label for="description_en">Description (EN)</x-ui.label>
        <x-ui.textarea name="description_en" id="description_en" rows="4">{{ old('description_en', $portfolio?->description_en) }}</x-ui.textarea>
    </div>
    <div class="sm:col-span-2">
        <x-ui.label for="content_en">Content (EN HTML)</x-ui.label>
        <x-ui.textarea name="content_en" id="content_en" rows="12">{{ old('content_en', $portfolio?->content_en) }}</x-ui.textarea>
    </div>
    <div>
        <x-ui.label for="meta_title_en">Meta Title (EN)</x-ui.label>
        <x-ui.input type="text" name="meta_title_en" id="meta_title_en" :value="old('meta_title_en', $portfolio?->meta_title_en)" maxlength="100" />
    </div>
    <div>
        <x-ui.label for="meta_description_en">Meta Description (EN)</x-ui.label>
        <x-ui.input type="text" name="meta_description_en" id="meta_description_en" :value="old('meta_description_en', $portfolio?->meta_description_en)" maxlength="160" />
    </div>

    <div class="sm:col-span-2">
        <x-ui.checkbox name="is_published" value="1" label="เผยแพร่" :checked="old('is_published', $portfolio?->is_published ?? false)" />
    </div>
</div>
