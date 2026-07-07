<?php

use function Laravel\Folio\name;

name('home');

?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head', ['title' => 'Welcome — '.config('app.name')])

    <style>
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
<body class="antialiased">

    <canvas id="confetti-canvas" aria-hidden="true" class="pointer-events-none fixed inset-0 z-50 h-full w-full"></canvas>

    <div class="flex items-center justify-center w-screen h-screen bg-black">
        <div class="welcome-rise relative flex flex-col justify-center py-6 sm:py-12">
            <div class="relative px-6 pt-8 bg-black shadow-xl pb-9 ring-1 ring-gray-200/[15%] sm:mx-auto sm:max-w-md sm:rounded-2xl sm:px-10">
                <div class="absolute top-0 right-0 w-full h-px -translate-y-px opacity-100 bg-gradient-to-r from-transparent via-white/30 to-transparent"></div>
                <div class="absolute bottom-0 left-0 w-full h-px translate-y-px opacity-100 bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>

                <div class="max-w-md mx-auto">
                    {{-- Logo (click it — the confetti fires again) --}}
                    <div class="flex items-center justify-center w-full h-auto py-2">
                        <button type="button" id="logo-tile" aria-label="Celebrate again" class="flex items-center justify-center transition-transform duration-300 ease-out cursor-pointer hover:scale-105 active:scale-95">
                            <span class="flex items-center justify-center size-9">
                                <x-logo-icon class="text-white!" />
                            </span>
                        </button>
                    </div>

                    <div class="relative flex flex-col items-center">
                        <h1 class="text-white pt-3.5 font-medium text-2xl">Welcome to your New App</h1>
                        <div class="pt-2 text-balance space-y-6 text-sm font-light leading-5 text-center text-white/60">
                            <p>Loaded with auth, billing, profiles, notifications, and more. <a href="/docs" target="_blank" class="hover:underline text-white/70 hover:text-white font-normal">Click here to learn more</a>.</p>
                        </div>


                        <div class="flex items-center w-full pt-7 text-xs font-normal leading-7">
                            <p class="w-1/2 text-center flex items-center justify-center pr-2.5">
                                <a href="{{ config('platform.builder_url') }}" target="_blank" rel="noopener" class="flex items-center justify-center w-full px-3 py-1 space-x-1 border rounded-lg text-neutral-200 hover:bg-white/5 border-white/20 hover:text-white group">
                                    <span>Start Building</span>
                                    <span class="block duration-300 ease-out group-hover:translate-x-1">→</span>
                                </a>
                            </p>
                            <p class="w-1/2 text-center flex items-center justify-center pl-2.5">
                                <a href="https://static.devdojo.com" target="_blank" rel="noopener" class="flex items-center justify-center w-full px-3 py-1 space-x-1 border rounded-lg bg-neutral-100 hover:bg-white text-neutral-800 border-white/20 hover:text-neutral-900 group">
                                    <span>View Docs</span>
                                    <span class="block duration-300 ease-out group-hover:translate-x-1">→</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
            var lastFrameAt = null;
            var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            function sizeCanvas() {
                var ratio = Math.min(window.devicePixelRatio || 1, 2);
                canvas.width = window.innerWidth * ratio;
                canvas.height = window.innerHeight * ratio;
                context.setTransform(ratio, 0, 0, ratio, 0, 0);
            }

            function palette() {
                return ['#7c3aed', '#0ea5e9', '#10b981', '#f59e0b', '#f43f5e', '#fafafa'];
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

            function tick(now) {
                /* Physics are tuned as per-frame steps at 60fps. Scale each step
                   by real elapsed time so a busy main thread (the WASM runtime
                   booting, say) drops the frame rate — not the confetti's speed. */
                if (lastFrameAt === null) {
                    lastFrameAt = now;
                }
                var dt = Math.min((now - lastFrameAt) / (1000 / 60), 4);
                lastFrameAt = now;

                context.clearRect(0, 0, window.innerWidth, window.innerHeight);

                particles = particles.filter(function (p) {
                    p.life += dt;
                    p.vy += 0.32 * dt;
                    p.vx *= Math.pow(0.985, dt);
                    p.vy *= Math.pow(0.985, dt);
                    p.x += (p.vx + Math.sin(p.wobble += 0.08 * dt)) * dt;
                    p.y += p.vy * dt;
                    p.rotation += p.spin * dt;

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

                if (! animationFrame) {
                    lastFrameAt = null;
                }
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
            window.setTimeout(celebrate, 350);
            document.getElementById('logo-tile').addEventListener('click', celebrate);
        })();
    </script>
</body>
</html>
