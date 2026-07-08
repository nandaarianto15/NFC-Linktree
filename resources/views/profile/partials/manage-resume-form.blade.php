{{-- Section: Resume / CV --}}
<div id="resume" class="relative z-10 p-6 sm:p-8 bg-white/60 dark:bg-slate-900/50 backdrop-blur-2xl border border-white/40 dark:border-white/10 rounded-2xl shadow-xl shadow-sky-500/5 transition-colors duration-500">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <div class="w-9 h-9 rounded-xl bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20 flex items-center justify-center transition-colors duration-500">
            <svg class="w-4 h-4 text-sky-500 dark:text-sky-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>
        </div>
        <div class="flex-1">
            <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-100 transition-colors duration-500">{{ $user->resume_title ?? 'Resume / CV' }}</h3>
            <p class="text-xs text-slate-400 dark:text-slate-500 transition-colors duration-500">Upload 1 file PDF, maksimal 2MB</p>
        </div>
    </div>

    {{-- Customize Label --}}
    <form action="{{ route('resume.update_title') }}" method="POST" class="mb-6 pb-6 border-b border-slate-200/50 dark:border-white/[0.05] space-y-3">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wider transition-colors duration-500" for="resume_title">Label / Judul Section</label>
            <div class="flex gap-3">
                <input
                    id="resume_title"
                    name="resume_title"
                    type="text"
                    value="{{ old('resume_title', $user->resume_title ?? 'Resume / CV') }}"
                    class="flex-1 py-2.5 px-3.5 text-sm text-slate-800 dark:text-slate-100 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl outline-none transition-all duration-200 focus:border-sky-500 focus:ring-[3px] focus:ring-sky-500/10 placeholder:text-slate-300 dark:placeholder:text-slate-600"
                    placeholder="Contoh: Resume / CV, Katalog, Sertifikat"
                    required
                >
                <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-sky-500 hover:bg-sky-600 rounded-xl cursor-pointer transition-all duration-200 active:scale-[0.985] shrink-0">
                    Simpan Judul
                </button>
            </div>
        </div>
    </form>

    {{-- Upload Form --}}
    <div
        x-data="{ confirming: false }"
        class="p-4 bg-slate-50/50 dark:bg-white/[0.02] rounded-xl border mb-6 transition-all duration-200"
        :class="confirming
            ? 'border-red-200 dark:border-red-500/20 ring-[3px] ring-red-500/10'
            : 'border-slate-200/50 dark:border-white/[0.05]'"
    >
        @if($user->resume_path)
            {{-- Existing resume — show info + replace / delete --}}
            <div class="flex items-center justify-between gap-4">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-10 h-10 shrink-0 rounded-xl bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20 flex items-center justify-center transition-colors duration-500">
                        <svg class="w-5 h-5 text-sky-500 dark:text-sky-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-slate-800 dark:text-slate-100 truncate transition-colors duration-500">{{ basename($user->resume_path) }}</p>
                        <p class="text-xs text-slate-400 dark:text-slate-500 transition-colors duration-500">{{ round(Storage::disk('public')->size($user->resume_path) / 1024, 1) }} KB</p>
                    </div>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                    {{-- Normal actions --}}
                    <div
                        x-show="!confirming"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-1"
                        class="flex items-center gap-2"
                    >
                        <a href="{{ asset('storage/' . $user->resume_path) }}" target="_blank"
                            class="px-3 py-2 text-xs font-semibold text-sky-600 dark:text-sky-400 bg-sky-50 dark:bg-sky-500/10 hover:bg-sky-100 dark:hover:bg-sky-500/20 border border-sky-200/60 dark:border-sky-500/20 rounded-lg transition-all duration-200 cursor-pointer">
                            Lihat
                        </a>
                        <button
                            type="button"
                            @click="confirming = true"
                            class="px-3 py-2 text-xs font-semibold text-red-500 bg-red-50 dark:bg-red-500/10 hover:bg-red-100 dark:hover:bg-red-500/20 border border-red-200/60 dark:border-red-500/20 rounded-lg transition-all duration-200 cursor-pointer">
                            Hapus
                        </button>
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
                        class="flex items-center gap-2"
                    >
                        <div class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-red-500 dark:text-red-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                            <span class="text-xs font-medium text-red-600 dark:text-red-400 whitespace-nowrap">Hapus {{ strtolower($user->resume_title ?? 'resume') }}?</span>
                        </div>
                        <button
                            type="button"
                            @click="confirming = false"
                            class="px-3 py-2 text-xs font-medium text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 border border-slate-200 dark:border-white/10 rounded-lg cursor-pointer transition-colors duration-150"
                        >
                            Batal
                        </button>
                        <form action="{{ route('resume.destroy') }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="px-3 py-2 text-xs font-semibold text-white bg-red-500 hover:bg-red-600 rounded-lg cursor-pointer transition-colors duration-150 active:scale-[0.97]"
                            >
                                Ya, Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Replace --}}
            <div
                x-show="!confirming"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="mt-4 pt-4 border-t border-slate-200/50 dark:border-white/[0.05] transition-colors duration-500"
            >
                <form action="{{ route('resume.update') }}" method="POST" enctype="multipart/form-data" class="flex items-end gap-3">
                    @csrf
                    @method('PUT')
                    <div class="flex-1 min-w-0">
                        <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1 uppercase tracking-wider transition-colors duration-500">Ganti File</label>
                        <input type="file" name="resume" accept="application/pdf" required
                            class="w-full text-sm text-slate-500 dark:text-slate-400 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-sky-50 dark:file:bg-sky-500/10 file:text-sky-600 dark:file:text-sky-400 file:cursor-pointer file:transition-colors file:duration-200 hover:file:bg-sky-100 dark:hover:file:bg-sky-500/20 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl cursor-pointer transition-colors duration-200">
                        @error('resume')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit"
                        class="px-5 py-2.5 text-sm font-semibold text-white bg-sky-500 hover:bg-sky-600 rounded-xl cursor-pointer transition-all duration-200 active:scale-[0.985] shrink-0">
                        Ganti
                    </button>
                </form>
            </div>
        @else
            {{-- No resume yet — show upload form --}}
            <form action="{{ route('resume.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                <div
                    x-data="{
                        dragging: false,
                        fileName: '',
                        fileSize: '',
                        error: '',
                        pickFile(file) {
                            this.error = '';
                            if (!file) return;
                            if (file.type !== 'application/pdf') {
                                this.error = 'Hanya file PDF yang diperbolehkan.';
                                this.fileName = '';
                                this.fileSize = '';
                                $refs.resumeInput.value = '';
                                return;
                            }
                            if (file.size > 2 * 1024 * 1024) {
                                this.error = 'Ukuran file maksimal 2MB.';
                                this.fileName = '';
                                this.fileSize = '';
                                $refs.resumeInput.value = '';
                                return;
                            }
                            this.fileName = file.name;
                            const kb = file.size / 1024;
                            this.fileSize = kb >= 1024
                                ? (kb / 1024).toFixed(1) + ' MB'
                                : kb.toFixed(1) + ' KB';
                        }
                    }"
                    @dragover.prevent="dragging = true"
                    @dragleave.prevent="dragging = false"
                    @drop.prevent="
                        dragging = false;
                        const file = $event.dataTransfer.files[0];
                        if (file) {
                            $refs.resumeInput.files = $event.dataTransfer.files;
                            pickFile(file);
                        }
                    "
                    :class="error
                        ? 'border-red-300 dark:border-red-500/40 bg-red-50/50 dark:bg-red-500/5'
                        : (fileName
                            ? 'border-sky-300 dark:border-sky-500/40 bg-sky-50/50 dark:bg-sky-500/5'
                            : (dragging
                                ? 'border-sky-400 dark:border-sky-500 bg-sky-50/50 dark:bg-sky-500/5'
                                : 'border-dashed border-slate-300 dark:border-white/10'))"
                    class="flex flex-col items-center justify-center gap-3 py-8 px-4 rounded-xl border-2 transition-all duration-200 cursor-pointer"
                    @click="$refs.resumeInput.click()"
                >
                    {{-- Icon: default / file selected / error --}}
                    <div
                        x-show="!error"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-90"
                    >
                        {{-- Default upload icon --}}
                        <div
                            x-show="!fileName"
                            class="w-12 h-12 rounded-2xl bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20 flex items-center justify-center transition-colors duration-500"
                        >
                            <svg class="w-6 h-6 text-sky-400 dark:text-sky-500/60" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                            </svg>
                        </div>
                        {{-- File selected icon --}}
                        <div
                            x-show="fileName"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-90"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-90"
                            class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20 flex items-center justify-center transition-colors duration-500"
                        >
                            <svg class="w-6 h-6 text-emerald-500 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                    </div>

                    {{-- Error icon --}}
                    <div
                        x-show="error"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-90"
                        class="w-12 h-12 rounded-2xl bg-red-50 dark:bg-red-500/10 border border-red-100 dark:border-red-500/20 flex items-center justify-center transition-colors duration-500"
                    >
                        <svg class="w-6 h-6 text-red-500 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                    </div>

                    {{-- Text: default --}}
                    <div
                        x-show="!fileName && !error"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="text-center"
                    >
                        <p class="text-sm font-medium text-slate-600 dark:text-slate-300 transition-colors duration-500">Klik atau seret file PDF ke sini</p>
                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5 transition-colors duration-500">PDF saja, maksimal 2MB</p>
                    </div>

                    {{-- Text: file selected --}}
                    <div
                        x-show="fileName && !error"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-1"
                        class="text-center min-w-0 w-full max-w-xs"
                    >
                        <p class="text-sm font-semibold text-slate-800 dark:text-slate-100 truncate transition-colors duration-500" x-text="fileName"></p>
                        <p class="text-xs text-emerald-600 dark:text-emerald-400 font-medium mt-0.5 transition-colors duration-500" x-text="fileSize + ' — Klik untuk mengganti'"></p>
                    </div>

                    {{-- Text: error --}}
                    <div
                        x-show="error"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-1"
                        class="text-center"
                    >
                        <p class="text-sm font-semibold text-red-600 dark:text-red-400 transition-colors duration-500" x-text="error"></p>
                        <p class="text-xs text-red-400 dark:text-red-500 mt-0.5 transition-colors duration-500">Klik untuk coba lagi</p>
                    </div>

                    <input type="file" name="resume" accept="application/pdf" required x-ref="resumeInput" class="hidden" @change="pickFile($event.target.files[0])">
                    @error('resume')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <button type="submit"
                    class="w-full px-5 py-2.5 text-sm font-semibold text-white bg-sky-500 hover:bg-sky-600 rounded-xl cursor-pointer transition-all duration-200 active:scale-[0.985]"
                    :disabled="!fileName"
                    :class="fileName ? '' : 'opacity-40 cursor-not-allowed hover:bg-sky-500'"
                >
                    Upload {{ $user->resume_title ?? 'Resume' }}
                </button>
            </form>
        @endif
    </div>

    {{-- Empty state (hidden when resume exists, shown as info below) --}}
    @if(!$user->resume_path)
        <div class="text-center py-2">
            <p class="text-xs text-slate-400 dark:text-slate-500 transition-colors duration-500">{{ $user->resume_title ?? 'Resume' }} akan ditampilkan di halaman publik profil kamu.</p>
        </div>
    @endif
</div>