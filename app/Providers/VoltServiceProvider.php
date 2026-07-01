<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Volt\FragmentAlias;
use Livewire\Volt\Volt;

class VoltServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Volt::mount([
            config('livewire.view_path', resource_path('views/livewire')),
            resource_path('views/pages'),
        ]);

        $this->alignVoltFragmentBasePath();
    }

    /**
     * Align Volt's @volt fragment-alias base path with every mounted Volt directory.
     *
     * Volt encodes @volt fragment aliases as paths relative to base_path(). The feature
     * packages in this project are symlinked in from outside the application root (e.g.
     * ~/Sites/platform-packages/*), and Folio resolves their real paths, so those pages
     * cannot be expressed relative to base_path(). Decoding then produces an invalid path
     * and Volt throws "Path must not be empty". Using the deepest directory shared by the
     * application root and all mounted Volt directories lets both in-app and external
     * fragments round-trip. When every directory already lives under base_path() this
     * resolves to base_path() itself, preserving the default behaviour.
     */
    protected function alignVoltFragmentBasePath(): void
    {
        $this->app->booted(function (): void {
            $directories = collect(Volt::paths())
                ->map(fn ($directory): string => realpath($directory->path) ?: $directory->path)
                ->push(base_path())
                ->all();

            if ($ancestor = $this->commonDirectory($directories)) {
                FragmentAlias::useBasePath($ancestor);
            }
        });
    }

    /**
     * Determine the deepest directory that contains all of the given paths.
     *
     * @param  array<int, string>  $paths
     */
    protected function commonDirectory(array $paths): ?string
    {
        if ($paths === []) {
            return null;
        }

        $segmented = array_map(
            fn (string $path): array => explode(DIRECTORY_SEPARATOR, rtrim($path, DIRECTORY_SEPARATOR)),
            $paths
        );

        $common = array_shift($segmented);

        foreach ($segmented as $segments) {
            $shared = [];

            foreach ($segments as $index => $segment) {
                if (($common[$index] ?? null) !== $segment) {
                    break;
                }

                $shared[] = $segment;
            }

            $common = $shared;
        }

        $directory = implode(DIRECTORY_SEPARATOR, $common);

        return $directory === '' ? DIRECTORY_SEPARATOR : $directory;
    }
}
