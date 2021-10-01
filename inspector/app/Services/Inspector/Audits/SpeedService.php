<?php

namespace App\Services\Inspector\Audits;

use App\Models\Inspector\Speed;
use App\Services\Inspector\InspectorService;

class SpeedService extends InspectorService
{
    public function __construct()
    {
        $this->model = new Speed;
    }

    public function result(): string
    {
        $this->viewData = [];
        return parent::result();
    }
}
