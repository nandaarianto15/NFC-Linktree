{{-- Section: Testimoni --}}
<div id="testimoni" class="relative z-10 p-6 sm:p-8 bg-white/60 dark:bg-slate-900/50 backdrop-blur-2xl border border-white/40 dark:border-white/10 rounded-2xl shadow-xl shadow-sky-500/5 transition-colors duration-500">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <div class="w-9 h-9 rounded-xl bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20 flex items-center justify-center transition-colors duration-500">
            <svg class="w-4 h-4 text-sky-500 dark:text-sky-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
            </svg>
        </div>
        <div>
            <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-100 transition-colors duration-500">Testimoni</h3>
            <p class="text-xs text-slate-400 dark:text-slate-500 transition-colors duration-500">Kata client atau rekan kerja tentang kamu</p>
        </div>
    </div>

    {{-- Form Tambah --}}
    <div class="p-4 bg-slate-50/50 dark:bg-white/[0.02] rounded-xl border border-slate-200/50 dark:border-white/[0.05] mb-6 transition-colors duration-500">
        <form action="{{ route('testimonials.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1 uppercase tracking-wider transition-colors duration-500">Nama Client</label>
                    <input type="text" name="client_name" placeholder="contoh: Budi Santoso" required
                        class="w-full py-2.5 px-3.5 text-sm text-slate-800 dark:text-slate-100 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl outline-none transition-all duration-200 focus:border-sky-500 focus:ring-[3px] focus:ring-sky-500/10 placeholder:text-slate-300 dark:placeholder:text-slate-600">
                    @error('client_name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1 uppercase tracking-wider transition-colors duration-500">Role / Jabatan <span class="normal-case text-slate-300 dark:text-slate-600">(opsional)</span></label>
                    <input type="text" name="client_role" placeholder="contoh: CEO PT Maju Bersama"
                        class="w-full py-2.5 px-3.5 text-sm text-slate-800 dark:text-slate-100 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl outline-none transition-all duration-200 focus:border-sky-500 focus:ring-[3px] focus:ring-sky-500/10 placeholder:text-slate-300 dark:placeholder:text-slate-600">
                    @error('client_role')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1 uppercase tracking-wider transition-colors duration-500">Isi Testimoni</label>
                <textarea name="content" rows="3" placeholder="Apa kata mereka tentang kerja sama dengan kamu..." required
                    class="w-full py-2.5 px-3.5 text-sm text-slate-800 dark:text-slate-100 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl outline-none transition-all duration-200 focus:border-sky-500 focus:ring-[3px] focus:ring-sky-500/10 placeholder:text-slate-300 dark:placeholder:text-slate-600 resize-none leading-relaxed"></textarea>
                @error('content')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>
            <button type="submit"
                class="px-5 py-2.5 text-sm font-semibold text-white bg-sky-500 hover:bg-sky-600 rounded-xl cursor-pointer transition-all duration-200 active:scale-[0.985]">
                Tambah Testimoni
            </button>
        </form>
    </div>

    {{-- Daftar Testimoni --}}
    @if($user->testimonials->isEmpty())
        <div class="text-center py-10">
            <div class="w-14 h-14 rounded-2xl bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20 flex items-center justify-center mx-auto mb-3 transition-colors duration-500">
                <svg class="w-6 h-6 text-sky-300 dark:text-sky-500/60" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                </svg>
            </div>
            <p class="text-sm text-slate-400 dark:text-slate-500 transition-colors duration-500">Belum ada testimoni ditambahkan.</p>
        </div>
    @else
        <div class="space-y-3">
            @foreach($user->testimonials as $testimonial)
                <div class="group relative p-4 bg-white/50 dark:bg-white/[0.02] rounded-xl border border-slate-200/50 dark:border-white/[0.05] hover:border-sky-200/60 dark:hover:border-sky-500/20 transition-all duration-200">
                    {{-- Quote mark dekoratif --}}
                    <div class="absolute top-3 left-3 text-3xl font-serif text-sky-200 dark:text-sky-500/10 leading-none select-none transition-colors duration-500">"</div>

                    <p class="relative z-10 pl-4 text-sm text-slate-600 dark:text-slate-300 leading-relaxed italic transition-colors duration-200">{{ $testimonial->content }}</p>

                    <div class="relative z-10 mt-3 pl-4 flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-full bg-sky-100 dark:bg-sky-500/15 flex items-center justify-center shrink-0 transition-colors duration-500">
                                <span class="text-[10px] font-bold text-sky-600 dark:text-sky-400 transition-colors duration-500">{{ strtoupper(substr($testimonial->client_name, 0, 1)) }}</span>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-slate-800 dark:text-slate-100 transition-colors duration-200">{{ $testimonial->client_name }}</p>
                                @if($testimonial->client_role)
                                    <p class="text-[11px] text-slate-400 dark:text-slate-500 transition-colors duration-200">{{ $testimonial->client_role }}</p>
                                @endif
                            </div>
                        </div>

                        <form action="{{ route('testimonials.destroy', $testimonial->id) }}" method="POST" onsubmit="return confirm('Hapus testimoni ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="opacity-0 group-hover:opacity-100 p-1.5 text-slate-300 dark:text-slate-600 hover:text-red-500 dark:hover:text-red-400 rounded-lg transition-all duration-200 cursor-pointer" title="Hapus">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>