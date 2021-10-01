<?php

namespace App\Http\Controllers\Sites;

use App\Http\Controllers\Controller;
use App\Services\Sites\SitesService;
use Illuminate\Support\Facades\View;

class SitesIndexController extends Controller
{
    public function __invoke(SitesService $sitesService)
    {
        View::share(['sites' => $sitesService->get()]);
        return view('sites.index');
    }
}
