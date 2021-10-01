<?php

namespace App\Services\Auth\Handlers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class LoginAuthHandler
{
    /**
     * Авторизация по ключу
     * @param Request $request
     * @param string $accessKey
     * @return bool
     */
    public function handle(Request $request, string $accessKey): bool
    {
        $result = false;
        if ($this->checkKey($accessKey)) {
            $md5key = md5($accessKey);
            $user = $this->setUserByKey($md5key);
            if ($user) {
                Auth::login($user, true);
                $result = true;
            }
        }
        return $result;
    }

    /**
     * Отправка запроса в CRM для авторизации
     * @param string $accessKey
     * @return bool
     */
    private function checkKey(string $accessKey): bool
    {
        $url = env('CRM_ACCESS_URL');
        if (empty($url)) {
            abort(500, 'В .env файле не указан параметр CRM_ACCESS_URL');
        }
        $response = Http::get(
            env('CRM_ACCESS_URL'),
            [
                'key' => $accessKey,
                'from' => config('app.url'),
            ]
        );
        return $response->body() === 'ok';
    }

    /**
     * Возвращает существующего или нового пользователя по ключу
     * @param string $md5key
     * @return mixed
     */
    private function setUserByKey(string $md5key)
    {
        $user = User::firstOrNew(['name' => $md5key]);
        $user->email = Str::random(16) . '@mediart.pro';
        $user->password = Str::random(16);
        $user->save();
        return $user;
    }
}
