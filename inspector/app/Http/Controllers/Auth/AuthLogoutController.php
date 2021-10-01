<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;
use App\Services\Routes\Providers\BaseRoutes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AuthLogoutController extends Controller
{
    /**
     * @param Request $request
     * @param AuthService $authService
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function __invoke(
        Request $request,
        AuthService $authService
    )
    {
        $authService->logout($request);
        return redirect(route(BaseRoutes::ROUTE_INDEX, App::getLocale()));
    }
}
