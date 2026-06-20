<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $title ?? config('app.name') }}</title>

{{-- Apply the saved theme before first paint to avoid a flash of the wrong mode,
     and expose a global toggle used by the <x-theme-toggle> component. --}}
<script>
    (function () {
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

@vite(['resources/css/app.css', 'resources/js/app.js'])
