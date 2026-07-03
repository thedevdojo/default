<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class StatusController extends Controller
{
    /**
     * Report this app's identity and capabilities to the platform builder.
     */
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'name' => config('app.name'),
            'environment' => app()->environment(),
            'laravel' => app()->version(),
            'php' => PHP_VERSION,
            'features' => config('foundation.features'),
            'time' => now()->toIso8601String(),
        ]);
    }
}
