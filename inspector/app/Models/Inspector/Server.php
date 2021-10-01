<?php

namespace App\Models\Inspector;

use App\Models\BaseModel;

class Server extends BaseModel
{
    protected $fillable = [
        'site_id',
        'ip',
        'lat',
        'long',
        'data'
    ];
}
