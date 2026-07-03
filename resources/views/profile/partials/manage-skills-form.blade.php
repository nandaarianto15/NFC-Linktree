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
    <div class="p-4 bg-slate-50/50 dark:bg-white/[0.02] rounded-xl border border-slate-200/50 dark:border-white/[0.05] mb-6 transition-colors duration-500">
        <form action="{{ route('skills.store') }}" method="POST" x-data="{ percentage: 80 }">
            @csrf
            <div class="flex gap-2">
                <input
                    type="text"
                    name="name"
                    placeholder="contoh: Laravel, React, Figma..."
                    required
                    class="flex-1 min-w-0 py-2.5 px-3.5 text-sm text-slate-800 dark:text-slate-100 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl outline-none transition-all duration-200 focus:border-sky-500 focus:ring-[3px] focus:ring-sky-500/10 placeholder:text-slate-300 dark:placeholder:text-slate-600"
                >
                <div class="shrink-0 relative">
                    <input
                        type="number"
                        name="percentage"
                        :value="percentage === 0 ? '' : percentage"
                        @input="let v = parseInt($el.value); percentage = isNaN(v) ? 0 : v"
                        @blur="if(percentage < 1) percentage = 80; else if(percentage > 100) percentage = 100;"
                        min="1"
                        max="100"
                        required
                        class="w-[72px] py-2.5 pl-3 pr-7 text-sm font-semibold text-sky-600 dark:text-sky-400 bg-sky-50 dark:bg-sky-500/10 border border-sky-200/60 dark:border-sky-500/20 rounded-xl outline-none transition-all duration-200 focus:border-sky-500 focus:ring-[3px] focus:ring-sky-500/10 text-right tabular-nums [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                    >
                    <span class="absolute right-2.5 top-1/2 -translate-y-1/2 text-xs text-sky-400 dark:text-sky-500 pointer-events-none">%</span>
                </div>
                <button
                    type="submit"
                    class="px-5 py-2.5 text-sm font-semibold text-white bg-sky-500 hover:bg-sky-600 rounded-xl cursor-pointer transition-all duration-200 active:scale-[0.985] shrink-0"
                >
                    Tambah
                </button>
            </div>

            {{-- Range Slider --}}
            <div class="mt-3 relative">
                <input
                    type="range"
                    min="1"
                    max="100"
                    x-model="percentage"
                    class="skill-slider w-full h-1.5 appearance-none bg-slate-200 dark:bg-white/10 rounded-full outline-none cursor-pointer transition-colors duration-200"
                >
                <div class="flex justify-between mt-1.5">
                    <span class="text-[10px] text-slate-300 dark:text-slate-600 transition-colors duration-500">Pemula</span>
                    <span class="text-[10px] text-slate-300 dark:text-slate-600 transition-colors duration-500">Mahir</span>
                    <span class="text-[10px] text-slate-300 dark:text-slate-600 transition-colors duration-500">Ahli</span>
                </div>
            </div>
            @error('name')
                <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
            @enderror
        </form>
    </div>

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
        <div class="space-y-3">
            @foreach($user->skills as $skill)
                <div
                    x-data="{ loaded: false, confirming: false }"
                    x-init="setTimeout(() => loaded = true, {{ $loop->index * 80 }})"
                    class="group relative bg-white/50 dark:bg-white/[0.02] rounded-xl border transition-all duration-200"
                    :class="confirming ? 'border-red-200 dark:border-red-500/20 ring-[3px] ring-red-500/10' : 'border-slate-200/50 dark:border-white/[0.05] hover:border-sky-200/60 dark:hover:border-sky-500/20'"
                >
                    <div class="p-3.5">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-100 transition-colors duration-200">{{ $skill->name }}</h4>
                            <div class="flex items-center gap-2.5">
                                <span
                                    x-show="!confirming"
                                    x-text="'{{ $skill->percentage }}%'"
                                    class="text-xs font-semibold tabular-nums transition-colors duration-500"
                                    :class="'{{ $skill->percentage }}' >= 80 ? 'text-sky-500 dark:text-sky-400' : ('{{ $skill->percentage }}' >= 50 ? 'text-slate-500 dark:text-slate-400' : 'text-slate-400 dark:text-slate-500')"
                                >{{ $skill->percentage }}%</span>
                                <button
                                    x-show="!confirming"
                                    @click="confirming = true"
                                    class="w-6 h-6 rounded-lg flex items-center justify-center text-slate-300 dark:text-slate-600 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 opacity-0 group-hover:opacity-100 transition-all duration-200 cursor-pointer"
                                    title="Hapus"
                                >
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Progress Bar --}}
                        <div x-show="!confirming" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1" class="h-2 bg-slate-100 dark:bg-white/[0.05] rounded-full overflow-hidden transition-colors duration-500">
                            <div
                                class="h-full rounded-full transition-all duration-700 ease-out"
                                :class="'{{ $skill->percentage }}' >= 80 ? 'bg-gradient-to-r from-sky-400 to-sky-500' : ('{{ $skill->percentage }}' >= 50 ? 'bg-gradient-to-r from-sky-300 to-sky-400' : 'bg-slate-300 dark:bg-slate-600')"
                                :style="'width: ' + (loaded ? '{{ $skill->percentage }}' : '0') + '%'"
                            ></div>
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
                                <p class="text-xs font-medium text-red-600 dark:text-red-400 truncate">Hapus "<span class="font-semibold">{{ $skill->name }}</span>"?</p>
                            </div>
                            <div class="flex items-center gap-1.5 shrink-0">
                                <button
                                    type="button"
                                    @click="confirming = false"
                                    class="px-3 py-1.5 text-xs font-medium text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 border border-slate-200 dark:border-white/10 rounded-lg cursor-pointer transition-colors duration-150"
                                >
                                    Batal
                                </button>
                                <form action="{{ route('skills.destroy', $skill->id) }}" method="POST" class="inline">
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
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
    .skill-slider::-webkit-slider-runnable-track {
        height: 6px;
        border-radius: 9999px;
    }
    .skill-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: #0ea5e9;
        border: 3px solid #ffffff;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.15);
        margin-top: -6px;
        cursor: pointer;
        transition: transform 150ms ease, box-shadow 150ms ease;
    }
    .skill-slider::-webkit-slider-thumb:hover {
        transform: scale(1.15);
        box-shadow: 0 2px 8px rgba(14, 165, 233, 0.35);
    }
    .skill-slider::-webkit-slider-thumb:active {
        transform: scale(1.05);
    }
    .skill-slider::-moz-range-track {
        height: 6px;
        border-radius: 9999px;
        background: transparent;
    }
    .skill-slider::-moz-range-thumb {
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: #0ea5e9;
        border: 3px solid #ffffff;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.15);
        cursor: pointer;
        transition: transform 150ms ease, box-shadow 150ms ease;
    }
    .skill-slider::-moz-range-thumb:hover {
        transform: scale(1.15);
        box-shadow: 0 2px 8px rgba(14, 165, 233, 0.35);
    }
    .dark .skill-slider::-webkit-slider-thumb {
        background: #38bdf8;
        border-color: #1e293b;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.4);
    }
    .dark .skill-slider::-moz-range-thumb {
        background: #38bdf8;
        border-color: #1e293b;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.4);
    }
</style>