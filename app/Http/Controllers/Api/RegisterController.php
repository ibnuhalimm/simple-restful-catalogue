<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
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
     * Store new users to database
     *
     * @param  \App\Http\Requests\Auth\RegisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        $userData = $request->only('name', 'email', 'password');

        return $this->apiResponse(200, 'Success', $this->authService->register($userData));
    }
}
