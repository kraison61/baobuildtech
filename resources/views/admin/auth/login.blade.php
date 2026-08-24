<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>เข้าสู่ระบบ — {{ config('app.name') }}</title>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen items-center justify-center bg-slate-900 px-4 text-slate-100">
    <div class="w-full max-w-md">
        <div class="mb-8 text-center">
            <h1 class="text-2xl font-semibold text-white">{{ config('app.name') }}</h1>
            <p class="mt-1 text-sm text-slate-400">Admin Panel</p>
        </div>

        <x-ui.card class="p-6">
            <x-admin.flash />

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-4">
                @csrf
                <div>
                    <x-ui.label for="email">อีเมล</x-ui.label>
                    <x-ui.input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus />
                </div>
                <div>
                    <x-ui.label for="password">รหัสผ่าน</x-ui.label>
                    <x-ui.input type="password" name="password" id="password" required />
                </div>
                <label class="flex items-center gap-2 text-sm text-slate-300">
                    <input type="checkbox" name="remember" value="1" class="size-4 rounded border-slate-600 bg-slate-800 text-emerald-600" @checked(old('remember')) />
                    จดจำการเข้าสู่ระบบ
                </label>
                <x-ui.button type="submit" class="w-full">เข้าสู่ระบบ</x-ui.button>
            </form>
        </x-ui.card>

        <p class="mt-4 text-center text-xs text-slate-500">
            <a href="{{ route('home') }}" class="text-slate-400 hover:text-white">← กลับหน้าเว็บ</a>
        </p>
    </div>
</body>
</html>
