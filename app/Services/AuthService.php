<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\User\AuthInterface;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    private $repo;

    /**
     * Create new instance
     *
     * @param \App\Repositories\User\AuthInterface  $repository
     * @return void
     */
    public function __construct(AuthInterface $repository)
    {
        $this->repo = $repository;
    }

    /**
     * Store new user
     *
     * @param  array  $user
     * @return array|bool
     */
    public function register(array $user)
    {
        try {
            $userData = $this->repo->create($user);

            return [
                'user' => UserResource::make($userData),
                'token' => $userData->createToken($userData->email)->plainTextToken
            ];

        } catch (\Throwable $th) {
            report($th);

            return false;
        }
    }

    /**
     * Authenticate the user
     *
     * @param  array        $loginInfo
     * @return array|bool
     */
    public function authenticate(array $loginInfo)
    {
        $email = $loginInfo['email'] ?? '';
        $password = $loginInfo['password'] ?? '';

        $user = User::where('email', $email)->first();

        if ($user && $password == $user->password) {
            return [
                'user' => UserResource::make($user),
                'token' => $user->createToken($user->email)->plainTextToken
            ];
        }

        return false;
    }
}