@props(['title' => 'Dashboard'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head', ['title' => $title])
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

    {{-- Loads Livewire's bundled Alpine.js so the <x-dropdown> components work,
         even though this page has no Livewire components. --}}
    @livewireScripts
</body>
</html>
