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

            <div class="flex items-center gap-2.5">
                <x-theme-toggle />
                @guest
                    <a href="{{ route('register') }}" class="rounded-xl bg-neutral-900 px-4 py-2 text-sm font-semibold text-white transition-all hover:bg-neutral-800 active:scale-[0.98] dark:bg-white dark:text-neutral-900 dark:hover:bg-neutral-200">
                        Get started
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="rounded-xl bg-neutral-900 px-4 py-2 text-sm font-semibold text-white transition-all hover:bg-neutral-800 active:scale-[0.98] dark:bg-white dark:text-neutral-900 dark:hover:bg-neutral-200">
                        Dashboard
                    </a>
                @endguest
            </div>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

    <footer class="border-t border-black/5 dark:border-white/5">
        <div class="mx-auto flex max-w-6xl flex-col items-center justify-between gap-4 px-6 py-8 text-sm text-neutral-500 sm:flex-row dark:text-neutral-400">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <div class="flex items-center gap-6">
                <a href="#" class="transition-colors hover:text-neutral-900 dark:hover:text-white">Privacy</a>
                <a href="#" class="transition-colors hover:text-neutral-900 dark:hover:text-white">Terms</a>
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
        })();
    </script>
</body>
</html>
