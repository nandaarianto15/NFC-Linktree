{{-- Section: Informasi Dasar --}}
<div id="info-dasar" class="relative z-10 p-6 sm:p-8 bg-white/60 dark:bg-slate-900/50 backdrop-blur-2xl border border-white/40 dark:border-white/10 rounded-2xl shadow-xl shadow-sky-500/5 transition-colors duration-500">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <div class="w-9 h-9 rounded-xl bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20 flex items-center justify-center transition-colors duration-500">
            <svg class="w-4 h-4 text-sky-500 dark:text-sky-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
        </div>
        <div>
            <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-100 transition-colors duration-500">Informasi Dasar</h3>
            <p class="text-xs text-slate-400 dark:text-slate-500 transition-colors duration-500">Foto, nama, dan deskripsi yang muncul di halaman publik</p>
        </div>
    </div>

    {{-- Toast Container --}}
    <div id="toast-container" class="fixed top-6 right-6 z-[9999] flex flex-col gap-3 pointer-events-none"></div>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('patch')

        {{-- Foto Profil --}}
        <div>
            <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-3 uppercase tracking-wider transition-colors duration-500">Foto Profil</label>
            <div class="flex items-center gap-5">
                <div class="relative shrink-0" id="photo-preview-wrapper">
                    @if($user->profile_photo_path)
                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="w-20 h-20 rounded-2xl object-cover border-2 border-white/60 dark:border-white/10 shadow-lg">
                    @else
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-sky-400 to-sky-600 flex items-center justify-center text-xl font-bold text-white shadow-lg shadow-sky-500/25">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                    @endif
                </div>
                <div>
                    <label for="photo" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-sky-600 dark:text-sky-400 bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20 rounded-xl cursor-pointer hover:bg-sky-100 dark:hover:bg-sky-500/20 transition-colors duration-200">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Z" />
                        </svg>
                        Pilih Foto
                    </label>
                    <input type="file" id="photo" name="photo" accept="image/*" class="hidden">
                    <p class="text-xs text-slate-400 dark:text-slate-500 mt-1.5 transition-colors duration-500">JPG, PNG, maks. 2MB</p>
                    {{-- Inline notification untuk error foto --}}
                    <div id="photo-error" class="hidden mt-2 flex items-center gap-2 px-3 py-2 text-xs font-medium text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-500/10 border border-red-100 dark:border-red-500/20 rounded-xl transition-all duration-300 opacity-0 -translate-y-1" role="alert">
                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                        <span id="photo-error-text"></span>
                    </div>
                    @error('photo')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Nama & Email --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wider transition-colors duration-500" for="name">Nama Lengkap</label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                    class="w-full py-2.5 px-3.5 text-sm text-slate-800 dark:text-slate-100 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl outline-none transition-all duration-200 focus:border-sky-500 focus:ring-[3px] focus:ring-sky-500/10 placeholder:text-slate-300 dark:placeholder:text-slate-600">
                @error('name')<p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wider transition-colors duration-500" for="email">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                    class="w-full py-2.5 px-3.5 text-sm text-slate-800 dark:text-slate-100 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl outline-none transition-all duration-200 focus:border-sky-500 focus:ring-[3px] focus:ring-sky-500/10 placeholder:text-slate-300 dark:placeholder:text-slate-600">
                @error('email')<p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>@enderror
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="mt-2">
                        @csrf
                        <p class="text-xs text-amber-600 dark:text-amber-400">
                            Email belum terverifikasi.
                            <button type="submit" class="font-medium underline hover:text-amber-700 dark:hover:text-amber-300 transition-colors duration-200">Kirim ulang</button>
                        </p>
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-1 text-xs text-emerald-600 dark:text-emerald-400">Link verifikasi baru telah dikirim.</p>
                        @endif
                    </form>
                @endif
            </div>
        </div>

        {{-- Title & Lokasi --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wider transition-colors duration-500" for="title">Jabatan</label>
                <input id="title" name="title" type="text" value="{{ old('title', $user->title) }}" placeholder="contoh: Full-Stack Developer"
                    class="w-full py-2.5 px-3.5 text-sm text-slate-800 dark:text-slate-100 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl outline-none transition-all duration-200 focus:border-sky-500 focus:ring-[3px] focus:ring-sky-500/10 placeholder:text-slate-300 dark:placeholder:text-slate-600">
                <p class="text-xs text-slate-400 dark:text-slate-500 mt-1.5 transition-colors duration-500">Muncul di bawah nama di halaman publik.</p>
                @error('title')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wider transition-colors duration-500" for="location">Lokasi</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                    </div>
                    <input id="location" name="location" type="text" value="{{ old('location', $user->location) }}" placeholder="contoh: Jakarta, Indonesia"
                        class="w-full py-2.5 pl-10 pr-3.5 text-sm text-slate-800 dark:text-slate-100 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl outline-none transition-all duration-200 focus:border-sky-500 focus:ring-[3px] focus:ring-sky-500/10 placeholder:text-slate-300 dark:placeholder:text-slate-600">
                </div>
                @error('location')<p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>@enderror
            </div>
        </div>

        {{-- Bio --}}
        <div>
            <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wider transition-colors duration-500" for="bio">Tentang Saya</label>
            <textarea id="bio" name="bio" rows="4" placeholder="Ceritakan sedikit tentang diri Anda..."
                class="w-full py-2.5 px-3.5 text-sm text-slate-800 dark:text-slate-100 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl outline-none transition-all duration-200 focus:border-sky-500 focus:ring-[3px] focus:ring-sky-500/10 placeholder:text-slate-300 dark:placeholder:text-slate-600 resize-none leading-relaxed">{{ old('bio', $user->bio) }}</textarea>
            <div class="flex justify-between items-center mt-1.5">
                <p class="text-xs text-slate-400 dark:text-slate-500 transition-colors duration-500">Muncul di halaman publik sebagai deskripsi singkat.</p>
                <span id="bio-count" class="text-xs text-slate-300 dark:text-slate-600 font-mono tabular-nums transition-colors duration-500">{{ strlen(old('bio', $user->bio ?? '')) }}/500</span>
            </div>
            @error('bio')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
        </div>

        {{-- Telepon --}}
        {{-- <div>
            <label class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wider transition-colors duration-500" for="phone">Nomor Telepon</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                    </svg>
                </div>
                <input id="phone" name="phone" type="tel" value="{{ old('phone', $user->phone) }}" placeholder="contoh: 081234567890"
                    class="w-full py-2.5 pl-10 pr-3.5 text-sm text-slate-800 dark:text-slate-100 bg-white/70 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl outline-none transition-all duration-200 focus:border-sky-500 focus:ring-[3px] focus:ring-sky-500/10 placeholder:text-slate-300 dark:placeholder:text-slate-600">
            </div>
            <p class="text-xs text-slate-400 dark:text-slate-500 mt-1.5 transition-colors duration-500">Opsional. Tidak ditampilkan publik.</p>
            @error('phone')<p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>@enderror
        </div> --}}

        {{-- Submit --}}
        <div class="pt-2">
            <button type="submit"
                class="w-full sm:w-auto px-8 py-2.5 text-sm font-semibold text-white bg-sky-500 hover:bg-sky-600 rounded-xl cursor-pointer transition-all duration-200 active:scale-[0.985] shadow-lg shadow-sky-500/25 hover:shadow-sky-500/40">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<script>
    // Bio counter
    const bioEl = document.getElementById('bio');
    const bioCount = document.getElementById('bio-count');
    if (bioEl && bioCount) {
        bioEl.addEventListener('input', () => {
            const len = bioEl.value.length;
            bioCount.textContent = len + '/500';
            bioCount.classList.toggle('text-red-500', len > 500);
            bioCount.classList.toggle('text-slate-300', len <= 500);
        });
    }

    // Toast notification helper
    function showToast(message, type = 'error') {
        const container = document.getElementById('toast-container');
        if (!container) return;

        const colors = {
            error: {
                bg: 'bg-red-50 dark:bg-red-500/10',
                border: 'border-red-200 dark:border-red-500/20',
                text: 'text-red-700 dark:text-red-300',
                icon: 'M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z',
                iconColor: 'text-red-500 dark:text-red-400',
                progress: 'bg-red-500'
            },
            success: {
                bg: 'bg-emerald-50 dark:bg-emerald-500/10',
                border: 'border-emerald-200 dark:border-emerald-500/20',
                text: 'text-emerald-700 dark:text-emerald-300',
                icon: 'M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z',
                iconColor: 'text-emerald-500 dark:text-emerald-400',
                progress: 'bg-emerald-500'
            },
            warning: {
                bg: 'bg-amber-50 dark:bg-amber-500/10',
                border: 'border-amber-200 dark:border-amber-500/20',
                text: 'text-amber-700 dark:text-amber-300',
                icon: 'M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z',
                iconColor: 'text-amber-500 dark:text-amber-400',
                progress: 'bg-amber-500'
            }
        };

        const c = colors[type] || colors.error;

        const toast = document.createElement('div');
        toast.className = `pointer-events-auto relative overflow-hidden flex items-start gap-3 px-4 py-3 ${c.bg} border ${c.border} rounded-xl shadow-lg shadow-black/5 backdrop-blur-sm transition-all duration-300 opacity-0 translate-x-4 max-w-sm`;
        toast.setAttribute('role', 'alert');
        toast.innerHTML = `
            <svg class="w-5 h-5 shrink-0 mt-0.5 ${c.iconColor}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="${c.icon}" />
            </svg>
            <p class="text-sm font-medium ${c.text} leading-snug">${message}</p>
            <button onclick="this.closest('[role=alert]').remove()" class="shrink-0 ml-1 p-0.5 rounded-lg ${c.text} opacity-40 hover:opacity-100 transition-opacity duration-200 cursor-pointer">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="absolute bottom-0 left-0 h-0.5 ${c.progress} transition-all duration-[4000ms] ease-linear" style="width: 100%"></div>
        `;

        container.appendChild(toast);

        // Animate in
        requestAnimationFrame(() => {
            toast.classList.remove('opacity-0', 'translate-x-4');
            toast.classList.add('opacity-100', 'translate-x-0');
        });

        // Animate progress bar shrinking
        requestAnimationFrame(() => {
            const bar = toast.querySelector('[class*="bottom-0"]');
            if (bar) {
                requestAnimationFrame(() => { bar.style.width = '0%'; });
            }
        });

        // Auto remove after 4s
        setTimeout(() => {
            toast.classList.remove('opacity-100', 'translate-x-0');
            toast.classList.add('opacity-0', 'translate-x-4');
            toast.addEventListener('transitionend', () => toast.remove(), { once: true });
        }, 4000);
    }

    // Inline photo error helper
    function showPhotoError(message) {
        const el = document.getElementById('photo-error');
        const text = document.getElementById('photo-error-text');
        if (!el || !text) return;
        text.textContent = message;
        el.classList.remove('hidden');
        requestAnimationFrame(() => {
            el.classList.remove('opacity-0', '-translate-y-1');
            el.classList.add('opacity-100', 'translate-y-0');
        });
        // Auto-hide setelah 5 detik
        clearTimeout(el._hideTimer);
        el._hideTimer = setTimeout(() => hidePhotoError(), 5000);
    }

    function hidePhotoError() {
        const el = document.getElementById('photo-error');
        if (!el) return;
        el.classList.remove('opacity-100', 'translate-y-0');
        el.classList.add('opacity-0', '-translate-y-1');
        el.addEventListener('transitionend', () => el.classList.add('hidden'), { once: true });
    }

    // Photo preview
    const photoInput = document.getElementById('photo');
    const photoWrapper = document.getElementById('photo-preview-wrapper');
    if (photoInput && photoWrapper) {
        photoInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (!file) return;

            // Sembunyikan error sebelumnya kalau ada
            hidePhotoError();

            if (file.size > 2 * 1024 * 1024) {
                photoInput.value = '';
                // Tampilkan inline error + toast
                showPhotoError('Ukuran foto melebihi batas 2MB. Silakan pilih file lain.');
                showToast('Ukuran foto maksimal 2MB.', 'error');
                return;
            }

            const reader = new FileReader();
            reader.onload = (ev) => {
                photoWrapper.innerHTML = '<img src="' + ev.target.result + '" alt="Preview" class="w-20 h-20 rounded-2xl object-cover border-2 border-white/60 dark:border-white/10 shadow-lg">';
            };
            reader.readAsDataURL(file);
        });
    }
</script>