<?php


namespace App\Services\Sites;

use App\Jobs\InspectSiteJob;
use App\Jobs\Queues;
use App\Models\Inspector\Site;
use App\Services\Sites\Handlers\CreateSitesHandler;
use App\Services\Sites\Handlers\DeleteSitesHandler;
use App\Services\Sites\Repositories\SitesRepository;
use Illuminate\Support\Facades\Http;
use Spatie\Url\Url;
use Exception;

class SitesService
{
    /** @var SitesRepository * */
    private SitesRepository $repository;

    /** @var CreateSitesHandler * */
    private CreateSitesHandler $createHandler;

    /** @var DeleteSitesHandler * */
    private DeleteSitesHandler $deleteHandler;

    /**
     * SitesService constructor.
     * @param SitesRepository $repository
     * @param CreateSitesHandler $createHandler
     * @param DeleteSitesHandler $deleteHandler
     */
    public function __construct(
        SitesRepository $repository,
        CreateSitesHandler $createHandler,
        DeleteSitesHandler $deleteHandler
    )
    {
        $this->repository = $repository;
        $this->createHandler = $createHandler;
        $this->deleteHandler = $deleteHandler;
    }

    /**
     * Get ALL sites
     * @return Site[]|\Illuminate\Database\Eloquent\Collection
     */
    public function get()
    {
        return $this->repository->get();
    }

    /**
     * Формирование URL-адреса и получение данных сайта (HTTPS, HOST)
     * @param string $url
     * @return array
     */
    public function getSiteDataByURL(string $url): array
    {
        $data = [];
        $url = str_replace(['http://', 'https://'], '', $url);
        if (!stristr($url, '://')) {
            $url = 'http://' . $url;
        }
        try {
            ini_set("user_agent", "Mozilla custom agent");
            $headers = get_headers($url, true);
        } catch (Exception $e) {
            $data = ['error' => $e->getMessage()];
        }
        if (!empty($headers) && !empty($headers[0])) {
            $status = $headers[0];
            if ($status === 'HTTP/1.1 301 Moved Permanently') {
                $url = is_array($headers['Location']) ? $headers['Location'][1] : $headers['Location'];
            }
            $response = Http::get($url);
            if ($response->status() === 200) {
                $url = Url::fromString($url);
                $data = [
                    'host' => $url->getHost(),
                    'https' => ($url->getScheme() === 'https') ? 1 : 0
                ];
            }
        }
        return $data;
    }

    /**
     * Add new site
     * @param array $data
     * @return Site
     */
    public function create(array $data): Site
    {
        $site = $this->createHandler->handle($data);
        InspectSiteJob::dispatch($site)->onQueue(Queues::INSPECT_QUEUE);
        return $site;
    }

    /**
     * Delete site by ID
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return $this->deleteHandler->handle($id);
    }

}
