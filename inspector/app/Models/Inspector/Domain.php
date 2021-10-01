<?php

namespace App\Models\Inspector;

use App\Models\BaseModel;

class Domain extends BaseModel
{
    protected $fillable = [
        'site_id',
        'data'
    ];
}
