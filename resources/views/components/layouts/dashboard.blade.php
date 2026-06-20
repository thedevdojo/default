@props(['title' => 'Dashboard'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head', ['title' => $title])

    <style>
        /* Vanilla-JS dropdowns (no Alpine): hidden by default, revealed when JS sets data-open. */
        [data-dropdown-menu] {
            opacity: 0;
            transform: scale(0.95);
            pointer-events: none;
            transition: opacity 0.12s ease, transform 0.12s ease;
        }
        [data-dropdown-menu][data-open] {
            opacity: 1;
            transform: scale(1);
            pointer-events: auto;
        }
    </style>
</head>
<body class="min-h-dvh bg-white font-sans text-neutral-700 antialiased dark:bg-black dark:text-neutral-300">
    {{-- Top banner --}}
    <div class="sticky top-0 z-40 flex h-10 w-full items-center justify-center bg-black px-4 text-center text-sm text-white dark:bg-white dark:text-black">
        Welcome to {{ config('app.name') }}!
        <a href="#" class="ml-1.5 underline underline-offset-2">Click here to create your first project</a>
    </div>

    <x-app.dashboard.top-nav />

    {{-- Pinned content frame: a warm card pinned under the sticky header that the window
         scrolls "inside" of. A background layer (z-0) sits behind the content and a border
         ring (z-20) in front, so scrolled content tucks under the border and the header. --}}
    <div aria-hidden="true" class="pointer-events-none fixed inset-x-2 top-[104px] bottom-0 z-0 rounded-t-2xl bg-[#faf9f6] dark:bg-neutral-900/90"></div>

    <main class="relative z-10 mx-2 px-4 pt-6 pb-8 sm:px-6 lg:px-8">
        {{ $slot }}
    </main>

    <div aria-hidden="true" class="pointer-events-none fixed inset-x-2 top-[104px] bottom-0 z-20 rounded-t-2xl border border-b-0 border-[#ece9e3] dark:border-white/[0.06]"></div>

    <script>
        (function () {
            function closeAll(except) {
                document.querySelectorAll('[data-dropdown-menu][data-open]').forEach(function (menu) {
                    if (menu === except) {
                        return;
                    }
                    menu.removeAttribute('data-open');
                    var dropdown = menu.closest('[data-dropdown]');
                    var trigger = dropdown ? dropdown.querySelector('[data-dropdown-trigger]') : null;
                    if (trigger) {
                        trigger.setAttribute('aria-expanded', 'false');
                    }
                });
            }

            document.addEventListener('click', function (event) {
                var trigger = event.target.closest('[data-dropdown-trigger]');

                if (trigger) {
                    var menu = trigger.closest('[data-dropdown]').querySelector('[data-dropdown-menu]');
                    var isOpen = menu.hasAttribute('data-open');
                    closeAll(isOpen ? null : menu);
                    if (isOpen) {
                        menu.removeAttribute('data-open');
                        trigger.setAttribute('aria-expanded', 'false');
                    } else {
                        menu.setAttribute('data-open', '');
                        trigger.setAttribute('aria-expanded', 'true');
                    }
                    return;
                }

                // A click anywhere outside an open menu closes them all.
                if (! event.target.closest('[data-dropdown-menu]')) {
                    closeAll(null);
                }
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    closeAll(null);
                }
            });
        })();
    </script>
</body>
</html>
