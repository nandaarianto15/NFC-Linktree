<!DOCTYPE html>
<html lang="id" class="h-full scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->title ? $user->name . ' | ' . $user->title : 'Profil Pengguna' }}</title>
    <meta name="description" content="{{ $user->bio ?? 'Profil Portofolio Digital' }}">

    <!-- Google Fonts: Bebas Neue & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN with Blue Theme Config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- PDF.js for book rendering -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        bebas: ['Bebas Neue', 'sans-serif'],
                    },
                    colors: {
                        mist: {
                            50: '#fcfdfe',
                            100: '#f4f6fa',
                            200: '#eaedf4',
                            300: '#d5dae6',
                            400: '#a3b0cc',
                        },
                        ink: {
                            900: '#0f172a',
                            800: '#1e293b',
                            700: '#475569',
                            500: '#64748b',
                        },
                        cobalt: {
                            DEFAULT: '#1d4ed8',
                            dark: '#1e3a8a',
                            light: '#eff6ff',
                        },
                        futura: {
                            DEFAULT: '#0284c7',
                            dark: '#0369a1',
                            light: '#f0f9ff',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom Premium Blue Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #eaedf4;
        }
        ::-webkit-scrollbar-thumb {
            background: #1d4ed8;
            border-radius: 99px;
        }

        /* Ambient Analytical Grid Overlays with soft Blue tint */
        .analytic-grid {
            background-image: 
                linear-gradient(rgba(29, 78, 216, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(29, 78, 216, 0.02) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* Topographic / Mathematical Matrix background for sidebar in blue */
        .matrix-bg {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg stroke='%231d4ed8' stroke-opacity='0.04' stroke-width='1'%3E%3Ccircle cx='50' cy='50' r='40' fill='none'/%3E%3Cpath d='M10 50h80M50 10v80'/%3E%3C/g%3E%3C/svg%3E");
            background-size: 80px 80px;
        }

        /* Fluid Soft Shadow */
        .premium-shadow {
            box-shadow: 
                0 4px 30px rgba(15, 23, 42, 0.02),
                0 1px 3px rgba(29, 78, 216, 0.05);
        }
        .card-shadow-hover:hover {
            box-shadow: 
                0 20px 40px rgba(29, 78, 216, 0.06),
                0 1px 4px rgba(29, 78, 216, 0.03);
        }

        /* Smooth Transition */
        .smooth-transition {
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* Skill tracking fills customized for blue harmony */
        .skill-bar-track {
            width: 100%;
            height: 8px;
            background-color: #eaedf4;
            border-radius: 9999px;
            overflow: hidden;
        }
        .skill-bar-fill {
            height: 100%;
            border-radius: 9999px;
            width: var(--w, 0%);
            transition: width 1s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .skill-bar-high {
            background-color: #1d4ed8;
        }
        .skill-bar-mid {
            background-color: #0284c7;
        }
        .skill-bar-low {
            background-color: #94a3b8;
        }

        /* Linktree accent bar shimmer */
        .linktree-accent {
            background: linear-gradient(180deg, #1d4ed8 0%, #0284c7 50%, #1d4ed8 100%);
            background-size: 100% 200%;
            animation: linktreeShimmer 4s ease-in-out infinite;
        }
        @keyframes linktreeShimmer {
            0%, 100% { background-position: 0% 0%; }
            50% { background-position: 0% 100%; }
        }

        /* ========== BOOK PREVIEW STYLES ========== */
        .book-container {
            perspective: 1800px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 6px;
            min-height: 380px;
        }
        @media (min-width: 640px) {
            .book-container {
                padding: 20px;
                min-height: 500px;
            }
        }

        .book-spread {
            display: flex;
            position: relative;
            transform-style: preserve-3d;
            transform: rotateX(2deg);
            transition: transform 0.5s ease;
        }

        .book-page {
            position: relative;
            background: #fff;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .book-page img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
            pointer-events: none;
            user-select: none;
        }

        /* Left page - shadow on right edge (spine side) */
        .book-page-left::after {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 25px; height: 100%;
            background: linear-gradient(to right, transparent, rgba(0,0,0,0.08));
            pointer-events: none;
            z-index: 2;
        }

        /* Right page - shadow on left edge (spine side) */
        .book-page-right::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 25px; height: 100%;
            background: linear-gradient(to left, transparent, rgba(0,0,0,0.08));
            pointer-events: none;
            z-index: 2;
        }

        /* Page stack effect on right side */
        .book-page-right::after {
            content: '';
            position: absolute;
            top: 2px; right: -3px;
            width: 3px; height: calc(100% - 4px);
            background: repeating-linear-gradient(
                to bottom,
                #e2e8f0 0px, #e2e8f0 1px,
                #f1f5f9 1px, #f1f5f9 2px
            );
            border-radius: 0 1px 1px 0;
            box-shadow: 1px 0 2px rgba(0,0,0,0.06);
        }

        /* Book spine */
        .book-spine {
            width: 4px;
            background: linear-gradient(to right, #c7ccd6, #a8b0be 40%, #9ca3af 50%, #a8b0be 60%, #c7ccd6);
            box-shadow: -3px 0 8px rgba(0,0,0,0.06), 3px 0 8px rgba(0,0,0,0.06);
            flex-shrink: 0;
            z-index: 5;
        }

        /* Flip page overlay */
        .flip-overlay {
            position: absolute;
            top: 0;
            transform-style: preserve-3d;
            z-index: 20;
            pointer-events: none;
            transition: transform 0.6s cubic-bezier(0.645, 0.045, 0.355, 1);
        }

        .flip-overlay.no-anim { transition: none !important; }

        /* Forward flip - on right side, rotates around left edge */
        .flip-overlay.flip-fwd {
            right: 0;
            transform-origin: left center;
        }

        /* Backward flip - on left side, rotates around right edge */
        .flip-overlay.flip-bwd {
            left: 0;
            transform-origin: right center;
        }

        .flip-face {
            position: absolute;
            inset: 0;
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
            overflow: hidden;
            background: #fff;
        }

        .flip-face img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
            pointer-events: none;
        }

        .flip-back {
            transform: rotateY(180deg);
        }

        /* Flip shadows */
        .flip-overlay.flip-fwd .flip-front {
            box-shadow: -6px 0 15px rgba(0,0,0,0.1);
        }
        .flip-overlay.flip-bwd .flip-front {
            box-shadow: 6px 0 15px rgba(0,0,0,0.1);
        }

        /* Navigation arrows */
        .book-nav {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(29, 78, 216, 0.25);
            color: #1d4ed8;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }
        .book-nav:hover:not(:disabled) {
            background: rgba(29, 78, 216, 0.15);
            transform: scale(1.1);
        }
        .book-nav:disabled {
            opacity: 0.3; cursor: not-allowed;
        }

        /* Page dots */
        .page-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: #d5dae6;
            transition: all 0.25s ease;
            cursor: pointer;
        }
        .page-dot.active {
            background: #1d4ed8;
            width: 18px;
            border-radius: 3px;
        }
        .page-dot:hover:not(.active) {
            background: #a3b0cc;
        }

        /* Loading spinner */
        .book-spinner {
            width: 36px; height: 36px;
            border: 3px solid #eaedf4;
            border-top-color: #1d4ed8;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* Progress bar */
        .book-progress {
            width: 160px; height: 3px;
            background: #eaedf4;
            border-radius: 99px; overflow: hidden;
        }
        .book-progress-fill {
            height: 100%; width: 0%;
            background: linear-gradient(90deg, #1d4ed8, #0284c7);
            border-radius: 99px;
            transition: width 0.3s ease;
        }

        /* Mobile: single page mode */
        @media (max-width: 767px) {
            .book-page-left, .book-spine { display: none !important; }
            .flip-overlay.flip-bwd {
                right: 0; left: auto;
                transform-origin: left center;
            }
        }

        /* Entrance animation */
        @keyframes bookIn {
            from { opacity: 0; transform: rotateX(2deg) scale(0.95); }
            to { opacity: 1; transform: rotateX(2deg) scale(1); }
        }
        .book-entering .book-spread {
            animation: bookIn 0.4s ease forwards;
        }

        /* Blank page */
        .blank-page {
            background: #f8fafc;
            display: flex; align-items: center; justify-content: center;
        }
        .blank-page::after {
            content: '';
            width: 60px; height: 80px;
            border: 2px dashed #d5dae6;
            border-radius: 8px;
            opacity: 0.5;
        }

        /* Let's Talk Bubble Pin Animation */
        .bubble-pin {
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.3s ease;
        }
        .bubble-pin.hit-boundary {
            transform: scale(0.85) translateY(6px);
            opacity: 0.8;
        }
    </style>
</head>
<body class="relative min-h-screen bg-mist-100 font-sans antialiased text-ink-800 selection:bg-cobalt selection:text-white analytic-grid">

    <!-- MOBILE SIDEBAR DRAWER (Hidden on Desktop, used only for Mobile Menu Drawer) -->
    <aside id="sidebarDrawer" class="fixed inset-y-0 left-0 z-50 w-80 bg-mist-200 border-r border-mist-300 matrix-bg flex flex-col justify-between p-6 overflow-y-auto transform -translate-x-full lg:hidden smooth-transition shadow-2xl">
        
        <div class="space-y-8">
            <!-- Profile / Logo Block -->
            <div class="flex items-center gap-4 border-b border-mist-300 pb-6">
                <div class="flex flex-col">
                    <span id="sideName" class="font-bebas tracking-wider text-ink-900 text-2xl leading-none">{{ $user->name ?? 'Belum ada nama' }}</span>
                    <span id="sideTitle" class="text-[9px] font-extrabold uppercase tracking-widest text-futura mt-1">{{ $user->title ?? 'Belum ada jabatan' }}</span>
                </div>
            </div>

            <!-- Vertical Navigation Links -->
            <nav class="space-y-1.5 font-bold text-xs uppercase tracking-widest text-ink-700">
                <a href="#hero" onclick="toggleMobileSidebar()" class="group flex items-center gap-3.5 px-4 py-3 rounded-xl bg-mist-50 text-cobalt border border-mist-300/60 premium-shadow transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Home</span>
                </a>
                <a href="#services" onclick="toggleMobileSidebar()" class="group flex items-center gap-3.5 px-4 py-3 rounded-xl hover:bg-mist-50 hover:text-cobalt transition-all">
                    <svg class="w-4 h-4 text-ink-500 group-hover:text-cobalt" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>Services</span>
                </a>
                <a href="#skills" onclick="toggleMobileSidebar()" class="group flex items-center gap-3.5 px-4 py-3 rounded-xl hover:bg-mist-50 hover:text-cobalt transition-all">
                    <svg class="w-4 h-4 text-ink-500 group-hover:text-cobalt" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                    </svg>
                    <span>Skills</span>
                </a>
                <a href="#experiences" onclick="toggleMobileSidebar()" class="group flex items-center gap-3.5 px-4 py-3 rounded-xl hover:bg-mist-50 hover:text-cobalt transition-all">
                    <svg class="w-4 h-4 text-ink-500 group-hover:text-cobalt" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>Experiences</span>
                </a>
                <a href="#portfolio" onclick="toggleMobileSidebar()" class="group flex items-center gap-3.5 px-4 py-3 rounded-xl hover:bg-mist-50 hover:text-cobalt transition-all">
                    <svg class="w-4 h-4 text-ink-500 group-hover:text-cobalt" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>Portfolio</span>
                </a>
                <a href="#testimonials" onclick="toggleMobileSidebar()" class="group flex items-center gap-3.5 px-4 py-3 rounded-xl hover:bg-mist-50 hover:text-cobalt transition-all">
                    <svg class="w-4 h-4 text-ink-500 group-hover:text-cobalt" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <span>Clients</span>
                </a>
                <a href="#contact" onclick="toggleMobileSidebar()" class="group flex items-center gap-3.5 px-4 py-3 rounded-xl hover:bg-mist-50 hover:text-cobalt transition-all">
                    <svg class="w-4 h-4 text-ink-500 group-hover:text-cobalt" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span>Contact</span>
                </a>
            </nav>

            <!-- Available for Freelance Projects Card Banner -->
            <div class="relative bg-gradient-to-tr from-cobalt to-futura text-mist-50 p-5 rounded-2xl premium-shadow space-y-4 overflow-hidden">
                <div class="absolute -right-8 -top-8 w-24 h-24 rounded-full bg-white/10 blur-xl"></div>
                <div class="relative space-y-1.5">
                    <h4 class="text-[9px] font-extrabold uppercase tracking-[0.2em] text-white/90">Predicting The Future</h4>
                    <p class="text-xs font-semibold leading-relaxed">Mari realisasikan visi & arsitektur digital Anda dengan kecepatan maksimal.</p>
                </div>
                <a href="#contact" onclick="toggleMobileSidebar()" class="inline-flex items-center justify-between w-full px-4 py-2.5 bg-mist-50 text-ink-900 rounded-xl text-[10px] font-extrabold uppercase tracking-widest hover:bg-cobalt-light transition-all">
                    <span>Hire Me</span>
                    <svg class="w-3.5 h-3.5 text-cobalt" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Download CV Block inside Mobile Sidebar -->
        <div class="border-t border-mist-300 pt-6 mt-8 space-y-5">
            @if(isset($user->resume_path) && $user->resume_path)
                @php
                    try {
                        $resumeSize = round(Storage::disk('public')->size($user->resume_path) / 1024, 1);
                        $resumeSizeLabel = $resumeSize >= 1024
                            ? round($resumeSize / 1024, 1) . ' MB'
                            : $resumeSize . ' KB';
                    } catch (\Exception $e) {
                        $resumeSizeLabel = 'PDF Document';
                    }
                @endphp
                <div class="space-y-2">
                    <div class="flex items-center justify-between text-[9px] font-extrabold uppercase tracking-widest text-ink-500">
                        <span>DOWNLOAD RESUME / CV</span>
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                    </div>
                    <a href="{{ asset('storage/' . $user->resume_path) }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3 px-4 py-3 bg-mist-50 border border-mist-300 rounded-xl premium-shadow hover:border-cobalt transition-colors">
                        <svg class="w-5 h-5 text-cobalt" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="text-[10px] font-extrabold uppercase tracking-widest text-ink-800 truncate block max-w-[150px]">{{ basename($user->resume_path) }}</span>
                    </a>
                </div>
            @else
                <div class="space-y-2">
                    <div class="flex items-center justify-between text-[9px] font-extrabold uppercase tracking-widest text-ink-500">
                        <span>DOWNLOAD RESUME / CV</span>
                    </div>
                    <div class="px-4 py-3 bg-mist-50 border border-mist-300 rounded-xl text-center italic">
                        <span class="text-[10px] font-bold text-ink-500">Konten pada bagian ini belum tersedia.</span>
                    </div>
                </div>
            @endif
        </div>
    </aside>

    <!-- FLOATING LET'S TALK BUBBLE (MOBILE ONLY) WITH BLUE GRADIENT -->
    <a id="mobileLetsTalkBubble" href="#contact" class="lg:hidden fixed bottom-6 right-6 z-50 flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-tr from-cobalt to-futura text-mist-50 shadow-2xl hover:scale-110 active:scale-95 transition-all bubble-pin">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
        </svg>
    </a>

    <!-- MAIN GRID SYSTEM -->
    <div class="relative min-h-screen flex">

        <!-- SCROLLABLE MAIN CONTENT AREA -->
        <main class="flex-1 min-w-0 flex flex-col justify-between overflow-x-hidden pt-20 lg:pt-28">

            <!-- DESKTOP NAVBAR (Only visible on Desktop, keeps constant premium size/padding) -->
            <header id="desktopNavbar" class="hidden lg:flex fixed top-4 inset-x-4 max-w-7xl mx-auto z-40 items-center justify-between border border-mist-300 bg-mist-50/70 backdrop-blur-md px-6 py-4 rounded-2xl premium-shadow">
                <!-- Left-side Profile Identity matching Sidebar design -->
                <div class="flex items-center gap-4 shrink-0 max-w-[300px]">
                    <div class="flex flex-col min-w-0">
                        <span class="font-bebas tracking-wider text-ink-900 text-2xl leading-none">{{ $user->name ?? 'Belum ada nama' }}</span>
                        <span class="text-[9px] font-extrabold uppercase tracking-widest text-futura mt-1 leading-tight">{{ $user->title ?? 'Belum ada jabatan' }}</span>
                    </div>
                </div>
                <!-- Middle Anchor Section Links -->
                <div class="flex items-center gap-8 text-[10px] font-extrabold uppercase tracking-[0.2em] text-ink-700">
                    <a href="#hero" class="hover:text-cobalt transition-colors">Home</a>
                    <a href="#services" class="hover:text-cobalt transition-colors">Services</a>
                    <a href="#skills" class="hover:text-cobalt transition-colors">Skills</a>
                    <a href="#experiences" class="hover:text-cobalt transition-colors">Experiences</a>
                    <a href="#portfolio" class="hover:text-cobalt transition-colors">Portfolio</a>
                    <a href="#testimonials" class="hover:text-cobalt transition-colors">Clients</a>
                    <a href="#contact" class="hover:text-cobalt transition-colors">Contact</a>
                </div>

                <!-- Right-side Let's Talk Button -->
                <div class="flex items-center gap-4">
                    <a href="#contact" class="inline-flex items-center gap-2 px-5 py-3 rounded-full bg-gradient-to-tr from-cobalt to-futura text-mist-50 text-[10px] font-extrabold uppercase tracking-widest hover:scale-105 transition-all shadow-md">
                        <span>Let's Talk</span>
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </a>
                </div>
            </header>

            <!-- MOBILE TOP BAR NAVBAR (Full width on top, shrinks in width upon scrolling) -->
            <header id="mobileNavbar" class="lg:hidden fixed top-0 left-0 right-0 w-full z-40 flex items-center justify-between border-b border-mist-300 bg-mist-50/80 backdrop-blur-md px-6 py-4 smooth-transition">
                <!-- Left Identity -->
                <div class="flex flex-col">
                    <span class="font-bebas tracking-wider text-ink-900 text-xl leading-none">{{ $user->name ?? 'Belum ada nama' }}</span>
                    <span class="text-[8px] font-extrabold uppercase tracking-widest text-futura mt-1 leading-none">{{ $user->title ?? 'Belum ada jabatan' }}</span>
                </div>
                <!-- Menu Toggle Button -->
                <button onclick="toggleMobileSidebar()" class="px-4 py-2 bg-ink-900 text-mist-100 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-cobalt transition-colors">
                    Menu
                </button>
            </header>

            <section id="hero" class="max-w-7xl mx-auto px-6 md:px-12 pt-6 pb-12 md:pt-20 md:pb-20 w-full">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center lg:items-start">
                    
                    <div class="lg:col-span-7 space-y-6">
                        <span class="text-xs font-extrabold tracking-[0.3em] text-futura uppercase block">HELLO, I'M</span>
                        <h2 id="heroName" class="font-bebas text-6xl md:text-8xl text-ink-900 tracking-wider leading-[0.9]">
                            {{ $user->name ?? 'Belum ada nama' }}
                        </h2>
                        
                        <p class="font-bebas text-2xl md:text-4xl text-ink-800 leading-tight">
                            {{ $user->headline ?? 'Konten pada bagian ini belum tersedia.' }}
                        </p>

                        <p class="text-sm md:text-base text-ink-700 leading-relaxed max-w-xl">
                            {{ $user->bio ?? 'Konten pada bagian ini belum tersedia.' }}
                        </p>

                        <div class="flex flex-col gap-4 pt-4">
                            <div class="flex flex-wrap gap-4">
                                <a href="#portfolio" class="inline-flex items-center gap-2.5 px-6 py-3.5 bg-ink-900 hover:bg-cobalt text-mist-100 font-extrabold text-[10px] uppercase tracking-widest rounded-xl transition-all shadow-lg">
                                    <span>View My Work</span>
                                    <svg class="w-4 h-4 text-cobalt" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>

                                <div class="flex gap-2">
                                    @if(isset($user->resume_path) && $user->resume_path)
                                        <a href="{{ asset('storage/' . $user->resume_path) }}" download class="inline-flex items-center gap-2 px-4 py-3.5 border border-mist-400 hover:border-cobalt text-ink-800 font-extrabold text-[10px] uppercase tracking-widest rounded-xl transition-all bg-mist-50">
                                            <svg class="w-4 h-4 text-cobalt" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                            <span>Download {{ $user->resume_title ?? 'CV' }}</span>
                                        </a>
                                        <button onclick="toggleInlinePdfPreview('{{ asset('storage/' . $user->resume_path) }}')" class="inline-flex items-center gap-2 px-4 py-3.5 border border-mist-400 hover:border-futura text-ink-800 font-extrabold text-[10px] uppercase tracking-widest rounded-xl transition-all bg-mist-50">
                                            <svg class="w-4 h-4 text-futura" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            <span id="pdfPreviewBtnText">Preview {{ $user->resume_title ?? 'CV' }}</span>
                                        </button>
                                    @else
                                        <div class="inline-flex items-center gap-2 px-4 py-3.5 border border-mist-300 text-ink-500 font-bold text-[10px] uppercase tracking-widest rounded-xl bg-mist-200 italic cursor-not-allowed">
                                            File {{ $user->resume_title ?? 'CV' }} Belum Tersedia
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div id="inlinePdfContainer" class="hidden w-full mt-4 bg-white border border-mist-300 rounded-2xl overflow-hidden premium-shadow transition-all duration-500">
                                <div class="bg-mist-200 px-4 py-3 flex justify-between items-center border-b border-mist-300">
                                    <div class="flex items-center gap-3">
                                        <svg class="w-4 h-4 text-cobalt" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                        <span class="text-[10px] font-extrabold tracking-widest text-ink-500 uppercase">{{ $user->resume_title ?? 'CV' }} Preview</span>
                                    </div>
                                    <button onclick="closeInlinePdfPreview()" class="text-xs text-ink-500 hover:text-ink-900 font-bold transition-colors">✕ Close</button>
                                </div>
                                <div class="bg-gradient-to-b from-slate-50 to-slate-100">
                                    <div id="bookLoading" class="hidden flex flex-col items-center justify-center py-16 gap-4">
                                        <div class="book-spinner"></div>
                                        <div class="text-center space-y-2">
                                            <p id="bookLoadText" class="text-xs font-semibold text-ink-500">Memuat halaman...</p>
                                            <div class="book-progress mx-auto">
                                                <div id="bookProgressFill" class="book-progress-fill"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="bookError" class="hidden flex flex-col items-center justify-center py-16 gap-3">
                                        <svg class="w-10 h-10 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                        </svg>
                                        <p class="text-xs text-ink-500">Gagal memuat preview</p>
                                        <button onclick="fallbackPdf()" class="text-[10px] font-bold text-cobalt hover:underline">Buka PDF di tab baru</button>
                                    </div>
                                    <div id="bookView" class="hidden">
                                        <div class="relative flex items-center justify-center py-4 px-1 sm:px-4">
                                            <button id="bookPrev" onclick="bookFlipPrev()" class="book-nav absolute left-2 md:relative md:left-auto z-30" disabled aria-label="Halaman sebelumnya">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                                            </button>
                                            <div class="book-container flex-1 max-w-full" id="bookContainer">
                                                <div class="book-spread" id="bookSpread">
                                                    <div class="book-page book-page-left" id="pageLeft">
                                                        <div class="blank-page w-full h-full" id="leftContent"></div>
                                                    </div>
                                                    <div class="book-spine" id="bookSpine"></div>
                                                    <div class="book-page book-page-right" id="pageRight">
                                                        <div class="blank-page w-full h-full" id="rightContent"></div>
                                                    </div>
                                                    <div class="flip-overlay" id="flipOverlay">
                                                        <div class="flip-face flip-front"><img id="flipFrontImg" src="" alt=""></div>
                                                        <div class="flip-face flip-back"><img id="flipBackImg" src="" alt=""></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button id="bookNext" onclick="bookFlipNext()" class="book-nav absolute right-2 md:relative md:right-auto z-30" aria-label="Halaman berikutnya">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                                            </button>
                                        </div>  
                                        <div class="flex flex-col items-center gap-2 pb-4">
                                            <div id="pageDots" class="flex items-center gap-1.5"></div>
                                            <span id="pageIndicator" class="text-[10px] font-medium text-ink-400 tabular-nums"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-10 space-y-4">
                            <span class="text-xs font-extrabold tracking-[0.3em] text-futura uppercase block">LET'S CONNECT</span>
                            <h3 class="font-bebas text-5xl font-black text-ink-900 tracking-wider">Connect With Me</h3>
                             <div class="max-w-xl space-y-3">
                                 @if(isset($user->phone) && $user->phone)
                                     <button data-name="{{ $user->name }}" 
                                             data-phone="{{ $user->phone }}" 
                                             data-email="{{ $user->email ?? '' }}" 
                                             data-title="{{ $user->title ?? '' }}" 
                                             data-location="{{ $user->location ?? '' }}" 
                                             data-url="{{ url()->current() }}"
                                             onclick="downloadVCard(this)" 
                                             class="group flex items-center justify-between w-full p-4 bg-gradient-to-r from-cobalt to-futura text-mist-50 rounded-2xl premium-shadow hover:shadow-lg hover:scale-[1.01] transition-all duration-300">
                                         <div class="flex items-center gap-3.5">
                                             <span class="w-8 h-8 rounded-lg bg-white/20 text-white flex items-center justify-center shrink-0">
                                                 <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                     <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                 </svg>
                                             </span>
                                             <span class="font-bebas text-lg md:text-xl text-white tracking-wider uppercase">Save Contact</span>
                                         </div>
                                         <svg class="w-4 h-4 text-white/80 group-hover:text-white transition-all duration-300 group-hover:translate-y-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                             <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                         </svg>
                                     </button>
                                 @endif

                                 @if(isset($links) && $links->isNotEmpty())
                                    @foreach($links as $link)
                                        @if($link->icon === 'whatsapp')
                                            <a href="javascript:void(0)" onclick="openWhatsappModal('{{ $link->url }}')" class="group flex items-center justify-between p-4 bg-mist-50 border border-cobalt/15 hover:border-cobalt/40 rounded-2xl premium-shadow hover:shadow-lg transition-all duration-300">
                                        @else
                                            <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" class="group flex items-center justify-between p-4 bg-mist-50 border border-cobalt/15 hover:border-cobalt/40 rounded-2xl premium-shadow hover:shadow-lg transition-all duration-300">
                                        @endif
                                            <div class="flex items-center gap-3.5">
                                                @php $isGeneric = empty($link->icon) || $link->icon === 'other'; @endphp
                                                @if(!$isGeneric)
                                                    <span class="w-8 h-8 flex items-center justify-center shrink-0 opacity-90 group-hover:opacity-100 transition-opacity">
                                                        @include('components.icons.social', ['icon' => $link->icon, 'size' => 24])
                                                    </span>
                                                @else
                                                    <span class="w-8 h-8 rounded-lg bg-cobalt/10 text-cobalt flex items-center justify-center shrink-0 opacity-80 group-hover:opacity-100 transition-opacity">
                                                        @include('components.icons.social', ['icon' => 'other', 'size' => 18])
                                                    </span>
                                                @endif
                                                <span class="font-bebas text-lg md:text-xl text-ink-800 group-hover:text-cobalt tracking-wider uppercase transition-colors duration-300">{{ $link->title }}</span>
                                            </div>
                                            <svg class="w-4 h-4 text-cobalt/0 group-hover:text-cobalt transition-all duration-300 -translate-x-2 group-hover:translate-x-0 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                        </a>
                                    @endforeach
                                @else
                                    <div class="bg-mist-50 border border-mist-300 p-6 rounded-2xl text-center">
                                        <p class="text-sm text-ink-500 italic">Tautan belum tersedia saat ini.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-5 flex justify-center relative order-first lg:order-none">
                        <div class="absolute inset-0 bg-gradient-to-tr from-cobalt/10 to-futura/5 rounded-full filter blur-3xl scale-90 -z-10"></div>
                        <div class="absolute w-[320px] h-[320px] rounded-full border-2 border-dashed border-cobalt/20 animate-[spin_40s_linear_infinite] top-[10%]"></div>
                        
                        <div class="relative w-[280px] h-[350px] md:w-[320px] md:h-[400px] rounded-[32px] overflow-hidden bg-mist-200 border-4 border-mist-50 premium-shadow">
                            @if(isset($user->profile_photo_path) && $user->profile_photo_path)
                                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" class="w-full h-full object-cover" alt="{{ $user->name }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-center p-4 bg-mist-200">
                                    <span class="text-xs text-ink-500 italic">Foto profil belum tersedia.</span>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-ink-900/30 to-transparent"></div>
                        </div>

                        <div class="absolute bottom-10 -right-4 bg-mist-50 border border-mist-300 p-4 rounded-2xl premium-shadow flex flex-col items-center justify-center text-center w-28 h-28 transform rotate-6 hover:rotate-0 transition-all duration-500">
                            <span class="font-bebas text-4xl text-futura leading-none font-bold">{{ $user->experience_years ?? 0 }}+</span>
                            <span class="text-[9px] font-extrabold text-ink-700 uppercase tracking-widest mt-1">Years Experiences</span>
                        </div>
                    </div>

                </div>
            </section>

            <!-- WHAT I DO: SERVICES SECTION -->
            <section id="services" class="border-t border-mist-300 max-w-7xl mx-auto px-6 md:px-12 py-16 w-full">
                <div class="space-y-3 mb-10">
                    <span class="text-xs font-extrabold tracking-[0.3em] text-futura uppercase block">WHAT I DO</span>
                    <h3 class="font-bebas text-5xl font-black text-ink-900 tracking-wider">Services I Offer</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
                    @if(isset($services) && $services->isNotEmpty())
                        @foreach($services as $service)
                            <div class="bg-mist-50 border border-mist-300 p-6 rounded-2xl smooth-transition hover:-translate-y-1 premium-shadow card-shadow-hover flex flex-col justify-between">
                                <div class="space-y-4">
                                    <div class="w-12 h-12 rounded-xl bg-cobalt/10 border border-cobalt/30 flex items-center justify-center text-cobalt">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 21l3.75-1.5L16.5 21l-.813-5.096A7.5 7.5 0 109.813 15.904z" />
                                        </svg>
                                    </div>
                                    <h4 class="text-base font-extrabold text-ink-900">{{ $service->title }}</h4>
                                    <p class="text-xs text-ink-700 leading-relaxed">{{ $service->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="bg-mist-50 border border-mist-300 p-6 rounded-2xl text-center col-span-full">
                            <p class="text-sm text-ink-500 italic">Konten pada bagian ini belum tersedia.</p>
                        </div>
                    @endif
                </div>
            </section>

            {{-- Skills --}}
            @if(isset($skills) && $skills->isNotEmpty())
                <section id="skills" class="border-t border-mist-300 max-w-7xl mx-auto px-6 md:px-12 py-16 w-full pt-8">
                    <div class="mb-6">
                        <span class="text-xs font-extrabold tracking-[0.3em] text-futura uppercase block">MY EXPERTISE</span>
                        <h2 class="font-bebas text-5xl font-black text-ink-900 tracking-wider">Skills</h2>
                    </div>
                    <div class="space-y-3">
                        @foreach($skills as $skill)
                            <div class="bg-mist-50 border border-mist-300 rounded-xl p-4 transition-all duration-300 hover:shadow-lg hover:shadow-sky-500/[0.03]">
                                <div class="flex items-center justify-between mb-2.5">
                                    <span class="text-[14px] font-medium text-slate-700 transition-colors duration-300">{{ $skill->name }}</span>
                                    <span class="text-xs font-semibold tabular-nums transition-colors duration-300 @if($skill->percentage >= 80) text-sky-500 @elseif($skill->percentage >= 50) text-slate-500 @else text-slate-400 @endif">{{ $skill->percentage }}%</span>
                                </div>
                                <div class="skill-bar-track">
                                    <div
                                        class="skill-bar-fill @if($skill->percentage >= 80) skill-bar-high @elseif($skill->percentage >= 50) skill-bar-mid @else skill-bar-low @endif"
                                        style="--w: {{ $skill->percentage }}%"
                                    ></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @else
                <!-- Empty State for Skills -->
                <section id="skills" class="border-t border-mist-300 max-w-7xl mx-auto px-6 md:px-12 py-16 w-full pt-8">
                    <div class="mb-6">
                        <span class="text-xs font-extrabold tracking-[0.3em] text-futura uppercase block">MY EXPERTISE</span>
                        <h2 class="font-bebas text-5xl font-black text-ink-900 tracking-wider">Skills</h2>
                    </div>
                    <div class="bg-mist-50 border border-mist-300 p-6 rounded-2xl text-center">
                        <p class="text-sm text-ink-500 italic">Konten pada bagian ini belum tersedia.</p>
                    </div>
                </section>
            @endif

            {{-- Experiences --}}
            @if(isset($experiences) && $experiences->isNotEmpty())
                <section id="experiences" class="border-t border-mist-300 max-w-7xl mx-auto px-6 md:px-12 py-16 w-full pt-8">
                    <div class="mb-6">
                        <span class="text-xs font-extrabold tracking-[0.3em] text-futura uppercase block">MY JOURNEY</span>
                        <h2 class="font-bebas text-5xl font-black text-ink-900 tracking-wider">Experiences</h2>
                    </div>
                    <div class="stagger space-y-4">
                        @foreach($experiences as $exp)
                            <div class="exp-card tilt-card bg-mist-50 border border-mist-300 rounded-2xl p-5 transition-all duration-300 hover:shadow-xl hover:shadow-sky-500/[0.03]">
                                <div class="tilt-inner">
                                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-1.5 mb-2">
                                        <h3 class="text-[15px] font-semibold text-slate-800 transition-colors duration-300">{{ $exp->role }}</h3>
                                        <span class="text-xs font-semibold text-sky-500 whitespace-nowrap tabular-nums transition-colors duration-300">{{ $exp->period }}</span>
                                    </div>
                                    <p class="text-[13px] font-medium text-slate-400 mb-2.5 transition-colors duration-300">{{ $exp->company }}</p>
                                    @if($exp->description)
                                        <p class="text-[13px] text-slate-500 leading-[1.75] transition-colors duration-300">{{ $exp->description }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @else
                <!-- Empty State for Experiences -->
                <section id="experiences" class="border-t border-mist-300 max-w-7xl mx-auto px-6 md:px-12 py-16 w-full pt-8">
                    <div class="mb-6">
                        <span class="text-xs font-extrabold tracking-[0.3em] text-futura uppercase block">MY JOURNEY</span>
                        <h2 class="font-bebas text-5xl font-black text-ink-900 tracking-wider">Experiences</h2>
                    </div>
                    <div class="bg-mist-50 border border-mist-300 p-6 rounded-2xl text-center">
                        <p class="text-sm text-ink-500 italic">Konten pada bagian ini belum tersedia.</p>
                    </div>
                </section>
            @endif

            <!-- PORTFOLIO SECTION -->
            @php $hasPortfolios = isset($portfolios) && $portfolios->isNotEmpty(); @endphp
            <section id="portfolio" class="border-t border-mist-300 max-w-7xl mx-auto px-6 md:px-12 py-16 w-full">
                <div class="flex items-end justify-between mb-10">
                    <div class="space-y-3">
                        <span class="text-xs font-extrabold tracking-[0.3em] text-futura uppercase block">MY WORK</span>
                        <h3 class="font-bebas text-5xl font-black text-ink-900 tracking-wider">Featured Projects</h3>
                    </div>
                    @if($hasPortfolios)
                        <button onclick="openAllProjectsModal()" class="text-xs font-extrabold tracking-widest text-ink-700 hover:text-cobalt transition-colors uppercase border-b-2 border-futura pb-1">
                            View All Projects
                        </button>
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8" id="portfolioGrid">
                    @if($hasPortfolios)
                        @foreach($portfolios as $portfolio)
                            <div class="group flex flex-col space-y-4">
                                <div class="relative aspect-[16/10] bg-mist-200 border border-mist-300 rounded-[24px] overflow-hidden premium-shadow">
                                    @if($portfolio->image_path)
                                        <img src="{{ asset('storage/' . $portfolio->image_path) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="{{ $portfolio->title }}">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-tr from-mist-200 to-mist-300 flex items-center justify-center">
                                            <svg class="w-12 h-12 text-mist-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                    @if($portfolio->url)
                                        <a href="{{ $portfolio->url }}" target="_blank" rel="noopener noreferrer" class="absolute inset-0 bg-ink-900/10 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                            <div class="w-10 h-10 rounded-full bg-mist-50 flex items-center justify-center premium-shadow transform scale-75 group-hover:scale-100 transition-transform">
                                                <svg class="w-4 h-4 text-cobalt" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                </svg>
                                            </div>
                                        </a>
                                    @endif
                                </div>
                                <div class="space-y-1.5 px-2">
                                    <h4 class="text-lg font-extrabold text-ink-900 group-hover:text-cobalt transition-colors">{{ $portfolio->title }}</h4>
                                    @if($portfolio->description)
                                        <p class="text-xs text-ink-700 leading-relaxed">{{ $portfolio->description }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="bg-mist-50 border border-mist-300 p-6 rounded-2xl text-center col-span-full">
                            <p class="text-sm text-ink-500 italic">Konten pada bagian ini belum tersedia.</p>
                        </div>
                    @endif
                </div>
            </section>

            <!-- NUMERICAL IMPACT STATS BAR -->
            @php 
                // Menghitung dinamis dari database
                $totalProjects = isset($portfolios) ? $portfolios->count() : 0;
                $totalClients = isset($clients) ? $clients->count() : 0;
                $totalSkills = isset($skills) ? $skills->count() : 0;
                $totalExp = isset($user->experience_years) ? $user->experience_years : 0;
            @endphp
            <section class="max-w-7xl mx-auto px-6 md:px-12 py-10 w-full">
                <div class="bg-gradient-to-r from-cobalt via-futura to-cobalt text-mist-50 rounded-3xl p-8 md:p-10 premium-shadow">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-4 items-center">
                        
                        <!-- Stat 1: Projects Completed -->
                        <div class="flex items-center gap-4 border-r-0 md:border-r border-white/20 last:border-0 pr-4">
                            <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-mist-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-bebas text-3xl md:text-4xl font-bold tracking-wider leading-none">{{ $totalProjects }}</span>
                                <span class="text-[9px] font-extrabold uppercase tracking-widest text-mist-300 mt-1">Projects Done</span>
                            </div>
                        </div>

                        <!-- Stat 2: Happy Clients -->
                        <div class="flex items-center gap-4 border-r-0 md:border-r border-white/20 last:border-0 pr-4">
                            <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-mist-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-bebas text-3xl md:text-4xl font-bold tracking-wider leading-none">{{ $totalClients }}</span>
                                <span class="text-[9px] font-extrabold uppercase tracking-widest text-mist-300 mt-1">Happy Clients</span>
                            </div>
                        </div>

                        <!-- Stat 3: Total Skills -->
                        <div class="flex items-center gap-4 border-r-0 md:border-r border-white/20 last:border-0 pr-4">
                            <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-mist-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-bebas text-3xl md:text-4xl font-bold tracking-wider leading-none">{{ $totalSkills }}</span>
                                <span class="text-[9px] font-extrabold uppercase tracking-widest text-mist-300 mt-1">Best Skills</span>
                            </div>
                        </div>

                        <!-- Stat 4: Years Experience -->
                        <div class="flex items-center gap-4 border-r-0 md:border-r border-white/20 last:border-0 pr-4">
                            <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-mist-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-bebas text-3xl md:text-4xl font-bold tracking-wider leading-none">{{ $totalExp }}+</span>
                                <span class="text-[9px] font-extrabold uppercase tracking-widest text-mist-300 mt-1">Years Experiences</span>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </section>

            <!-- CLIENTS LOGO SECTION -->
            <section id="testimonials" class="border-t border-mist-300 max-w-7xl mx-auto px-6 md:px-12 py-24 w-full">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-4">
                    <div class="space-y-3">
                        <span class="text-xs font-extrabold tracking-[0.3em] text-futura uppercase block">CLIENTS</span>
                        <h3 class="font-bebas text-5xl md:text-6xl font-black text-ink-900 tracking-wider">Trusted By</h3>
                    </div>
                    {{-- <p class="text-xs font-medium text-ink-500 max-w-xs md:text-right leading-relaxed">
                        Kolaborasi strategis yang telah kami bangun bersama berbagai mitra dan brand terpercaya.
                    </p> --}}
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-x-8 gap-y-14 md:gap-x-12 md:gap-y-20 items-center">
                    @if(isset($clients) && $clients->isNotEmpty())
                        @foreach($clients as $client)
                            <div class="flex flex-col items-center justify-center relative p-4 transition-all duration-300 group text-center JSON-container">
                                
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-700 ease-out pointer-events-none">
                                    <div class="w-24 h-24 bg-cobalt/20 rounded-full filter blur-xl transform scale-50 group-hover:scale-125 transition-transform duration-500 ease-out"></div>
                                    <div class="absolute w-40 h-40 bg-cobalt/5 rounded-full filter blur-2xl transform scale-50 group-hover:scale-150 transition-transform duration-700 ease-out延迟-75"></div>
                                </div>
                                
                                @if(isset($client->logo_path) && $client->logo_path)
                                    <div class="h-32 md:h-48 w-full flex items-center justify-center mb-6 overflow-hidden relative z-10">
                                        <img src="{{ asset('storage/' . $client->logo_path) }}" 
                                             class="max-h-32 md:max-h-48 w-auto object-contain filter grayscale contrast-125 opacity-30 group-hover:grayscale-0 group-hover:opacity-100 group-hover:scale-105 group-hover:drop-shadow-[0_10px_20px_rgba(var(--cobalt-rgb,0,102,204),0.15)] transition-all duration-500 ease-out" 
                                             alt="{{ $client->name ?? 'Client Logo' }}">
                                    </div>
                                    
                                    @if(isset($client->name))
                                        <div class="flex flex-col items-center pt-2 w-full overflow-hidden relative z-10">
                                            <span class="w-4 h-[2px] bg-ink-300 group-hover:w-16 group-hover:bg-cobalt group-hover:shadow-[0_0_8px_rgba(var(--cobalt-rgb,0,102,204),0.6)] transition-all duration-500 ease-out mb-2.5"></span>
                                            
                                            <p class="font-sans text-[10px] md:text-xs font-extrabold tracking-[0.25em] text-ink-500 uppercase transition-all duration-300 transform group-hover:translate-y-[-1px] group-hover:text-ink-900">
                                                {{ $client->name }}
                                            </p>
                                        </div>
                                    @endif
                                @elseif(isset($client->name))
                                    <div class="flex flex-col items-center py-8 relative z-10">
                                        <span class="font-bebas text-3xl md:text-4xl text-ink-400 group-hover:text-cobalt tracking-widest uppercase transition-colors duration-300 group-hover:drop-shadow-[0_0_12px_rgba(var(--cobalt-rgb,0,102,204),0.3)]">{{ $client->name }}</span>
                                        <span class="w-8 h-[2px] bg-ink-300 mt-3 transform scale-x-50 group-hover:scale-x-125 group-hover:bg-cobalt transition-all duration-300"></span>
                                    </div>
                                @endif

                            </div>
                        @endforeach
                    @else
                        <div class="bg-mist-50 border border-mist-300 p-6 rounded-2xl text-center col-span-full">
                            <p class="text-sm text-ink-500 italic">Konten pada bagian ini belum tersedia.</p>
                        </div>
                    @endif
                </div>
            </section>

            <!-- CONTACT & LET'S WORK TOGETHER SECTION -->
            <section id="contact" class="border-t border-mist-300 max-w-7xl mx-auto px-6 md:px-12 py-16 w-full">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                    
                    <!-- Left Grid Card Promo -->
                    <div class="lg:col-span-6 bg-gradient-to-tr from-cobalt to-futura text-mist-50 p-8 rounded-3xl flex flex-col justify-between premium-shadow relative overflow-hidden">
                        <div class="absolute -right-12 -top-12 w-32 h-32 rounded-full bg-white/5 blur-2xl"></div>
                        <div class="space-y-4">
                            <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center">
                                <svg class="w-6 h-6 text-mist-50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                            </div>
                            <h4 class="font-bebas text-4xl font-bold tracking-wider">Let's Build the Future!</h4>
                            <p class="text-xs text-mist-100 leading-relaxed">{{ $user->cta_description ?? 'Mempunyai rencana inovasi atau proyek berkecepatan tinggi? Mari salurkan logika kritis kita bersama untuk membangun platform digital terbaik.' }}</p>
                        </div>
                        <span class="text-[10px] font-extrabold tracking-widest uppercase text-white/50 mt-12 block">SAKA | ALENKOSA  &copy; 2026</span>
                    </div>

                    {{-- Middle Grid Interactive Mail Form (Commented out as requested)
                    <div class="lg:col-span-5 bg-mist-50 border border-mist-300 p-8 rounded-3xl premium-shadow">
                        <form id="contactForm" method="POST" action="{{ route('messages.public.store', $user->profile_token ?? 'default') }}" onsubmit="submitContactForm(event)" class="space-y-5 text-xs font-bold uppercase tracking-wider text-ink-700">
                            @csrf
                            <div class="space-y-1.5">
                                <label for="senderName" class="block text-ink-500 text-[10px] tracking-widest">Nama Lengkap</label>
                                <input type="text" id="senderName" name="name" required class="w-full px-4 py-3 bg-mist-100 border border-mist-300 rounded-xl text-ink-800 text-sm font-medium focus:outline-none focus:border-cobalt transition-colors" placeholder="John Doe">
                            </div>
                            <div class="space-y-1.5">
                                <label for="senderEmail" class="block text-ink-500 text-[10px] tracking-widest">Email Address</label>
                                <input type="email" id="senderEmail" name="email" required class="w-full px-4 py-3 bg-mist-100 border border-mist-300 rounded-xl text-ink-800 text-sm font-medium focus:outline-none focus:border-cobalt transition-colors" placeholder="john@example.com">
                            </div>
                            <!-- Perusahaan & Asal Kota samping menyamping -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label for="senderCompany" class="block text-ink-500 text-[10px] tracking-widest">Perusahaan / Instansi</label>
                                    <input type="text" id="senderCompany" name="company" required class="w-full px-4 py-3 bg-mist-100 border border-mist-300 rounded-xl text-ink-800 text-sm font-medium focus:outline-none focus:border-cobalt transition-colors" placeholder="SAKA Alenkosa">
                                </div>
                                <div class="space-y-1.5">
                                    <label for="senderCity" class="block text-ink-500 text-[10px] tracking-widest">Asal Kota</label>
                                    <input type="text" id="senderCity" name="city" required class="w-full px-4 py-3 bg-mist-100 border border-mist-300 rounded-xl text-ink-800 text-sm font-medium focus:outline-none focus:border-cobalt transition-colors" placeholder="Jakarta">
                                </div>
                            </div>
                            <div class="space-y-1.5">
                                <label for="senderMessage" class="block text-ink-500 text-[10px] tracking-widest">Penjelasan Proyek</label>
                                <textarea id="senderMessage" name="message" rows="4" required class="w-full px-4 py-3 bg-mist-100 border border-mist-300 rounded-xl text-ink-800 text-sm font-medium focus:outline-none focus:border-cobalt transition-colors resize-none" placeholder="Jelaskan kebutuhan proyek Anda..."></textarea>
                            </div>
                            <button type="submit" id="contactSubmitBtn" class="w-full inline-flex items-center justify-center gap-2.5 px-6 py-3.5 bg-ink-900 hover:bg-cobalt text-mist-100 font-extrabold text-[10px] uppercase tracking-widest rounded-xl transition-all shadow-lg">
                                <span>Send Message</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>
                        </form>
                        <!-- Success Toast -->
                        <div id="contactSuccess" class="hidden mt-4 px-4 py-3 bg-cobalt/10 border border-cobalt/30 rounded-xl text-center">
                            <span class="text-xs font-bold text-cobalt">Pesan berhasil dikirim! Terima kasih.</span>
                        </div>
                    </div>
                    --}}

                    <!-- Right Grid Contact Info -->
                    <div class="lg:col-span-6 bg-mist-50 border border-mist-300 p-8 rounded-3xl premium-shadow flex flex-col justify-between">
                        <div class="space-y-6">
                            <span class="text-[9px] font-extrabold tracking-[0.25em] text-ink-500 uppercase block">Get in Touch</span>
                            
                            @if(isset($user->email) && $user->email)
                                <div class="space-y-2">
                                    <span class="text-[9px] font-extrabold tracking-widest text-ink-500 uppercase block">Email</span>
                                    <a href="mailto:{{ $user->email }}" class="text-sm text-ink-800 hover:text-cobalt transition-colors font-medium break-all">{{ $user->email }}</a>
                                </div>
                            @endif

                            @if(isset($user->phone) && $user->phone)
                                <div class="space-y-2">
                                    <span class="text-[9px] font-extrabold tracking-widest text-ink-500 uppercase block">Phone</span>
                                    <a href="tel:{{ $user->phone }}" class="text-sm text-ink-800 hover:text-cobalt transition-colors font-medium">{{ $user->phone }}</a>
                                </div>
                            @endif

                            @if(isset($user->location) && $user->location)
                                <div class="space-y-2">
                                    <span class="text-[9px] font-extrabold tracking-widest text-ink-500 uppercase block">Location</span>
                                    <span class="text-sm text-ink-800 font-medium">{{ $user->location }}</span>
                                </div>
                            @endif

                            @if(isset($links) && $links->isNotEmpty())
                                <div class="space-y-2 pt-4 border-t border-mist-300">
                                    <span class="text-[9px] font-extrabold tracking-widest text-ink-500 uppercase block">Social</span>
                                    <div class="flex flex-wrap gap-3">
                                        @foreach($links as $link)
                                            @if($link->icon === 'whatsapp')
                                                <a href="javascript:void(0)" onclick="openWhatsappModal('{{ $link->url }}')" class="w-9 h-9 rounded-xl bg-mist-100 border border-mist-300 flex items-center justify-center text-ink-500 hover:text-cobalt hover:border-cobalt transition-all" title="{{ $link->title }}">
                                            @else
                                                <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-xl bg-mist-100 border border-mist-300 flex items-center justify-center text-ink-500 hover:text-cobalt hover:border-cobalt transition-all" title="{{ $link->title }}">
                                            @endif
                                                @if($link->icon)
                                                    @include('components.icons.social', ['icon' => $link->icon, 'size' => 18])
                                                @else
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                                    </svg>
                                                @endif
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </section>

            <!-- FOOTER -->
            <footer class="border-t border-mist-300 max-w-7xl mx-auto px-6 md:px-12 py-8 w-full">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <span class="text-[10px] font-extrabold tracking-widest text-ink-500 uppercase">&copy; {{ date('Y') }} {{ $user->name ?? 'Profil' }}. All rights reserved.</span>
                    <span class="text-[10px] font-bold text-ink-400">Crafted with precision.</span>
                </div>
            </footer>

        </main>
    </div>

    <!-- WHATSAPP MODAL -->
    <div id="whatsappModal" class="fixed inset-0 z-[60] hidden">
        <div class="absolute inset-0 bg-ink-900/60 backdrop-blur-sm" onclick="closeWhatsappModal()"></div>
        <div class="relative flex items-center justify-center min-h-screen p-4">
            <div class="relative bg-mist-50 border border-mist-300 rounded-3xl w-full max-w-lg premium-shadow p-8">
                <div class="flex justify-between items-center border-b border-mist-300 pb-4 mb-5">
                    <div>
                        <span class="text-xs font-extrabold tracking-[0.3em] text-futura uppercase block">HUBUNGI VIA WHATSAPP</span>
                        <h3 class="font-bebas text-3xl font-black text-ink-900 tracking-wider">Kirim Pesan WhatsApp</h3>
                    </div>
                    <button onclick="closeWhatsappModal()" class="w-10 h-10 rounded-xl bg-mist-200 border border-mist-300 flex items-center justify-center text-ink-500 hover:text-ink-900 hover:border-cobalt transition-all">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="whatsappForm" onsubmit="submitWhatsappForm(event)" class="space-y-5 text-xs font-bold uppercase tracking-wider text-ink-700">
                    <input type="hidden" id="waLinkUrl" value="">
                    <div class="space-y-1.5">
                        <label for="waSenderName" class="block text-ink-500 text-[10px] tracking-widest">Nama Lengkap</label>
                        <input type="text" id="waSenderName" name="name" required class="w-full px-4 py-3 bg-mist-100 border border-mist-300 rounded-xl text-ink-800 text-sm font-medium focus:outline-none focus:border-cobalt transition-colors" placeholder="John Doe">
                    </div>
                    <div class="space-y-1.5">
                        <label for="waSenderEmail" class="block text-ink-500 text-[10px] tracking-widest">Email Address</label>
                        <input type="email" id="waSenderEmail" name="email" required class="w-full px-4 py-3 bg-mist-100 border border-mist-300 rounded-xl text-ink-800 text-sm font-medium focus:outline-none focus:border-cobalt transition-colors" placeholder="john@example.com">
                    </div>
                    <div class="space-y-1.5">
                        <label for="waSenderCompany" class="block text-ink-500 text-[10px] tracking-widest">Perusahaan / Instansi</label>
                        <input type="text" id="waSenderCompany" name="company" required class="w-full px-4 py-3 bg-mist-100 border border-mist-300 rounded-xl text-ink-800 text-sm font-medium focus:outline-none focus:border-cobalt transition-colors" placeholder="SAKA Alenkosa">
                    </div>
                    <div class="space-y-1.5">
                        <label for="waSenderCity" class="block text-ink-500 text-[10px] tracking-widest">Asal Kota</label>
                        <input type="text" id="waSenderCity" name="city" required class="w-full px-4 py-3 bg-mist-100 border border-mist-300 rounded-xl text-ink-800 text-sm font-medium focus:outline-none focus:border-cobalt transition-colors" placeholder="Jakarta">
                    </div>
                    <div class="space-y-1.5">
                        <label for="waSenderMessage" class="block text-ink-500 text-[10px] tracking-widest">Penjelasan Proyek</label>
                        <textarea id="waSenderMessage" name="message" rows="4" required class="w-full px-4 py-3 bg-mist-100 border border-mist-300 rounded-xl text-ink-800 text-sm font-medium focus:outline-none focus:border-cobalt transition-colors resize-none" placeholder="Jelaskan kebutuhan proyek Anda..."></textarea>
                    </div>
                    <button type="submit" id="waSubmitBtn" class="w-full inline-flex items-center justify-center gap-2.5 px-6 py-3.5 bg-ink-900 hover:bg-cobalt text-mist-100 font-extrabold text-[10px] uppercase tracking-widest rounded-xl transition-all shadow-lg">
                        <span>Send Message & Chat WA</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- ALL PROJECTS MODAL -->
    <div id="allProjectsModal" class="fixed inset-0 z-[60] hidden">
        <div class="absolute inset-0 bg-ink-900/60 backdrop-blur-sm" onclick="closeAllProjectsModal()"></div>
        <div class="relative flex items-center justify-center min-h-screen p-4">
            <div class="relative bg-mist-50 border border-mist-300 rounded-3xl w-full max-w-4xl max-h-[85vh] overflow-y-auto premium-shadow">
                <div class="sticky top-0 bg-mist-50/90 backdrop-blur-md border-b border-mist-300 px-8 py-5 flex items-center justify-between rounded-t-3xl z-10">
                    <div>
                        <span class="text-xs font-extrabold tracking-[0.3em] text-futura uppercase block">ALL PROJECTS</span>
                        <h3 class="font-bebas text-3xl font-black text-ink-900 tracking-wider">Complete Portfolio</h3>
                    </div>
                    <button onclick="closeAllProjectsModal()" class="w-10 h-10 rounded-xl bg-mist-200 border border-mist-300 flex items-center justify-center text-ink-500 hover:text-ink-900 hover:border-cobalt transition-all">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6" id="allProjectsGrid">
                    <!-- Populated dynamically or statically with all portfolios -->
                </div>
            </div>
        </div>
    </div>

    <!-- SIDEBAR OVERLAY BACKDROP -->
    <div id="sidebarOverlay" class="fixed inset-0 z-40 bg-ink-900/40 backdrop-blur-sm hidden lg:hidden" onclick="toggleMobileSidebar()"></div>

    <script>
        // ==================== MOBILE SIDEBAR TOGGLE ====================
        function toggleMobileSidebar() {
            const drawer = document.getElementById('sidebarDrawer');
            const overlay = document.getElementById('sidebarOverlay');
            const isOpen = !drawer.classList.contains('-translate-x-full');
            
            if (isOpen) {
                drawer.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.style.overflow = '';
            } else {
                drawer.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        }

        // ==================== BOOK PREVIEW STATE ====================
        const bookState = {
            pages: [],
            currentSpread: 0,
            totalSpreads: 0,
            totalPages: 0,
            isFlipping: false,
            isLoaded: false,
            pdfUrl: null,
            fallbackUrl: null,
            isMobile: window.innerWidth < 768
        };

        // ==================== PDF PREVIEW (BOOK STYLE) ====================
        function toggleInlinePdfPreview(url) {
            const container = document.getElementById('inlinePdfContainer');
            const btnText = document.getElementById('pdfPreviewBtnText');
            
            if (container.classList.contains('hidden')) {
                container.classList.remove('hidden');
                btnText.textContent = 'Hide Preview';
                bookState.fallbackUrl = url;
                
                if (bookState.isLoaded && bookState.pdfUrl === url) {
                    showBookView();
                } else {
                    bookState.pdfUrl = url;
                    loadBookPdf(url);
                }
            } else {
                closeInlinePdfPreview();
            }
        }

        function closeInlinePdfPreview() {
            const container = document.getElementById('inlinePdfContainer');
            const btnText = document.getElementById('pdfPreviewBtnText');
            
            container.classList.add('hidden');
            btnText.textContent = 'Preview {{ $user->resume_title ?? "CV" }}';
        }

        function fallbackPdf() {
            if (bookState.fallbackUrl) {
                window.open(bookState.fallbackUrl, '_blank');
            }
        }

        function showBookView() {
            document.getElementById('bookLoading').classList.add('hidden');
            document.getElementById('bookError').classList.add('hidden');
            document.getElementById('bookView').classList.remove('hidden');
            
            bookState.currentSpread = 0;
            sizeBookPages();
            document.getElementById('flipOverlay').style.display = 'none';
            renderSpread();
        }

        async function loadBookPdf(url) {
            const loading = document.getElementById('bookLoading');
            const error = document.getElementById('bookError');
            const view = document.getElementById('bookView');
            const progressFill = document.getElementById('bookProgressFill');
            const loadText = document.getElementById('bookLoadText');
            
            loading.classList.remove('hidden');
            error.classList.add('hidden');
            view.classList.add('hidden');
            
            try {
                if (typeof pdfjsLib === 'undefined') {
                    await new Promise((resolve) => {
                        const s = document.createElement('script');
                        s.src = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js';
                        s.onload = resolve;
                        document.head.appendChild(s);
                    });
                }
                pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
                const pdf = await pdfjsLib.getDocument(url).promise;
                bookState.totalPages = pdf.numPages;
                bookState.pages = [];

                for (let i = 1; i <= pdf.numPages; i++) {
                    const page = await pdf.getPage(i);
                    const viewport = page.getViewport({ scale: 1.5 });
                    const canvas = document.createElement('canvas');
                    canvas.width = viewport.width; canvas.height = viewport.height;
                    await page.render({ canvasContext: canvas.getContext('2d'), viewport }).promise;
                    bookState.pages.push(canvas.toDataURL('image/jpeg', 0.9));
                    progressFill.style.width = Math.round((i / pdf.numPages) * 100) + '%';
                }

                bookState.isLoaded = true;
                bookState.isMobile = window.innerWidth < 768;
                bookState.totalSpreads = bookState.isMobile ? pdf.numPages : Math.ceil((pdf.numPages + 1) / 2);
                showBookView();
            } catch (err) {
                loading.classList.add('hidden');
                error.classList.add('hidden');
                document.getElementById('bookError').classList.remove('hidden');
            }
        }

        function sizeBookPages() {
            const isMobile = window.innerWidth < 768;
            const container = document.getElementById('bookContainer');
            const leftPage = document.getElementById('pageLeft');
            const rightPage = document.getElementById('pageRight');
            const spine = document.getElementById('bookSpine');
            const flip = document.getElementById('flipOverlay');
            
            const containerWidth = container.clientWidth;
            const maxHeight = isMobile ? 550 : 700;
            const pageRatio = 842 / 595;

            if (isMobile) {
                leftPage.style.display = 'block';
                leftPage.style.width = '12px';
                leftPage.style.flexShrink = '0';
                spine.style.display = 'block';
                
                const availW = containerWidth - 20;
                let w = Math.min(availW, 400);
                let h = w * pageRatio;
                if (h > maxHeight) { h = maxHeight; w = h / pageRatio; }

                rightPage.style.width = w + 'px';
                rightPage.style.height = h + 'px';
                leftPage.style.height = h + 'px';
                flip.style.width = w + 'px';
                flip.style.height = h + 'px';
            } else {
                leftPage.style.display = 'block';
                spine.style.display = 'block';
                const availWidth = containerWidth - 4;
                const pageW = availWidth / 2;
                let pageH = pageW * pageRatio;
                if (pageH > maxHeight) {
                    pageH = maxHeight;
                    const adjustedW = pageH / pageRatio;
                    leftPage.style.width = adjustedW + 'px';
                    leftPage.style.height = pageH + 'px';
                    rightPage.style.width = adjustedW + 'px';
                    rightPage.style.height = pageH + 'px';
                    flip.style.width = adjustedW + 'px';
                    flip.style.height = pageH + 'px';
                } else {
                    leftPage.style.width = pageW + 'px';
                    leftPage.style.height = pageH + 'px';
                    rightPage.style.width = pageW + 'px';
                    rightPage.style.height = pageH + 'px';
                    flip.style.width = pageW + 'px';
                    flip.style.height = pageH + 'px';
                }
            }
        }

        function renderSpread() {
            const leftContent = document.getElementById('leftContent');
            const rightContent = document.getElementById('rightContent');
            const s = bookState.currentSpread;

            if (bookState.isMobile) {
                setPageContent(rightContent, bookState.pages[s], false);
                setPageContent(leftContent, bookState.pages[s-1] || null, true);
                document.getElementById('pageIndicator').textContent = `Halaman ${s + 1} / ${bookState.totalPages}`;
            } else {
                const leftIdx = s * 2 - 1;
                const rightIdx = s * 2;
                setPageContent(leftContent, bookState.pages[leftIdx] || null, true);
                setPageContent(rightContent, bookState.pages[rightIdx] || null, false);
                document.getElementById('pageIndicator').textContent = `Halaman ${leftIdx+1 > 0 ? leftIdx+1 : '-'}–${rightIdx+1} / ${bookState.totalPages}`;
            }
            updateNavButtons();
            updateDots();
        }

        function setPageContent(el, img, isLeft = false) {
            if (!img) {
                el.innerHTML = '';
                return;
            }
            if (isLeft) {
                el.innerHTML = `<img src="${img}" style="width:100%;height:100%;object-fit:cover;object-position:right center;display:block;">`;
            } else {
                el.innerHTML = `<img src="${img}" style="width:100%;height:100%;object-fit:contain;display:block;">`;
            }
        }

        function updateNavButtons() {
            document.getElementById('bookPrev').disabled = bookState.currentSpread <= 0 || bookState.isFlipping;
            document.getElementById('bookNext').disabled = bookState.currentSpread >= bookState.totalSpreads - 1 || bookState.isFlipping;
        }

        function updateDots() {
            const dots = document.getElementById('pageDots');
            dots.innerHTML = '';
            for(let i=0; i<bookState.totalSpreads; i++) {
                const dot = document.createElement('div');
                dot.className = `page-dot ${i === bookState.currentSpread ? 'active' : ''}`;
                dot.onclick = () => goToSpread(i);
                dots.appendChild(dot);
            }
        }

        function goToSpread(idx) {
            if (bookState.isFlipping || idx === bookState.currentSpread) return;
            bookState.currentSpread = idx;
            renderSpread();
        }

        function bookFlipNext() {
            if (bookState.isFlipping || bookState.currentSpread >= bookState.totalSpreads - 1) return;
            bookState.isFlipping = true;
            updateNavButtons();

            const flip = document.getElementById('flipOverlay');
            const leftContent = document.getElementById('leftContent');
            const rightContent = document.getElementById('rightContent');
            const s = bookState.currentSpread;

            flip.style.display = 'block';
            flip.style.transition = 'none';
            flip.style.right = '0';
            flip.style.left = 'auto';
            flip.style.transformOrigin = 'left center';
            flip.style.transform = 'rotateY(0deg)';
            
            if (bookState.isMobile) {
                document.getElementById('flipFrontImg').src = bookState.pages[s] || '';
                document.getElementById('flipBackImg').src = bookState.pages[s+1] || '';
                
                // Mobile: Langsung tampilkan halaman tujuan di bawahnya agar langsung kelihatan saat dibuka
                setPageContent(rightContent, bookState.pages[s+1] || null, false);
            } else {
                const leftIdx = s * 2 - 1;
                const nextLeftIdx = (s + 1) * 2 - 1;
                const nextRightIdx = (s + 1) * 2;

                document.getElementById('flipFrontImg').src = bookState.pages[s*2] || '';
                document.getElementById('flipBackImg').src = bookState.pages[nextLeftIdx] || '';

                // Desktop Next: Halaman kanan tujuan langsung di-render di background statis bawah overlay, 
                // sedangkan halaman kiri lama tetap dipertahankan sampai lembaran menutupi sisi kiri.
                setPageContent(leftContent, leftIdx >= 0 ? bookState.pages[leftIdx] : null, true);
                setPageContent(rightContent, bookState.pages[nextRightIdx] || null, false);
            }
            
            flip.offsetHeight; // Force reflow
            flip.style.transition = 'transform 0.55s cubic-bezier(0.25, 1, 0.5, 1)';
            flip.style.transform = 'rotateY(-180deg)';

            flip.addEventListener('transitionend', () => {
                bookState.currentSpread++;
                renderSpread();
                
                flip.style.transform = '';
                flip.style.transition = '';
                flip.style.display = 'none';
                bookState.isFlipping = false;
            }, {once: true});
        }

        function bookFlipPrev() {
            if (bookState.isFlipping || bookState.currentSpread <= 0) return;
            bookState.isFlipping = true;
            updateNavButtons();

            const flip = document.getElementById('flipOverlay');
            const leftContent = document.getElementById('leftContent');
            const rightContent = document.getElementById('rightContent');
            const s = bookState.currentSpread;

            flip.style.display = 'block';
            flip.style.transition = 'none';

            if (bookState.isMobile) {
                flip.style.right = '0';
                flip.style.left = 'auto';
                flip.style.transformOrigin = 'left center';
                flip.style.transform = 'rotateY(-180deg)';

                document.getElementById('flipFrontImg').src = bookState.pages[s-1] || '';
                document.getElementById('flipBackImg').src = bookState.pages[s] || '';

                // Mobile Prev: Pertahankan halaman aktif saat ini di bawah, isi baru muncul setelah selesai animasi menutup.
                setPageContent(rightContent, bookState.pages[s] || null, false);

                flip.offsetHeight; // Force reflow
                flip.style.transition = 'transform 0.55s cubic-bezier(0.25, 1, 0.5, 1)';
                flip.style.transform = 'rotateY(0deg)';
            } else {
                // DESKTOP PREV MODE (Membuka dari kiri ke kanan)
                flip.style.left = '0';
                flip.style.right = 'auto';
                flip.style.transformOrigin = 'right center';
                flip.style.transform = 'rotateY(0deg)';

                const rightIdx = s * 2;
                const prevLeftIdx = (s - 1) * 2 - 1;
                const prevRightIdx = (s - 1) * 2;

                // Lembaran pembalik: 
                // Front (depan) memuat halaman kiri saat ini (s*2-1) yang akan diangkat ke kanan.
                // Back (belakang) memuat halaman kanan tujuan (prevRightIdx) yang otomatis akan IKUT TERBUKA seiring rotasi 3D.
                document.getElementById('flipFrontImg').src = bookState.pages[s*2-1] || '';
                document.getElementById('flipBackImg').src = bookState.pages[prevRightIdx] || '';

                // STRATEGI DESKTOP PREV: 
                // Langsung pasang halaman KIRI tujuan di background statis sebelah kiri.
                // Kunci halaman KANAN lama di background statis sebelah kanan.
                // Dengan begini, saat kertas kiri diangkat, halaman kiri tujuan langsung terlihat di bawahnya,
                // dan halaman kanan tujuan menempel di punggung kertas pembalik mengikuti rotasi animasi secara sinkron!
                setPageContent(leftContent, prevLeftIdx >= 0 ? bookState.pages[prevLeftIdx] : null, true);
                setPageContent(rightContent, bookState.pages[rightIdx] || null, false);

                flip.offsetHeight; // Force reflow
                flip.style.transition = 'transform 0.55s cubic-bezier(0.25, 1, 0.5, 1)';
                flip.style.transform = 'rotateY(180deg)';
            }

            flip.addEventListener('transitionend', () => {
                bookState.currentSpread--;
                renderSpread(); // Sinkronisasi akhir seluruh DOM statis
                
                flip.style.transform = '';
                flip.style.transition = '';
                flip.style.display = 'none';
                bookState.isFlipping = false;
            }, {once: true});
        }

        // ==================== TOUCH/SWIPE FOR BOOK ====================
        (function() {
            let startX = 0, startTime = 0;
            const bookView = document.getElementById('bookView');
            bookView.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
                startY = e.touches[0].clientY;
                startTime = Date.now();
            }, { passive: true });

            bookView.addEventListener('touchend', (e) => {
                if (bookState.isFlipping) return;
                const dx = e.changedTouches[0].clientX - startX;
                const dy = e.changedTouches[0].clientY - startY;
                const dt = Date.now() - startTime;

                if (Math.abs(dx) > 40 && Math.abs(dx) > Math.abs(dy) * 1.5 && dt < 500) {
                    if (dx < 0) bookFlipNext();
                    else bookFlipPrev();
                }
            }, { passive: true });
        })();

        // ==================== KEYBOARD FOR BOOK ====================
        document.addEventListener('keydown', (e) => {
            const container = document.getElementById('inlinePdfContainer');
            if (container.classList.contains('hidden')) return;

            if (e.key === 'ArrowRight') { e.preventDefault(); bookFlipNext(); }
            else if (e.key === 'ArrowLeft') { e.preventDefault(); bookFlipPrev(); }
        });

        // ==================== RESIZE HANDLER ====================
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                if (bookState.isLoaded && !document.getElementById('inlinePdfContainer').classList.contains('hidden')) {
                    const wasMobile = bookState.isMobile;
                    bookState.isMobile = window.innerWidth < 768;
                    
                    if (wasMobile !== bookState.isMobile) {
                        bookState.totalSpreads = bookState.isMobile ? bookState.totalPages : Math.ceil(bookState.totalPages / 2);
                        if (bookState.currentSpread >= bookState.totalSpreads) {
                            bookState.currentSpread = bookState.totalSpreads - 1;
                        }
                        updateDots();
                    }
                    sizeBookPages();
                    renderSpread();
                }
            }, 200);
        });

        // ==================== CONTACT FORM SUBMIT ====================
        function submitContactForm(e) {
            e.preventDefault();
            const form = document.getElementById('contactForm');
            const btn = document.getElementById('contactSubmitBtn');
            const success = document.getElementById('contactSuccess');
            
            btn.innerHTML = '<span>Sending...</span>';
            btn.disabled = true;
            btn.classList.add('opacity-70');
            
            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (response.ok) {
                    form.reset();
                    success.classList.remove('hidden');
                    setTimeout(() => success.classList.add('hidden'), 4000);
                } else {
                    alert('Gagal mengirim pesan. Silakan coba lagi.');
                }
            })
            .catch(() => {
                alert('Terjadi kesalahan jaringan. Silakan coba lagi.');
            })
            .finally(() => {
                btn.innerHTML = '<span>Send Message</span><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>';
                btn.disabled = false;
                btn.classList.remove('opacity-70');
            });
        }

        // ==================== ALL PROJECTS MODAL ====================
        function openAllProjectsModal() {
            const modal = document.getElementById('allProjectsModal');
            const grid = document.getElementById('allProjectsGrid');
            
            // Clone existing portfolio items into modal
            const sourceGrid = document.getElementById('portfolioGrid');
            if (sourceGrid && grid.innerHTML.trim() === '') {
                grid.innerHTML = sourceGrid.innerHTML;
            }
            
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeAllProjectsModal() {
            document.getElementById('allProjectsModal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAllProjectsModal();
                closeWhatsappModal();
                const drawer = document.getElementById('sidebarDrawer');
                if (!drawer.classList.contains('-translate-x-full')) {
                    toggleMobileSidebar();
                }
            }
        });

        // ==================== MOBILE NAVBAR SCROLL BEHAVIOR & BUBBLE PINNING ====================
        let lastScrollY = 0;
        const mobileNavbar = document.getElementById('mobileNavbar');
        
        window.addEventListener('scroll', function() {
            const currentScrollY = window.scrollY;
            
            // Mobile Navbar styling on scroll
            if (currentScrollY > 100) {
                mobileNavbar.classList.add('shadow-md');
                mobileNavbar.style.backgroundColor = 'rgba(244, 246, 250, 0.95)';
            } else {
                mobileNavbar.classList.remove('shadow-md');
                mobileNavbar.style.backgroundColor = '';
            }
            
            // Let's Talk Bubble Pinning Logic
            const bubble = document.getElementById('mobileLetsTalkBubble');
            const contactSection = document.getElementById('contact');
            if (bubble && contactSection) {
                const contactTop = contactSection.offsetTop;
                const windowHeight = window.innerHeight;
                
                // Bubble height is 56px (w-14 h-14)
                // Bottom spacing is 24px (bottom-6)
                const bubbleHeight = 56;
                const bottomSpacing = 24;
                const threshold = contactTop - bubbleHeight - bottomSpacing;
                
                if (currentScrollY + windowHeight - bottomSpacing - bubbleHeight >= contactTop) {
                    bubble.style.position = 'absolute';
                    bubble.style.top = threshold + 'px';
                    bubble.style.bottom = 'auto';
                    bubble.classList.add('hit-boundary');
                } else {
                    bubble.style.position = 'fixed';
                    bubble.style.top = 'auto';
                    bubble.style.bottom = '24px';
                    bubble.classList.remove('hit-boundary');
                }
            }
            
            lastScrollY = currentScrollY;
        }, { passive: true });

        // ==================== DOWNLOAD VCARD (SAVE CONTACT) ====================
        function downloadVCard(btn) {
            if (!btn) return;
            const name = btn.getAttribute('data-name');
            const phone = btn.getAttribute('data-phone');
            const email = btn.getAttribute('data-email');
            const title = btn.getAttribute('data-title');
            const location = btn.getAttribute('data-location');
            const url = btn.getAttribute('data-url');
            
            let vcard = [
                'BEGIN:VCARD',
                'VERSION:3.0',
                'REV:' + new Date().toISOString(),
                'FN:' + name,
                'N:' + name + ';;;;',
                'TEL;TYPE=CELL:' + phone
            ];
            if (email) vcard.push('EMAIL;TYPE=PREF,INTERNET:' + email);
            if (title) vcard.push('TITLE:' + title);
            if (location) vcard.push('ADR;TYPE=WORK:;;' + location + ';;;;');
            if (url) vcard.push('URL:' + url);
            vcard.push('END:VCARD');

            const vcardContent = vcard.join('\r\n');
            const blob = new Blob([vcardContent], { type: 'text/vcard;charset=utf-8;' });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'kontak.vcf';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        // ==================== WHATSAPP MODAL FUNCTIONS ====================
        function openWhatsappModal(url) {
            document.getElementById('waLinkUrl').value = url;
            document.getElementById('whatsappModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeWhatsappModal() {
            document.getElementById('whatsappModal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        function submitWhatsappForm(e) {
            e.preventDefault();
            const form = document.getElementById('whatsappForm');
            const btn = document.getElementById('waSubmitBtn');
            const name = document.getElementById('waSenderName').value;
            const email = document.getElementById('waSenderEmail').value;
            const company = document.getElementById('waSenderCompany').value;
            const city = document.getElementById('waSenderCity').value;
            const message = document.getElementById('waSenderMessage').value;
            const waUrl = document.getElementById('waLinkUrl').value;
            
            btn.innerHTML = '<span>Sending...</span>';
            btn.disabled = true;
            btn.classList.add('opacity-70');

            // 1. Submit to database via AJAX
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('name', name);
            formData.append('email', email);
            formData.append('company', company);
            formData.append('city', city);
            formData.append('message', message);

            fetch("{{ route('messages.public.store', $user->profile_token ?? 'default') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (response.ok) {
                    // 2. Open WhatsApp in new tab with template (without email)
                    const publicProfileName = {!! json_encode($user->name) !!};
                    const waText = `Halo ${publicProfileName}, saya ingin berdiskusi mengenai proyek yang ingin kami buat. Berikut detail singkat kami:\n\nNama: ${name}\nPerusahaan/Instansi: ${company}\nKota: ${city}\n\n${message}\n\nMohon info waktu luang Anda untuk berdiskusi lebih lanjut. Terima kasih`;
                    
                    let finalUrl = waUrl;
                    if (!finalUrl.startsWith('http://') && !finalUrl.startsWith('https://')) {
                        finalUrl = 'https://' + finalUrl;
                    }
                    try {
                        const urlObj = new URL(finalUrl);
                        urlObj.searchParams.set('text', waText);
                        finalUrl = urlObj.toString();
                    } catch (err) {
                        if (finalUrl.includes('?')) {
                            finalUrl = finalUrl + '&text=' + encodeURIComponent(waText);
                        } else {
                            finalUrl = finalUrl + '?text=' + encodeURIComponent(waText);
                        }
                    }

                    window.open(finalUrl, '_blank');
                    
                    // Reset and close
                    form.reset();
                    closeWhatsappModal();
                } else {
                    alert('Gagal mengirim pesan. Silakan coba lagi.');
                }
            })
            .catch(() => {
                alert('Terjadi kesalahan jaringan. Silakan coba lagi.');
            })
            .finally(() => {
                btn.innerHTML = '<span>Send Message & Chat WA</span>';
                btn.disabled = false;
                btn.classList.remove('opacity-70');
            });
        }
    </script>

</body>
</html>