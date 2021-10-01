<?php

namespace App\Jobs;

use App\Models\Inspector\Site;
use App\Services\Inspector\AuditServices;
use App\Services\LogService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AuditJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var Site */
    private Site $site;

    /** @var string */
    private string $audit;

    /**
     * Create a new job instance.
     * @param Site $site
     * @param string $audit
     */
    public function __construct(
        Site $site,
        string $audit
    )
    {
        $this->site = $site;
        $this->audit = $audit;
    }

    /**
     * Запускаем указанный аудит сайта
     * @return void
     */
    public function handle(): void
    {
        $service = $this->getAuditServices()->getServiceByName($this->audit);
        $service->site = $this->site;
        if (!$service->hasResult()) {
            $service->inspect();
            $this->getLogServices()->add($this->site->host . ' (id:' . $this->site->id . ') ' . mb_strtoupper($this->audit) . ' audit is done');
        }
    }

    /**
     * Audit service
     * @return AuditServices
     */
    private function getAuditServices(): AuditServices
    {
        return app(AuditServices::class);
    }

    /**
     * Log service
     * @return LogService
     */
    private function getLogServices(): LogService
    {
        return app(LogService::class);
    }
}
