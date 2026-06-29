<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login | NFC Link</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
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

<body class="min-h-[100dvh] relative overflow-hidden grid place-items-center p-6 antialiased font-['Inter',sans-serif] bg-white dark:bg-slate-950 transition-colors duration-500">

    <div class="absolute -top-[10%] -right-[5%] w-[500px] h-[500px] rounded-full bg-sky-200/50 dark:bg-sky-500/5 blur-3xl pointer-events-none transition-colors duration-700"></div>
    <div class="absolute -bottom-[15%] -left-[10%] w-[500px] h-[500px] rounded-full bg-sky-200/50 dark:bg-sky-400/5 blur-3xl pointer-events-none transition-colors duration-700"></div>
    <div class="absolute top-[40%] left-[55%] w-[300px] h-[300px] rounded-full bg-sky-300/20 dark:bg-sky-600/5 blur-3xl pointer-events-none transition-colors duration-700"></div>

    <button
        onclick="toggleTheme()"
        class="fixed top-5 right-5 z-50 w-9 h-9 rounded-full bg-white/60 dark:bg-white/10 backdrop-blur-xl border border-white/40 dark:border-white/10 flex items-center justify-center cursor-pointer transition-all duration-300 hover:scale-110 hover:bg-white/80 dark:hover:bg-white/15"
        aria-label="Toggle theme"
    >
        <svg class="w-4 h-4 text-slate-500 block dark:hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
        </svg>
        <svg class="w-4 h-4 text-sky-300 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
        </svg>
    </button>

    <div class="relative z-10 w-full max-w-[400px] bg-white/60 dark:bg-slate-900/50 backdrop-blur-2xl border border-white/40 dark:border-white/10 rounded-2xl p-8 sm:p-10 shadow-xl shadow-sky-500/5 transition-colors duration-500">
        <div class="text-center mb-8">
            {{-- <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20 mb-4 transition-colors duration-500">
                <svg class="w-5 h-5 text-sky-500 dark:text-sky-400 transition-colors duration-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 11.25h.008v.008H7.5V11.25Zm3 0h.008v.008H10.5V11.25Zm3 0h.008v.008H13.5V11.25Zm3 0h.008v.008H16.5V11.25ZM4.5 15h.008v.008H4.5V15Zm3 0h.008v.008H7.5V15Zm3 0h.008v.008H10.5V15Zm3 0h.008v.008H13.5V15Zm3 0h.008v.008H16.5V15ZM4.5 7.5h.008v.008H4.5V7.5Zm3 0h.008v.008H7.5V7.5Zm3 0h.008v.008H10.5V7.5Zm3 0h.008v.008H13.5V7.5Zm3 0h.008v.008H16.5V7.5Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
                </svg>
            </div> --}}
            <h1 class="text-lg font-semibold text-slate-800 dark:text-slate-100 mb-1 tracking-tight transition-colors duration-500">SAKA</h1>
            <p class="text-sm text-slate-400 dark:text-slate-500 transition-colors duration-500">Tap to connect your world</p>
        </div>

        @if (session('status'))
            <div class="text-sm text-sky-600 dark:text-sky-400 bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20 rounded-xl py-2.5 px-4 mb-6 text-center transition-colors duration-500">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wider transition-colors duration-500" for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nama@contoh.com" class="w-full py-2.5 px-3.5 text-sm text-slate-800 dark:text-slate-100 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl outline-none transition-all duration-200 focus:border-sky-500 focus:ring-[3px] focus:ring-sky-500/10 placeholder:text-slate-300 dark:placeholder:text-slate-600" >
                @error('email')
                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wider transition-colors duration-500" for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" class="w-full py-2.5 px-3.5 text-sm text-slate-800 dark:text-slate-100 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl outline-none transition-all duration-200 focus:border-sky-500 focus:ring-[3px] focus:ring-sky-500/10 placeholder:text-slate-300 dark:placeholder:text-slate-600" >
                @error('password')
                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- <div class="flex items-center justify-between mb-6 mt-2">
                <label class="inline-flex items-center gap-2 cursor-pointer text-sm text-slate-500 dark:text-slate-400 select-none transition-colors duration-500" for="remember_me">
                    <input id="remember_me" type="checkbox" name="remember" class="custom-check w-4 h-4 border border-slate-300 dark:border-white/20 rounded-md bg-white dark:bg-white/5 cursor-pointer transition-all duration-200 shrink-0">
                    <span>Ingat saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-slate-400 dark:text-slate-500 hover:text-sky-500 dark:hover:text-sky-400 transition-colors duration-200" href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </div> --}}

            <button type="submit" class="w-full py-2.5 text-sm font-semibold text-white bg-sky-500 hover:bg-sky-600 rounded-xl cursor-pointer transition-all duration-200 active:scale-[0.985]">
                Masuk
            </button>
        </form>

        {{-- <div class="text-center mt-7 pt-5 border-t border-slate-200/50 dark:border-white/5 text-xs text-slate-300 dark:text-slate-600 transition-colors duration-500">
            &copy; {{ date('Y') }} NFC Link
        </div> --}}
    </div>

    <script>
        function toggleTheme() {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
        }
    </script>

</body>
</html>