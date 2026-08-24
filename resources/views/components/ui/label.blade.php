@props(['for' => null, 'value' => null])

<label {{ $attributes->merge(['class' => 'mb-1 block text-sm font-medium text-slate-300']) }} @if($for) for="{{ $for }}" @endif>
    {{ $value ?? $slot }}
</label>
