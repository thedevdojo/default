<?php

use function Laravel\Folio\name;

name('home');

?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head', ['title' => 'Welcome — '.config('app.name')])

    <style>
        /* Swap standalone chrome for builder-friendly hints when rendered
           inside the builder canvas (html.is-embedded is set pre-paint). */
        .embedded-only { display: none; }
        html.is-embedded .standalone-only { display: none; }
        html.is-embedded .embedded-only { display: inline-flex; }

        @keyframes welcome-rise {
            from { opacity: 0; transform: translateY(14px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .welcome-rise { animation: welcome-rise 0.7s cubic-bezier(0.16, 1, 0.3, 1) both; }

        @media (prefers-reduced-motion: reduce) {
            .welcome-rise { animation: none; }
        }
    </style>
</head>
<body class="min-h-dvh overflow-x-hidden bg-white font-sans text-neutral-700 antialiased selection:bg-neutral-900/10 dark:bg-[#080808] dark:text-neutral-300 dark:selection:bg-white/20">

    {{-- Ambient background: faded dot grid + soft brand glow --}}
    <div aria-hidden="true" class="pointer-events-none fixed inset-0">
        <div class="absolute inset-0 bg-[radial-gradient(circle,#000_1px,transparent_1px)] opacity-[0.05] [background-size:22px_22px] [mask-image:radial-gradient(ellipse_65%_65%_at_50%_38%,black,transparent)] dark:bg-[radial-gradient(circle,#fff_1px,transparent_1px)] dark:opacity-[0.08]"></div>
        <div class="absolute top-[-22%] left-1/2 h-[34rem] w-[56rem] max-w-none -translate-x-1/2 rounded-full bg-[radial-gradient(closest-side,rgba(124,58,237,0.09),transparent)] blur-2xl dark:bg-[radial-gradient(closest-side,rgba(124,58,237,0.15),transparent)]"></div>
    </div>

    <canvas id="confetti-canvas" aria-hidden="true" class="pointer-events-none fixed inset-0 z-50 h-full w-full"></canvas>

    <x-theme-toggle class="standalone-only fixed top-5 right-5 z-40 bg-white/70 backdrop-blur dark:bg-white/[0.03]" />

    <main class="relative z-10 flex min-h-dvh flex-col items-center justify-center px-6 py-24 text-center">

        {{-- Logo tile (click it — the confetti fires again) --}}
        <button type="button" id="logo-tile" aria-label="Celebrate again" class="welcome-rise group flex size-12 cursor-pointer items-center justify-center transition-transform duration-300 ease-out hover:scale-105 active:scale-95">
            <x-logo-icon class="h-7 text-neutral-900 transition-transform duration-500 ease-out group-hover:rotate-12 dark:text-white" />
        </button>

        {{-- Live status pill --}}
        <div class="welcome-rise mt-8 inline-flex items-center gap-2 rounded-full border border-neutral-200 bg-white/80 py-1 pr-3.5 pl-2.5 backdrop-blur dark:border-white/10 dark:bg-white/[0.04]" style="animation-delay: 60ms">
            <span class="relative flex size-2">
                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-60"></span>
                <span class="relative inline-flex size-2 rounded-full bg-emerald-500"></span>
            </span>
            <span class="font-mono text-xs text-neutral-600 dark:text-neutral-400">{{ request()->getHost() }}</span>
            <span class="text-xs text-neutral-400 dark:text-neutral-500">is live</span>
        </div>

        <h1 class="welcome-rise mt-6 max-w-2xl text-4xl leading-[1.08] font-medium tracking-tight text-balance text-neutral-900 sm:text-5xl dark:text-white" style="animation-delay: 120ms">
            Welcome to your new&nbsp;app.
        </h1>

        <p class="welcome-rise mt-5 max-w-xl text-lg text-pretty text-neutral-600 dark:text-neutral-400" style="animation-delay: 180ms">
            The foundation is done — authentication, billing, profiles, and notifications are
            wired and waiting. Now for the part only you can build.
        </p>

        {{-- Standalone: send them to the builder. Embedded: they're already there. --}}
        <div class="standalone-only welcome-rise mt-9 flex flex-col items-center gap-3 sm:flex-row" style="animation-delay: 240ms">
            <x-button type="a" href="{{ config('platform.builder_url') }}" size="xl" class="group font-semibold shadow-[0_8px_24px_-8px_rgba(0,0,0,0.4)] dark:shadow-[0_8px_24px_-8px_rgba(255,255,255,0.25)]">
                Start building
                <svg class="size-4 transition-transform duration-200 group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6l6 6-6 6" /></svg>
            </x-button>
            <x-button type="a" :href="route('dashboard')" variant="outline" size="xl" class="font-semibold shadow-sm">
                Open dashboard
            </x-button>
        </div>

        <p class="standalone-only welcome-rise mt-5 text-xs text-neutral-400 dark:text-neutral-500" style="animation-delay: 300ms">
            or press
            <kbd class="mx-0.5 inline-flex h-5 min-w-5 items-center justify-center rounded-md border border-neutral-200 bg-neutral-50 px-1 font-mono text-[11px] font-medium text-neutral-500 dark:border-white/10 dark:bg-white/[0.06] dark:text-neutral-400">B</kbd>
            to open the builder
        </p>

        <div class="embedded-only welcome-rise mt-9 items-center gap-2.5 rounded-full border border-violet-200 bg-violet-50 py-2 pr-4 pl-3 dark:border-violet-500/20 dark:bg-violet-500/10" style="animation-delay: 240ms">
            <svg class="size-4 text-violet-500 dark:text-violet-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z" /></svg>
            <span class="text-sm text-violet-700 dark:text-violet-300">You're in the builder — describe your idea in the chat to start shaping this app.</span>
        </div>

        {{-- What's already on --}}
        <div class="welcome-rise mt-16" style="animation-delay: 360ms">
            <p class="text-[11px] font-semibold tracking-[0.14em] text-neutral-400 uppercase dark:text-neutral-500">Included &amp; ready</p>
            <ul class="mt-4 flex max-w-lg flex-wrap items-center justify-center gap-2">
                @foreach (['Authentication', 'Billing', 'Profiles', 'Notifications', 'Blog', 'Changelog'] as $feature)
                    <li class="inline-flex items-center gap-1.5 rounded-full border border-neutral-200 bg-white px-3 py-1 text-xs text-neutral-600 dark:border-white/10 dark:bg-white/[0.03] dark:text-neutral-400">
                        <svg class="size-3 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        {{ $feature }}
                    </li>
                @endforeach
            </ul>
        </div>
    </main>

    <footer class="standalone-only fixed inset-x-0 bottom-6 z-10 justify-center">
        <p class="text-center text-xs text-neutral-400 dark:text-neutral-600">Built on the DevDojo Platform</p>
    </footer>

    <script>
        (function () {
            /* ------------------------------------------------------------------
             * Confetti — a small, dependency-free canvas celebration.
             * Fires once when the page settles; the logo tile replays it.
             * ------------------------------------------------------------------ */
            var canvas = document.getElementById('confetti-canvas');
            var context = canvas.getContext('2d');
            var particles = [];
            var animationFrame = null;
            var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            function sizeCanvas() {
                var ratio = Math.min(window.devicePixelRatio || 1, 2);
                canvas.width = window.innerWidth * ratio;
                canvas.height = window.innerHeight * ratio;
                context.setTransform(ratio, 0, 0, ratio, 0, 0);
            }

            function palette() {
                var dark = document.documentElement.classList.contains('dark');

                return ['#7c3aed', '#0ea5e9', '#10b981', '#f59e0b', '#f43f5e', dark ? '#fafafa' : '#171717'];
            }

            function burst(originX, originY, angle, spread, count, power) {
                var colors = palette();

                for (var i = 0; i < count; i++) {
                    var direction = (angle + (Math.random() - 0.5) * spread) * (Math.PI / 180);
                    var velocity = power * (0.5 + Math.random() * 0.75);

                    particles.push({
                        x: originX,
                        y: originY,
                        vx: Math.cos(direction) * velocity,
                        vy: -Math.sin(direction) * velocity,
                        width: 5 + Math.random() * 5,
                        height: 8 + Math.random() * 6,
                        color: colors[(Math.random() * colors.length) | 0],
                        rotation: Math.random() * Math.PI,
                        spin: (Math.random() - 0.5) * 0.3,
                        wobble: Math.random() * Math.PI * 2,
                        life: 0,
                        maxLife: 110 + Math.random() * 60,
                        round: Math.random() < 0.25,
                    });
                }

                if (! animationFrame) {
                    animationFrame = requestAnimationFrame(tick);
                }
            }

            function tick() {
                context.clearRect(0, 0, window.innerWidth, window.innerHeight);

                particles = particles.filter(function (p) {
                    p.life++;
                    p.vy += 0.32;
                    p.vx *= 0.985;
                    p.vy *= 0.985;
                    p.x += p.vx + Math.sin(p.wobble += 0.08);
                    p.y += p.vy;
                    p.rotation += p.spin;

                    if (p.life > p.maxLife || p.y > window.innerHeight + 40) {
                        return false;
                    }

                    var fade = p.life > p.maxLife * 0.65
                        ? 1 - (p.life - p.maxLife * 0.65) / (p.maxLife * 0.35)
                        : 1;

                    context.save();
                    context.globalAlpha = Math.max(fade, 0);
                    context.translate(p.x, p.y);
                    context.rotate(p.rotation);
                    context.fillStyle = p.color;

                    if (p.round) {
                        context.beginPath();
                        context.arc(0, 0, p.width / 2, 0, Math.PI * 2);
                        context.fill();
                    } else {
                        context.fillRect(-p.width / 2, -p.height / 2, p.width, p.height * Math.abs(Math.cos(p.wobble)));
                    }

                    context.restore();

                    return true;
                });

                animationFrame = particles.length ? requestAnimationFrame(tick) : null;
            }

            function celebrate() {
                if (reducedMotion) {
                    return;
                }

                var w = window.innerWidth;
                var h = window.innerHeight;

                burst(w * 0.08, h * 0.92, 62, 55, 90, 19);
                burst(w * 0.92, h * 0.92, 118, 55, 90, 19);
                setTimeout(function () { burst(w * 0.5, h * 0.62, 90, 100, 70, 14); }, 180);
            }

            sizeCanvas();
            window.addEventListener('resize', sizeCanvas);
            window.setTimeout(celebrate, 400);
            document.getElementById('logo-tile').addEventListener('click', celebrate);

            /* Press B (standalone only) to jump into the builder. */
            var embedded = document.documentElement.classList.contains('is-embedded');

            document.addEventListener('keydown', function (event) {
                if (embedded || event.metaKey || event.ctrlKey || event.altKey) {
                    return;
                }

                var target = event.target;

                if (target && (target.tagName === 'INPUT' || target.tagName === 'TEXTAREA' || target.isContentEditable)) {
                    return;
                }

                if (event.key === 'b' || event.key === 'B') {
                    window.location.href = @js(config('platform.builder_url'));
                }
            });
        })();
    </script>
</body>
</html>
