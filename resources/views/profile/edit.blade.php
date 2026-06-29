<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-slate-800 dark:text-slate-100 tracking-tight transition-colors duration-500">
            Edit Profile
        </h2>
    </x-slot>

    <div class="py-6 pb-16">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

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

            @include('profile.partials.update-profile-information-form')
            @include('profile.partials.manage-skills-form')
            @include('profile.partials.manage-experiences-form')
            @include('profile.partials.manage-portfolios-form')
            {{-- @include('profile.partials.manage-testimonials-form') --}}

            {{-- @todo: Update Password --}}
            {{-- @include('profile.partials.update-password-form') --}}

            {{-- @todo: Delete Account --}}
            {{-- @include('profile.partials.delete-user-form') --}}
        </div>
    </div>
</x-app-layout>