@props([
    'typeName' => 'faqable_type',
    'idName' => 'faqable_id',
    'types' => [],
    'recordsByType' => [],
    'selectedType' => '',
    'selectedId' => '',
])

@php
    $uid = 'morph-' . uniqid();
@endphp

<div class="grid gap-4 sm:grid-cols-2" data-morph-select="{{ $uid }}" data-records='@json($recordsByType)'>
    <div>
        <x-ui.label :for="$uid . '-type'">ประเภท</x-ui.label>
        <x-ui.select :name="$typeName" :id="$uid . '-type'" data-morph-type required>
            @foreach ($types as $value => $label)
                <option value="{{ $value }}" @selected(old($typeName, $selectedType) === $value)>{{ $label }}</option>
            @endforeach
        </x-ui.select>
    </div>
    <div>
        <x-ui.label :for="$uid . '-id'">รายการ</x-ui.label>
        <x-ui.select :name="$idName" :id="$uid . '-id'" data-morph-id required
            data-selected="{{ old($idName, $selectedId) }}"></x-ui.select>
    </div>
</div>

<script>
(() => {
    const root = document.querySelector('[data-morph-select="{{ $uid }}"]');
    if (!root) return;

    const records = JSON.parse(root.dataset.records || '{}');
    const typeSelect = root.querySelector('[data-morph-type]');
    const idSelect = root.querySelector('[data-morph-id]');
    const selected = idSelect.dataset.selected || '';

    const render = (keepSelection = true) => {
        const options = records[typeSelect.value] ?? [];
        const current = keepSelection ? (idSelect.dataset.selected || idSelect.value || '') : '';
        idSelect.innerHTML = options.map(o =>
            `<option value="${o.id}"${String(o.id) === String(current) ? ' selected' : ''}>${o.label}</option>`
        ).join('');
        if (!idSelect.value && options.length) idSelect.value = String(options[0].id);
    };

    typeSelect.addEventListener('change', () => {
        idSelect.dataset.selected = '';
        render(false);
    });

    render();
})();
</script>
