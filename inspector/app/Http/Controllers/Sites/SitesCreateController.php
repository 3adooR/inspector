<?php

namespace App\Http\Controllers\Sites;

use App\Services\Routes\Providers\Sites\SitesRoutes;
use App\Services\Sites\SitesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SitesCreateController
{
    public function __invoke(Request $request, SitesService $sitesService)
    {
        $siteUrl = $request->get('siteUrl');
        if (empty($siteUrl)) {
            return null;
        }

        $site = $sitesService->getSiteDataByURL($siteUrl);
        if (empty($site) || !$sitesService->create($site)) {
            return null;
        }

        return redirect(route(SitesRoutes::ROUTE_SITES_INDEX, App::getLocale()));
    }
}
