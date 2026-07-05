{{-- Section: Layanan --}}
<div id="layanan" class="relative z-10 p-6 sm:p-8 bg-white/60 dark:bg-slate-900/50 backdrop-blur-2xl border border-white/40 dark:border-white/10 rounded-2xl shadow-xl shadow-sky-500/5 transition-colors duration-500">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <div class="w-9 h-9 rounded-xl bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20 flex items-center justify-center transition-colors duration-500">
            <svg class="w-4 h-4 text-sky-500 dark:text-sky-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 21l3.75-1.5L16.5 21l-.813-5.096A7.5 7.5 0 109.813 15.904z" />
            </svg>
        </div>
        <div>
            <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-100 transition-colors duration-500">Layanan Saya</h3>
            <p class="text-xs text-slate-400 dark:text-slate-500 transition-colors duration-500">Daftar jasa/layanan yang Anda tawarkan pada halaman publik</p>
        </div>
    </div>

    {{-- Form Tambah --}}
    <div class="p-4 bg-slate-50/50 dark:bg-white/[0.02] rounded-xl border border-slate-200/50 dark:border-white/[0.05] mb-6 transition-colors duration-500">
        <form action="{{ route('services.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wider" for="service_title">Nama Layanan</label>
                    <input
                        type="text"
                        id="service_title"
                        name="title"
                        placeholder="contoh: Web Development"
                        required
                        class="w-full py-2.5 px-3.5 text-sm text-slate-800 dark:text-slate-100 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl outline-none transition-all duration-200 focus:border-sky-500 focus:ring-[3px] focus:ring-sky-500/10 placeholder:text-slate-300 dark:placeholder:text-slate-600"
                    >
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wider" for="service_description">Deskripsi Singkat</label>
                    <input
                        type="text"
                        id="service_description"
                        name="description"
                        placeholder="contoh: Membangun website yang cepat dan responsif"
                        class="w-full py-2.5 px-3.5 text-sm text-slate-800 dark:text-slate-100 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl outline-none transition-all duration-200 focus:border-sky-500 focus:ring-[3px] focus:ring-sky-500/10 placeholder:text-slate-300 dark:placeholder:text-slate-600"
                    >
                </div>
            </div>
            <div class="flex justify-end">
                <button
                    type="submit"
                    class="px-5 py-2.5 text-sm font-semibold text-white bg-sky-500 hover:bg-sky-600 rounded-xl cursor-pointer transition-all duration-200 active:scale-[0.985] shrink-0"
                >
                    Tambah Layanan
                </button>
            </div>
        </form>
    </div>

    {{-- Daftar Layanan --}}
    @if($user->services->isEmpty())
        <div class="text-center py-10">
            <div class="w-14 h-14 rounded-2xl bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20 flex items-center justify-center mx-auto mb-3 transition-colors duration-500">
                <svg class="w-6 h-6 text-sky-300 dark:text-sky-500/60" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 21l3.75-1.5L16.5 21l-.813-5.096A7.5 7.5 0 109.813 15.904z" />
                </svg>
            </div>
            <p class="text-sm text-slate-400 dark:text-slate-500 transition-colors duration-500">Belum ada layanan ditambahkan.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($user->services as $service)
                <div
                    x-data="{ confirming: false }"
                    class="group relative p-4 bg-white/50 dark:bg-white/[0.02] rounded-xl border transition-all duration-200"
                    :class="confirming ? 'border-red-200 dark:border-red-500/20 ring-[3px] ring-red-500/10' : 'border-slate-200/50 dark:border-white/[0.05] hover:border-sky-200/60 dark:hover:border-sky-500/20'"
                >
                    <div x-show="!confirming">
                        <div class="flex items-center justify-between mb-1">
                            <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-100 transition-colors duration-200">{{ $service->title }}</h4>
                            <button
                                @click="confirming = true"
                                class="w-6 h-6 rounded-lg flex items-center justify-center text-slate-300 dark:text-slate-600 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 opacity-0 group-hover:opacity-100 transition-all duration-200 cursor-pointer"
                                title="Hapus"
                            >
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">{{ $service->description ?? '-' }}</p>
                    </div>

                    {{-- Konfirmasi Hapus --}}
                    <div
                        x-show="confirming"
                        x-transition
                        class="flex items-center justify-between gap-3 h-full"
                    >
                        <div class="flex items-center gap-2 min-w-0">
                            <div class="shrink-0 w-6 h-6 rounded-lg bg-red-50 dark:bg-red-500/10 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-red-500 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                </svg>
                            </div>
                            <p class="text-xs font-medium text-red-600 dark:text-red-400 truncate">Hapus "<span class="font-semibold">{{ $service->title }}</span>"?</p>
                        </div>
                        <div class="flex items-center gap-1.5 shrink-0">
                            <button
                                type="button"
                                @click="confirming = false"
                                class="px-3 py-1.5 text-xs font-medium text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 border border-slate-200 dark:border-white/10 rounded-lg cursor-pointer transition-colors duration-150"
                            >
                                Batal
                            </button>
                            <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="px-3 py-1.5 text-xs font-semibold text-white bg-red-500 hover:bg-red-600 rounded-lg cursor-pointer transition-colors duration-150"
                                >
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
