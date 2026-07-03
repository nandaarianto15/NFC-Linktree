{{-- Section: Proyek / Portfolio --}}
<div id="proyek" class="relative z-10 p-6 sm:p-8 bg-white/60 dark:bg-slate-900/50 backdrop-blur-2xl border border-white/40 dark:border-white/10 rounded-2xl shadow-xl shadow-sky-500/5 transition-colors duration-500">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <div class="w-9 h-9 rounded-xl bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20 flex items-center justify-center transition-colors duration-500">
            <svg class="w-4 h-4 text-sky-500 dark:text-sky-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5a2.25 2.25 0 0 0 2.25-2.25V5.25a2.25 2.25 0 0 0-2.25-2.25H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z" />
            </svg>
        </div>
        <div>
            <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-100 transition-colors duration-500">Proyek / Portfolio</h3>
            <p class="text-xs text-slate-400 dark:text-slate-500 transition-colors duration-500">Showcase karya yang pernah dikerjakan</p>
        </div>
    </div>

    {{-- Form Tambah --}}
    <div class="p-4 bg-slate-50/50 dark:bg-white/[0.02] rounded-xl border border-slate-200/50 dark:border-white/[0.05] mb-6 transition-colors duration-500">
        <form action="{{ route('portfolios.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1 uppercase tracking-wider transition-colors duration-500">Judul Proyek</label>
                <input type="text" name="title" placeholder="contoh: Website E-Commerce Toko ABC" required
                    class="w-full py-2.5 px-3.5 text-sm text-slate-800 dark:text-slate-100 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl outline-none transition-all duration-200 focus:border-sky-500 focus:ring-[3px] focus:ring-sky-500/10 placeholder:text-slate-300 dark:placeholder:text-slate-600">
                @error('title')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1 uppercase tracking-wider transition-colors duration-500">Deskripsi <span class="normal-case text-slate-300 dark:text-slate-600">(opsional)</span></label>
                <textarea name="description" rows="2" placeholder="Jelaskan singkat tentang proyek ini..."
                    class="w-full py-2.5 px-3.5 text-sm text-slate-800 dark:text-slate-100 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl outline-none transition-all duration-200 focus:border-sky-500 focus:ring-[3px] focus:ring-sky-500/10 placeholder:text-slate-300 dark:placeholder:text-slate-600 resize-none leading-relaxed"></textarea>
                @error('description')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1 uppercase tracking-wider transition-colors duration-500">Gambar <span class="normal-case text-slate-300 dark:text-slate-600">(opsional)</span></label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full text-sm text-slate-500 dark:text-slate-400 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-sky-50 dark:file:bg-sky-500/10 file:text-sky-600 dark:file:text-sky-400 file:cursor-pointer file:transition-colors file:duration-200 hover:file:bg-sky-100 dark:hover:file:bg-sky-500/20 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl cursor-pointer transition-colors duration-200">
                    <p class="text-xs text-slate-400 dark:text-slate-500 mt-1 transition-colors duration-500">JPG, PNG, maks. 2MB</p>
                    @error('image')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1 uppercase tracking-wider transition-colors duration-500">Link Proyek <span class="normal-case text-slate-300 dark:text-slate-600">(opsional)</span></label>
                    <input type="url" name="url" placeholder="https://..."
                        class="w-full py-2.5 px-3.5 text-sm text-slate-800 dark:text-slate-100 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl outline-none transition-all duration-200 focus:border-sky-500 focus:ring-[3px] focus:ring-sky-500/10 placeholder:text-slate-300 dark:placeholder:text-slate-600">
                    @error('url')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
            <button type="submit"
                class="px-5 py-2.5 text-sm font-semibold text-white bg-sky-500 hover:bg-sky-600 rounded-xl cursor-pointer transition-all duration-200 active:scale-[0.985]">
                Tambah Proyek
            </button>
        </form>
    </div>

    {{-- Daftar Portfolio --}}
    @if($user->portfolios->isEmpty())
        <div class="text-center py-10">
            <div class="w-14 h-14 rounded-2xl bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20 flex items-center justify-center mx-auto mb-3 transition-colors duration-500">
                <svg class="w-6 h-6 text-sky-300 dark:text-sky-500/60" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z" />
                </svg>
            </div>
            <p class="text-sm text-slate-400 dark:text-slate-500 transition-colors duration-500">Belum ada proyek ditambahkan.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            @foreach($user->portfolios as $portfolio)
                <div
                    x-data="{ confirming: false }"
                    class="group relative bg-white/50 dark:bg-white/[0.02] rounded-xl border overflow-hidden transition-all duration-200"
                    :class="confirming ? 'border-red-200 dark:border-red-500/20 ring-[3px] ring-red-500/10' : 'border-slate-200/50 dark:border-white/[0.05] hover:border-sky-200/60 dark:hover:border-sky-500/20'"
                >
                    {{-- Image --}}
                    <div class="relative aspect-video bg-slate-100 dark:bg-slate-800/50 overflow-hidden">
                        @if($portfolio->image_path)
                            <img src="{{ asset('storage/' . $portfolio->image_path) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-sky-100 to-sky-200 dark:from-sky-500/10 dark:to-sky-600/10 flex items-center justify-center transition-colors duration-500">
                                <svg class="w-8 h-8 text-sky-300 dark:text-sky-500/40" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z" />
                                </svg>
                            </div>
                        @endif
                        {{-- Red overlay saat konfirmasi --}}
                        <div
                            x-show="confirming"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="absolute inset-0 bg-red-500/10 dark:bg-red-500/20 backdrop-blur-[2px]"
                        ></div>
                        {{-- Delete --}}
                        <button
                            x-show="!confirming"
                            @click="confirming = true"
                            class="absolute top-2 right-2 w-7 h-7 rounded-lg bg-white/90 dark:bg-slate-900/90 backdrop-blur-sm flex items-center justify-center text-slate-400 hover:text-red-500 opacity-0 group-hover:opacity-100 transition-all duration-200 cursor-pointer shadow-sm"
                            title="Hapus"
                        >
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    {{-- Info --}}
                    <div
                        x-show="!confirming"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-1"
                        class="p-3"
                    >
                        <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-100 transition-colors duration-200 truncate">{{ $portfolio->title }}</h4>
                        @if($portfolio->description)
                            <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5 line-clamp-2 transition-colors duration-200">{{ $portfolio->description }}</p>
                        @endif
                    </div>
                    {{-- Konfirmasi Hapus (menggantikan confirm()) --}}
                    <div
                        x-show="confirming"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="p-3"
                    >
                        <div class="flex items-center gap-2 mb-2.5">
                            <div class="shrink-0 w-6 h-6 rounded-lg bg-red-50 dark:bg-red-500/10 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-red-500 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                </svg>
                            </div>
                            <p class="text-xs font-medium text-red-600 dark:text-red-400 truncate">Hapus "<span class="font-semibold">{{ $portfolio->title }}</span>"?</p>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <button
                                type="button"
                                @click="confirming = false"
                                class="flex-1 px-3 py-1.5 text-xs font-medium text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 border border-slate-200 dark:border-white/10 rounded-lg cursor-pointer transition-colors duration-150 text-center"
                            >
                                Batal
                            </button>
                            <form action="{{ route('portfolios.destroy', $portfolio->id) }}" method="POST" class="flex-1 inline">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="w-full px-3 py-1.5 text-xs font-semibold text-white bg-red-500 hover:bg-red-600 rounded-lg cursor-pointer transition-colors duration-150 active:scale-[0.97]"
                                >
                                    Ya, Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>