<?php

namespace App\Jobs;

use App\Models\Inspector\Site;
use App\Services\Inspector\MenuService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class InspectSiteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var MenuService */
    private MenuService $menuService;

    /** @var Site */
    private Site $site;

    /**
     * Inspect site job instance.
     * @param Site $site
     */
    public function __construct(Site $site)
    {
        $this->site = $site;
        $this->menuService = new MenuService;
    }

    /**
     * Запускаем все аудиты по очереди
     * Каждый аудит - отдельная задача в очереди
     * @return void
     */
    public function handle(): void
    {
        $menu = $this->menuService->getMenuNames();
        foreach ($menu as $menuName => $menuTitle) {
            AuditJob::dispatch($this->site, $menuName)->onQueue(Queues::AUDIT_QUEUE);
        }
    }
}
