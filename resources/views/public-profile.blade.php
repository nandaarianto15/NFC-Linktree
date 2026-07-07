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
                            50: '#fcfdfe',    // Warm Pristine White
                            100: '#f4f6fa',   // Mist Alabaster Main Background
                            200: '#eaedf4',   // Sidebar Background
                            300: '#d5dae6',   // Border lines
                            400: '#a3b0cc',
                        },
                        ink: {
                            900: '#0f172a',   // Deep Slate/Navy Black for text
                            800: '#1e293b',   // Subtitle text
                            700: '#475569',   // Body text
                            500: '#64748b',   // Muted text
                        },
                        cobalt: {
                            DEFAULT: '#1d4ed8', // Darker Cobalt Blue
                            dark: '#1e3a8a',
                            light: '#eff6ff',
                        },
                        futura: {
                            DEFAULT: '#0284c7', // Sky Blue/Cyan Blue (Replacing the former emerald teal)
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
    </style>
</head>
<body class="min-h-screen bg-mist-100 font-sans antialiased text-ink-800 selection:bg-cobalt selection:text-white analytic-grid">

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
    <a href="#contact" class="lg:hidden fixed bottom-6 right-6 z-50 flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-tr from-cobalt to-futura text-mist-50 shadow-2xl hover:scale-110 active:scale-95 transition-all">
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

            <!-- HERO SECTION -->
            <section id="hero" class="max-w-7xl mx-auto px-6 md:px-12 pt-6 pb-12 md:pt-20 md:pb-20 w-full">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    
                    <!-- Hero Texts (Left Side) -->
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

                        <!-- Action Buttons and PDF Dynamic Inline Preview -->
                        <div class="flex flex-col gap-4 pt-4">
                            <div class="flex flex-wrap gap-4">
                                <a href="#portfolio" class="inline-flex items-center gap-2.5 px-6 py-3.5 bg-ink-900 hover:bg-cobalt text-mist-100 font-extrabold text-[10px] uppercase tracking-widest rounded-xl transition-all shadow-lg">
                                    <span>View My Work</span>
                                    <svg class="w-4 h-4 text-cobalt" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>

                                <!-- CV Download & Preview toggle button -->
                                <div class="flex gap-2">
                                    @if(isset($user->resume_path) && $user->resume_path)
                                        <a href="{{ asset('storage/' . $user->resume_path) }}" download class="inline-flex items-center gap-2 px-4 py-3.5 border border-mist-400 hover:border-cobalt text-ink-800 font-extrabold text-[10px] uppercase tracking-widest rounded-xl transition-all bg-mist-50">
                                            <svg class="w-4 h-4 text-cobalt" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                            <span>Download CV</span>
                                        </a>
                                        <button onclick="toggleInlinePdfPreview('{{ asset('storage/' . $user->resume_path) }}')" class="inline-flex items-center gap-2 px-4 py-3.5 border border-mist-400 hover:border-futura text-ink-800 font-extrabold text-[10px] uppercase tracking-widest rounded-xl transition-all bg-mist-50">
                                            <svg class="w-4 h-4 text-futura" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            <span id="pdfPreviewBtnText">Preview CV</span>
                                        </button>
                                    @else
                                        <div class="inline-flex items-center gap-2 px-4 py-3.5 border border-mist-300 text-ink-500 font-bold text-[10px] uppercase tracking-widest rounded-xl bg-mist-200 italic cursor-not-allowed">
                                            File CV Belum Tersedia
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- PDF Inline Expandable Preview Frame (Hidden by Default) -->
                            <div id="inlinePdfContainer" class="hidden w-full mt-4 bg-white border border-mist-300 rounded-2xl overflow-hidden premium-shadow transition-all duration-500">
                                <div class="bg-mist-200 px-4 py-3 flex justify-between items-center border-b border-mist-300">
                                    <span class="text-[10px] font-extrabold tracking-widest text-ink-500 uppercase">CV Document Preview</span>
                                    <button onclick="closeInlinePdfPreview()" class="text-xs text-ink-500 hover:text-ink-900 font-bold">✕ Close</button>
                                </div>
                                <div class="w-full aspect-[4/5] sm:h-[600px] bg-slate-100">
                                    <iframe id="pdfFrame" class="w-full h-full border-0" src=""></iframe>
                                </div>
                            </div>
                        </div>

                        <!-- Linktree Row -->
                        <div class="pt-10 border-t border-mist-300 space-y-4">
                            <span class="text-[9px] font-extrabold tracking-[0.25em] text-ink-500 uppercase block">My Linktree / Network</span>
                            <div class="flex flex-wrap items-center gap-6 md:gap-10">
                                @if(isset($links) && $links->isNotEmpty())
                                    @foreach($links as $link)
                                        <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" class="font-bebas text-lg md:text-xl text-ink-800 hover:text-cobalt tracking-wider uppercase transition-colors duration-300">
                                            {{ $link->title }}
                                        </a>
                                    @endforeach
                                @else
                                    <span class="text-sm text-ink-500 italic">Tautan belum tersedia saat ini.</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Profile Banner & Floating Stats (Right Side) -->
                    <div class="lg:col-span-5 flex justify-center relative">
                        <!-- Graphic Halo Background Ring in Blue representing orbit/forecasting -->
                        <div class="absolute inset-0 bg-gradient-to-tr from-cobalt/10 to-futura/5 rounded-full filter blur-3xl scale-90 -z-10"></div>
                        <div class="absolute w-[320px] h-[320px] rounded-full border-2 border-dashed border-cobalt/20 animate-[spin_40s_linear_infinite] top-[10%]"></div>
                        
                        <!-- Main Cinematic Wide Portrait -->
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

                        <!-- Floating Stat Badge -->
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

            <!-- CLIENTS LOGO SECTION (Menggantikan Testimonials) -->
            <section id="testimonials" class="border-t border-mist-300 max-w-7xl mx-auto px-6 md:px-12 py-16 w-full">
                <div class="flex items-center justify-between mb-10">
                    <div class="space-y-3">
                        <span class="text-xs font-extrabold tracking-[0.3em] text-futura uppercase block">CLIENTS</span>
                        <h3 class="font-bebas text-5xl font-black text-ink-900 tracking-wider">Trusted By</h3>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 items-center">
                    @if(isset($clients) && $clients->isNotEmpty())
                        @foreach($clients as $client)
                            <div class="flex items-center justify-center p-4 transition-all duration-300 hover:scale-105">
                                @if(isset($client->logo_path) && $client->logo_path)
                                    <img src="{{ asset('storage/' . $client->logo_path) }}" class="max-h-16 w-auto object-contain" alt="{{ $client->name ?? 'Client Logo' }}">
                                @elseif(isset($client->name))
                                    <span class="font-bebas text-2xl text-ink-700 tracking-wider">{{ $client->name }}</span>
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
                    <div class="lg:col-span-4 bg-gradient-to-tr from-cobalt to-futura text-mist-50 p-8 rounded-3xl flex flex-col justify-between premium-shadow relative overflow-hidden">
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

                    <!-- Middle Grid Interactive Mail Form -->
                    <div class="lg:col-span-5 bg-mist-50 border border-mist-300 p-8 rounded-3xl premium-shadow">
                        <form id="contactForm" method="POST" action="{{ route('messages.public.store', $user->profile_token ?? 'default') }}" onsubmit="submitContactForm(event)" class="space-y-5 text-xs font-bold uppercase tracking-wider text-ink-700">
                            @csrf
                            <div class="space-y-1.5">
                                <label class="text-ink-500 text-[10px]">Your Name</label>
                                <input type="text" name="name" required placeholder="John Doe" class="w-full px-4 py-3 border border-mist-300 bg-mist-100 rounded-xl focus:border-cobalt focus:outline-none transition-colors font-medium normal-case text-ink-900">
                            </div>
                            <div class="space-y-1.5">
                                <label class="text-ink-500 text-[10px]">Your Email</label>
                                <input type="email" name="email" required placeholder="john@example.com" class="w-full px-4 py-3 border border-mist-300 bg-mist-100 rounded-xl focus:border-cobalt focus:outline-none transition-colors font-medium normal-case text-ink-900">
                            </div>
                            <div class="space-y-1.5">
                                <label class="text-ink-500 text-[10px]">Your Message</label>
                                <textarea name="message" required rows="4" placeholder="Detail singkat mengenai kerja sama yang ingin Anda capai..." class="w-full px-4 py-3 border border-mist-300 bg-mist-100 rounded-xl focus:border-cobalt focus:outline-none transition-colors font-medium normal-case resize-none text-ink-900"></textarea>
                            </div>
                            <button type="submit" id="submitBtn" class="w-full py-4 bg-ink-900 hover:bg-cobalt text-mist-100 rounded-xl font-extrabold text-[10px] uppercase tracking-widest transition-colors shadow-lg">
                                Send Message
                            </button>
                        </form>
                    </div>

                    <!-- Right Grid Contact Details info -->
                    <div class="lg:col-span-3 flex flex-col justify-center space-y-6 pl-0 lg:pl-6">
                        <!-- Detail 1 (Email) -->
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-mist-200 border border-mist-300 flex items-center justify-center text-futura shrink-0">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="text-[9px] font-extrabold text-ink-500 uppercase tracking-widest">Email</span>
                                <a href="mailto:{{ $user->email ?? '#' }}" class="text-xs font-bold text-ink-900 break-all hover:text-cobalt transition-colors">{{ $user->email ?? 'Konten belum tersedia' }}</a>
                            </div>
                        </div>

                        <!-- Detail 2 (Phone) -->
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-mist-200 border border-mist-300 flex items-center justify-center text-futura shrink-0">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="text-[9px] font-extrabold text-ink-500 uppercase tracking-widest">Phone</span>
                                <a href="tel:{{ $user->phone ?? '#' }}" class="text-xs font-bold text-ink-900 break-all hover:text-cobalt transition-colors">{{ $user->phone ?? 'Konten belum tersedia' }}</a>
                            </div>
                        </div>

                        <!-- Detail 3 (Location) -->
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-mist-200 border border-mist-300 flex items-center justify-center text-futura shrink-0">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="text-[9px] font-extrabold text-ink-500 uppercase tracking-widest">Location</span>
                                <span class="text-xs font-bold text-ink-900">{{ $user->location ?? 'Konten belum tersedia' }}</span>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

            <!-- FLOATING FOOTER -->
            <footer class="relative z-10 w-full text-center pb-12 pt-6 border-t border-mist-300">
                <div class="inline-flex flex-col items-center gap-1.5">
                    <span class="text-[9px] font-extrabold text-ink-500 uppercase tracking-[0.25em]">SAKA | ALENKOSA. ALL RIGHTS RESERVED &copy; 2026.</span>
                </div>
            </footer>

        </main>
    </div>

    <!-- VIEW ALL PROJECTS POP-UP MODAL CONTAINER -->
    <div id="allProjectsModal" class="fixed inset-0 z-[110] hidden items-center justify-center p-4 bg-ink-900/60 backdrop-blur-md opacity-0 smooth-transition">
        <div class="bg-mist-100 w-full max-w-4xl max-h-[85vh] rounded-[32px] border border-mist-300 premium-shadow flex flex-col overflow-hidden transform scale-95 smooth-transition">
            <!-- Modal Header -->
            <div class="px-8 py-5 border-b border-mist-300 bg-mist-50 flex items-center justify-between shrink-0">
                <div class="space-y-1">
                    <span class="text-[10px] font-extrabold tracking-widest text-futura uppercase">Full Portfolio</span>
                    <h3 class="font-bebas text-3xl text-ink-900 tracking-wider">All Archetype Projects</h3>
                </div>
                <button onclick="closeAllProjectsModal()" class="w-10 h-10 rounded-full border border-mist-300 bg-mist-50 flex items-center justify-center text-ink-700 hover:text-ink-900 hover:border-cobalt transition-colors font-bold text-sm">✕</button>
            </div>
            
            <!-- Modal Content (Scrollable Grid) -->
            <div class="p-8 overflow-y-auto grid grid-cols-1 md:grid-cols-2 gap-6 analytic-grid">
                @if($hasPortfolios)
                    @foreach($portfolios as $portfolio)
                        <!-- Kartu dibuat clickable dengan pembungkus <a> -->
                        <a href="{{ $portfolio->url ?? '#' }}" target="_blank" rel="noopener noreferrer" class="group flex flex-col space-y-4 bg-mist-50 border border-mist-300 p-4 rounded-2xl premium-shadow hover:-translate-y-1 smooth-transition">
                            <div class="relative aspect-[16/10] bg-mist-200 rounded-xl overflow-hidden premium-shadow">
                                @if($portfolio->image_path)
                                    <img src="{{ asset('storage/' . $portfolio->image_path) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="{{ $portfolio->title }}">
                                @else
                                    <div class="w-full h-full bg-gradient-to-tr from-mist-200 to-mist-300 flex items-center justify-center">
                                        <svg class="w-10 h-10 text-mist-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                    </div>
                                @endif
                                <!-- Indikator klik -->
                                <div class="absolute inset-0 bg-ink-900/10 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <div class="w-10 h-10 rounded-full bg-mist-50 flex items-center justify-center premium-shadow transform scale-75 group-hover:scale-100 transition-transform">
                                        <svg class="w-4 h-4 text-cobalt" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-1.5 px-2">
                                <h4 class="text-base font-extrabold text-ink-900 group-hover:text-cobalt transition-colors">{{ $portfolio->title }}</h4>
                                @if($portfolio->description)
                                    <p class="text-xs text-ink-700 leading-relaxed">{{ $portfolio->description }}</p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                @else
                    <!-- Fallback Empty State yang konsisten -->
                    <div class="bg-mist-50 border border-mist-300 p-6 rounded-2xl text-center col-span-full">
                        <p class="text-sm text-ink-500 italic">Konten pada bagian ini belum tersedia.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Alert / Toast Popup notification with Blue Gradient design -->
    <div id="toastAlert" class="fixed bottom-6 right-6 z-[100] px-6 py-4 rounded-2xl bg-gradient-to-r from-cobalt to-futura text-mist-50 font-extrabold text-[10px] uppercase tracking-widest shadow-2xl translate-y-28 opacity-0 transition-all duration-500">
        Pesan Berhasil Terkirim!
    </div>

    <!-- CLIENT SIDE PREVIEW MOCK INJECTOR & DYNAMIC NAVIGATION SCROLL SCRIPT -->
    <script>
        // Check if the page is loaded statically in browser preview or Laravel backend
        window.addEventListener('DOMContentLoaded', () => {
            const isStatic = window.location.href.startsWith('file://') || window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1';
            
            if (isStatic) {
                // If loaded in a dev browser preview environment, inject realistic mock values
                const elementsToInject = {
                    'sideName': 'Belum ada nama',
                    'sideTitle': 'Belum ada jabatan',
                    'heroName': 'Belum ada nama'
                };

                for (const [id, value] of Object.entries(elementsToInject)) {
                    const el = document.getElementById(id);
                    if (el && el.innerText.includes('{{')) {
                        el.innerText = value;
                    }
                }
            }
        });

        // Open All Projects Pop-up Modal Function
        function openAllProjectsModal() {
            const modal = document.getElementById('allProjectsModal');
            const inner = modal.querySelector('div');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                inner.classList.remove('scale-95');
                inner.classList.add('scale-100');
            }, 10);
            document.body.classList.add('overflow-hidden');
        }

        // Close All Projects Pop-up Modal Function
        function closeAllProjectsModal() {
            const modal = document.getElementById('allProjectsModal');
            const inner = modal.querySelector('div');
            modal.classList.add('opacity-0');
            inner.classList.remove('scale-100');
            inner.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }, 400);
            document.body.classList.remove('overflow-hidden');
        }

        // Toggle Drawer Sidebar menu on mobile screen dimensions
        function toggleMobileSidebar() {
            const drawer = document.getElementById('sidebarDrawer');
            drawer.classList.toggle('-translate-x-full');
        }

        // Toggle Expandable Inline PDF Preview (without popup/modal)
        function toggleInlinePdfPreview(pdfUrl) {
            const container = document.getElementById('inlinePdfContainer');
            const frame = document.getElementById('pdfFrame');
            const previewBtnText = document.getElementById('pdfPreviewBtnText');

            if (container.classList.contains('hidden')) {
                frame.src = pdfUrl;
                container.classList.remove('hidden');
                previewBtnText.innerText = 'Hide Preview';
                
                // Smooth scroll to container view
                setTimeout(() => {
                    container.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 100);
            } else {
                closeInlinePdfPreview();
            }
        }

        // Close inline PDF frame helper
        function closeInlinePdfPreview() {
            const container = document.getElementById('inlinePdfContainer');
            const frame = document.getElementById('pdfFrame');
            const previewBtnText = document.getElementById('pdfPreviewBtnText');

            container.classList.add('hidden');
            frame.src = '';
            previewBtnText.innerText = 'Preview CV';
        }

        // Display Custom Elegant Toast Alert Message box
        function showContactNotification() {
            const toast = document.getElementById('toastAlert');
            toast.classList.remove('translate-y-28', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');

            setTimeout(() => {
                toast.classList.add('translate-y-28', 'opacity-0');
                toast.classList.remove('translate-y-0', 'opacity-100');
            }, 3000);
        }

        // Handle CTA form submit via AJAX
        async function submitContactForm(event) {
            event.preventDefault();
            const form = event.target;
            const submitBtn = document.getElementById('submitBtn');
            const originalBtnText = submitBtn.innerText;
            
            // Set loading state
            submitBtn.disabled = true;
            submitBtn.innerText = 'SENDING...';

            const formData = new FormData(form);

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    showContactNotification();
                    form.reset();
                } else {
                    alert(data.message || 'Terjadi kesalahan, silakan coba lagi.');
                }
            } catch (error) {
                console.error(error);
                alert('Gagal mengirim pesan. Silakan periksa koneksi Anda.');
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerText = originalBtnText;
            }
        }

        // Dynamic Shrinking *width* on Scroll for Mobile Top Bar Navbar only.
        window.addEventListener('scroll', () => {
            const mobileNavbar = document.getElementById('mobileNavbar');
            if (!mobileNavbar) return;

            if (window.scrollY > 40) {
                // Shrink width: Transform from full-width to floating inset card
                mobileNavbar.classList.remove('top-0', 'left-0', 'right-0', 'w-full', 'rounded-none', 'border-b', 'px-6', 'py-4');
                mobileNavbar.classList.add('top-4', 'left-4', 'right-4', 'w-[calc(100%-2rem)]', 'rounded-2xl', 'border', 'px-4', 'py-3', 'shadow-xl', 'bg-mist-50/90', 'border-cobalt/20');
            } else {
                // Return to flat full-width top bar
                mobileNavbar.classList.add('top-0', 'left-0', 'right-0', 'w-full', 'rounded-none', 'border-b', 'px-6', 'py-4');
                mobileNavbar.classList.remove('top-4', 'left-4', 'right-4', 'w-[calc(100%-2rem)]', 'rounded-2xl', 'border', 'px-4', 'py-3', 'shadow-xl', 'bg-mist-50/90', 'border-cobalt/20');
            }
        });
    </script>
</body>
</html>