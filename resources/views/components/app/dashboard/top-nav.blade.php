<header class="sticky top-10 z-30 bg-white dark:bg-[#0e0f15]">
    <div class="flex h-16 items-center gap-4 px-3 sm:px-4 lg:px-6">
        {{-- Logo --}}
        <a href="{{ route('dashboard') }}" class="flex h-6 shrink-0 items-center gap-2.5" aria-label="{{ config('app.name') }} dashboard">
            <x-logo-icon />
        </a>

        {{-- Project selector --}}
        <x-dropdown align="left" gap="2">
            <x-slot:trigger>
                <button type="button"
                        class="flex items-center gap-2 rounded-medium border border-neutral-200/90 bg-white py-1.5 pr-2.5 pl-2 shadow-xs transition-colors hover:bg-neutral-50 dark:border-white/[0.08] dark:bg-white/[0.04] dark:shadow-sm dark:hover:bg-white/[0.07]">
                    <span class="flex size-6 items-center justify-center rounded-full bg-neutral-100 text-neutral-500 dark:bg-white/10 dark:text-neutral-300">
                        <svg class="size-3.5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
                    </span>
                    <span class="text-sm font-medium text-neutral-900 dark:text-white">All Projects</span>
                    <svg class="size-4 text-neutral-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" d="M6 9l6 6 6-6"/></svg>
                </button>
            </x-slot:trigger>

            <x-slot:menu class="w-64 border-neutral-200 bg-white p-1.5 dark:border-white/[0.08] dark:bg-[#0e0f15]">
                <p class="px-2.5 py-1.5 text-[0.65rem] font-semibold tracking-wide text-neutral-400 uppercase dark:text-neutral-500">Your projects</p>
                <p class="px-2.5 py-2 text-sm text-neutral-400">No projects yet</p>
                <div class="my-1 h-px bg-neutral-100 dark:bg-white/[0.06]"></div>
                <a href="#" class="flex items-center gap-2.5 rounded-small px-2.5 py-2 text-sm font-medium text-neutral-700 transition-colors hover:bg-neutral-100 dark:text-neutral-200 dark:hover:bg-white/[0.05]">
                    <svg class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" d="M12 5v14M5 12h14"/></svg>
                    Create new project
                </a>
            </x-slot:menu>
        </x-dropdown>

        {{-- Right cluster --}}
        <div class="ml-auto flex items-center gap-2">
            {{-- Avatar + menu --}}
            <x-dropdown align="right" gap="2">
                <x-slot:trigger>
                    <button type="button" class="flex shrink-0 rounded-full transition focus:outline-none">
                        <img src="{{ auth()->user()->avatar() }}" alt="{{ auth()->user()->name }}" class="size-8 rounded-full bg-neutral-100 object-cover ring-1 ring-neutral-200 ring-offset-2 ring-offset-white transition hover:ring-neutral-300 dark:bg-white/10 dark:ring-white/15 dark:ring-offset-[#0e0f15] dark:hover:ring-white/30">
                    </button>
                </x-slot:trigger>

                <x-slot:menu class="w-60 border-neutral-200 bg-white p-1.5 dark:border-white/[0.08] dark:bg-[#0e0f15]">
                    <p class="truncate px-3 py-2 text-sm text-neutral-500 dark:text-neutral-400">{{ auth()->user()->email }}</p>
                    <div class="my-1 h-px bg-neutral-100 dark:bg-white/[0.06]"></div>

                    <a href="#" class="flex items-center gap-2.5 rounded-small px-3 py-2 text-sm text-neutral-700 transition-colors hover:bg-neutral-100 dark:text-neutral-200 dark:hover:bg-white/[0.05]">
                        <svg class="size-4 text-neutral-400" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 11-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 11-4 0v-.09a1.65 1.65 0 00-1-1.51 1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 11-2.83-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 110-4h.09a1.65 1.65 0 001.51-1 1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 112.83-2.83l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 114 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 112.83 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 110 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
                        Settings
                    </a>
                    <a href="#" class="flex items-center gap-2.5 rounded-small px-3 py-2 text-sm text-neutral-700 transition-colors hover:bg-neutral-100 dark:text-neutral-200 dark:hover:bg-white/[0.05]">
                        <svg class="size-4 text-neutral-400" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 7a4 4 0 11-3.9 5H7v3H4v-3l3.1-.001A4 4 0 0115 7z"/><circle cx="15" cy="11" r="1" fill="currentColor"/></svg>
                        API Credentials
                    </a>
                    <a href="#" class="flex items-center gap-2.5 rounded-small px-3 py-2 text-sm text-neutral-700 transition-colors hover:bg-neutral-100 dark:text-neutral-200 dark:hover:bg-white/[0.05]">
                        <svg class="size-4 text-neutral-400" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 8a6 6 0 10-12 0c0 7-3 9-3 9h18s-3-2-3-9M13.7 21a2 2 0 01-3.4 0"/></svg>
                        Notifications
                    </a>
                    <a href="#" class="flex items-center gap-2.5 rounded-small px-3 py-2 text-sm text-neutral-700 transition-colors hover:bg-neutral-100 dark:text-neutral-200 dark:hover:bg-white/[0.05]">
                        <svg class="size-4 text-neutral-400" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><circle cx="12" cy="12" r="4.5"/><path stroke-linecap="round" stroke-linejoin="round" d="M5.3 18.7c-1.6-1-2-4 1.2-7.3M18.7 5.3c1.6 1 2 4-1.2 7.3"/></svg>
                        Profile
                    </a>

                    <div class="my-1 h-px bg-neutral-100 dark:bg-white/[0.06]"></div>
                    <x-app.light-dark-toggle />
                    <div class="my-1 h-px bg-neutral-100 dark:bg-white/[0.06]"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex w-full items-center gap-2.5 rounded-small px-3 py-2 text-sm text-neutral-700 transition-colors hover:bg-neutral-100 dark:text-neutral-200 dark:hover:bg-white/[0.05]">
                            <svg class="size-4 text-neutral-400" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12H3m0 0l4-4m-4 4l4 4M13 4h6a2 2 0 012 2v12a2 2 0 01-2 2h-6"/></svg>
                            Log out
                        </button>
                    </form>
                </x-slot:menu>
            </x-dropdown>
        </div>
    </div>
</header>
