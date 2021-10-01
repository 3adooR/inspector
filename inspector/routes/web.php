<?php

use App\Services\Routes\Providers\BaseRoutesProvider;
use App\Services\Routes\Providers\Sites\SitesRoutesProvider;
use App\Services\Routes\Providers\Inspector\InspectorRoutesProvider;

/** Web Routes **/
app(BaseRoutesProvider::class)->registerRoutes();
app(SitesRoutesProvider::class)->registerRoutes();
app(InspectorRoutesProvider::class)->registerRoutes();

require __DIR__ . '/auth.php';
