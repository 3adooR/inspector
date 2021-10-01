<?php

namespace App\Services\Auth\Handlers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutAuthHandler
{
    public function handle(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
