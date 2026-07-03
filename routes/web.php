<?php

use App\Http\Controllers\Platform\StatusController;
use App\Http\Middleware\AuthorizePlatformBridge;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Page routes live in resources/views/pages and are registered automatically
| by Laravel Folio. Add controller or closure based routes below as needed.
|
*/

Route::get('/platform/api/status', StatusController::class)
    ->middleware(AuthorizePlatformBridge::class)
    ->name('platform.status');
