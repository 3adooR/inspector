<?php

namespace App\Models\Inspector;

use App\Models\BaseModel;

class Code extends BaseModel
{
    protected $fillable = [
        'site_id',
        'valid',
        'errors',
        'warnings',
        'result'
    ];
}
