<?php

namespace App\Http\Controllers\Inspector;

use App\Http\Controllers\Controller;
use App\Models\Inspector\Site;
use App\Services\Inspector\AuditServices;
use App\Services\Inspector\MenuService;
use App\Services\LogService;
use Illuminate\Support\Facades\Cache;

class InspectorController extends Controller
{
    /** @var MenuService */
    private MenuService $menuService;

    /** @var LogService */
    private LogService $logger;

    /** @var string */
    public string $currentMenuItem = 'info';

    /** @var */
    public $site;

    public function __construct(
        MenuService $menuService,
        LogService $logger
    )
    {
        $this->menuService = $menuService;
        $this->logger = $logger;
    }

    /**
     * Страница аудитов сайта
     * @param int $siteID
     * @param string $menu
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(int $siteID, string $menu = '')
    {
        $this->setSite($siteID);
        $this->setCurrentMenu($menu);
        return view('layouts.inspector', [
            'menu' => $this->menuService->setMenu(),
            'currentMenu' => [
                'name' => $this->currentMenuItem,
                'icon' => $this->menuService->getMenuIcon($this->currentMenuItem),
                'title' => $this->menuService->getMenuName($this->currentMenuItem),
                'next' => $this->menuService->getNextMenuName($this->currentMenuItem),
            ],
            'siteID' => $siteID,
            'site' => $this->site,
            'content' => $this->getContent($this->currentMenuItem)
        ]);
    }

    /**
     * Установка текущего сайта
     * @param int $siteID
     */
    private function setSite(int $siteID)
    {
        $this->site = Cache::get('site-' . $siteID);
        if (!$this->site) {
            $this->site = Site::findOrFail($siteID);
            Cache::put('site-' . $siteID, $this->site, env('CACHE_TTL'));
        }
    }

    /**
     * Установка текущего пункта меню (аудита)
     * @param $menu
     */
    private function setCurrentMenu(string $menu)
    {
        if (!empty($menu)) {
            $this->currentMenuItem = $menu;
        }
    }

    /**
     * Информация текущего аудита
     * @param string $menu
     * @return string
     */
    private function getContent(string $menu): string
    {
        $service = (new AuditServices)->getServiceByName($menu);
        $service->site = $this->site;
        $service->viewName = $menu;
        if (!$service->hasResult()) {
            $service->inspect();
            $this->logger->add($this->site->host . ' (id:' . $this->site->id . ') ' . mb_strtoupper($menu) . ' audit is done');
        }
        return $service->result();
    }
}
