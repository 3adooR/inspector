<?php

namespace App\Console\Commands;

use App\Services\Sites\Repositories\SitesRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CacheSites extends Command
{
    /** @var string The name and signature of the console command */
    protected $signature = 'cache-sites';

    /** @var string The console command description */
    protected $description = 'Make cache of sites in DB';

    /** @var SitesRepository */
    private SitesRepository $sitesRepository;

    /**
     * Instance.
     * @param SitesRepository $sitesRepository
     */
    public function __construct(SitesRepository $sitesRepository)
    {
        parent::__construct();
        $this->sitesRepository = $sitesRepository;
    }

    /**
     * Cache sites
     * @return void
     */
    public function handle(): void
    {
        Cache::forget('sites');
        $this->line('<fg=magenta>Sites cache cleared!</>');
        $this->sitesRepository->cache();
        if (Cache::get('sites')) {
            $this->line('<fg=green>Sites cache made successfully!</>');
        } else {
            $this->line('<fg=red>Sites cache is empty!</>');
        }
    }
}
