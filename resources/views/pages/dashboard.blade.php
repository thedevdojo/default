<?php

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;

middleware('auth');
name('dashboard');

?>

<x-layouts.dashboard :title="'Dashboard — '.config('app.name')">
    <div class="flex min-h-[calc(100dvh-160px)] flex-col items-center justify-center">
        <x-elements.empty-state />
    </div>
</x-layouts.dashboard>
