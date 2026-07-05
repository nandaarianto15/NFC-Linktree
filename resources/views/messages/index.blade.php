<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-slate-800 dark:text-slate-100 tracking-tight transition-colors duration-500">
            Pesan Masuk (Inbox)
        </h2>
    </x-slot>

    <div class="py-6 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Success Alert --}}
            @if(session('success'))
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-2"
                    x-init="setTimeout(() => show = false, 3000)"
                    class="flex items-center gap-3 p-4 bg-emerald-50/80 dark:bg-emerald-500/10 backdrop-blur-xl border border-emerald-200/60 dark:border-emerald-500/20 rounded-2xl text-emerald-700 dark:text-emerald-300 text-sm transition-colors duration-500"
                >
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Messages Area --}}
            <div class="relative z-10 p-6 sm:p-8 bg-white/60 dark:bg-slate-900/50 backdrop-blur-2xl border border-white/40 dark:border-white/10 rounded-2xl shadow-xl shadow-sky-500/5 transition-colors duration-500">
                
                {{-- Header --}}
                <div class="flex items-center gap-3 mb-6 border-b border-slate-200/60 dark:border-white/5 pb-4">
                    <div class="w-9 h-9 rounded-xl bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20 flex items-center justify-center transition-colors duration-500">
                        <svg class="w-4 h-4 text-sky-500 dark:text-sky-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0l-7.5-4.615a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-800 dark:text-slate-100 tracking-tight transition-colors duration-500">Daftar Pesan Masuk</h3>
                        <p class="text-xs text-slate-400 dark:text-slate-500 transition-colors duration-500">Hubungan langsung dari calon klien yang mengisi formulir kontak di profil Anda</p>
                    </div>
                    @if($messages->isNotEmpty())
                        <span class="ml-auto text-xs font-medium text-slate-400 dark:text-slate-500 bg-slate-100/80 dark:bg-white/5 px-2.5 py-1 rounded-full transition-colors duration-500">
                            Total: {{ $messages->total() }}
                        </span>
                    @endif
                </div>

                @if($messages->isEmpty())
                    <div class="flex flex-col items-center justify-center py-20 text-center">
                        <div class="w-16 h-16 rounded-2xl bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20 flex items-center justify-center mb-4 transition-colors duration-500">
                            <svg class="w-6 h-6 text-sky-300 dark:text-sky-500/60" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0l-7.5-4.615a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400 transition-colors duration-500">Belum ada pesan masuk</p>
                        <p class="text-xs text-slate-300 dark:text-slate-600 mt-1 transition-colors duration-500">Calon klien yang mengirim pesan dari halaman publik Anda akan tercantum di sini.</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($messages as $msg)
                            <div
                                x-data="{ confirming: false }"
                                class="group relative p-5 bg-white/50 dark:bg-white/[0.02] rounded-2xl border transition-all duration-200"
                                :class="confirming ? 'border-red-200 dark:border-red-500/20 ring-[3px] ring-red-500/10' : 'border-slate-200/50 dark:border-white/[0.05] hover:border-sky-200/60 dark:hover:border-sky-500/20 hover:shadow-lg hover:shadow-sky-500/[0.02]'"
                            >
                                <div x-show="!confirming" class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                                    <div class="space-y-2 flex-1 min-w-0">
                                        <div class="flex flex-wrap items-center gap-2">
                                            <h4 class="text-sm font-bold text-slate-800 dark:text-slate-100 transition-colors duration-200">{{ $msg->name }}</h4>
                                            <span class="text-xs text-slate-300 dark:text-slate-700">•</span>
                                            <a href="mailto:{{ $msg->email }}" class="text-xs text-sky-500 dark:text-sky-400 hover:underline truncate">{{ $msg->email }}</a>
                                            <span class="text-xs text-slate-300 dark:text-slate-700">•</span>
                                            <span class="text-xs text-slate-400 dark:text-slate-500">{{ $msg->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed break-words whitespace-pre-wrap">{{ $msg->message }}</p>
                                    </div>
                                    <div class="shrink-0 flex items-center md:self-center">
                                        <button
                                            @click="confirming = true"
                                            class="p-2 text-slate-300 dark:text-slate-600 hover:text-red-500 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-xl transition-all duration-200 cursor-pointer"
                                            title="Hapus Pesan"
                                        >
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                {{-- Konfirmasi Hapus --}}
                                <div
                                    x-show="confirming"
                                    x-transition
                                    class="flex items-center justify-between gap-3"
                                >
                                    <div class="flex items-center gap-2 min-w-0">
                                        <div class="shrink-0 w-6 h-6 rounded-lg bg-red-50 dark:bg-red-500/10 flex items-center justify-center">
                                            <svg class="w-3.5 h-3.5 text-red-500 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                            </svg>
                                        </div>
                                        <p class="text-xs font-medium text-red-600 dark:text-red-400 truncate">Hapus pesan dari "<span class="font-semibold">{{ $msg->name }}</span>"?</p>
                                    </div>
                                    <div class="flex items-center gap-1.5 shrink-0">
                                        <button
                                            type="button"
                                            @click="confirming = false"
                                            class="px-3 py-1.5 text-xs font-medium text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 border border-slate-200 dark:border-white/10 rounded-lg cursor-pointer transition-colors duration-150"
                                        >
                                            Batal
                                        </button>
                                        <form action="{{ route('messages.destroy', $msg->id) }}" method="POST" class="inline">
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

                    {{-- Pagination --}}
                    <div class="mt-6">
                        {{ $messages->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
