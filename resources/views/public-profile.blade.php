<!DOCTYPE html>
<html lang="id" class="h-full scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->title ? $user->name . ' | ' . $user->title : $user->name . ' | NFC Link' }}</title>

    <meta name="description" content="{{ $user->bio ?? $user->name . ' digital profile' }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        if (!localStorage.getItem('theme')) {
            document.documentElement.classList.add('dark');
        } else if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>

    <style>
        /* Noise texture */
        .noise::after {
            content: '';
            position: fixed;
            inset: 0;
            z-index: 0;
            opacity: 0.015;
            pointer-events: none;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
            background-size: 200px 200px;
        }

        /* Reveal */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.9s cubic-bezier(0.16, 1, 0.3, 1), transform 0.9s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ═══ Floating background orbs ═══ */
        .orb {
            position: absolute;
            border-radius: 9999px;
            will-change: transform;
        }
        .orb-1 {
            -top-[20%]; -right-[15%];
            width: 650px; height: 650px;
            background: radial-gradient(circle, rgba(14,165,233,0.08), transparent 70%);
            animation: orb-drift-1 25s ease-in-out infinite;
        }
        .orb-2 {
            -bottom-[25%]; -left-[20%];
            width: 750px; height: 750px;
            background: radial-gradient(circle, rgba(14,165,233,0.06), transparent 70%);
            animation: orb-drift-2 30s ease-in-out infinite;
        }
        .orb-3 {
            top-[50%]; left-[35%];
            width: 350px; height: 350px;
            background: radial-gradient(circle, rgba(99,102,241,0.05), transparent 70%);
            animation: orb-drift-3 20s ease-in-out infinite;
        }
        .dark .orb-1 { background: radial-gradient(circle, rgba(14,165,233,0.04), transparent 70%); }
        .dark .orb-2 { background: radial-gradient(circle, rgba(14,165,233,0.03), transparent 70%); }
        .dark .orb-3 { background: radial-gradient(circle, rgba(99,102,241,0.025), transparent 70%); }

        @keyframes orb-drift-1 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(-40px, 30px) scale(1.05); }
            50% { transform: translate(-20px, -20px) scale(0.97); }
            75% { transform: translate(30px, 15px) scale(1.03); }
        }
        @keyframes orb-drift-2 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(35px, -25px) scale(1.04); }
            66% { transform: translate(-25px, 20px) scale(0.96); }
        }
        @keyframes orb-drift-3 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            20% { transform: translate(20px, -30px) scale(1.08); }
            40% { transform: translate(-15px, 10px) scale(0.95); }
            60% { transform: translate(25px, 20px) scale(1.05); }
            80% { transform: translate(-10px, -15px) scale(0.98); }
        }

        /* ═══ Floating particles ═══ */
        .particle {
            position: absolute;
            border-radius: 9999px;
            pointer-events: none;
            opacity: 0;
            animation: particle-float linear infinite;
        }
        @keyframes particle-float {
            0% { opacity: 0; transform: translateY(0) scale(0); }
            10% { opacity: 1; transform: scale(1); }
            90% { opacity: 1; }
            100% { opacity: 0; transform: translateY(-100vh) scale(0.5); }
        }

        /* ═══ Mouse spotlight ═══ */
        .mouse-spotlight {
            position: fixed;
            width: 600px;
            height: 600px;
            border-radius: 9999px;
            pointer-events: none;
            z-index: 1;
            opacity: 0;
            transition: opacity 0.8s ease;
            background: radial-gradient(circle, rgba(14,165,233,0.06), transparent 60%);
            transform: translate(-50%, -50%);
        }
        .dark .mouse-spotlight {
            background: radial-gradient(circle, rgba(14,165,233,0.04), transparent 60%);
        }
        .mouse-spotlight.active { opacity: 1; }

        /* ═══ Avatar ring ═══ */
        .avatar-wrap { position: relative; perspective: 800px; }
        .avatar-wrap::before {
            content: '';
            position: absolute;
            inset: -5px;
            border-radius: 9999px;
            background: conic-gradient(from 0deg, #0ea5e9, #38bdf8, #7dd3fc, #0ea5e9, #0284c7, #0ea5e9);
            animation: ring-spin 8s linear infinite;
            z-index: 0;
            opacity: 0.7;
            box-shadow:
                0 2px 6px rgba(14,165,233,0.35),
                0 8px 20px rgba(14,165,233,0.12),
                inset 0 1px 2px rgba(255,255,255,0.4);
        }
        .dark .avatar-wrap::before {
            box-shadow:
                0 2px 8px rgba(14,165,233,0.25),
                0 8px 24px rgba(14,165,233,0.08),
                inset 0 1px 2px rgba(255,255,255,0.1);
        }
        .avatar-wrap::after {
            content: '';
            position: absolute;
            inset: -24px;
            border-radius: 9999px;
            background: radial-gradient(circle, rgba(14,165,233,0.12), transparent 65%);
            z-index: -1;
            animation: ring-pulse 4s ease-in-out infinite alternate;
        }
        @keyframes ring-spin { to { transform: rotate(360deg); } }
        @keyframes ring-pulse { from { opacity: 0.5; transform: scale(0.95); } to { opacity: 1; transform: scale(1.08); } }

        /* ═══ Avatar 3D ═══ */
        .avatar-3d {
            position: relative;
            z-index: 1;
            box-shadow:
                -3px -3px 6px rgba(255,255,255,0.6),
                -1px -1px 2px rgba(255,255,255,0.3),
                4px 4px 8px rgba(148,163,184,0.18),
                8px 8px 16px rgba(148,163,184,0.1),
                inset 0 2px 6px rgba(255,255,255,0.5),
                inset 0 -3px 6px rgba(148,163,184,0.08);
            transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .avatar-3d:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow:
                -5px -5px 10px rgba(255,255,255,0.7),
                -2px -2px 4px rgba(255,255,255,0.35),
                6px 6px 12px rgba(148,163,184,0.22),
                14px 14px 28px rgba(148,163,184,0.14),
                inset 0 2px 6px rgba(255,255,255,0.55),
                inset 0 -3px 6px rgba(148,163,184,0.1);
        }
        .dark .avatar-3d {
            box-shadow:
                -3px -3px 6px rgba(255,255,255,0.04),
                -1px -1px 2px rgba(255,255,255,0.02),
                4px 4px 8px rgba(0,0,0,0.5),
                8px 8px 16px rgba(0,0,0,0.35),
                inset 0 2px 6px rgba(255,255,255,0.06),
                inset 0 -3px 6px rgba(0,0,0,0.35);
        }
        .dark .avatar-3d:hover {
            box-shadow:
                -5px -5px 10px rgba(255,255,255,0.05),
                -2px -2px 4px rgba(255,255,255,0.025),
                6px 6px 12px rgba(0,0,0,0.55),
                14px 14px 28px rgba(0,0,0,0.4),
                inset 0 2px 6px rgba(255,255,255,0.08),
                inset 0 -3px 6px rgba(0,0,0,0.4);
        }
        .avatar-3d::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 9999px;
            background: linear-gradient(135deg, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0.1) 25%, transparent 45%, transparent 70%, rgba(0,0,0,0.04) 100%);
            pointer-events: none;
            z-index: 2;
        }
        .dark .avatar-3d::after {
            background: linear-gradient(135deg, rgba(255,255,255,0.12) 0%, rgba(255,255,255,0.04) 25%, transparent 45%, transparent 70%, rgba(0,0,0,0.15) 100%);
        }

        /* ═══ Glass card base ═══ */
        .glass {
            background: rgba(255,255,255,0.45);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255,255,255,0.35);
            transition: border-color 0.4s ease, box-shadow 0.4s ease;
        }
        .dark .glass {
            background: rgba(255,255,255,0.02);
            border-color: rgba(255,255,255,0.06);
        }

        /* ═══ Animated accent line ═══ */
        .accent-line {
            width: 24px;
            height: 2px;
            border-radius: 9999px;
            background: linear-gradient(90deg, #0ea5e9, #38bdf8);
            position: relative;
            overflow: hidden;
        }
        .accent-line::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.7), transparent);
            animation: accent-shimmer 3s ease-in-out infinite;
        }
        @keyframes accent-shimmer {
            0%, 100% { left: -100%; }
            50% { left: 200%; }
        }

        /* ═══ Experience card left border ═══ */
        .exp-card {
            position: relative;
            padding-left: 18px;
        }
        .exp-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 12px;
            bottom: 12px;
            width: 2px;
            border-radius: 9999px;
            background: linear-gradient(to bottom, #0ea5e9, rgba(14,165,233,0.06));
            transition: box-shadow 0.4s ease;
        }
        .exp-card:hover::before {
            box-shadow: 0 0 8px rgba(14,165,233,0.3), 0 0 16px rgba(14,165,233,0.1);
        }

        /* ═══ Skill tag ═══ */
        .skill-tag {
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .skill-tag::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, transparent, rgba(14,165,233,0.08), transparent);
            transform: translateX(-100%);
            transition: transform 0.5s ease;
        }
        .skill-tag:hover::after {
            transform: translateX(100%);
        }

        /* ═══ Link card ═══ */
        .link-card {
            position: relative;
            overflow: hidden;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .link-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(14,165,233,0.5), transparent);
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        .link-card:hover::before { opacity: 1; }

        /* ═══ Card 3D tilt ═══ */
        .tilt-card {
            transform-style: preserve-3d;
            transition: transform 0.15s ease-out, box-shadow 0.3s ease;
        }
        .tilt-card .tilt-inner {
            transform: translateZ(0);
            transition: transform 0.15s ease-out;
        }

        /* ═══ Portfolio ═══ */
        .port-img {
            transition: transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .port-card:hover .port-img {
            transform: scale(1.08);
        }

        /* ═══ Scrollbar ═══ */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(148,163,184,0.12); border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(148,163,184,0.25); }

        /* ═══ Stagger children ═══ */
        .stagger > * {
            opacity: 0;
            transform: translateY(12px);
            transition: opacity 0.5s cubic-bezier(0.16, 1, 0.3, 1), transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .stagger.visible > *:nth-child(1) { transition-delay: 0ms; opacity: 1; transform: translateY(0); }
        .stagger.visible > *:nth-child(2) { transition-delay: 60ms; opacity: 1; transform: translateY(0); }
        .stagger.visible > *:nth-child(3) { transition-delay: 120ms; opacity: 1; transform: translateY(0); }
        .stagger.visible > *:nth-child(4) { transition-delay: 180ms; opacity: 1; transform: translateY(0); }
        .stagger.visible > *:nth-child(5) { transition-delay: 240ms; opacity: 1; transform: translateY(0); }
        .stagger.visible > *:nth-child(6) { transition-delay: 300ms; opacity: 1; transform: translateY(0); }
        .stagger.visible > *:nth-child(7) { transition-delay: 360ms; opacity: 1; transform: translateY(0); }
        .stagger.visible > *:nth-child(8) { transition-delay: 420ms; opacity: 1; transform: translateY(0); }
        .stagger.visible > *:nth-child(9) { transition-delay: 480ms; opacity: 1; transform: translateY(0); }
        .stagger.visible > *:nth-child(10) { transition-delay: 540ms; opacity: 1; transform: translateY(0); }

        /* ═══ Subtle grid pattern ═══ */
        .bg-grid {
            background-image:
                linear-gradient(rgba(148,163,184,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(148,163,184,0.03) 1px, transparent 1px);
            background-size: 60px 60px;
        }
        .dark .bg-grid {
            background-image:
                linear-gradient(rgba(255,255,255,0.012) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.012) 1px, transparent 1px);
        }

        /* ═══ Horizontal separator glow ═══ */
        .section-glow {
            position: relative;
        }
        .section-glow::before {
            content: '';
            position: absolute;
            top: 0;
            left: 10%;
            right: 10%;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(14,165,233,0.15), transparent);
        }
    </style>
