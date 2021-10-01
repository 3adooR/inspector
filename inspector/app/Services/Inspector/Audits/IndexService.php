<?php

namespace App\Services\Inspector\Audits;

use App\Services\Inspector\InspectorService;

class IndexService extends InspectorService
{
    public function result(): string
    {
        $this->viewData = [];
        return parent::result();
    }
}
