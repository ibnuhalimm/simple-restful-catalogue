<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use ApiResponse;

    protected $authService;

    /**
     * Create new instance
     *
     * @param  \App\Services\AuthService  $authService
     * @return void
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Authenticate the users
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return  \Illuminate\Http\Response
     */
    public function show(LoginRequest $request)
    {
        $loginInfo = $request->only('email', 'password');
        $authResult = $this->authService->authenticate($loginInfo);

        if ($authResult) {
            $userData = $authResult['user'];

            return $this->apiResponse(200, 'Hi, ' . $userData->name, $authResult);
        }

        return $this->apiResponse(401, 'Sorry, wrong email or password.');
    }
}
