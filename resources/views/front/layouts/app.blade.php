<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('company.legal_name'))</title>
    <meta name="description" content="@yield('meta_description', config('company.description'))">
    @stack('head')
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans text-ink antialiased text-pretty">
    <x-front.header />

    @hasSection('breadcrumb')
        @yield('breadcrumb')
    @endif

    @yield('content')

    <x-front.footer />
    <x-front.mobile-cta />
    <x-front.to-top />

    @stack('scripts')
</body>
</html>
