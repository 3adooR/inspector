<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->info();
        return view('layouts.home', [
            'isLogin' => Auth::check()
        ]);
    }

    /**
     * Вывод информацию в консоль о версии PHP и драйвере сессий
     */
    private function info()
    {
        $this->debug('PHP: ' . phpversion());
        $this->debug('session driver ' . env('SESSION_DRIVER'));
    }
}
