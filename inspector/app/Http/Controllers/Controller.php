<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Barryvdh\Debugbar\Facade as Debug;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Вывод отладочной информации в DebugBar
     * @param $var
     * @param string $type
     */
    public static function debug($var, string $type = 'info')
    {
        switch ($type) {
            case 'error':
                Debug::error($var);
                break;
            case 'warning':
                Debug::warning($var);
                break;
            default:
                Debug::info($var);
        }
    }
}
