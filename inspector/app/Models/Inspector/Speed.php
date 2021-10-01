<?php

namespace App\Models\Inspector;

use App\Models\BaseModel;

class Speed extends BaseModel
{
    protected $fillable = [
        'site_id',
        'time',
        'count_js',
        'count_сss',
        'count_images',
        'count_css_images',
        'weight_page',
        'weight_js',
        'weight_сss',
        'weight_images',
        'weight_css_images'
    ];
}
