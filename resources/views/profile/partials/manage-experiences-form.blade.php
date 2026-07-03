{{-- Section: Pengalaman --}}
<div id="pengalaman" class="relative z-10 p-6 sm:p-8 bg-white/60 dark:bg-slate-900/50 backdrop-blur-2xl border border-white/40 dark:border-white/10 rounded-2xl shadow-xl shadow-sky-500/5 transition-colors duration-500">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <div class="w-9 h-9 rounded-xl bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20 flex items-center justify-center transition-colors duration-500">
            <svg class="w-4 h-4 text-sky-500 dark:text-sky-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0" />
            </svg>
        </div>
        <div>
            <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-100 transition-colors duration-500">Pengalaman</h3>
            <p class="text-xs text-slate-400 dark:text-slate-500 transition-colors duration-500">Riwayat pekerjaan atau posisi yang pernah diemban</p>
        </div>
    </div>

    {{-- Form Tambah --}}
    <div class="p-4 bg-slate-50/50 dark:bg-white/[0.02] rounded-xl border border-slate-200/50 dark:border-white/[0.05] mb-6 transition-colors duration-500">
        <form action="{{ route('experiences.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1 uppercase tracking-wider transition-colors duration-500">Jabatan</label>
                    <input type="text" name="role" placeholder="contoh: Frontend Developer" required
                        class="w-full py-2.5 px-3.5 text-sm text-slate-800 dark:text-slate-100 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl outline-none transition-all duration-200 focus:border-sky-500 focus:ring-[3px] focus:ring-sky-500/10 placeholder:text-slate-300 dark:placeholder:text-slate-600">
                    @error('role')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1 uppercase tracking-wider transition-colors duration-500">Perusahaan</label>
                    <input type="text" name="company" placeholder="contoh: PT Toko Digital" required
                        class="w-full py-2.5 px-3.5 text-sm text-slate-800 dark:text-slate-100 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl outline-none transition-all duration-200 focus:border-sky-500 focus:ring-[3px] focus:ring-sky-500/10 placeholder:text-slate-300 dark:placeholder:text-slate-600">
                    @error('company')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1 uppercase tracking-wider transition-colors duration-500">Periode</label>
                <input type="text" name="period" placeholder="contoh: Jan 2022 - Sekarang" required
                    class="w-full sm:w-64 py-2.5 px-3.5 text-sm text-slate-800 dark:text-slate-100 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl outline-none transition-all duration-200 focus:border-sky-500 focus:ring-[3px] focus:ring-sky-500/10 placeholder:text-slate-300 dark:placeholder:text-slate-600">
                @error('period')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1 uppercase tracking-wider transition-colors duration-500">Deskripsi <span class="normal-case text-slate-300 dark:text-slate-600">(opsional)</span></label>
                <textarea name="description" rows="2" placeholder="Ceritakan singkat tanggung jawab atau pencapaian kamu..."
                    class="w-full py-2.5 px-3.5 text-sm text-slate-800 dark:text-slate-100 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl outline-none transition-all duration-200 focus:border-sky-500 focus:ring-[3px] focus:ring-sky-500/10 placeholder:text-slate-300 dark:placeholder:text-slate-600 resize-none leading-relaxed"></textarea>
                @error('description')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>
            <button type="submit"
                class="px-5 py-2.5 text-sm font-semibold text-white bg-sky-500 hover:bg-sky-600 rounded-xl cursor-pointer transition-all duration-200 active:scale-[0.985]">
                Tambah Pengalaman
            </button>
        </form>
    </div>

    {{-- Daftar Experience --}}
    @if($user->experiences->isEmpty())
        <div class="text-center py-10">
            <div class="w-14 h-14 rounded-2xl bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20 flex items-center justify-center mx-auto mb-3 transition-colors duration-500">
                <svg class="w-6 h-6 text-sky-300 dark:text-sky-500/60" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
            </div>
            <p class="text-sm text-slate-400 dark:text-slate-500 transition-colors duration-500">Belum ada pengalaman ditambahkan.</p>
        </div>
    @else
        <div class="space-y-3">
            @foreach($user->experiences as $exp)
                <div
                    x-data="{ confirming: false }"
                    class="group relative flex items-start gap-4 p-4 bg-white/50 dark:bg-white/[0.02] rounded-xl border transition-all duration-200"
                    :class="confirming ? 'border-red-200 dark:border-red-500/20 ring-[3px] ring-red-500/10' : 'border-slate-200/50 dark:border-white/[0.05] hover:border-sky-200/60 dark:hover:border-sky-500/20'"
                >
                    {{-- Timeline dot --}}
                    <div class="w-8 h-8 rounded-full bg-sky-50 dark:bg-sky-500/10 border-2 border-sky-500/30 dark:border-sky-500/20 flex items-center justify-center shrink-0 mt-0.5 transition-colors duration-200">
                        <div class="w-2 h-2 rounded-full bg-sky-500"></div>
                    </div>
                    {{-- Content --}}
                    <div class="flex-1 min-w-0">
                        <div
                            x-show="!confirming"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-1"
                        >
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1 mb-1">
                                <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-100 transition-colors duration-200">{{ $exp->role }}</h4>
                                <span class="text-xs font-medium text-sky-500 dark:text-sky-400 whitespace-nowrap transition-colors duration-200">{{ $exp->period }}</span>
                            </div>
                            <p class="text-xs font-medium text-slate-400 dark:text-slate-500 mb-1 transition-colors duration-200">{{ $exp->company }}</p>
                            @if($exp->description)
                                <p class="text-xs text-slate-400 dark:text-slate-500 leading-relaxed transition-colors duration-200">{{ $exp->description }}</p>
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
                            class="flex items-center justify-between gap-3"
                        >
                            <div class="flex items-center gap-2 min-w-0">
                                <div class="shrink-0 w-6 h-6 rounded-lg bg-red-50 dark:bg-red-500/10 flex items-center justify-center">
                                    <svg class="w-3.5 h-3.5 text-red-500 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                    </svg>
                                </div>
                                <p class="text-xs font-medium text-red-600 dark:text-red-400 truncate">Hapus pengalaman "<span class="font-semibold">{{ $exp->role }}</span>"?</p>
                            </div>
                            <div class="flex items-center gap-1.5 shrink-0">
                                <button
                                    type="button"
                                    @click="confirming = false"
                                    class="px-3 py-1.5 text-xs font-medium text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 border border-slate-200 dark:border-white/10 rounded-lg cursor-pointer transition-colors duration-150"
                                >
                                    Batal
                                </button>
                                <form action="{{ route('experiences.destroy', $exp->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="px-3 py-1.5 text-xs font-semibold text-white bg-red-500 hover:bg-red-600 rounded-lg cursor-pointer transition-colors duration-150 active:scale-[0.97]"
                                    >
                                        Ya, Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- Delete --}}
                    <button
                        x-show="!confirming"
                        @click="confirming = true"
                        class="opacity-0 group-hover:opacity-100 p-1.5 text-slate-300 dark:text-slate-600 hover:text-red-500 dark:hover:text-red-400 rounded-lg transition-all duration-200 cursor-pointer shrink-0"
                        title="Hapus"
                    >
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                </div>
            @endforeach
        </div>
    @endif
</div>