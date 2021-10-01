<?php

namespace App\Services\Routes\Providers\Sites;

use App\Http\Controllers\Sites\SitesCreateController;
use App\Http\Controllers\Sites\SitesDeleteController;
use App\Http\Controllers\Sites\SitesIndexController;
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\Localisation;
use Illuminate\Support\Facades\Route;

class SitesRoutesProvider
{
    public function registerRoutes(): void
    {
        Route::group([
            'prefix' => '{lang}/sites',
            'middleware' => [
                CheckLogin::class,
                Localisation::class
            ]
        ], function () {
            Route::get('/', SitesIndexController::class)->name(SitesRoutes::ROUTE_SITES_INDEX);
            Route::post('/create', SitesCreateController::class)->name(SitesRoutes::ROUTE_SITES_CREATE);
            Route::get('/delete/{id}', SitesDeleteController::class)->name(SitesRoutes::ROUTE_SITES_DELETE);
        });
    }
}
