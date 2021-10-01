<?php

namespace App\Http\Controllers\Sites;

use App\Services\Routes\Providers\Sites\SitesRoutes;
use App\Services\Sites\SitesService;
use Illuminate\Support\Facades\App;

class SitesDeleteController
{
    public function __invoke(SitesService $sitesService, int $id)
    {
        $result = null;
        if (!$sitesService->delete($id)) {
            abort(404, __('app.site_not_found'));
        } else {
            $result = redirect(route(SitesRoutes::ROUTE_SITES_INDEX, App::getLocale()));
        }
        return $result;
    }
}
