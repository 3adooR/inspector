<?php

namespace App\Services\Sites\Handlers;

use App\Models\Inspector\Site;
use App\Services\Sites\Repositories\SitesRepository;

class CreateSitesHandler
{
    private $repository;

    public function __construct(SitesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(array $data): Site
    {
        return $this->repository->create($data);
    }
}
