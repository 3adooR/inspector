<?php

namespace App\Services\Inspector\Audits;

use App\Services\Inspector\InspectorService;

class InfoService extends InspectorService
{
    public function result(): string
    {
        $this->viewData = ['site' => $this->site];
        return parent::result();
    }
}
