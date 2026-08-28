@props(['quoteRequest' => null])

@php
    $jobTypes = \App\Support\ContactContent::jobTypes();
    $statusLabels = \App\Models\QuoteRequest::statusLabels();
@endphp

<div class="grid gap-4 sm:grid-cols-2">
    <div>
        <x-ui.label for="name">ชื่อผู้ติดต่อ *</x-ui.label>
        <x-ui.input type="text" name="name" id="name" :value="old('name', $quoteRequest?->name)" required />
    </div>
    <div>
        <x-ui.label for="phone">เบอร์โทร *</x-ui.label>
        <x-ui.input type="tel" name="phone" id="phone" :value="old('phone', $quoteRequest?->phone)" required />
    </div>
    <div>
        <x-ui.label for="job_type">ประเภทงาน *</x-ui.label>
        <x-ui.select name="job_type" id="job_type" required>
            @foreach ($jobTypes as $type)
                <option value="{{ $type['value'] }}" @selected(old('job_type', $quoteRequest?->job_type) === $type['value'])>
                    {{ $type['label'] }}
                </option>
            @endforeach
        </x-ui.select>
    </div>
    <div>
        <x-ui.label for="area">ที่ตั้งหน้างาน *</x-ui.label>
        <x-ui.input type="text" name="area" id="area" :value="old('area', $quoteRequest?->area)" required />
    </div>
    <div class="sm:col-span-2">
        <x-ui.label for="detail">รายละเอียดหน้างาน</x-ui.label>
        <x-ui.textarea name="detail" id="detail" rows="5">{{ old('detail', $quoteRequest?->detail) }}</x-ui.textarea>
    </div>
    <div>
        <x-ui.label for="status">สถานะ *</x-ui.label>
        <x-ui.select name="status" id="status" required>
            @foreach ($statusLabels as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $quoteRequest?->status ?? \App\Models\QuoteRequest::STATUS_PENDING) === $value)>
                    {{ $label }}
                </option>
            @endforeach
        </x-ui.select>
    </div>
    <div>
        <x-ui.label for="contacted_at">วันที่ติดต่อกลับ</x-ui.label>
        <x-ui.input
            type="datetime-local"
            name="contacted_at"
            id="contacted_at"
            :value="old('contacted_at', $quoteRequest?->contacted_at?->format('Y-m-d\TH:i'))"
        />
    </div>
    <div class="sm:col-span-2">
        <x-ui.label for="admin_notes">บันทึกภายใน</x-ui.label>
        <x-ui.textarea name="admin_notes" id="admin_notes" rows="4">{{ old('admin_notes', $quoteRequest?->admin_notes) }}</x-ui.textarea>
    </div>
</div>
