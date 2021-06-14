<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;

class AuthRepository extends BaseRepository implements AuthInterface
{
    /**
     * Create new instance
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}