<?php

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;

middleware('auth');
name('database');

?>

<x-layouts.dashboard :title="'Database — '.config('app.name')">
    <div class="mx-auto max-w-7xl">
        {{-- Header --}}
        <div class="flex flex-col gap-1 pb-6">
            <div class="flex items-center gap-2.5">
                <span class="flex size-8 items-center justify-center rounded-lg bg-neutral-900 text-white dark:bg-white dark:text-black">
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <ellipse cx="12" cy="5" rx="8" ry="3" />
                        <path d="M4 5v6c0 1.66 3.58 3 8 3s8-1.34 8-3V5" />
                        <path d="M4 11v6c0 1.66 3.58 3 8 3s8-1.34 8-3v-6" />
                    </svg>
                </span>
                <h1 class="text-xl font-semibold tracking-tight text-neutral-900 dark:text-white">Database</h1>
            </div>
            <p class="text-sm text-neutral-500 dark:text-neutral-400">
                Browse, search, and edit the records living inside this application's database — right here in the browser.
            </p>
        </div>

        {{-- Browser: table list (left) + records grid (right) --}}
        <div class="grid grid-cols-1 gap-5 lg:grid-cols-[16rem_minmax(0,1fr)]">
            <aside class="rounded-2xl border border-[#ece9e3] bg-white/70 p-5 dark:border-white/[0.06] dark:bg-white/[0.02]">
                <p class="pb-3 text-xs font-semibold uppercase tracking-[0.14em] text-neutral-400">Tables</p>
                @livewire('devdojo.tables')
            </aside>

            <section class="rounded-2xl border border-[#ece9e3] bg-white p-5 dark:border-white/[0.06] dark:bg-neutral-950/40">
                @livewire('devdojo.database')
            </section>
        </div>
    </div>
</x-layouts.dashboard>
