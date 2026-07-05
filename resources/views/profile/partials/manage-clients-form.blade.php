{{-- Section: Klien --}}
<div id="klien" class="relative z-10 p-6 sm:p-8 bg-white/60 dark:bg-slate-900/50 backdrop-blur-2xl border border-white/40 dark:border-white/10 rounded-2xl shadow-xl shadow-sky-500/5 transition-colors duration-500">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <div class="w-9 h-9 rounded-xl bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20 flex items-center justify-center transition-colors duration-500">
            <svg class="w-4 h-4 text-sky-500 dark:text-sky-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.97 5.97 0 00-.75-2.906m-.173-4.056a3.75 3.75 0 110-7.5 3.75 3.75 0 010 7.5zM15.75 18H18m-1.125-1.125h.008v.008h-.008v-.008zm-9.375 0h.008v.008h-.008v-.008zM3 16.279A6 6 0 006.75 18H9m-6-1.721a3 3 0 004.682-2.72m-.94 3.198l-.001.031c0 .225.012.447.037.666A11.944 11.944 0 0012 21c2.17 0 4.207-.576 5.963-1.584A6.062 6.062 0 0018 18.72m-12 0a5.97 5.97 0 01.75-2.906m.173-4.056a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z" />
            </svg>
        </div>
        <div>
            <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-100 transition-colors duration-500">Klien Saya / Partner</h3>
            <p class="text-xs text-slate-400 dark:text-slate-500 transition-colors duration-500">Daftar klien atau logo perusahaan yang mempercayai Anda</p>
        </div>
    </div>

    {{-- Form Tambah --}}
    <div class="p-4 bg-slate-50/50 dark:bg-white/[0.02] rounded-xl border border-slate-200/50 dark:border-white/[0.05] mb-6 transition-colors duration-500">
        <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-end">
                <div>
                    <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wider" for="client_name">Nama Klien / Instansi</label>
                    <input
                        type="text"
                        id="client_name"
                        name="name"
                        placeholder="contoh: Google, PT. Maju Jaya"
                        required
                        class="w-full py-2.5 px-3.5 text-sm text-slate-800 dark:text-slate-100 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl outline-none transition-all duration-200 focus:border-sky-500 focus:ring-[3px] focus:ring-sky-500/10 placeholder:text-slate-300 dark:placeholder:text-slate-600"
                    >
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wider" for="client_logo">Logo Klien (Opsional)</label>
                    <input
                        type="file"
                        id="client_logo"
                        name="logo"
                        accept="image/*"
                        class="w-full py-2 px-3 text-sm text-slate-800 dark:text-slate-100 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl outline-none file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-sky-50 file:text-sky-600 dark:file:bg-sky-500/10 dark:file:text-sky-400 cursor-pointer"
                    >
                </div>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-[10px] text-slate-400 dark:text-slate-500">Maksimal resolusi logo disarankan transparan PNG, ukuran maks 2MB.</span>
                <button
                    type="submit"
                    class="px-5 py-2.5 text-sm font-semibold text-white bg-sky-500 hover:bg-sky-600 rounded-xl cursor-pointer transition-all duration-200 active:scale-[0.985] shrink-0"
                >
                    Tambah Klien
                </button>
            </div>
        </form>
    </div>

    {{-- Daftar Klien --}}
    @if($user->clients->isEmpty())
        <div class="text-center py-10">
            <div class="w-14 h-14 rounded-2xl bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20 flex items-center justify-center mx-auto mb-3 transition-colors duration-500">
                <svg class="w-6 h-6 text-sky-300 dark:text-sky-500/60" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198" />
                </svg>
            </div>
            <p class="text-sm text-slate-400 dark:text-slate-500 transition-colors duration-500">Belum ada klien ditambahkan.</p>
        </div>
    @else
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
            @foreach($user->clients as $client)
                <div
                    x-data="{ confirming: false }"
                    class="group relative p-4 bg-white/50 dark:bg-white/[0.02] rounded-xl border transition-all duration-200 flex flex-col items-center justify-between text-center min-h-[120px]"
                    :class="confirming ? 'border-red-200 dark:border-red-500/20 ring-[3px] ring-red-500/10' : 'border-slate-200/50 dark:border-white/[0.05] hover:border-sky-200/60 dark:hover:border-sky-500/20'"
                >
                    <div x-show="!confirming" class="w-full flex flex-col items-center gap-3">
                        <button
                            @click="confirming = true"
                            class="absolute top-2 right-2 w-6 h-6 rounded-lg flex items-center justify-center text-slate-300 dark:text-slate-600 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 opacity-0 group-hover:opacity-100 transition-all duration-200 cursor-pointer"
                            title="Hapus"
                        >
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <div class="h-16 w-full flex items-center justify-center">
                            @if($client->logo_path)
                                <img src="{{ asset('storage/' . $client->logo_path) }}" class="max-h-12 max-w-full object-contain" alt="{{ $client->name }}">
                            @else
                                <span class="font-bebas text-lg text-slate-500 dark:text-slate-400 tracking-wider truncate max-w-full px-1">{{ $client->name }}</span>
                            @endif
                        </div>
                        <h4 class="text-xs font-semibold text-slate-700 dark:text-slate-300 truncate w-full">{{ $client->name }}</h4>
                    </div>

                    {{-- Konfirmasi Hapus --}}
                    <div
                        x-show="confirming"
                        x-transition
                        class="flex flex-col items-center justify-center gap-3 h-full w-full"
                    >
                        <p class="text-[11px] font-medium text-red-600 dark:text-red-400 line-clamp-2">Hapus klien "{{ $client->name }}"?</p>
                        <div class="flex items-center gap-1.5 justify-center">
                            <button
                                type="button"
                                @click="confirming = false"
                                class="px-2 py-1 text-[10px] font-medium text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 border border-slate-200 dark:border-white/10 rounded-lg cursor-pointer transition-colors duration-150"
                            >
                                Batal
                            </button>
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="px-2 py-1 text-[10px] font-semibold text-white bg-red-500 hover:bg-red-600 rounded-lg cursor-pointer transition-colors duration-150"
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
