{{-- Reflects the current theme via `dark:` variants and flips it with window.toggleTheme(). --}}
<button
    type="button"
    role="switch"
    onclick="window.toggleTheme()"
    {{ $attributes->merge(['class' => 'flex w-full items-center gap-2.5 rounded-lg px-3 py-2 text-sm text-neutral-700 transition-colors hover:bg-neutral-100 dark:text-neutral-200 dark:hover:bg-white/[0.05]']) }}
>
    <span class="relative inline-flex h-[18px] w-8 shrink-0 items-center rounded-full bg-neutral-200 transition-colors dark:bg-white/25">
        <span class="absolute left-0.5 size-3.5 rounded-full bg-white shadow-sm transition-transform duration-200 ease-out dark:translate-x-[14px]"></span>
    </span>
    <span class="dark:hidden">Dark Mode</span>
    <span class="hidden dark:inline">Light Mode</span>
</button>
