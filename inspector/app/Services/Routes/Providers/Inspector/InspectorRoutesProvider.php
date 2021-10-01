<?php

namespace App\Services\Routes\Providers\Inspector;

use App\Http\Controllers\Inspector\InspectorController;
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\Localisation;
use Illuminate\Support\Facades\Route;

class InspectorRoutesProvider
{
    public function registerRoutes(): void
    {
        Route::group([
            'prefix' => '{lang}/inspect',
            'middleware' => [
                CheckLogin::class,
                Localisation::class
            ]
        ], function () {
            Route::get('/{id}/{menu?}', [
                InspectorController::class,
                'index'
            ])->name(InspectorRoutes::ROUTE_INSPECTOR_INDEX);
        });
    }
}
