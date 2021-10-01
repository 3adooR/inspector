<?php

namespace App\Services\Sites\Repositories;

use App\Models\Inspector\Site;
use App\Services\LogService;
use Illuminate\Support\Facades\Cache;

class SitesRepository
{
    /** @var LogService */
    private LogService $logger;

    public function __construct(LogService $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Получение списка всех добавленных сайтов
     * @return Site[]|\Illuminate\Database\Eloquent\Collection
     */
    public function get()
    {
        $sites = Cache::get('sites');
        if (empty($sites)) {
            $sites = $this->cache();
        }
        return $sites;
    }

    /**
     * Добавление сайта в БД
     * @param array $data
     * @return Site
     */
    public function create(array $data): Site
    {
        $site = Site::firstOrCreate($data);
        $this->cache();
        $this->logger->add('Added site: ' . $site->host . ' (id:' . $site->id . ') ', 'alert');
        return $site;
    }

    /**
     * Удаление сайта из БД
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        $result = Site::destroy($id);
        $this->cache();
        $this->logger->add('Delete site id:' . $id, 'warning');
        return $result;
    }

    /**
     * Получение всего списка сайтов и кеширование его
     * @return Site[]|\Illuminate\Database\Eloquent\Collection
     */
    public function cache()
    {
        $sites = Site::all();
        Cache::put('sites', $sites, env('CACHE_TTL'));
        return $sites;
    }
}
