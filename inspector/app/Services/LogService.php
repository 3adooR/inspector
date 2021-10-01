<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Log;

class LogService
{
    protected $userID = 0;
    protected $userIP = '';

    public function add(string $message, string $type = 'notice')
    {
        $this->userID = Auth::id();
        $this->userIP = Request::ip();
        $message = 'UID: ' . $this->userID
            . '; IP: ' . $this->userIP
            . '; ' . mb_strtoupper($type) . ': ' . $message;
        switch ($type) {
            case 'warning':
                Log::warning($message);
                break;
            case 'error':
                Log::error($message);
                break;
            case 'alert':
                Log::alert($message);
                break;
            default:
                Log::notice($message);
        }
    }
}