</head>

<body class="min-h-[100dvh] relative overflow-x-hidden font-['Inter',sans-serif] antialiased bg-[#fafbfc] dark:bg-[#070a0f] transition-colors duration-700 noise bg-grid">

    {{-- ── Mouse spotlight ── --}}
    <div class="mouse-spotlight" id="spotlight"></div>

    {{-- ── Animated background ── --}}
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>

    {{-- ── Floating particles container ── --}}
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none" id="particles"></div>

    <button
        onclick="toggleTheme()"
        class="fixed top-5 right-5 z-50 w-9 h-9 rounded-full glass flex items-center justify-center cursor-pointer transition-all duration-300 hover:scale-110 hover:bg-white/70 dark:hover:bg-white/[0.06]"
        aria-label="Toggle theme"
    >
        <svg class="w-4 h-4 text-slate-400 block dark:hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
        </svg>
        <svg class="w-4 h-4 text-sky-300/60 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
        </svg>
    </button>

    <main class="relative z-10 max-w-5xl mx-auto px-6 pt-24 sm:pt-32 pb-12">

        {{-- ═══════════ HERO ═══════════ --}}
        <section class="mb-16 lg:mb-20 reveal">
            <div class="flex flex-col items-center text-center lg:flex-row lg:items-center lg:text-left lg:gap-12">
                <div class="avatar-wrap shrink-0 mb-8 lg:mb-0">
                    @if($user->profile_photo_path)
                        <img
                            src="{{ asset('storage/' . $user->profile_photo_path) }}"
                            alt="{{ $user->name }}"
                            class="avatar-3d w-[120px] h-[120px] lg:w-[140px] lg:h-[140px] rounded-full object-cover"
                        >
                    @else
                        <div class="avatar-3d w-[120px] h-[120px] lg:w-[140px] lg:h-[140px] rounded-full bg-gradient-to-br from-sky-400 to-sky-600 flex items-center justify-center text-4xl lg:text-5xl font-extrabold text-white overflow-hidden">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                    @endif
                </div>

                <div class="min-w-0 flex-1">
                    <h1 class="text-[2.5rem] sm:text-5xl lg:text-[3.5rem] font-extrabold text-slate-900 dark:text-white tracking-[-0.03em] leading-[1.1] transition-colors duration-500">
                        {{ $user->name }}
                    </h1>

                    @if($user->title)
                        <div class="inline-flex items-center gap-2.5 mt-4 lg:mt-5 px-5 py-2 rounded-full bg-sky-50/70 dark:bg-sky-500/[0.07] border border-sky-100/50 dark:border-sky-500/12 transition-colors duration-500">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-60"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-sky-500"></span>
                            </span>
                            <span class="text-[13px] font-medium text-sky-600 dark:text-sky-400/80 tracking-wide transition-colors duration-500">{{ $user->title }}</span>
                        </div>
                    @endif

                    @if($user->location)
                        <div class="flex items-center justify-center lg:justify-start gap-1.5 mt-3 text-slate-400 dark:text-slate-500 transition-colors duration-500">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            <span class="text-[13px]">{{ $user->location }}</span>
                        </div>
                    @endif

                    @if($user->bio)
                        <p class="mt-5 lg:mt-6 text-[15px] sm:text-base text-slate-500 dark:text-slate-400/70 max-w-md mx-auto lg:max-w-none leading-[1.8] transition-colors duration-500">
                            {{ $user->bio }}
                        </p>
                    @endif
                </div>
            </div>
        </section>

        {{-- ═══════════ CONTENT ═══════════ --}}
        @php $hasLinks = $links->isNotEmpty(); @endphp

        <div @if($hasLinks) class="lg:grid lg:grid-cols-12 lg:gap-10 lg:items-start" @endif>

            {{-- ─── CONNECT ─── --}}
            @if($hasLinks)
                <section class="order-1 lg:order-none lg:col-span-4 xl:col-span-4 mb-12 lg:mb-0 reveal">
                    <div class="lg:sticky lg:top-28">
                        <div class="mb-5">
                            <div class="accent-line mb-3"></div>
                            <h2 class="text-lg font-bold text-slate-800 dark:text-white tracking-tight transition-colors duration-500">Connect</h2>
                        </div>
                        <div class="stagger space-y-2">
                            @foreach($links as $link)
                                <a
                                    href="{{ $link->url }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="link-card tilt-card group flex items-center gap-3.5 w-full px-4 py-3.5 glass rounded-xl shadow-sm shadow-slate-900/[0.02] dark:shadow-black/5 hover:shadow-xl hover:shadow-sky-500/[0.04] hover:-translate-y-0.5 active:scale-[0.985] transition-all duration-300"
                                >
                                    <div class="tilt-inner flex items-center gap-3.5 w-full">
                                        <div class="w-9 h-9 rounded-lg bg-sky-50/80 dark:bg-sky-500/[0.08] border border-sky-100/50 dark:border-sky-500/15 flex items-center justify-center shrink-0 group-hover:bg-sky-100 dark:group-hover:bg-sky-500/15 transition-all duration-300">
                                            <svg class="w-[18px] h-[18px] text-sky-500 dark:text-sky-400/80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                                                <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
                                            </svg>
                                        </div>
                                        <span class="flex-1 text-[14px] font-medium text-slate-700 dark:text-slate-200 transition-colors duration-300">{{ $link->title }}</span>
                                        <svg class="w-4 h-4 text-slate-300 dark:text-slate-600 group-hover:text-sky-500 dark:group-hover:text-sky-400 group-hover:translate-x-0.5 transition-all duration-300 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0-6.75-6.75M19.5 12l-6.75 6.75" />
                                        </svg>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            {{-- ─── MAIN CONTENT ─── --}}
            <div class="order-2 lg:order-none {{ $hasLinks ? 'lg:col-span-8 xl:col-span-8' : '' }}">

                {{-- Skills --}}
                @if($skills->isNotEmpty())
                    <section class="mb-16 lg:mb-20 reveal section-glow pt-8">
                        <div class="mb-6">
                            <div class="accent-line mb-3"></div>
                            <h2 class="text-lg font-bold text-slate-800 dark:text-white tracking-tight transition-colors duration-500">Skills</h2>
                        </div>
                        <div class="stagger flex flex-wrap gap-2.5">
                            @foreach($skills as $skill)
                                <span class="skill-tag px-4 py-2.5 text-[13px] font-medium text-slate-600 dark:text-slate-300 glass rounded-2xl hover:-translate-y-0.5 hover:shadow-lg hover:shadow-sky-500/5 cursor-default transition-colors duration-500">
                                    {{ $skill->name }}
                                </span>
                            @endforeach
                        </div>
                    </section>
                @endif

                {{-- Experiences --}}
                @if($experiences->isNotEmpty())
                    <section class="mb-16 lg:mb-20 reveal section-glow pt-8">
                        <div class="mb-6">
                            <div class="accent-line mb-3"></div>
                            <h2 class="text-lg font-bold text-slate-800 dark:text-white tracking-tight transition-colors duration-500">Experiences</h2>
                        </div>
                        <div class="stagger space-y-4">
                            @foreach($experiences as $exp)
                                <div class="exp-card tilt-card glass rounded-2xl p-5 transition-all duration-300 hover:shadow-xl hover:shadow-sky-500/[0.03]">
                                    <div class="tilt-inner">
                                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-1.5 mb-2">
                                            <h3 class="text-[15px] font-semibold text-slate-800 dark:text-slate-100 transition-colors duration-300">{{ $exp->role }}</h3>
                                            <span class="text-xs font-semibold text-sky-500 dark:text-sky-400/70 whitespace-nowrap tabular-nums transition-colors duration-300">{{ $exp->period }}</span>
                                        </div>
                                        <p class="text-[13px] font-medium text-slate-400 dark:text-slate-500 mb-2.5 transition-colors duration-300">{{ $exp->company }}</p>
                                        @if($exp->description)
                                            <p class="text-[13px] text-slate-500 dark:text-slate-400/70 leading-[1.75] transition-colors duration-300">{{ $exp->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

                {{-- Project --}}
                @if($portfolios->isNotEmpty())
                    <section class="mb-16 lg:mb-20 reveal section-glow pt-8">
                        <div class="mb-6">
                            <div class="accent-line mb-3"></div>
                            <h2 class="text-lg font-bold text-slate-800 dark:text-white tracking-tight transition-colors duration-500">Project</h2>
                        </div>
                        <div class="stagger grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($portfolios as $portfolio)
                                <div class="port-card tilt-card group glass rounded-2xl overflow-hidden transition-all duration-400 hover:shadow-2xl hover:shadow-sky-500/[0.04] hover:-translate-y-1">
                                    <div class="tilt-inner">
                                        <div class="relative aspect-[16/10] overflow-hidden bg-slate-100 dark:bg-slate-800/30">
                                            @if($portfolio->image_path)
                                                <img src="{{ asset('storage/' . $portfolio->image_path) }}" alt="{{ $portfolio->title }}" class="port-img w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full bg-gradient-to-br from-slate-50 to-sky-50 dark:from-slate-800/40 dark:to-sky-500/5 flex items-center justify-center transition-colors duration-500">
                                                    <svg class="w-10 h-10 text-slate-200 dark:text-sky-500/20" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z" />
                                                    </svg>
                                                </div>
                                            @endif
                                            @if($portfolio->url)
                                                <a href="{{ $portfolio->url }}" target="_blank" rel="noopener noreferrer" class="absolute inset-0 bg-slate-900/0 group-hover:bg-slate-900/50 flex items-center justify-center transition-all duration-500">
                                                    <div class="w-11 h-11 rounded-full bg-white/90 backdrop-blur flex items-center justify-center opacity-0 group-hover:opacity-100 scale-60 group-hover:scale-100 transition-all duration-500 shadow-lg">
                                                        <svg class="w-4 h-4 text-slate-800" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0-6.75-6.75M19.5 12l-6.75 6.75" />
                                                        </svg>
                                                    </div>
                                                </a>
                                            @endif
                                        </div>
                                        <div class="p-4">
                                            <h3 class="text-[14px] font-semibold text-slate-800 dark:text-slate-100 transition-colors duration-300">{{ $portfolio->title }}</h3>
                                            @if($portfolio->description)
                                                <p class="text-[12px] text-slate-400 dark:text-slate-500 mt-1.5 line-clamp-2 leading-relaxed transition-colors duration-300">{{ $portfolio->description }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

            </div>
        </div>
    </main>

    <footer class="relative z-10 w-full text-center pb-10 pt-4">
        <div class="inline-flex items-center gap-2.5 px-5 py-2.5 rounded-full glass transition-colors duration-500">
            <span class="text-[10px] font-semibold text-slate-400/60 dark:text-slate-600 uppercase tracking-[0.18em] transition-colors duration-500">Powered by SAKA | ALENKOSA</span>
        </div>
    </footer>

    <script>
        function toggleTheme() {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
        }

        // ─── Scroll reveal ───
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const delay = entry.target.dataset.delay || 0;
                    setTimeout(() => {
                        entry.target.classList.add('visible');
                    }, delay);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -30px 0px' });

        document.querySelectorAll('.reveal, .stagger').forEach((el, i) => {
            el.dataset.delay = i * 100;
            observer.observe(el);
        });

        // ─── Mouse spotlight (desktop only) ───
        const spotlight = document.getElementById('spotlight');
        let spotlightActive = false;

        if (window.matchMedia('(pointer: fine)').matches) {
            document.addEventListener('mousemove', (e) => {
                if (!spotlightActive) {
                    spotlight.classList.add('active');
                    spotlightActive = true;
                }
                requestAnimationFrame(() => {
                    spotlight.style.left = e.clientX + 'px';
                    spotlight.style.top = e.clientY + 'px';
                });
            });

            document.addEventListener('mouseleave', () => {
                spotlight.classList.remove('active');
                spotlightActive = false;
            });
        }

        // ─── 3D tilt on cards (desktop only) ───
        if (window.matchMedia('(pointer: fine)').matches) {
            document.querySelectorAll('.tilt-card').forEach(card => {
                card.addEventListener('mousemove', (e) => {
                    const rect = card.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    const rotateX = ((y - centerY) / centerY) * -3;
                    const rotateY = ((x - centerX) / centerX) * 3;
                    card.style.transform = `perspective(600px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateZ(0)`;
                });

                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'perspective(600px) rotateX(0deg) rotateY(0deg) translateZ(0)';
                });
            });
        }

        // ─── Floating particles ───
        const particleContainer = document.getElementById('particles');
        const isMobile = window.innerWidth < 768;
        const particleCount = isMobile ? 6 : 12;

        function createParticle() {
            const p = document.createElement('div');
            p.classList.add('particle');
            const size = Math.random() * 2.5 + 1;
            const left = Math.random() * 100;
            const duration = Math.random() * 15 + 20;
            const delay = Math.random() * 20;
            const isDark = document.documentElement.classList.contains('dark');

            p.style.cssText = `
                width: ${size}px;
                height: ${size}px;
                left: ${left}%;
                bottom: -10px;
                background: ${isDark ? 'rgba(14,165,233,0.25)' : 'rgba(14,165,233,0.2)'};
                box-shadow: 0 0 ${size * 3}px ${isDark ? 'rgba(14,165,233,0.1)' : 'rgba(14,165,233,0.08)'};
                animation-duration: ${duration}s;
                animation-delay: ${delay}s;
            `;
            particleContainer.appendChild(p);
        }

        for (let i = 0; i < particleCount; i++) createParticle();

        // Re-create particles on theme change to update colors
        const origToggle = toggleTheme;
        toggleTheme = function() {
            origToggle();
            setTimeout(() => {
                particleContainer.innerHTML = '';
                for (let i = 0; i < particleCount; i++) createParticle();
            }, 50);
        };
    </script>

</body>
</html>