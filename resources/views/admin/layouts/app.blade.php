<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') — {{ config('app.name') }}</title>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-900 text-slate-100">
    <div class="flex min-h-screen">
        <x-admin.sidebar />

        <div id="admin-mobile-panel" class="fixed inset-0 z-40 hidden md:hidden" aria-hidden="true">
            <div id="admin-mobile-backdrop" class="absolute inset-0 bg-black/60"></div>
            <aside class="relative z-10 h-full w-64 overflow-y-auto bg-slate-800">
                <x-admin.sidebar />
            </aside>
        </div>

        <div class="flex min-w-0 flex-1 flex-col">
            <header class="flex items-center justify-between border-b border-slate-700 bg-slate-800 px-4 py-3 md:px-6">
                <button type="button" id="admin-mobile-toggle" class="rounded-lg p-2 text-slate-300 hover:bg-slate-700 md:hidden" aria-label="เปิดเมนู">
                    ☰
                </button>
                <div class="flex-1">
                    @hasSection('header')
                        @yield('header')
                    @else
                        <p class="text-sm text-slate-400">{{ auth()->user()?->name }}</p>
                    @endif
                </div>
            </header>
            <main class="flex-1 p-4 md:p-6">
                <x-admin.flash />
                @yield('content')
            </main>
        </div>
    </div>
    <script>
    (() => {
        const panel = document.getElementById('admin-mobile-panel');
        const toggle = document.getElementById('admin-mobile-toggle');
        const backdrop = document.getElementById('admin-mobile-backdrop');
        if (!panel || !toggle) return;

        const setOpen = (open) => {
            panel.classList.toggle('hidden', !open);
            panel.setAttribute('aria-hidden', open ? 'false' : 'true');
        };

        toggle.addEventListener('click', () => setOpen(panel.classList.contains('hidden')));
        backdrop?.addEventListener('click', () => setOpen(false));
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') setOpen(false);
        });
    })();
    </script>
</body>
</html>
