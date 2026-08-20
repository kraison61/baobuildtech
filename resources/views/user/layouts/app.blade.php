<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') — {{ config('app.name') }}</title>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100 text-slate-800">
    <div class="flex min-h-screen">
        <aside class="hidden w-64 shrink-0 bg-white border-e border-gray-200 md:block">
            <div class="p-4 font-semibold">{{ config('app.name') }}</div>
        </aside>
        <div class="flex flex-1 flex-col">
            <header class="border-b border-gray-200 bg-white px-4 py-3 md:px-6">
                @yield('header')
            </header>
            <main class="flex-1 p-4 md:p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
