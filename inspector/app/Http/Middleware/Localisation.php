<?php

namespace App\Http\Middleware;

use App\Services\LocalisationService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class Localisation
{
    /**
     * @var LocalisationService
     */
    private LocalisationService $localisationService;

    /**
     * Localisation constructor.
     * @param LocalisationService $localisation
     */
    public function __construct(LocalisationService $localisationService)
    {
        $this->localisationService = $localisationService;
    }

    /**
     * Localisation
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $this->localisationService->getLocale($request);
        if (!$this->localisationService->isValid($locale)) {
            abort(404);
        }
        $this->localisationService->setLocale($locale);
        View::share(['lang' => $locale]);
        return $next($request);
    }
}
