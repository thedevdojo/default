@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    @include('partials.head', ['title' => $title])
</head>
<body class="min-h-dvh bg-white font-sans text-neutral-700 antialiased selection:bg-neutral-900/10 dark:bg-[#080808] dark:text-neutral-300 dark:selection:bg-white/20">
    <header class="nav-root fixed inset-x-0 top-0 z-50 bg-white/80 backdrop-blur-lg dark:bg-[#080808]/80">
        {{-- At-top state (no border, taller) is declared in plain CSS so it's correct on first
             paint; the shrink + border only animate once JS adds `.is-scrolled` / `.nav-ready`. --}}
        <style>
            .nav-root { border-bottom: 1px solid transparent; }
            .nav-root.is-scrolled { border-bottom-color: rgb(0 0 0 / 0.08); }
            .dark .nav-root.is-scrolled { border-bottom-color: rgb(255 255 255 / 0.06); }
            .nav-inner { padding-top: 1.25rem; padding-bottom: 1.25rem; }
            .nav-root.is-scrolled .nav-inner { padding-top: 0.625rem; padding-bottom: 0.625rem; }
            .nav-ready { transition: border-color 0.3s ease; }
            .nav-ready .nav-inner { transition: padding 0.3s cubic-bezier(0.16, 1, 0.3, 1); }
        </style>
        <div class="nav-inner mx-auto flex max-w-6xl items-center justify-between px-6">
            <a href="{{ route('home') }}" aria-label="{{ config('app.name') }} home" class="flex">
                <x-logo />
            </a>

            {{-- Center nav links --}}
            <nav class="absolute left-1/2 hidden -translate-x-1/2 items-center gap-8 md:flex" aria-label="Primary">
                @foreach (['Home' => '#top', 'Features' => '#features', 'About' => '#about'] as $label => $href)
                    <a href="{{ $href }}" class="text-sm text-neutral-600 transition-colors hover:text-neutral-900 dark:text-neutral-400 dark:hover:text-white">{{ $label }}</a>
                @endforeach
            </nav>

            <div class="flex items-center gap-2.5">
                <x-theme-toggle />
                @guest
                    <x-button type="a" :href="route('register')" size="lg" class="hidden font-semibold sm:inline-flex">
                        Get started
                    </x-button>
                @else
                    <x-button type="a" :href="route('dashboard')" size="lg" class="hidden font-semibold sm:inline-flex">
                        Dashboard
                    </x-button>
                @endguest

                {{-- Mobile menu toggle --}}
                <button type="button" data-nav-toggle aria-label="Toggle menu" aria-expanded="false" class="flex size-9 items-center justify-center rounded-xl border border-neutral-200 text-neutral-600 transition-colors hover:bg-neutral-50 md:hidden dark:border-white/10 dark:text-neutral-300 dark:hover:bg-white/[0.06]">
                    <svg class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16" /></svg>
                </button>
            </div>
        </div>

        {{-- Mobile menu --}}
        <div data-nav-menu hidden class="border-t border-neutral-200 bg-white/95 backdrop-blur-xl md:hidden dark:border-white/10 dark:bg-[#0c0c0c]/95">
            <nav class="mx-auto flex max-w-6xl flex-col px-6 py-3" aria-label="Mobile">
                @foreach (['Home' => '#top', 'Features' => '#features', 'About' => '#about'] as $label => $href)
                    <a href="{{ $href }}" data-nav-link class="border-b border-neutral-200/70 py-3 text-sm text-neutral-700 last:border-0 dark:border-white/5 dark:text-neutral-300">{{ $label }}</a>
                @endforeach
                @guest
                    <x-button type="a" :href="route('register')" size="lg" class="mt-3 w-full justify-center font-semibold">
                        Get started
                    </x-button>
                @else
                    <x-button type="a" :href="route('dashboard')" size="lg" class="mt-3 w-full justify-center font-semibold">
                        Dashboard
                    </x-button>
                @endguest
            </nav>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

    <footer class="border-t border-neutral-200 py-14 dark:border-white/[0.07]">
        <div class="mx-auto max-w-6xl px-6">
            <div class="flex flex-col gap-12 lg:flex-row lg:justify-between">
                <div class="max-w-xs">
                    <a href="{{ route('home') }}" aria-label="{{ config('app.name') }} home" class="flex">
                        <x-logo />
                    </a>
                    <p class="mt-4 text-sm text-neutral-500 dark:text-neutral-400">A clean, modern starting point for whatever you're building. Authentication, billing, and accounts — ready to go.</p>
                </div>

                <div class="grid grid-cols-2 gap-10 sm:grid-cols-3">
                    @php $cols = [
                        'Navigation' => ['Home' => '#top', 'Features' => '#features', 'About' => '#about'],
                        'Product' => ['Dashboard' => route('dashboard'), 'Sign in' => route('login'), 'Get started' => route('register')],
                        'Legal' => ['Privacy' => '#', 'Terms' => '#', 'Contact' => '#'],
                    ]; @endphp
                    @foreach ($cols as $heading => $links)
                        <div>
                            <p class="text-xs font-semibold tracking-wide text-neutral-500 uppercase dark:text-neutral-400">{{ $heading }}</p>
                            <ul role="list" class="mt-4 space-y-2.5">
                                @foreach ($links as $label => $href)
                                    <li><a href="{{ $href }}" class="text-sm text-neutral-600 transition-colors hover:text-neutral-900 dark:text-neutral-400 dark:hover:text-white">{{ $label }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-12 flex flex-col items-center justify-between gap-3 border-t border-neutral-200 pt-6 sm:flex-row dark:border-white/[0.07]">
                <p class="text-xs text-neutral-400 dark:text-neutral-600">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                <p class="font-mono text-xs text-neutral-400 dark:text-neutral-600">Built for builders who ship.</p>
            </div>
        </div>
    </footer>

    <script>
        (function () {
            var nav = document.querySelector('.nav-root');
            if (! nav) {
                return;
            }
            var onScroll = function () {
                nav.classList.toggle('is-scrolled', window.scrollY > 24);
            };
            onScroll();
            window.addEventListener('scroll', onScroll, { passive: true });
            requestAnimationFrame(function () {
                nav.classList.add('nav-ready');
            });

            var toggle = nav.querySelector('[data-nav-toggle]');
            var menu = nav.querySelector('[data-nav-menu]');
            if (toggle && menu) {
                var setOpen = function (open) {
                    menu.toggleAttribute('hidden', ! open);
                    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
                };
                toggle.addEventListener('click', function () {
                    setOpen(menu.hasAttribute('hidden'));
                });
                menu.querySelectorAll('[data-nav-link]').forEach(function (link) {
                    link.addEventListener('click', function () {
                        setOpen(false);
                    });
                });
            }
        })();
    </script>
</body>
</html>
