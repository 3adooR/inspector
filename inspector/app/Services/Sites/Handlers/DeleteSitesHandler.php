<?php

namespace App\Services\Sites\Handlers;

use App\Services\Sites\Repositories\SitesRepository;

class DeleteSitesHandler
{
    private $repository;

    public function __construct(SitesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle($id): int
    {
        return $this->repository->delete($id);
    }
}
