{{-- Section: Keahlian --}}
<div id="keahlian" class="relative z-10 p-6 sm:p-8 bg-white/60 dark:bg-slate-900/50 backdrop-blur-2xl border border-white/40 dark:border-white/10 rounded-2xl shadow-xl shadow-sky-500/5 transition-colors duration-500">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <div class="w-9 h-9 rounded-xl bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20 flex items-center justify-center transition-colors duration-500">
            <svg class="w-4 h-4 text-sky-500 dark:text-sky-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
            </svg>
        </div>
        <div>
            <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-100 transition-colors duration-500">Keahlian</h3>
            <p class="text-xs text-slate-400 dark:text-slate-500 transition-colors duration-500">Teknologi dan skill yang kamu kuasai</p>
        </div>
    </div>

    {{-- Form Tambah --}}
    <form action="{{ route('skills.store') }}" method="POST" class="mb-6">
        @csrf
        <div class="flex gap-2">
            <input
                type="text"
                name="name"
                placeholder="contoh: Laravel, React, Figma..."
                required
                class="flex-1 py-2.5 px-3.5 text-sm text-slate-800 dark:text-slate-100 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl outline-none transition-all duration-200 focus:border-sky-500 focus:ring-[3px] focus:ring-sky-500/10 placeholder:text-slate-300 dark:placeholder:text-slate-600"
            >
            <button
                type="submit"
                class="px-5 py-2.5 text-sm font-semibold text-white bg-sky-500 hover:bg-sky-600 rounded-xl cursor-pointer transition-all duration-200 active:scale-[0.985] shrink-0"
            >
                Tambah
            </button>
        </div>
        @error('name')
            <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
        @enderror
    </form>

    {{-- Daftar Skill --}}
    @if($user->skills->isEmpty())
        <div class="text-center py-10">
            <div class="w-14 h-14 rounded-2xl bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20 flex items-center justify-center mx-auto mb-3 transition-colors duration-500">
                <svg class="w-6 h-6 text-sky-300 dark:text-sky-500/60" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z" />
                </svg>
            </div>
            <p class="text-sm text-slate-400 dark:text-slate-500 transition-colors duration-500">Belum ada keahlian ditambahkan.</p>
        </div>
    @else
        <div class="flex flex-wrap gap-2">
            @foreach($user->skills as $skill)
                <div class="group inline-flex items-center gap-1.5 pl-3.5 pr-2 py-1.5 text-sm font-medium text-sky-600 dark:text-sky-400 bg-sky-50/80 dark:bg-sky-500/10 border border-sky-100/80 dark:border-sky-500/20 rounded-xl transition-all duration-200">
                    {{ $skill->name }}
                    <form action="{{ route('skills.destroy', $skill->id) }}" method="POST" onsubmit="return confirm('Hapus keahlian ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-6 h-6 rounded-lg flex items-center justify-center text-sky-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 transition-all duration-200 cursor-pointer" title="Hapus">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</div>