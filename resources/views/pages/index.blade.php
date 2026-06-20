<?php

use function Laravel\Folio\name;

name('home');

?>

<x-layouts.marketing :title="config('app.name').' — Build something great'">
    <section id="top" class="relative overflow-hidden pt-36 pb-24 sm:pt-44 sm:pb-32">

        <div class="mx-auto max-w-6xl px-6">
            {{-- Eyebrow pill --}}
            <x-badge variant="outline" size="lg" pill class="gap-2 bg-secondary py-1 pr-3.5 pl-1.5 font-normal text-foreground">
                <span class="inline-flex size-5 items-center justify-center rounded-full bg-primary text-primary-foreground">
                    <svg class="size-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 3L4 14h7l-1 7 9-11h-7l1-7z" />
                    </svg>
                </span>
                Your next project starts here
            </x-badge>

            <h1 class="mt-7 max-w-5xl text-4xl leading-[1.07] font-medium tracking-tight text-balance text-neutral-900 sm:text-5xl lg:text-6xl dark:text-white">
                Build something great, even faster.
            </h1>

            <p class="mt-6 max-w-[800px] text-lg text-pretty text-neutral-600 dark:text-neutral-400">
                A clean, modern starting point for whatever you're building. Create a web app, SaaS,
                internal tool, or your next side project even faster. Plug'n play authentication, billing, accounts and more.
            </p>

            <div class="mt-9 flex flex-col items-start gap-3 sm:flex-row sm:items-center">
                @guest
                    <x-button type="a" :href="route('register')" size="xl" class="font-semibold">
                        Get started
                        <svg class="size-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6l6 6-6 6" /></svg>
                    </x-button>
                    <x-button type="a" variant="outline" :href="route('login')" size="xl" class="font-semibold shadow-sm">
                        Sign in
                    </x-button>
                @else
                    <x-button type="a" :href="route('dashboard')" size="xl" class="font-semibold">
                        Go to dashboard
                        <svg class="size-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6l6 6-6 6" /></svg>
                    </x-button>
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
                ['Plug & play auth', 'Login, social & 2FA built in', '<svg class="size-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><rect x="5" y="11" width="14" height="9" rx="2"/><path stroke-linecap="round" d="M8 11V8a4 4 0 018 0"/></svg>'],
                ['Billing ready', 'Subscriptions & checkout', '<svg class="size-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><rect x="3" y="6" width="18" height="12" rx="2"/><path stroke-linecap="round" d="M3 10h18"/></svg>'],
                ['Fully yours', 'Own your code and data', '<svg class="size-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3l8 4v5c0 4.5-3.2 7.3-8 9-4.8-1.7-8-4.5-8-9V7l8-4z"/></svg>'],
                ['Ship faster', 'Skip the boilerplate setup', '<svg class="size-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 3L4 14h7l-1 7 9-11h-7l1-7z"/></svg>'],
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

    {{-- Features --}}
    <section id="features" class="scroll-mt-24 border-t border-neutral-200/70 py-24 sm:py-28 dark:border-white/[0.06]">
        <div class="mx-auto max-w-6xl px-6">
            <div class="max-w-2xl">
                <span class="text-xs font-semibold tracking-wider text-neutral-500 uppercase dark:text-neutral-400">Features</span>
                <h2 class="mt-3 text-3xl font-medium tracking-tight text-balance text-neutral-900 sm:text-4xl dark:text-white">
                    Everything you need to ship.
                </h2>
                <p class="mt-4 text-lg text-pretty text-neutral-600 dark:text-neutral-400">
                    Skip the boilerplate. The essentials are built in and wired together, so you can focus on the parts
                    that make your product yours.
                </p>
            </div>

            @php
                $featureCards = [
                    ['Authentication', 'Login, registration, social sign-in, and two-factor — secure and ready on day one.', '<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 0h10.5a2.25 2.25 0 012.25 2.25v6.75a2.25 2.25 0 01-2.25 2.25H6.75a2.25 2.25 0 01-2.25-2.25v-6.75a2.25 2.25 0 012.25-2.25z" />'],
                    ['Billing & plans', 'Subscriptions, checkout, and feature limits with Stripe or Paddle out of the box.', '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9V6.75A2.25 2.25 0 014.5 4.5h15a2.25 2.25 0 012.25 2.25v10.5A2.25 2.25 0 0119.5 19.5h-15A2.25 2.25 0 012.25 17.25V9z" />'],
                    ['Profiles', 'Public user profiles with dynamic fields, social links, and privacy controls.', '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 19.5a7.5 7.5 0 0115 0v.75H4.5v-.75z" />'],
                    ['Notifications', 'In-app notifications and per-user preferences your users can fine-tune.', '<path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.8 23.8 0 005.454-1.31A8.97 8.97 0 0118 9.75V9A6 6 0 006 9v.75a8.97 8.97 0 01-2.312 6.022 23.8 23.8 0 005.455 1.31m6.714 0a3 3 0 11-6.714 0m6.714 0a24.2 24.2 0 01-6.714 0" />'],
                    ['Content & blog', 'A built-in blog and changelog with an admin to keep users in the loop.', '<path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" />'],
                    ['Yours to extend', 'A thin, conventional Laravel app underneath — add features the way you already know.', '<path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3" />'],
                ];
            @endphp

            <div class="mt-14 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($featureCards as [$title, $desc, $icon])
                    <div class="rounded-2xl border border-neutral-200 bg-white p-6 transition-colors hover:border-neutral-300 dark:border-white/10 dark:bg-white/[0.02] dark:hover:border-white/20">
                        <span class="inline-flex size-10 items-center justify-center rounded-xl bg-neutral-900 text-white dark:bg-white dark:text-neutral-900">
                            <svg class="size-5" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true">{!! $icon !!}</svg>
                        </span>
                        <h3 class="mt-5 text-base font-semibold text-neutral-900 dark:text-white">{{ $title }}</h3>
                        <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">{{ $desc }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- About --}}
    <section id="about" class="scroll-mt-24 border-t border-neutral-200/70 py-24 sm:py-28 dark:border-white/[0.06]">
        <div class="mx-auto max-w-6xl px-6">
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-2 lg:gap-20">
                <div>
                    <span class="text-xs font-semibold tracking-wider text-neutral-500 uppercase dark:text-neutral-400">About</span>
                    <h2 class="mt-3 text-3xl font-medium tracking-tight text-balance text-neutral-900 sm:text-4xl dark:text-white">
                        A foundation you can build on.
                    </h2>
                    <div class="mt-9 flex flex-col items-start gap-3 sm:flex-row sm:items-center">
                        @guest
                            <x-button type="a" :href="route('register')" size="xl" class="font-semibold">
                                Get started
                                <svg class="size-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6l6 6-6 6" /></svg>
                            </x-button>
                        @else
                            <x-button type="a" :href="route('dashboard')" size="xl" class="font-semibold">
                                Go to dashboard
                                <svg class="size-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6l6 6-6 6" /></svg>
                            </x-button>
                        @endguest
                    </div>
                </div>

                <div class="space-y-5 text-lg text-pretty text-neutral-600 dark:text-neutral-400">
                    <p>
                        This is a starting point, not a straitjacket. Every piece is here to get you moving —
                        authentication, billing, profiles, and more — wired together and ready the moment you start.
                    </p>
                    <p>
                        From here, it's yours. Add your own features, ship your idea, and let the foundation handle the
                        parts every app needs so you don't have to build them again.
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-layouts.marketing>
