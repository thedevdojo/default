<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="platform-builder-url" content="{{ config('platform.builder_url') }}">
<title>{{ $title ?? config('app.name') }}</title>

{{-- Apply the saved theme before first paint to avoid a flash of the wrong mode,
     and expose a global toggle used by the <x-theme-toggle> component. --}}
<script>
    (function () {
        // Flag embedded rendering (builder canvas) before first paint so pages
        // can swap standalone-only chrome without a flash.
        if (window.self !== window.top) {
            document.documentElement.classList.add('is-embedded');
        }

        try {
            var stored = localStorage.getItem('theme');
            var dark = stored === null
                ? window.matchMedia('(prefers-color-scheme: dark)').matches
                : stored === 'dark';
            document.documentElement.classList.toggle('dark', dark);
            document.documentElement.style.colorScheme = dark ? 'dark' : 'light';
        } catch (e) {}

        window.toggleTheme = function () {
            var dark = !document.documentElement.classList.contains('dark');
            document.documentElement.classList.toggle('dark', dark);
            document.documentElement.style.colorScheme = dark ? 'dark' : 'light';
            try {
                localStorage.setItem('theme', dark ? 'dark' : 'light');
            } catch (e) {}
        };
    })();
</script>

@if (config('platform.runtime'))
    {{-- Inside the platform's browser runtime, Tailwind compiles in the
         browser from the live resources/css/app.css — so classes and design
         tokens the AI writes style instantly, with no asset build. The JS
         bundle stays on Vite: it carries the builder bridge, and Livewire
         ships its own Alpine (a CDN copy would double-register it). --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    {!! App\Support\PlatformRuntimeCss::styleTags() !!}
    @vite(['resources/js/app.js'])
@else
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endif
