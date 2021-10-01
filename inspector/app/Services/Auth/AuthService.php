<?php

namespace App\Services\Auth;

use App\Services\Auth\Handlers\LoginAuthHandler;
use App\Services\Auth\Handlers\LogoutAuthHandler;
use Illuminate\Http\Request;

class AuthService
{
    /** @var LoginAuthHandler * */
    private $loginHandler;

    /** @var LogoutAuthHandler * */
    private $logoutHandler;

    /**
     * AuthService constructor.
     * @param LoginAuthHandler $loginHandler
     * @param LogoutAuthHandler $logoutHandler
     */
    public function __construct(
        LoginAuthHandler $loginHandler,
        LogoutAuthHandler $logoutHandler
    )
    {
        $this->loginHandler = $loginHandler;
        $this->logoutHandler = $logoutHandler;
    }

    /**
     * Login
     * @param Request $request
     * @param string $accessKey
     * @return bool
     */
    public function login(Request $request, string $accessKey): bool
    {
        return $this->loginHandler->handle($request, $accessKey);
    }

    /**
     * Logout
     * @param Request $request
     */
    public function logout(Request $request): void
    {
        $this->logoutHandler->handle($request);
    }
}
