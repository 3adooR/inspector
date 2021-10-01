<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;
use App\Services\Routes\Providers\Sites\SitesRoutes;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class AuthLoginController extends Controller
{
    /** @var string - Ключ доступа */
    public $accessKey = '';

    /**
     * Получение ключа доступа и вызов авторизации
     * @param Request $request
     * @param AuthService $authService
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, AuthService $authService): \Illuminate\Http\JsonResponse
    {
        $code = Response::HTTP_UNAUTHORIZED;
        $result = ['success' => false];
        $this->accessKey = $request->get('key');
        $result['errors'] = $this->hasErrors();
        if (empty($result['errors'])) {
            if (!$authService->login($request, $this->accessKey)) {
                $result['errors'] = ['message' => __('app.access_denied')];
            } else {
                $code = Response::HTTP_ACCEPTED;
                $result = [
                    'success' => true,
                    'redirect' => route(SitesRoutes::ROUTE_SITES_INDEX, App::getLocale())
                ];
            }
        }
        return response()->json($result, $code);
    }

    /**
     * Возвращает массив ошибок валидации
     * @return array|\Illuminate\Support\MessageBag
     */
    private function hasErrors()
    {
        $validator = Validator::make(['key' => $this->accessKey], [
            'key' => [
                'required',
                'string',
                'size:10'
            ],
        ]);
        return ($validator->fails()) ? $validator->errors() : [];
    }
}
