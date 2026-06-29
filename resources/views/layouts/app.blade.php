<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
        <title>SAKA Dashboard</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script>
            if (localStorage.getItem('theme') === 'dark') {
                document.documentElement.classList.add('dark');
            }
        </script>

        <style>
            .custom-check { appearance: none; position: relative; }
            .custom-check:checked { background: #0EA5E9; border-color: #0EA5E9; }
            .custom-check:checked::after {
                content: '';
                position: absolute;
                left: 4.5px; top: 1.5px;
                width: 5px; height: 9px;
                border: solid #fff;
                border-width: 0 1.5px 1.5px 0;
                transform: rotate(45deg);
            }
        </style>
    </head>
    <body class="min-h-screen font-['Inter',sans-serif] antialiased bg-white dark:bg-slate-950 transition-colors duration-500">

        {{-- Background Orbs --}}
        <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
            <div class="absolute -top-[10%] -right-[5%] w-[500px] h-[500px] rounded-full bg-sky-200/50 dark:bg-sky-500/5 blur-3xl transition-colors duration-700"></div>
            <div class="absolute -bottom-[15%] -left-[10%] w-[600px] h-[600px] rounded-full bg-sky-100/60 dark:bg-sky-400/5 blur-3xl transition-colors duration-700"></div>
            <div class="absolute top-[40%] left-[55%] w-[300px] h-[300px] rounded-full bg-sky-300/20 dark:bg-sky-600/5 blur-3xl transition-colors duration-700"></div>
        </div>

        @include('layouts.navigation')

        @isset($header)
            <div class="max-w-7xl mx-auto pt-8 pb-2 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        @endisset

        <main>
            {{ $slot }}
        </main>

        <script>
            function toggleTheme() {
                document.documentElement.classList.toggle('dark');
                localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
            }
        </script>
    </body>
</html>