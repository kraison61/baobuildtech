@props(['label' => null, 'description' => null, 'checked' => false])

<label {{ $attributes->only('class')->merge(['class' => 'flex items-start gap-3 rounded-lg border border-slate-700 bg-slate-800/50 px-3 py-2']) }}>
    <input
        type="checkbox"
        @checked(old($attributes->get('name'), $checked))
        {{ $attributes->except('class')->merge(['class' => 'mt-0.5 size-4 rounded border-slate-600 bg-slate-800 text-emerald-600 focus:ring-emerald-500']) }}
    />
    @if ($label || $description)
        <span>
            @if ($label)
                <span class="block text-sm font-medium text-slate-200">{{ $label }}</span>
            @endif
            @if ($description)
                <span class="block text-xs text-slate-400">{{ $description }}</span>
            @endif
        </span>
    @else
        <span class="text-sm text-slate-200">{{ $slot }}</span>
    @endif
</label>
