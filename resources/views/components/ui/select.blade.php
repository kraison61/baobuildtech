<select {{ $attributes->merge(['class' => 'block w-full rounded-lg border border-slate-600 bg-slate-800 px-3 py-2 text-sm text-slate-100 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500']) }}>
    {{ $slot }}
</select>
