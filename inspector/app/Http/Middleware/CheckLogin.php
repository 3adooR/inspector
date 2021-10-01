<?php

namespace App\Http\Middleware;

use App\Services\Routes\Providers\BaseRoutes;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect(route(BaseRoutes::ROUTE_INDEX));
        }
        return $next($request);
    }
}
