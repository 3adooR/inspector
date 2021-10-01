<?php

namespace App\Models\Inspector;

use App\Models\BaseModel;

class Site extends BaseModel
{
    protected $fillable = [
        'host',
        'https'
    ];

    public function domain()
    {
        $this->hasOne(Domain::class);
    }

    public function server()
    {
        $this->hasOne(Server::class);
    }

    public function code()
    {
        $this->hasOne(Code::class);
    }

    public function speed()
    {
        $this->hasOne(Speed::class);
    }

    public function pages()
    {
        $this->hasMany(Page::class);
    }
}
