<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="cta-clicks-url" content="{{ route('cta-clicks.store') }}">
    <title>@yield('title', config('company.legal_name'))</title>
    <meta name="description" content="@yield('meta_description', \App\Support\Company::description())">
    <link rel="canonical" href="@yield('canonical', url()->current())">
    <link rel="alternate" hreflang="th" href="{{ \App\Support\Locale::alternateUrl('th') }}">
    <link rel="alternate" hreflang="en" href="{{ \App\Support\Locale::alternateUrl('en') }}">
    <link rel="alternate" hreflang="x-default" href="{{ \App\Support\Locale::alternateUrl('th') }}">
    <x-ui.favicons />
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
    <x-front.to-top />

    @stack('scripts')
</body>
</html>
