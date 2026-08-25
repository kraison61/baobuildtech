@props([
    'cancelUrl',
    'submitLabel' => 'บันทึก',
])

<div class="flex flex-wrap items-center gap-3 border-t border-slate-700 pt-6">
    <x-ui.button type="submit">{{ $submitLabel }}</x-ui.button>
    <x-ui.button variant="ghost" :href="$cancelUrl">ยกเลิก</x-ui.button>
</div>
