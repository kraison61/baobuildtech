@props([
    'title',
    'action' => null,
    'actionLabel' => 'เพิ่มใหม่',
])

<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-semibold text-white">{{ $title }}</h1>
        @if ($slot->isNotEmpty())
            <p class="mt-1 text-sm text-slate-400">{{ $slot }}</p>
        @endif
    </div>
    @if ($action)
        <x-ui.button :href="$action">{{ $actionLabel }}</x-ui.button>
    @endif
</div>
