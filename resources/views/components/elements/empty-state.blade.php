<div class="flex flex-col items-center justify-center py-5 text-center">
    <img src="{{ asset('images/empty.png') }}" alt="No projects" class="mb-6 -ml-9 block h-56 w-auto opacity-60 dark:hidden">
    <img src="{{ asset('images/empty-dark.png') }}" alt="No projects" class="mb-6 -ml-9 hidden h-56 w-auto opacity-60 dark:block">

    <h3 class="text-base font-semibold text-neutral-900 dark:text-white">No projects created yet</h3>
    <p class="mt-2 max-w-lg text-balance text-sm text-neutral-500 dark:text-neutral-400">
        Create your first project. Connect your DigitalOcean account and it'll be live in under 2 minutes.
    </p>

    <x-button type="a" href="#" size="xl" class="mt-6 font-semibold">
        Create Your First Project
    </x-button>
</div>
