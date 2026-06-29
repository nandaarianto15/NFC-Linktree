<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-slate-800 dark:text-slate-100 tracking-tight">
            Dashboard Linktree NFC
        </h2>
    </x-slot>

    <div class="py-6 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Success Alert --}}
            @if(session('success'))
                <div class="flex items-center gap-3 p-4 bg-emerald-50/80 dark:bg-emerald-500/10 backdrop-blur-xl border border-emerald-200/60 dark:border-emerald-500/20 rounded-2xl text-emerald-700 dark:text-emerald-300 text-sm transition-colors duration-500">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- QR Code Section --}}
            <div class="relative z-10 p-6 sm:p-8 bg-white/60 dark:bg-slate-900/50 backdrop-blur-2xl border border-white/40 dark:border-white/10 rounded-2xl shadow-xl shadow-sky-500/5 transition-colors duration-500">
                <div class="flex flex-col sm:flex-row items-center gap-6">
                    <div class="shrink-0 p-4 bg-white dark:bg-slate-800/80 rounded-2xl shadow-lg border border-slate-100 dark:border-white/10 transition-colors duration-500">
                        {!! QrCode::size(160)->generate(route('public.profile', auth()->user()->profile_token)) !!}
                    </div>
                    <div class="flex-1 text-center sm:text-left min-w-0">
                        <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100 mb-1.5 tracking-tight transition-colors duration-500">QR Code Profil Anda</h3>
                        <p class="text-sm text-slate-400 dark:text-slate-500 mb-4 transition-colors duration-500">
                            Scan QR code atau tanam link berikut ke dalam kartu NFC Anda.
                        </p>
                        <div class="flex items-center gap-2 p-3 bg-slate-50/80 dark:bg-white/5 rounded-xl border border-slate-200/50 dark:border-white/10 transition-colors duration-500">
                            <p class="flex-1 text-xs font-mono text-sky-600 dark:text-sky-400 truncate select-all transition-colors duration-500" id="profile-link">
                                {{ route('public.profile', auth()->user()->profile_token) }}
                            </p>
                            <button
                                onclick="navigator.clipboard.writeText(document.getElementById('profile-link').textContent); this.innerHTML='<span class=\'text-emerald-500\'>Tersalin!</span>'; setTimeout(()=>this.innerHTML='Salin', 1500)"
                                class="shrink-0 px-3 py-1.5 text-xs font-medium text-sky-600 dark:text-sky-400 hover:bg-sky-50 dark:hover:bg-sky-500/10 rounded-lg transition-colors duration-200 cursor-pointer"
                            >
                                Salin
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Form + List Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Add Link Form --}}
                <div class="relative z-10 p-6 sm:p-8 bg-white/60 dark:bg-slate-900/50 backdrop-blur-2xl border border-white/40 dark:border-white/10 rounded-2xl shadow-xl shadow-sky-500/5 transition-colors duration-500">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-9 h-9 rounded-xl bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20 flex items-center justify-center transition-colors duration-500">
                            <svg class="w-4 h-4 text-sky-500 dark:text-sky-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-slate-800 dark:text-slate-100 tracking-tight transition-colors duration-500">Tambah Link</h3>
                    </div>

                    <form action="{{ route('links.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wider transition-colors duration-500" for="title">Nama Judul</label>
                            <input
                                id="title"
                                name="title"
                                type="text"
                                class="w-full py-2.5 px-3.5 text-sm text-slate-800 dark:text-slate-100 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl outline-none transition-all duration-200 focus:border-sky-500 focus:ring-[3px] focus:ring-sky-500/10 placeholder:text-slate-300 dark:placeholder:text-slate-600"
                                placeholder="Instagram"
                                required
                            >
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wider transition-colors duration-500" for="url">URL / Nomor WA</label>
                            <input
                                id="url"
                                name="url"
                                type="text"
                                class="w-full py-2.5 px-3.5 text-sm text-slate-800 dark:text-slate-100 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl outline-none transition-all duration-200 focus:border-sky-500 focus:ring-[3px] focus:ring-sky-500/10 placeholder:text-slate-300 dark:placeholder:text-slate-600"
                                placeholder="no HP atau link"
                                required
                            >
                            <p class="mt-1.5 text-xs text-slate-400 dark:text-slate-500 transition-colors duration-500">
                                Otomatis jadi link WhatsApp jika memasukkan nomor HP.
                            </p>
                        </div>
                        <button
                            type="submit"
                            class="w-full py-2.5 text-sm font-semibold text-white bg-sky-500 hover:bg-sky-600 rounded-xl cursor-pointer transition-all duration-200 active:scale-[0.985]"
                        >
                            Simpan Link
                        </button>
                    </form>
                </div>

                {{-- Link List --}}
                <div class="relative z-10 p-6 sm:p-8 bg-white/60 dark:bg-slate-900/50 backdrop-blur-2xl border border-white/40 dark:border-white/10 rounded-2xl shadow-xl shadow-sky-500/5 lg:col-span-2 transition-colors duration-500">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-9 h-9 rounded-xl bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20 flex items-center justify-center transition-colors duration-500">
                            <svg class="w-[18px] h-[18px] text-sky-500 dark:text-sky-400/80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                                <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-slate-800 dark:text-slate-100 tracking-tight transition-colors duration-500">Daftar Link</h3>
                        @if($links->isNotEmpty())
                            <span class="ml-auto text-xs font-medium text-slate-400 dark:text-slate-500 bg-slate-100/80 dark:bg-white/5 px-2.5 py-1 rounded-full transition-colors duration-500">
                                {{ $links->count() }}
                            </span>
                        @endif
                    </div>

                    @if($links->isEmpty())
                        <div class="flex flex-col items-center justify-center py-16 text-center">
                            <div class="w-16 h-16 rounded-2xl bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20 flex items-center justify-center mb-4 transition-colors duration-500">
                                <svg class="w-[18px] h-[18px] text-sky-500 dark:text-sky-400/80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
                                    </svg>
                            </div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400 transition-colors duration-500">Belum ada link</p>
                            <p class="text-xs text-slate-300 dark:text-slate-600 mt-1 transition-colors duration-500">Gunakan form di sebelah kiri untuk menambah link pertama Anda.</p>
                        </div>
                    @else
                        <div class="space-y-2.5">
                            @foreach($links as $link)
                                <div class="group flex items-center gap-3.5 p-3.5 bg-white/50 dark:bg-white/[0.03] rounded-xl border border-slate-200/50 dark:border-white/[0.06] hover:bg-white/70 dark:hover:bg-white/[0.06] hover:border-sky-200/60 dark:hover:border-sky-500/20 transition-all duration-200">
                                    <div class="w-9 h-9 rounded-lg bg-sky-50 dark:bg-sky-500/10 flex items-center justify-center shrink-0 transition-colors duration-200">
                                        <svg class="w-[18px] h-[18px] text-sky-500 dark:text-sky-400/80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                                            <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-medium text-slate-800 dark:text-slate-100 transition-colors duration-200">{{ $link->title }}</h4>
                                        <p class="text-xs text-slate-400 dark:text-slate-500 truncate font-mono mt-0.5 transition-colors duration-200">{{ $link->url }}</p>
                                    </div>
                                    <form action="{{ route('links.destroy', $link->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus link ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="opacity-0 group-hover:opacity-100 p-2 text-slate-300 dark:text-slate-600 hover:text-red-500 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-lg transition-all duration-200 cursor-pointer" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>