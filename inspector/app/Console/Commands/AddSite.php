<?php

namespace App\Console\Commands;

use App\Services\Sites\SitesService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class AddSite extends Command
{
    /** @var string The name and signature of the console command */
    protected $signature = 'add-site {url?* : URL (string or array) of new site(s)}';

    /** @var string The console command description */
    protected $description = 'Add site(s) to DB';

    /** @var SitesService */
    private SitesService $sitesService;

    /**
     * Instance
     * @param SitesService $sitesService
     */
    public function __construct(SitesService $sitesService)
    {
        parent::__construct();
        $this->sitesService = $sitesService;
    }

    /**
     * Add new site to DB and cache all
     * @return void
     */
    public function handle(): void
    {
        $this->addSite();
    }

    /**
     * Main logic to adding the new site to DB
     * @param bool $useUrlFromArguments
     */
    private function addSite(bool $useUrlFromArguments = true): void
    {
        // Get URL
        $url = $this->getUrl($useUrlFromArguments);
        if (empty($url)) {
            $this->error('Указан пустой URL сайта');
            return;
        }

        // Validate and add
        if (is_array($url)) {
            foreach ($url as $urlVal) {
                $this->validateAndAdd($urlVal);
            }
        } else {
            $this->validateAndAdd($url);
        }

        // Add more?
        if ($this->confirm('Добавить ещё?', true)) {
            $this->addSite(false);
        } else {
            $this->info('Bye bye!');
        }
    }

    /**
     * Add protocol, validate and add site
     * @param string $url
     */
    private function validateAndAdd(string $url)
    {
        // Add protocol
        $url = $this->addProtocolIfEmpty($url);

        // Validate
        $validator = Validator::make(
            ['url' => $url],
            ['url' => 'required|string|url']
        );
        if ($validator->fails()) {
            foreach (collect($validator->errors()) as $messages) {
                foreach ($messages as $error) {
                    $this->error($error);
                }
            }
            return;
        }

        // Add
        $this->addUrl($url);
    }

    /**
     * Get URL from argument OR ask it
     * @param bool $useUrlFromArguments
     * @return array|string
     */
    private function getUrl(bool $useUrlFromArguments = true)
    {
        if ($useUrlFromArguments) {
            $url = $this->argument('url');
        }
        if (empty($url)) {
            $url = $this->ask('Введите URL сайта');
        }
        if (!is_array($url)) {
            $url = trim($url);
        } else {
            foreach ($url as $urlKey => $urlVal) {
                $url[$urlKey] = trim($urlVal);
            }
        }
        return $url;
    }

    /**
     * Add protocol HTTP if it's empty
     * @param string $url
     * @return string
     */
    private function addProtocolIfEmpty(string $url): string
    {
        if (!stristr($url, '://')) {
            $url = 'http://' . $url;
        }
        return $url;
    }

    /**
     * Add site to DB
     * @param string $url
     */
    private function addUrl(string $url)
    {
        $site = $this->sitesService->getSiteDataByURL($url);
        if (!empty($site['error'])) {
            $this->error($site['error']);
            return;
        }

        if (empty($site) || !$this->sitesService->create($site)) {
            $this->error('Не верно указан URL сайта');
        } else {
            $this->info('Сайт "' . $site['host'] . '" успешно добавлен в БД');
        }
    }
}
