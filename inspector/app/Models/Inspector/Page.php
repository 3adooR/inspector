<?php

namespace App\Models\Inspector;

use App\Models\BaseModel;

class Page extends BaseModel
{
    protected $fillable = [
        'site_id',
        'parent',
        'code',
        'title',
        'description',
        'keywords',
        'h1',
        'parsed'
    ];

    protected $hidden = [
        'parsed'
    ];
}
