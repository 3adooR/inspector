<?php

namespace App\Services\Routes\Providers;

use App\Http\Controllers\AppController;
use App\Http\Controllers\Auth\AuthLoginController;
use App\Http\Controllers\Auth\AuthLogoutController;
use App\Http\Middleware\Localisation;
use Illuminate\Support\Facades\Route;

class BaseRoutesProvider
{
    public function registerRoutes(): void
    {
        Route::post('/app-login', AuthLoginController::class)
            ->name(BaseRoutes::ROUTE_LOGIN);

        Route::get('/app-logout', AuthLogoutController::class)
            ->name(BaseRoutes::ROUTE_LOGOUT);

        Route::get('/{lang?}', AppController::class)
            ->name(BaseRoutes::ROUTE_INDEX)
            ->middleware(Localisation::class);
    }
}
