<?php

use function Laravel\Folio\name;

name('home');

?>

<x-layouts.marketing :title="config('app.name').' — Build something great'">
    <section id="top" class="relative overflow-hidden pt-36 pb-24 sm:pt-44 sm:pb-32">
        {{-- Background: radial glow + dotted field --}}
        <div class="pointer-events-none absolute inset-0 -z-10">
            <div class="absolute top-[-10%] right-[-5%] h-[620px] w-[620px] rounded-full bg-[radial-gradient(circle,rgba(124,58,237,0.10),transparent_60%)] blur-2xl dark:bg-[radial-gradient(circle,rgba(80,70,120,0.18),transparent_60%)]"></div>
            <div class="absolute inset-0 [background-image:radial-gradient(circle,rgba(0,0,0,0.05)_1px,transparent_1px)] [background-size:34px_34px] [mask-image:radial-gradient(70%_60%_at_50%_0%,black,transparent)] dark:[background-image:radial-gradient(circle,rgba(255,255,255,0.04)_1px,transparent_1px)]"></div>
        </div>

        <div class="mx-auto max-w-6xl px-6">
            {{-- Eyebrow pill --}}
            <span class="inline-flex items-center gap-2 rounded-full border border-neutral-200 bg-neutral-50 py-1 pr-3.5 pl-1.5 text-sm text-neutral-700 dark:border-white/10 dark:bg-white/[0.04] dark:text-neutral-300">
                <span class="inline-flex size-5 items-center justify-center rounded-full bg-neutral-900 text-white dark:bg-white dark:text-neutral-900">
                    <svg class="size-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 3L4 14h7l-1 7 9-11h-7l1-7z" />
                    </svg>
                </span>
                Your next project starts here
            </span>

            <h1 class="mt-7 max-w-5xl text-4xl leading-[1.07] font-medium tracking-tight text-balance text-neutral-900 sm:text-5xl lg:text-6xl dark:text-white">
                Build something great, even faster.
            </h1>

            <p class="mt-6 max-w-[800px] text-lg text-pretty text-neutral-600 dark:text-neutral-400">
                A clean, modern starting point for whatever you're building. Create a web app, SaaS,
                internal tool, or your next side project even faster. Plug'n play authentication, billing, accounts and more.
            </p>

            <div class="mt-9 flex flex-col items-start gap-3 sm:flex-row sm:items-center">
                @guest
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center justify-center gap-2 rounded-xl bg-neutral-900 px-5 py-3 text-sm font-semibold text-white transition-all hover:bg-neutral-800 active:scale-[0.98] dark:bg-white dark:text-neutral-900 dark:hover:bg-neutral-200">
                        Get started
                        <svg class="size-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6l6 6-6 6" /></svg>
                    </a>
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center justify-center gap-2 rounded-xl border border-neutral-200 bg-white px-5 py-3 text-sm font-semibold text-neutral-800 shadow-sm transition-all hover:bg-neutral-50 active:scale-[0.98] dark:border-white/10 dark:bg-white/[0.04] dark:text-neutral-200 dark:shadow-none dark:hover:bg-white/[0.08]">
                        Sign in
                    </a>
                @else
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center justify-center gap-2 rounded-xl bg-neutral-900 px-5 py-3 text-sm font-semibold text-white transition-all hover:bg-neutral-800 active:scale-[0.98] dark:bg-white dark:text-neutral-900 dark:hover:bg-neutral-200">
                        Go to dashboard
                        <svg class="size-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6l6 6-6 6" /></svg>
                    </a>
                @endguest
            </div>
        </div>

        {{-- Product mockup (gray placeholder stands in for the dashboard screenshot) --}}
        <div class="relative mx-auto mt-16 max-w-6xl px-6">
            <div class="pointer-events-none absolute inset-x-10 -top-6 bottom-10 -z-10 rounded-[2rem] bg-[radial-gradient(60%_50%_at_50%_0%,rgba(124,58,237,0.12),transparent_70%)] blur-2xl dark:bg-[radial-gradient(60%_50%_at_50%_0%,rgba(124,58,237,0.18),transparent_70%)]"></div>

            <div class="rounded-3xl bg-black/5 p-2 ring-1 ring-gray-900/10 backdrop-blur-2xl dark:bg-white/10 dark:ring-white/10">
                <div class="overflow-hidden rounded-2xl bg-neutral-50 shadow-2xl shadow-neutral-400/20 dark:bg-[#0a0b0f] dark:shadow-[0_40px_120px_-30px_rgba(80,70,140,0.5)]">
                    <div class="aspect-[16/11] w-full bg-neutral-200 dark:bg-white/5"></div>
                </div>
            </div>
        </div>

        {{-- Feature cards --}}
        @php
            $features = [
                ['Managed provisioning', 'OpenClaw installed for you', '<svg class="size-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 18a4 4 0 01-.5-7.97A5.5 5.5 0 0117.9 9.5 3.75 3.75 0 0117 18H7z"/></svg>'],
                ['You own the server', 'Root SSH from day one', '<svg class="size-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 7l5 5-5 5M13 17h6"/></svg>'],
                ['Multi-channel', 'Slack, Telegram, Discord & more', '<svg class="size-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a8 8 0 01-11.5 7.2L4 20l1-5A8 8 0 1121 12z"/></svg>'],
                ['No lock-in', 'Cancel and it keeps running', '<svg class="size-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><rect x="5" y="11" width="14" height="9" rx="2"/><path stroke-linecap="round" d="M8 11V8a4 4 0 018 0"/></svg>'],
            ];
        @endphp

        <div class="mx-auto mt-6 max-w-6xl px-6">
            <div class="grid grid-cols-1 gap-px overflow-hidden rounded-2xl border border-neutral-200 bg-neutral-200 shadow-sm sm:grid-cols-2 lg:grid-cols-4 dark:border-white/10 dark:bg-white/10 dark:shadow-none">
                @foreach ($features as [$title, $sub, $icon])
                    <div class="flex items-start gap-3 bg-white p-5 dark:bg-[#0a0a0a]">
                        <span class="mt-0.5 text-neutral-600 dark:text-neutral-400">{!! $icon !!}</span>
                        <div>
                            <p class="text-sm font-medium text-neutral-900 dark:text-white">{{ $title }}</p>
                            <p class="mt-0.5 text-xs text-neutral-500 dark:text-neutral-400">{{ $sub }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-layouts.marketing>
